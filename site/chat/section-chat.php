<?php

$sql = "SELECT * FROM message left join users 
            on users.unique_id = message.receive_id 
            where ( send_id = ? and receive_id = ?) or (send_id = ? and receive_id = ?) order by time";

$allMess = pdo_get_all_rows($sql, $receiver, $_SESSION['unique_id'], $_SESSION['unique_id'], $receiver);

$sql = "SELECT * FROM users WHERE unique_id = ?";

$receiver_info = pdo_get_one_row($sql, $receiver);







?>



<div class="section-chat">

    <div class='chat-name'>
        <div id="receiver_id" data="<?php echo $receiver_info['unique_id'] ?>" hidden></div>
        <h2 class='chat-name--name'><?php echo $receiver_info['fname'] . " " . $receiver_info['lname'] ?></h2>
        <div class='chat-name--delete'>
            <i class='far fa-trash-alt'></i>Xóa lịch sử cuộc hội thoại
        </div>
    </div>
    <div class='chat-content'>
        <?php

        if (!$allMess) {
            echo "<div class='content-date'>
                    <span>Hãy bắt đầu cuộc hội thoại</span>
                    </div>";
        } else {
            $checkDay = true;
            foreach ($allMess as $mess) {
                extract($mess);

                // set up ngày tháng

                $d =  explode("-", explode(" ", $mess['time'])[0])[2];
                $h =  explode(":", explode(" ", $mess['time'])[1])[0];
                $m =  explode(":", explode(" ", $mess['time'])[1])[1];

                $nowD = date('d', time() + 3600 * 6);
                $nowH = date('H', time() + 3600 * 6);
                $nowM = date('i', time() + 3600 * 6);



                $when = "";
                $time = $nowD - $d;

                $smallTime = $h . ":" . $m;

                if ($time < 1) {
                    if ($checkDay) {
                        $when = "Hôm nay";
                        $checkDay = false;
                    }
                }
                if ($time >= 1) {
                    if ($time == 1) {
                        $when = "Hôm qua";
                    } else {
                        $tempTime = explode("-", explode(" ", $mess['time'])[0]);
                        $tempTime = array_reverse(array_slice($tempTime, 1));

                        $when = implode(" Tháng ", $tempTime);
                    }
                }




                if ($send_id == $_SESSION['unique_id']) {
                    echo "
                    <div class='content-date'>
                    <span>{$when}</span>
                    </div>
                <div class='content content-right'>
                    <span class='content-message'>$content</span>
                    <div class='small-time'>{$smallTime}</div>
                 </div>";
                } else {
                    echo "
                    <div class='content-date'>
                    <span>{$when}</span>
                    </div>
                    <div class='content content-left'>
                    <div class='content-avatar'>
                        <img src='../../images/user/$img' />
                    </div>
                        <span class='content-message'>$content</span>
                        <div class='small-time'>{$smallTime}</div>
                    </div>";
                }
            }
        }

        ?>
    </div>
    <div class='chat-write'>
        <textarea type='text' class='write-input' placeholder='Nhắn tin ở đây'></textarea>
        <div class='write-send-btn' data='$box_id'>
            <span><i class='fas fa-paper-plane'></i></span>
        </div>
    </div>

</div>



<!-- Chạy ajax load tin nhắn -->
<script>
    const chatContent = document.querySelector(".chat-content");
    const receiverId = document.querySelector("#receiver_id").getAttribute('data');
    // <!-- Scroll To bottom -->
    function scrollToBottom() {
        chatContent.scrollTop = chatContent.scrollHeight;
    }

    chatContent.addEventListener("mouseenter", function() {
        chatContent.classList.add("active");

    })
    chatContent.addEventListener("mouseleave", function() {
        chatContent.classList.remove("active");

    })

    setInterval(function() {
        const http = new XMLHttpRequest();

        http.open("post", "../../back-end/loadChatContent.php", true);
        http.onload = () => {
            if (http.readyState === XMLHttpRequest.DONE) {
                if (http.status === 200) {
                    let data = http.response;
                    chatContent.innerHTML = data;
                    if (!chatContent.classList.contains("active")) {
                        scrollToBottom();
                    }

                }
            }
        }
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("receiver=" + receiverId);
    }, 500)
</script>


<!-- Chạy ajax nhắn tin -->
<script>
    const messageInput = document.querySelector(".write-input");

    const sendBtn = document.querySelector(".write-send-btn");



    sendBtn.addEventListener("click", function() {
        let content = messageInput.value;
        const http = new XMLHttpRequest();

        http.open("post", "../../back-end/sendMessage.php", true);
        http.onload = () => {
            if (http.readyState === XMLHttpRequest.DONE) {
                if (http.status === 200) {
                    let data = http.response;
                    if (data == "success") {
                        messageInput.value = '';
                    }
                }
            }
        }
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("box_id=" + receiverId + "&content=" + content);
    })


    messageInput.addEventListener("keydown", function(event) {
        if (event.keyCode == 13 && !event.shiftKey) {

            let content = messageInput.value;
            const http = new XMLHttpRequest();

            http.open("post", "../../back-end/sendMessage.php", true);
            http.onload = () => {
                if (http.readyState === XMLHttpRequest.DONE) {
                    if (http.status === 200) {
                        let data = http.response;
                        if (data == "success") {
                            messageInput.value = '';
                        }
                    }
                }
            }
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            http.send("box_id=" + receiverId + "&content=" + content);
        } else {
            sendBtn.classList.add("active");
            if (!writeInput.value) {
                sendBtn.classList.remove("active");
            }
        }
    });
</script>
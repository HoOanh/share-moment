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
        <h2 class='chat-name--name'><?php echo $receiver_info['fname'] ." ".$receiver_info['lname'] ?></h2>
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

            foreach ($allMess as $mess) {
                extract($mess);

                if ($send_id == $_SESSION['unique_id']) {
                    echo "
                <div class='content content-right'>
                    <span class='content-message'>$content</span>
                 </div>";
                } else {
                    echo "
                    <div class='content content-left'>
                    <div class='content-avatar'>
                        <img src='../../images/user/$img' />
                    </div>
                        <span class='content-message'>$content</span>
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
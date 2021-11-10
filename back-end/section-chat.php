<?php
session_start();
require "../dao/pdo.php";
$receiver = $_POST['receiver'];
$sql = "SELECT * FROM message left join users
            on users.unique_id = message.receive_id
           where ( send_id = ? and receive_id = ?) or (send_id = ? and receive_id = ?) order by time";

$allMess = pdo_get_all_rows($sql, $receiver, $_SESSION['unique_id'], $_SESSION['unique_id'], $receiver);

$sql = "SELECT * FROM users WHERE unique_id = ?";

$receiver_info = pdo_get_one_row($sql, $receiver);
if ($receiver ===  $_SESSION['unique_id']) $name = "Cloud của tôi";
else $name = $receiver_info['fname'] . " " . $receiver_info['lname'];
?>



<div class='chat-name'>
    <div id="receiver_id" data="<?php echo $receiver_info['unique_id'] ?>" hidden></div>
    <div>
        <h2 class='chat-name--name'><?php echo $receiver_info['fname'] . " " . $receiver_info['lname'] ?><?php echo  $receiver_info['user_status'] == 'Đang hoạt động' ? "<span class='status online'> {$receiver_info['user_status']}" : "<span class='status offline'> {$receiver_info['user_status']}" ?></span></h2>

    </div>
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
            $content = nl2br($content);
            // set up ngày tháng

            $d =  explode("-", explode(" ", $mess['time'])[0])[2];
            $h =  explode(":", explode(" ", $mess['time'])[1])[0];
            $m =  explode(":", explode(" ", $mess['time'])[1])[1];

            $nowD = date('d', time() + 3600 * 6);
            $nowH = date('H', time() + 3600 * 6);
            $nowM = date('i', time() + 3600 * 6);

            $datetime1 = strtotime($mess['time']);
            $datetime2 = strtotime(date('Y/m/d H:i:s', time() + 3600 * 6));


            $when = "";
            $minus = $datetime2 - $datetime1;

            $smallTime = $h . ":" . $m;

            if ($minus < 3600 * 24) {
                if ($checkDay) {
                    $when = "Hôm nay";
                    $checkDay = false;
                }
            } else if ($minus >= 3600 * 24) {

                $tempTime = explode("-", explode(" ", $mess['time'])[0]);
                $tempTime = array_reverse(array_slice($tempTime, 1));

                $when = implode(" Tháng ", $tempTime);
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
                        <img src='../../images/user/{$receiver_info['img']}' />
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

<!-- Chạy ajax load tin nhắn -->
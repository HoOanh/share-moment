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


$output = '';


if (!$allMess) {
    $output = "<div class='content-date'>
            <span>Hãy bắt đầu cuộc hội thoại</span>
            </div>";
} else {

    $checkDay = true;
    foreach ($allMess as $mess) {
        extract($mess);


        // set up ngày tháng

        $d =  explode("-",explode(" ",$mess['time'])[0])[2];
        $h =  explode(":",explode(" ",$mess['time'])[1])[0];
        $m =  explode(":",explode(" ",$mess['time'])[1])[1];

        $nowD = date('d', time()+3600*6);
        $nowH = date('H', time()+3600*6);
        $nowM = date('i', time()+3600*6);



        $when = "";
        $time = $nowD - $d;
        $smallTime = $h. ":".$m;
    

        if ($time < 1){
            if($checkDay){
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
            $output .= "
            <div class='content-date'>
                    <span>{$when}</span>
                    </div>
        <div class='content content-right'>
            <span class='content-message'>$content</span>
            <div class='small-time'>{$smallTime}</div>
         </div>";
        } else {
            $output .= "
            <div class='content-date'>
                    <span>{$when}</span>
                    </div>
            <div class='content content-left'>
            <div class='content-avatar'>
                <img src='../../images/user/{$receiver_info['img']} ' />
            </div>
                <span class='content-message'>$content</span>
                <div class='small-time'>{$smallTime}</div>
            </div>";
        }
    }
}

echo nl2br($output);

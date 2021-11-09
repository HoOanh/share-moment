<?php
session_start();
require "../dao/pdo.php";

$box_id = $_POST['box_id'];

// Lấy thông tin của người nhận
$sql = "SELECT * from users where unique_id = ?";
$receive_user = pdo_get_one_row($sql,$box_id);

$start = "<div class='chat-name'>
<h2 class='chat-name--name'>{$receive_user['fname']} {$receive_user['lname']}</h2>
<div class='chat-name--delete'>
  <i class='far fa-trash-alt'></i>Xóa lịch sử cuộc hội thoại
</div>
</div>
<div class='chat-content'>
<div class='content-date'>
  <span>28 June, 2020</span>
</div>";



$sql = "Select * from message left join users on users.unique_id = message.send_id where (send_id = ? and receive_id = ?) or (send_id=? and receive_id=?) order by time";

$allMessages = pdo_get_all_rows($sql, $box_id, $_SESSION['unique_id'], $_SESSION['unique_id'], $box_id);



$output = '';



foreach ($allMessages as $mess) {
    extract($mess);

    if ($send_id == $_SESSION['unique_id']) {
        $output .= "
        <div class='content content-right'>
    <span class='content-message'>$content</span>
</div>";
    } else {
       
        $output .= "<div class='content content-left'>
        <div class='content-avatar'>
            <img src='../../images/user/$img' />
        </div>
        <span class='content-message'>$content</span>
    </div>";

    }
}



$end = "</div>

<div class='chat-write'>
  <textarea type='text' class='write-input' placeholder='Nhắn tin ở đây'></textarea>
  <div class='write-send-btn' data='$box_id'>
    <span><i class='fas fa-paper-plane'></i></span>
  </div>
</div>";



if(!$output){
    $output = "
    <div class='content-date'>
          <span>Hãy bắt đầu cuộc thoại này</span>
        </div>
        ";
}

$output = $start . $output .$end;

echo $output;

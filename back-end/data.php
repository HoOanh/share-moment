<?php
extract($item);
$name = $fname . " " . $lname;
$status = "";

// Lấy tin nhắn cuối cùng
$sql = "SELECT * FROM message where (send_id = ? and receive_id = ?) or (send_id = ? and receive_id = ?) order by time desc limit 1";
$lastMessage = pdo_get_one_row($sql, $_SESSION['unique_id'], $unique_id, $unique_id, $_SESSION['unique_id']);

$when = "";
if ($lastMessage) {
  // if(strlen($lastMessage['content']) >= 30){
  //   $last = substr($lastMessage['content'],0,30) + "...";
  // }
  if ($lastMessage['send_id'] == $_SESSION['unique_id']) $last = "<strong>Bạn:</strong> " . $lastMessage['content'];
  else $last = $lastMessage['content'];

  $datetime1 = strtotime($lastMessage['time']);
  $datetime2 = strtotime(date('Y/m/d H:i:s', time() + 3600 * 6));

  $time = $datetime2 - $datetime1;
  if ($time < 3600) {
    if (floor($time / 60) == 0) {
      $when = "Vừa xong";
    } else {
      $when = floor($time / 60) . " phút trước";
    }
  } else if ($time < 3600 * 24) {
    $when = floor($time / 3600) . " giờ trước";
  } else if ($time >= 3600 * 24) {
    $when = floor($time / (3600 * 24)) . " ngày trước";
  }
} else {
  $last = "Hãy bắt đầu cuộc hội thoại";
}




if ($user_status === "Đang hoạt động") $status = 'online';
$output .= "<li class='messenger__item' data=$unique_id>
 <a>
   <div class='messenger__item-avatar $status'>
     <img src='../../images/user/$img' alt='' />
   </div>
   <div class='messenger__item-by'>
     <div class='messenger__item-headline'>
       <h5>
          $name
           </h5>
       <span>{$when}</span>
     </div>
     <p>
       {$last}
     </p>
   </div>
 </a>
 </li>";

<?php
extract($item); 
$name = $fname . " " . $lname;
$status = "";
if ($unique_id === $_SESSION['unique_id']) $name = 'Cloud của tôi';
if ($user_status === "Đang hoạt động") $status = 'online';
$output .= "<li class='messenger__item' data=$unique_id>
 <a href='?receiver=$unique_id'>
   <div class='messenger__item-avatar $status'>
     <img src='../../images/user/$img' alt='' />
   </div>
   <div class='messenger__item-by'>
     <div class='messenger__item-headline'>
       <h5>
          $name
           </h5>
       <span>4 hours ago</span>
     </div>
     <p>
       laoreet dolore magna aliquam erat volutpat sed diam
       nonummy.
     </p>
   </div>
 </a>
 </li>";

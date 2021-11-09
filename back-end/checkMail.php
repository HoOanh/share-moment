<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require '../dao/pdo.php';

$output = ["data"=>""];

$email = $_POST['email'];

$email = trim(strip_tags($email));

if (!empty($email)) {
    $sql = "Select * from users where email = ?";
    $result = pdo_get_one_row($sql,$email);
    if($result){
        // requier send mail
        $output["data"] = "success";

    }else{
        $output["data"] = "Email không tồn tại";
    }
}else{
    $output["data"] ="Vui lòng nhập email";
}


// Trả về dữ liệu kiểu JSON
die(json_encode($output));




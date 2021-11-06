<?php
session_start();
require '../dao/pdo_login.php';
$user_name = $_POST['user_name'];
$pass = $_POST['pass'];

$user_name = trim(strip_tags($user_name));
$pass = trim(strip_tags($pass));

$output ="";

if (!empty($pass) && !empty($user_name)) {
    $result = login($user_name, $pass);
    if($result){
        extract($result);
        $_SESSION['unique_id'] = $unique_id;
    }else{
        $output = "Mật khẩu hoặc tài khoản sai";
    }
}else{
    $output ="Vui lòng nhập đầy đủ thông tin";
}

echo $output;

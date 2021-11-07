<?php
session_start();
require '../dao/pdo.php';
require '../dao/pdo_login.php';

$output = ["data"=>"","role"=>0];

$user_name = $_POST['user_name'];
$pass = $_POST['pass'];

$user_name = trim(strip_tags($user_name));
$pass = trim(strip_tags($pass));



if (!empty($pass) && !empty($user_name)) {
    $result = login($user_name, $pass);
    if($result){
        extract($result);
        $_SESSION['unique_id'] = $unique_id;
        $output["data"] = "success";
        if($role){
            $output["role"] = $role;
        }

        $sql = "update users set user_status = 'Đang hoạt động' where unique_id = ?";
        pdo_execute($sql,$_SESSION['unique_id']);

    }else{
        $output["data"] = "Mật khẩu hoặc tài khoản sai";
    }
}else{
    $output["data"] ="Vui lòng nhập đầy đủ thông tin";
}


// Trả về dữ liệu kiểu JSON
die(json_encode($output));

 


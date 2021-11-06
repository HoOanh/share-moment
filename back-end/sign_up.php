<?php
session_start();
require '../dao/sign-up.php';
$img =  $_FILES['img'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$gender = $_POST['gender'];
$user_name = $_POST['user_name'];
$phone =  $_POST['phone'];

$fname = trim(strip_tags($fname));
$lname = trim(strip_tags($lname));
$email = trim(strip_tags($email));
$pass = trim(strip_tags($pass));
$gender = trim(strip_tags($gender));
$user_name = trim(strip_tags($user_name));
$phone = trim(strip_tags($phone));


$output = '';
if (!empty ($fname) && !empty ($lname) && !empty ($email) && !empty ($pass) && !empty ($gender) && !empty ($phone) && !empty ($user_name)  ) {
    if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
        // kiểm tra email đã tồn tại hay chưa
        $checkEmail = checkEmail($email);
        if($checkEmail !== []){
            $output = "$email - đã tồn tại !";
        }else{
            // check ảnh
            if (isset($_FILES['img'])) {
               $img_name = $_FILES['img']['name']; //lấy tên ảnh
               $img_type = $_FILES['img']['type']; // lấy loại ảnh
               $img_tmp_name = $_FILES['img']['tmp_name']; // day la file de upload anh
               
            //  kiểm tra nhr có phù hợp hay ko
               $img_explode = explode('.', $img_name); // hàm explode trả về mảng ngăn cách bằng dấu chấm

               $img_ext = strtolower(end($img_explode)) ; // lay phan mo rong cua file upload

               $duoi_cua_anh = ['png','jpeg','jpg'];
               if(in_array($img_ext,$duoi_cua_anh)=== true){
                    $time = time(); // ta
                    $final_img = $time.$img_name;
                    
                    if(move_uploaded_file($img_tmp_name,"../images/user/".$final_img)){
                        $user_status = "Đang hoạt động";
                        $random_id = rand(time(),10000000);

                        // lua user
                        $addUser = addUser($random_id,$fname,$lname,$email,$pass,$final_img,$user_status,$gender,$phone,$user_name);
                        if($addUser){
                            $getUser = getUser('email',$email);
                            if($getUser){
                                $_SESSION['unique_id'] = $getUser['unique_id'];
                            }
                        }else{
                            $output = "Đăng ký không thành công !";
                        }
                    }else{
                        $output = "Hãy chọn lại ảnh!";
                    }
               }else{
                   $output = "Ảnh phải thuộc kiểu: png - jpeg - jpg";
               }
            } else {
                $output = "Vui lòng chọn ảnh đại diện !";
            }
            
        }

    } else {
        $output = "$email - không hợp lệ!";
    }
    
} else {
   $output = "Vui lòng nhập đầy đủ thông tin!";
}
echo $output ;


?>
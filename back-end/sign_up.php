<?php
session_start();
require '../dao/pdo.php';
require '../dao/pdo_sign-up.php';

$output = ["data" => "", "role" => 0];

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



if (!empty($fname) && !empty($lname) && !empty($email) && !empty($pass) && !empty($phone) && !empty($user_name)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Kiểm tra số điện thoại có hợp lệ hay không
        if (preg_match('/\d{10}/', $phone)) {

            // kiểm tra email đã tồn tại hay chưa
            $checkEmail = checkEmail($email);
            if ($checkEmail !== []) {
                $output["data"] = "$email - đã tồn tại !";
            } else {
                // check ảnh
                if (isset($_FILES['img'])) {
                    $img_name = $_FILES['img']['name']; //lấy tên ảnh
                    $img_type = $_FILES['img']['type']; // lấy loại ảnh
                    $img_tmp_name = $_FILES['img']['tmp_name']; // day la file de upload anh

                    //  kiểm tra nhr có phù hợp hay ko
                    $img_explode = explode('.', $img_name); // hàm explode trả về mảng ngăn cách bằng dấu chấm

                    $img_ext = strtolower(end($img_explode)); // lay phan mo rong cua file upload

                    $duoi_cua_anh = ['png', 'jpeg', 'jpg'];
                    if (in_array($img_ext, $duoi_cua_anh) === true) {
                        $time = time(); // ta
                        $final_img = $time . $img_name;

                        if (move_uploaded_file($img_tmp_name, "../images/user/" . $final_img)) {
                            $user_status = "Đang hoạt động";
                            $random_id = rand(time(), 10000000);

                            // lua user
                            $addUser = addUser($random_id, $fname, $lname, $email, $pass, $final_img, $user_status, $gender, $phone, $user_name);
                            if ($addUser) {
                                $getUser = getUser('email', $email);
                                if ($getUser) {
                                    $_SESSION['unique_id'] = $getUser['unique_id'];
                                    $output["data"] = "success";
                                }
                            } else {
                                $output["data"] = "Đăng ký không thành công !";
                            }
                        } else {
                            $output["data"] = "Hãy chọn lại ảnh!";
                        }
                    } else {
                        $output["data"] = "Ảnh phải thuộc kiểu: png - jpeg - jpg";
                    }
                } else {
                    $output["data"] = "Vui lòng chọn ảnh đại diện !";
                }
            }
        } else {
            $output["data"] = "Số điện thoại không hợp lệ!";
        }
    } else {
        $output["data"] = "Email không hợp lệ!";
    }
} else {
    $output["data"] = "Vui lòng nhập đầy đủ thông tin!";
}

// Trả về dữ liệu kiểu JSON

die(json_encode($output));

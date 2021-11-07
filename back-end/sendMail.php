<?php

$email = $_POST['email'];
$output = ["data"=>""];
require "../vendor/phpmailer/Exception.php";
require "../vendor/phpmailer/PHPMailer.php";
require "../vendor/phpmailer/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


$encode_mail = sha1($email);

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = "true";
$mail->SMTPSecure = "tls";
$mail->Port = "587";
$mail->Username = "sharemoment.offical@gmail.com";
$mail->Password = "123456Seven@";
$mail->Subject = "Reset password";
$mail->setFrom("sharemoment.offical@gmail.com");
$mail->isHTML(true);

$mail->Body = "<h1 style='color:#10b981'>Xin chào, đây là Sharemoment!</h1><a style='color:#000' href='https://localhost/share-moment/site/login/?action=inputPass&token=$encode_mail'>Nhấp vào đây để đổi mật khẩu</a>";
$mail->addAddress($email);

if ($mail->Send()) {
    $output["data"] = "success";
} else {
    $output["data"] = "Đã xảy ra lỗi trong quá trình gửi mail";
};
$mail->smtpClose();


die(json_encode($output));

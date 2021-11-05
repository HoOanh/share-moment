<?php
require_once '../dao/sign-up.php';

$email = $_GET['email'];


$u = checkEmail($email);

if ($u === []) {
    echo 'sai';
} 



?>

<span><?=$u['email']?></span>
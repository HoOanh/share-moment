<?php
session_start();
require '../dao/pdo.php';

$input = $_POST['searchValue'];
$value = "%$input%";

$sql = 'SELECT * FROM users WHERE (fname LIKE ? OR lname LIKE ?) and unique_id != ?';
$allResult = pdo_get_all_rows($sql, $value, $value,$_SESSION['unique_id']);

$output = "";

if (!$allResult) {
    $output = "<p style = 'text-align: center; font-size: 2rem; padding: 2rem;'>Không tìm thấy tài khoản nào</p>";
} else {
    foreach ($allResult as $item) {
        require 'data.php';
    }
}

echo $output;

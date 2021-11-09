<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: ../login");
}

require "../../dao/pdo.php";

$sql = "SELECT * FROM users WHERE unique_id = ?";
$user = pdo_get_one_row($sql, $_SESSION['unique_id']);
extract($user);

$VIEW_NAME = "chat.php";

include "../index.php";

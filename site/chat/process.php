<?php 
    session_start();
    require "../../dao/pdo.php";
    if(isset($_GET['logout'])){

        $sql = "update users set user_status = 'Offline' where unique_id = ?";
        pdo_execute($sql,$_SESSION['unique_id']);
        unset($_SESSION['unique_id']);
        header("location: ../login");
    }
?>
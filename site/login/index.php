<?php 
     

    $VIEW_NAME = "login.php";

    if(isset($_GET['action'])){

        if($_GET['action'] == "inputEmail"){
            
            $VIEW_NAME = "inputEmail.php";
        }
        if($_GET['action'] == "inputPass"){
            
            $VIEW_NAME = "inputPass.php";
        }
    }

    include "../index.php";



?>
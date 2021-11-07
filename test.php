<?php 
require "dao/pdo.php";

    function getUser($field,$email){
        $sql = "SELECT * FROM users WHERE ". $field ." = ? ";
      
        return pdo_get_one_row($sql,$email);
    }
echo "tao nef";
print_r(getUser("email","admin2@gmail.com"));

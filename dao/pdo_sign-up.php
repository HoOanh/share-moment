<?php


function checkEmail($email){
    $sql = " SELECT email FROM users WHERE email = '{$email}' ";
    return pdo_get_all_rows($sql);
}



function addUser($random_id,$fname,$lname,$email,$pass,$final_img,$user_status,$gender,$phone,$user_name){
    $sql = " INSERT INTO users (unique_id, fname, lname, email, pass, img, user_status,gender,  phone, user_name) 
            VALUE ({$random_id}, '{$fname}','{$lname}','{$email}','{$pass}','{$final_img}','{$user_status}' , '{$gender}' ,'{$phone}','{$user_name}' )";
     return pdo_execute($sql);
    
}

function getUser($field,$email){
    $sql = "SELECT * FROM users WHERE ". $field ." = ? ";
    return pdo_get_one_row($sql,$email);
}
?>
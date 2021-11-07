<?php


function login($username,$password){
$sql = "SELECT * FROM users where user_name = ? and pass = ?";
return pdo_get_one_row($sql,$username,$password);
}
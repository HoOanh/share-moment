<?php
session_start();
require '../dao/pdo.php';

// get user
$sql1 = "SELECT * FROM users";
$listUsers = pdo_get_all_rows($sql1);
$output = "";

foreach ($listUsers as $item) {
  if($item['unique_id'] == $_SESSION['unique_id']){
    continue;
  }
  require 'data.php';
}

echo $output;

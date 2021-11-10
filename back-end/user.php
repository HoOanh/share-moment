<?php
session_start();
require '../dao/pdo.php';

// get user
$sql1 = "SELECT  * , MAX(time) as timeMess FROM users LEFT JOIN message
                ON (users.unique_id = message.receive_id)
                OR (users.unique_id = message.send_id)
                group by users.unique_id
                ORDER BY timeMess DESC";
$listUsers = pdo_get_all_rows($sql1);
$output = "";

foreach ($listUsers as $item) {
  if ($item['unique_id'] == $_SESSION['unique_id']) {
    continue;
  }
  require 'data.php';
}

echo $output;

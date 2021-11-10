<?php 
    session_start();

    require "../dao/pdo.php";

    $box_id = $_POST['box_id'];
    $content = trim($_POST['content']);
    $time = date('Y/m/d H:i:s', time()+3600*6);

    $sql = "INSERT INTO message (send_id, receive_id, content, time) VALUES(?,?,?,?)";

    if(pdo_execute($sql,$_SESSION['unique_id'],$box_id,$content,$time)){
        echo "success";
    }
    

?>
<?php
    require_once('config.php');
    $data = $_POST['id'];
    $sql = "delete from todo_details where list_id=$data";
    $result = mysqli_query($con,$sql);
    if($result){
echo true;
    }

?>
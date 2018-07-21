<?php
    require_once('config.php');
    $data = $_POST['id'];
    $sql_status = "select * from todo_details where list_id=$data";
    $result_status = mysqli_query($con,$sql_status);
    while ($row =  mysqli_fetch_assoc($result_status)){
        $status = $row['status'];
    }
    if($status=='open'){
        $sql = "update todo_details SET status='close' where list_id=$data";
        $result = mysqli_query($con,$sql);
    }else{
        $sql = "update todo_details SET status='open' where list_id=$data";
        $result = mysqli_query($con,$sql);       
    }
    if($result){
echo true;
    }

?>
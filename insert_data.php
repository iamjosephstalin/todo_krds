<?php
    require_once('config.php');
    $data = $_POST['input'];

    $sql = "insert into todo_details (description) values('$data')";
    $result = mysqli_query($con,$sql);
    //var_dump($sql);
    if($result){
        $_SESSION['success'] = true;
        header("location: index.php");
    }

?>
<?php
$username = "hvudwjwnphvjrv"; 
$password = "c2ad91ad54554d325757a0322c1d16fa884387a8e059129e3200777af5154b48"; 
$host = "ec2-54-204-18-53.compute-1.amazonaws.com"; 
$dbname = "d6sk1vp3k6ctg"; 

$con = mysqli_connect($host,$username,$password,$dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
// echo "Connected successfully";
?>

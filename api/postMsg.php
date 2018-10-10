<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
require_once('includes/commonvars.php'); 


$user=$_POST['username'];
$room=$_POST['room'];
$msg=$_POST['msg'];
$time = date("y/m/d");

$getLast = mysqli_query($con,"SELECT * from $chatTable ORDER BY id DESC LIMIT 1");
$lastId = mysqli_fetch_assoc($getLast);
$indexNo = $lastId['id'] + 1;

$sqlquery="INSERT INTO $chatTable (room, user, msg, time,id) VALUES ('$room','$user','$msg', now(), $indexNo)";
mysqli_query($con,$sqlquery) or die("Query to insert new record to firsttable failed with this error: ".mysql_error());
?>
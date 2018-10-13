<?php
header('Access-Control-Allow-Origin: *');
require_once('includes/commonvars.php'); 

$oldVal=$_GET['oldvalue'];
$newVal=$_GET['newvalue'];
$room=$_GET['room'];
$time = date("y/m/d");
$msg = "";

$getLast = mysqli_query($con,"SELECT * from $chatTable ORDER BY id DESC LIMIT 1");
$lastId = mysqli_fetch_assoc($getLast);
$indexNo = $lastId['id'] + 1;

if(strlen($newVal) > 0){
    $msg=$newVal." has entered the room";
}
else{
    $msg=$oldVal." has left the room";
}

$sqlquery="INSERT INTO $chatTable (room, user, msg, time,id) VALUES ('$room','ChatBot','$msg', now(), $indexNo)";
mysqli_query($con,$sqlquery) or die("Query to insert new record to firsttable failed with this error: ".mysql_error());

//delete extra entries
require_once('includes/delete.php');
?>
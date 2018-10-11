<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
require_once('includes/commonvars.php'); 
$chatLengthLimit = 50;


$user=$_POST['username'];
$room=$_POST['room'];
$msg=clean($_POST['msg']);
$time = date("y/m/d");

$getLast = mysqli_query($con,"SELECT * from $chatTable ORDER BY id DESC LIMIT 1");
$lastId = mysqli_fetch_assoc($getLast);
$indexNo = $lastId['id'] + 1;

$sqlquery="INSERT INTO $chatTable (room, user, msg, time,id) VALUES ('$room','$user','$msg', now(), $indexNo)";
mysqli_query($con,$sqlquery) or die("Query to insert new record to firsttable failed with this error: ".mysql_error());

//delete extra entries
$result = mysqli_query($con,"SELECT COUNT(*) from $chatTable");
$row = mysqli_fetch_assoc($result);
$numberOfEntries = $row['COUNT(*)'];
if($numberOfEntries > $chatLengthLimit){
    $numberToDelete = $numberOfEntries - $chatLengthLimit;
    mysqli_query($con,"DELETE FROM $chatTable ORDER BY id ASC LIMIT $numberToDelete");
}
?>
<?php
header('Access-Control-Allow-Origin: *');
require_once('includes/commonvars.php');

$vidId = $_GET['vidId'];
$vidLength = $_GET['vidLength'];
$vidName = $_GET['vidName'];
$vidCreator = $_GET['vidCreator'];
$submitedBy = $_GET['username'];

$result = mysqli_query($con,"SELECT COUNT(*) from $vidTable");
$row = mysqli_fetch_assoc($result);
$vidNum = $row['COUNT(*)'];

$sqlquery="INSERT INTO $vidTable (vidID, currentTime, vidNo, submitedBy,vidLength,vidCreator,vidTitle) VALUES ('$vidId',0,'$vidNum','$submitedBy','$vidLength','$vidCreator','$vidName')";
mysqli_query($con,$sqlquery) or die("Query to insert new record to firsttable failed with this error: ".mysql_error());
//mysqli_close($con);

echo "success";
?>
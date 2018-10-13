<?php
header('Access-Control-Allow-Origin: *');
require_once('includes/commonvars.php'); 
$time = date("Y-m-d H:i:s");

$user=$_GET['username'];

mysqli_query($con,"UPDATE $memberTable SET lastCheckin = '$time', online=1 WHERE user = '$user'");
mysqli_close($con);
?>
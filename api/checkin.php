<?php
header('Access-Control-Allow-Origin: *');
require_once('includes/commonvars.php'); 

$user=$_GET['username'];

mysqli_query($con,"UPDATE $memberTable SET lastCheckin = now() WHERE user = '$user'");
mysqli_close($con);
?>
<?php
header('Access-Control-Allow-Origin: *');
require_once('includes/commonvars.php'); 
$time = date("Y-m-d H:i:s");
$user=$_GET['username'];
$currentVidTime = 0;
$isHost = false;
if(isset($_GET['currentVidTime'])){
    $currentVidTime=$_GET['currentVidTime'];
}

$searchForHost = mysqli_query($con, "SELECT * FROM $memberTable WHERE host= '1' AND user= '$user'");
while($rowS = mysqli_fetch_assoc($searchForHost)){
    $isHost = true;
}

mysqli_query($con,"UPDATE $memberTable SET lastCheckin = '$time', online=1 WHERE user = '$user'");
if($isHost){
    mysqli_query($con,"UPDATE $vidTable SET currentTime = '$currentVidTime' WHERE vidNo = '0'");
}
include('checkHost.php');
mysqli_close($con);
?>
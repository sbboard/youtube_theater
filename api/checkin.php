<?php
header('Access-Control-Allow-Origin: *');
require_once('includes/commonvars.php'); 
$time = date("Y-m-d H:i:s");
$user=$_GET['username'];
$currentVidTime = 0;
$isHost = false;
$currentVid=$_GET['currentVid'];
$vidExists = false;

if(isset($_GET['currentVidTime'])){
    $currentVidTime=$_GET['currentVidTime'];
}

$searchForHost = mysqli_query($con, "SELECT * FROM $memberTable WHERE host= '1' AND user= '$user'");
while($rowS = mysqli_fetch_assoc($searchForHost)){
    $isHost = true;
}

//update last checkin
mysqli_query($con,"UPDATE $memberTable SET lastCheckin = '$time', online=1 WHERE user = '$user'");

//host responsibilities
if($isHost){
    mysqli_query($con,"UPDATE $vidTable SET currentTime = '$currentVidTime' WHERE vidNo = '0'");

    //check votes
    //get number of people
    //get number of downvotes
    //if downvotes is greater than half of people
    //delete video from queue
}

$vidExistsStill = mysqli_query($con, "SELECT * FROM $vidTable WHERE vidID = '$currentVid'");
while($vidExistsQuery = mysqli_fetch_assoc($vidExistsStill)){
    $vidExists = true;
}
if($vidExists == true){
    echo "false";
}
else{
    echo "true";
}
//idk something to trigger that the video has been deleted
//return true
include('checkHost.php');
mysqli_close($con);
?>
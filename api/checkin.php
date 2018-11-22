<?php
header('Access-Control-Allow-Origin: *');
require_once('includes/commonvars.php'); 
$time = date("Y-m-d H:i:s");
$user=$_GET['username'];
$currentVidTime = 0;
$isHost = false;
$currentVid=$_GET['currentVid'];
$vidExists = false;
$downVotes = 0;
$totalBoys = 1;
$killedStatus = false;
$placeholder = $_GET['placeholder'];
if(isset($_GET['currentVidTime'])){
    $currentVidTime=$_GET['currentVidTime'];
}

//check if host exists
$searchForHost = mysqli_query($con, "SELECT * FROM $memberTable WHERE host= '1' AND user= '$user'");
while($rowS = mysqli_fetch_assoc($searchForHost)){
    $isHost = true;
}

//update last checkin
mysqli_query($con,"UPDATE $memberTable SET lastCheckin = '$time', online=1 WHERE user = '$user'");

//host responsibilities
if($isHost){
    //update current time
    mysqli_query($con,"UPDATE $vidTable SET currentTime = '$currentVidTime' WHERE vidNo = '0'");

    //get number of people
    $pplQuery = mysqli_query($con,"SELECT COUNT(*) from $memberTable WHERE online='1'");
    $rowPpl = mysqli_fetch_assoc($pplQuery);
    $totalBoys = $rowPpl['COUNT(*)'];

    //get number of downvotes
    
    $downVoteGet = mysqli_query($con,"SELECT downvote FROM $vidTable WHERE vidNo='0'");
    $downRow = mysqli_fetch_assoc($downVoteGet);
    $downVotes = $downRow['downvote'];

    //if downvotes is greater than half of people delete video from queue
    if($downVotes >= $totalBoys/2){
        $deleteRun = mysqli_query($con,"SELECT * FROM $vidTable WHERE vidID = '$currentVid' AND vidNo = 0");
        while($rowR = mysqli_fetch_array($deleteRun)){
            mysqli_query($con,"DELETE FROM $vidTable WHERE vidID = '$currentVid' AND vidNo = 0");
            mysqli_query($con,"UPDATE $vidTable SET vidNo = vidNo - 1");
        }
    }
}

$vidExistsStill = mysqli_query($con, "SELECT * FROM $vidTable WHERE vidID = '$currentVid'");
while($vidExistsQuery = mysqli_fetch_assoc($vidExistsStill)){
    $vidExists = true;
}
if($vidExists == true){
    $killedStatus = "false";
}
else{
    if($currentVid != $placeholder){
        $killedStatus = "true";
    }
    else{
        $killedStatus = "false";
    }
}
echo "{\"killed\":\"".$killedStatus."\", \"downvotes\":\"".$downVotes."\"}";

include('checkHost.php');
mysqli_close($con);
?>
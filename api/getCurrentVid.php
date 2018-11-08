<?php
header('Access-Control-Allow-Origin: *');
require_once('includes/commonvars.php');

$roomNo=$_GET['room'];
$currentVid="";
$nextVidFound = false;

$result = mysqli_query($con,"SELECT * FROM $vidTable WHERE vidNo = 0");
while($row = mysqli_fetch_array($result)){
        $currentVid.="{\"currentVid\": \"".$row['vidID']."\", ";
        $currentVid.="\"currentTime\": \"".$row['currentTime']."\"";
}
$result = mysqli_query($con,"SELECT * FROM $vidTable WHERE vidNo = 1");
while($row = mysqli_fetch_array($result)){
    $nextVidFound = true;
    $currentVid.=", \"nextVid\": \"".$row['vidID']."\"";
    $currentVid.="}";
}

if($nextVidFound === false){
    $currentVid.="}";
}

mysqli_close($con);
echo $currentVid;
?>
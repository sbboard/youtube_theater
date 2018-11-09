<?php
header('Access-Control-Allow-Origin: *');
require_once('includes/commonvars.php');

$endedVid = $_GET['endedVid'];
$currentVid = "";

//delete ended vid
$deleteRun = mysqli_query($con,"SELECT * FROM $vidTable WHERE vidID = '$endedVid' AND vidNo = 0");
while($rowR = mysqli_fetch_array($deleteRun)){
    mysqli_query($con,"DELETE FROM $vidTable WHERE vidID = '$endedVid' AND vidNo = 0");
    mysqli_query($con,"UPDATE $vidTable SET vidNo = vidNo - 1");

}

$currentVid="";
$result = mysqli_query($con,"SELECT * FROM $vidTable WHERE vidNo = 1");
while($row = mysqli_fetch_array($result)){
    $currentVid.=$row['vidID'];
}

mysqli_close($con);
echo $currentVid;
?>
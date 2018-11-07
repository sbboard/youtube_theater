<?php
header('Access-Control-Allow-Origin: *');
require_once('includes/commonvars.php');

$vidId = $_GET['vidId'];
$vidLength = $_GET['vidLength'];
$vidName = clean($_GET['vidName']);
$vidCreator = clean($_GET['vidCreator']);
$submitedBy = $_GET['username'];

$result = mysqli_query($con,"SELECT COUNT(*) from $vidTable");
$row = mysqli_fetch_assoc($result);
$vidNum = $row['COUNT(*)'];
$dupeVid = true;

$sql="SELECT * FROM $vidTable WHERE vidID = '$vidId'";
if ($result=mysqli_query($con,$sql)){
    // Return the number of rows in result set
    $rowcount=mysqli_num_rows($result);
    if($rowcount > 0){
        $dupeVid = true;
    }
    else{
        $dupeVid = false;
    }
}

if($dupeVid){
    echo "video already in queue";
}
elseif($vidNum > 9){
    echo "queue is full";
}
else{
    $sqlquery="INSERT INTO $vidTable (vidID, currentTime, vidNo, submitedBy,vidLength,vidCreator,vidTitle) VALUES ('$vidId',0,'$vidNum','$submitedBy','$vidLength','$vidCreator','$vidName')";
    mysqli_query($con,$sqlquery) or die("Query to insert new record to firsttable failed with this error: ".mysql_error());
    //mysqli_close($con);
    echo "success";
}
?>
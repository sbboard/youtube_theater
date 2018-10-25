<?php
header('Access-Control-Allow-Origin: *');
require_once('includes/commonvars.php');

$endedVid = $_GET['endedVid'];


//if vid is still there{
//delete vid
//move vids up
//}

//return top vid

//////
// Temporarily just loads the second vid in the thing.
// This wont work after deletion.
//////
$currentVid="";
$result = mysqli_query($con,"SELECT * FROM $vidTable WHERE vidNo = 1");
while($row = mysqli_fetch_array($result)){
    $currentVid.=$row['vidID'];
}

mysqli_close($con);
echo $currentVid;
?>
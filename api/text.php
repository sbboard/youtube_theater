<?php
header('Access-Control-Allow-Origin: *');
require_once('includes/commonvars.php'); 
require_once('includes/logout.php');

$roomNo=$_GET['room'];

$json="";
$json.="{";
$json.="\"chatlog\":[";
//select entire table

$result = mysqli_query($con,"SELECT * FROM $chatTable WHERE room = '$roomNo'");
while($row = mysqli_fetch_array($result)){
        $json.="{\"username\":\"".$row['user']."\", \"message\":\"".$row['msg']."\", \"time\":\"".$row['time']."\", \"id\":\"".$row['id']."\"},";
}
mysqli_close($con);
$json=rtrim($json,',');
$json.="]}";

echo $json;

?>
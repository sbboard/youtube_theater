<?php
header('Access-Control-Allow-Origin: *');
require_once('includes/commonvars.php');

$roomNo=$_GET['room'];

$json="";
$json.="{";
$json.="\"online\":[";
//select entire table

$result = mysqli_query($con,"SELECT * FROM $memberTable WHERE online = 1");
while($row = mysqli_fetch_array($result)){
        $json.="{\"username\":\"".$row['user']."\"},";
}
mysqli_close($con);
$json=rtrim($json,',');
$json.="]}";

echo $json;

?>
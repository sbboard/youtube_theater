<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
require_once("includes/commonvars.php");

$hostFound = false;

$searchForHost = mysqli_query($con, "SELECT * FROM $memberTable WHERE host= '1' AND online= '1'");
while($rowS = mysqli_fetch_assoc($searchForHost)){
    $hostFound = true;
}
if(!$hostFound){
    mysqli_query($con,"UPDATE $memberTable SET host = '0'");
    mysqli_query($con,"UPDATE $memberTable SET host= '1' WHERE user = '$username'");
}

?>
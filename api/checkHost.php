<?php
require_once("includes/commonvars.php");

$hostFound = false;
if(!isset($username)){
    $username = $user;
}

$searchForHost = mysqli_query($con, "SELECT * FROM $memberTable WHERE host= '1' AND online= '1'");
while($rowS = mysqli_fetch_assoc($searchForHost)){
    $hostFound = true;
}
if(!$hostFound){
    mysqli_query($con,"UPDATE $memberTable SET host = '0'");
    mysqli_query($con,"UPDATE $memberTable SET host= '1' WHERE user = '$username'");
}

?>
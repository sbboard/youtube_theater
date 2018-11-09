<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
require_once("includes/commonvars.php");

$error = null;
$password = $_POST['password'];
$username = clean($_POST['username']);
$savedpass = null;
$foundUsername = false;
$hostFound = false;

$result = mysqli_query($con, "SELECT * FROM $memberTable WHERE user='$username'");
while($row = mysqli_fetch_assoc($result)){
    $foundUsername = true;
    $savedpass = $row['password'];

    $searchForHost = mysqli_query($con, "SELECT * FROM $memberTable WHERE host= '1' AND online= '1'");
    while($rowS = mysqli_fetch_assoc($searchForHost)){
        $hostFound = true;
    }
    if(!$hostFound){
        mysqli_query($con,"UPDATE $memberTable SET host = '0'");
        mysqli_query($con,"UPDATE $memberTable SET host= '1' WHERE user = '$username'");
    }
}
if($foundUsername){
    if(!password_verify($password,$savedpass)){
        $error = "Password incorrect";
    }
}
else{
    $error = "Username not found";
}
mysqli_close($con);
echo $error;
?>
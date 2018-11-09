<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
require_once("includes/commonvars.php");

$error = null;
$password = $_POST['password'];
$username = clean($_POST['username']);
$savedpass = null;
$foundUsername = false;

$result = mysqli_query($con, "SELECT * FROM $memberTable WHERE user='$username'");
while($row = mysqli_fetch_assoc($result)){
    $foundUsername = true;
    $savedpass = $row['password'];
    include('checkHost.php');
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
<?php
require_once("includes/commonvars.php");

$returnMsg = "";
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$username = clean($_POST['username']);

//check for dupe usernames
$result = mysqli_query($con,"SELECT * from $memberTable");
while($row = mysqli_fetch_assoc($result)){
    if($row['user'] == $username){
        $returnMsg = "Username already exists.";
    }
}
if($returnMsg==""){
        //get indexNo
        $getLast = mysqli_query($con,"SELECT * from $memberTable ORDER BY id DESC LIMIT 1");
        $lastId = mysqli_fetch_assoc($getLast);
        $indexNo = $lastId['id'] + 1;

        $sqlquery="INSERT INTO $memberTable (user, password, id) VALUES ('$username', '$password', '$indexNo')";
        mysqli_query($con,$sqlquery) or die("Query to insert new record to firsttable failed with this error: ".mysql_error()); 
        $newVal = $username;
        $room="1";
        include("logMsg.php");
        $returnMsg="success";
} 

echo $returnMsg;
mysqli_close($con);
?>
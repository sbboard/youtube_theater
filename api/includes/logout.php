<?php
require_once('commonvars.php'); 
$d2 = date("Y-m-d H:i:s", time() - 10);

$statCheck = mysqli_query($con,"SELECT * FROM $memberTable WHERE online=1");
while($row = mysqli_fetch_array($statCheck)){
        if($row['lastCheckin'] < $d2){
            $username = $row['user'];
            mysqli_query($con,"UPDATE $memberTable SET online = 0 WHERE user = '$username'");
        }
}

//delete extra entries
//require_once('delete.php');
?>
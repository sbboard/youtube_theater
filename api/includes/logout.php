<?php
require_once('commonvars.php'); 
$d2 = date("Y-m-d H:i:s", time() - 5);

$statCheck = mysqli_query($con,"SELECT * FROM $memberTable WHERE online=1");
while($row = mysqli_fetch_array($statCheck)){
        if($row['lastCheckin'] < $d2){
            $oldVal=$row['user'];
            $newVal="";
            $room="1";
            include('logMsg.php');
        }
}
?>
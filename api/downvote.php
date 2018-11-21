<?php
header('Access-Control-Allow-Origin: *');
require_once('includes/commonvars.php'); 

$direction=$_GET['instructions'];
if($direction=="downvote"){
    //add downvote
    mysqli_query($con,"UPDATE video SET downvote = downvote + 1 WHERE vidNo = 0");
    echo "true";
}
elseif($direction=="fix"){
    mysqli_query($con,"UPDATE video SET downvote = downvote - 1 WHERE vidNo = 0");
    echo "false";
}
else{
    echo "UM";
}
?>
<?php
header('Access-Control-Allow-Origin: *');
require_once('includes/commonvars.php'); 

$direction=$_GET['direction'];
if($direction=="downvote"){
    //add downvote
    echo "true";
}
elseif($direction=="fix"){
    //remove downvote
    echo "false";
}
else{
    echo "UM";
}
?>
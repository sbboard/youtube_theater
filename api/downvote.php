<?php
header('Access-Control-Allow-Origin: *');
require_once('includes/commonvars.php'); 

$direction=$_GET['direction'];
if($direction=="downvote"){
    //add downvote
}
elseif($direction=="fix"){
    //remove downvote
}
else{
    echo "UM";
}
?>
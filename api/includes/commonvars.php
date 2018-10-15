<?php
//SQL Details
require_once('includes/secretvars.php'); 
$mysqlserver="localhost";
$dbname = 'youtube';
$memberTable = 'members';
$chatTable = 'chatlog';
$vidTable = 'video';
$con=mysqli_connect($mysqlserver,$mysqlusername, $mysqlpassword,$dbname);

function clean($string) {
    $string = trim($string," ");
    $string = addslashes($string);
    return $string;
}
?>
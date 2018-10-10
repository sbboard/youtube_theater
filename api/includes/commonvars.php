<?php
//SQL Details
require_once('includes/secretvars.php'); 
$mysqlserver="localhost";
$dbname = 'youtube';
$con=mysqli_connect($mysqlserver,$mysqlusername, $mysqlpassword,$dbname);
$tablename = 'members';

function clean($string) {
    $string = trim($string," ");
    $string = addslashes($string);
    return $string;
}
?>
<?php
//SQL Details
require_once('/api/includes/secretvars.php'); 
$mysqlserver="localhost";
$con=mysqli_connect($mysqlserver,$mysqlusername, $mysqlpassword,$dbname);
$tablename = 'members';
$dbname = 'youtube';

//1 is red
//2 is blue
//3 is both

function clean($string) {
    $string = trim($string," ");
    $string = addslashes($string);
    return $string;
}
?>
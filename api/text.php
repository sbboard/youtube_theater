<?php
header('Access-Control-Allow-Origin: *');
require_once('includes/commonvars.php'); 

//select entire table
$result = mysqli_query($con,"SELECT * FROM ".$tablename);

while($row = mysqli_fetch_array($result)){
        $test = $row['user'];
}

mysqli_close($con);

//return $test;
return "ok";
?>
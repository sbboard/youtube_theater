<?php
require_once('includes/commonvars.php');

$room=$_GET['room'];

$result = mysqli_query($con,"SELECT COUNT(*) from $vidTable");
$row = mysqli_fetch_assoc($result);
$indexNo = $row['COUNT(*)'];
echo $indexNo;

mysqli_close($con);
?>
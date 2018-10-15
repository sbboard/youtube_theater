<?php
require_once('includes/commonvars.php'); 
$chatLengthLimit = 100;

$result = mysqli_query($con,"SELECT COUNT(*) from $chatTable");
$row = mysqli_fetch_assoc($result);
$numberOfEntries = $row['COUNT(*)'];
if($numberOfEntries > $chatLengthLimit){
    $numberToDelete = $numberOfEntries - $chatLengthLimit;
    mysqli_query($con,"DELETE FROM $chatTable ORDER BY id ASC LIMIT $numberToDelete");
}

?>
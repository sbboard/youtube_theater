<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
require_once('includes/commonvars.php');

$username=$_GET['name'];

$sql="SELECT * FROM $memberTable WHERE user = '$username'";

if ($result=mysqli_query($con,$sql)){
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  if($rowcount > 0){
      echo "false";
  }
  else{
      echo "true";
  }
}

mysqli_close($con);
?>
<?php
// Create connection
$con=mysqli_connect("68.178.143.11","multitube","Number1pass!","multitube");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
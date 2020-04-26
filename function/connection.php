<?php
 $host = 'localhost';
 $user = 'root';
 $pass = '';
 $db = 'test';
$conn = new mysqli($host, $user, $pass, $db);
if($conn->connect_error) 
  die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

return $conn;
?>
<?php
$mysqli = new mysqli("localhost","root","Dannysql110","php_beginner_crud_level_1");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>
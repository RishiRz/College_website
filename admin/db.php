<?php
// Start session safely FIRST
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$conn = mysqli_connect("localhost", "root", "", "college_db");

if (!$conn) {
  die("Database connection failed");
} else {
  // optional debug
  //echo "connected successfully";
}

?>

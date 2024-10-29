<?php
// Database connection settings
$hname = 'localhost';  // Usually "localhost" for XAMPP
$uname = "root";         // Default XAMPP username
$pass = "";             // Default XAMPP password (empty)
$db = 'nepali_stay';  

// Create connection
$conn = mysqli_connect($hname, $uname, $pass, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

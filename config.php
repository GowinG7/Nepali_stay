<?php
// Database connection settings
$servername = "localhost";  // Usually "localhost" for XAMPP
$username = "root";         // Default XAMPP username
$password = "";             // Default XAMPP password (empty)
$dbname = "nepali_stay";  // Replace with your actual database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

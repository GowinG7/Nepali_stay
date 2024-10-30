<?php
// Database credentials
//$hostname = "localhost"; //servername and hostname are same
$servername = "localhost";   // Typically 'localhost' for a local server
$username = "root";          // Database username, often 'root' for local dev
$password = "";              // Database password, keep blank if no password is set
$dbname = "nepali_stay"; // Name of the database you're connecting to

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<?php
session_start(); // Start the session
session_destroy(); // Destroy the current session
header("Location: index.php"); // Redirect to index.php
exit(); // Terminate the script
?>

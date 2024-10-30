<?php
session_start();
if(isset($_SESSION["users"]))
{
    header("Location: index.php");
}
?>


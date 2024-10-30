<?php
include('../links.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Page</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-container{
            margin-top: 107px ;
            margin-left: 59px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 logo-container">
                <img src="Logo.jpg" alt="Logo">
            </div>
            <div class="col-md-6 align-items-center justify-content-center">
                <div class="form-container">
                
            <form action="registration.php" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" name="fullname" placeholder="Enter Full Name" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="Cpassword" placeholder="Confirm password" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Register</button>
            </form>
            <br>
            <p>Already Registered? <a href="login.php">Login Here</a> </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
include('../links.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login Page</title>
</head>
<link rel="stylesheet" href="style.css">
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 logo-container">
                <img src="Logo.jpg" alt="Logo">
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="form-container">
                  
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                </form>
                <br>
                <p>Not registered yet? <a href="registration.php">Register Here</a> </p>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
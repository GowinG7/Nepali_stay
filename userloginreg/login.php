<?php
// Start a new session or resume the existing session
session_start();

// Check if the session variable "user" is set, indicating the user is logged in
if (isset($_SESSION["user"])) {
    // Redirect the user to the login page if they are already logged in
    // pailai login.php ma redirected grya hyperlink lagayerw  so paxi session ma pardena raixa khaali xdney 
    header("Location: "); // Redirects to login.php
   
}

include('../links.php');
require_once "dbconfig.php"; // Make sure to include the database connection

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
    <title>Login Page</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 logo-container">
                <img src="Logo.jpg" alt="Logo">
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="form-container">
                    <?php
                    // Initialize an error message variable
                    $errorMessage = "";

                    // Check if the form is submitted
                    if (isset($_POST["login"])) {
                        $email = trim($_POST["email"]);
                        $password = $_POST["password"];

                        // Validate email format: letters, numbers, periods, and specific domains
                        if (!preg_match("/^[a-zA-Z0-9.]+@(gmail|yahoo|outlook)\.com$/", $email)) {
                            $errorMessage = "Email must contain only letters, numbers, periods, and end with @gmail.com, @yahoo.com, or @outlook.com.";
                        } 
                        // Validate password length
                        elseif (strlen($password) < 8) {
                            $errorMessage = "Password must be at least 8 characters long.";
                        } 
                        else {
                            // Prepare and execute SQL statement
                            $sql = "SELECT * FROM users WHERE email = ?";
                            $stmt = mysqli_stmt_init($conn);
                            if (mysqli_stmt_prepare($stmt, $sql)) {
                                mysqli_stmt_bind_param($stmt, "s", $email);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                $user = mysqli_fetch_assoc($result);

                                if ($user) {
                                    // Compare the hashed password
                                    if (password_verify($password, $user["password"])) {
                                        $_SESSION["user"] = "yes";
                                        header("Location: ../Frontendindex.php"); //success bayeC kata direct grney
                                        exit();
                                    } else {
                                        $errorMessage = "Password does not match.";
                                    }
                                } else {
                                    $errorMessage = "Email does not match.";
                                }
                            } else {
                                $errorMessage = "Something went wrong with the SQL statement.";
                            }
                        }
                    }
                    
                    // Display error messages if any
                    if ($errorMessage) {
                        echo "<div class='alert alert-danger'>$errorMessage</div>";
                    }
                    ?>

                    <form action="login.php" method="post">
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                    </form>
                    <br>
                    <p>Not registered yet? <a href="registration.php">Register Here</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

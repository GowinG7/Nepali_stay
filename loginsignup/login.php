<?php
session_start(); // Start the session

// Include the database configuration file
require_once 'db_config.php';
require('../links.php');

// Check if the form is submitted
if (isset($_POST["submit"])) {
    // Get user inputs
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    
    // Validate inputs
    if (empty($username) || empty($password)) {
        $errorMessage = "Both username and password are required.";
    } else {
        // Prepare SQL query to check if the username or email exists
        $sql = "SELECT * FROM user_creden WHERE username = ? OR email = ?";
        $stmt = mysqli_stmt_init($conn);
        
        if (mysqli_stmt_prepare($stmt, $sql)) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "ss", $username, $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            // Check if the user exists
            if ($user = mysqli_fetch_assoc($result)) {
                // Compare the plain password
                if ($password === $user["pass"]) { // Compare the plain password
                    // Store user info in session
                    $_SESSION["user"] = $user["username"];
                    $_SESSION["user_id"] = $user["id"];
                    $_SESSION["user_email"] = $user["email"];
                    
                    // Redirect to the dashboard page
                    header("Location: ../userdashboard.php"); 
                    exit(); // Stop further execution after redirection
                } else {
                    $errorMessage = "Incorrect password.";
                }
            } else {
                $errorMessage = "Username or email does not exist.";
            }
        } else {
            $errorMessage = "Error with SQL query.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="login.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="login-form">
        <!-- Display error messages if any -->
        <?php
        if (isset($errorMessage)) {
            echo "<div class='alert alert-danger'>$errorMessage</div>";
        }
        ?>
        
        <form action="login.php" method="POST">
            <h4>Login</h4>
            
            <!-- Username or Email input -->
            <input name="username" type="text" class="form-control" placeholder="Username or Email" required>
            
            <!-- Password input -->
            <input name="password" type="password" class="form-control" placeholder="Password" required>
            
            <!-- Login button -->
            <button name="submit" type="submit" class="btn">Login</button>
            
            <!-- Footer links -->
            <div class="footer">
                <a href="forgot_password.php">Forgot your password?</a>
                <hr>
                <div>
                    Don't have an account? 
                    <a href="signup.php">Sign up</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

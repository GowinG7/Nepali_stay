<?php
session_start(); // Start the session

// Include the database configuration file
require_once 'db_config.php'; // Ensure this file contains your DB connection setup
require('../links.php'); // Adjust as needed based on your project structure

// Error messages for individual fields
$usernameError = $passwordError = $serverError = "";

// Remove previous error messages after page refresh
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get user inputs
    $username = trim($_POST["username"]); // Can be email or username
    $password = $_POST["password"]; // Plain-text password entered by the user

    // Validate username or email
    if (empty($username)) {
        $usernameError = "Username or email is required.";
    } elseif (!preg_match("/^[a-zA-Z0-9_@]+$/", $username) && 
              !preg_match("/^[a-zA-Z0-9.]+@(gmail|yahoo|outlook)\.com$/", $username)) {
        $usernameError = "Username can only contain letters, numbers, underscores, and the @ symbol, or email must end with @gmail.com, @yahoo.com, or @outlook.com.";
    }

    // Validate password
    if (empty($password)) {
        $passwordError = "Password is required.";
    } elseif (strlen($password) < 8) {
        $passwordError = "Password must be at least 8 characters.";
    }

    // Proceed if there are no validation errors
    if (empty($usernameError) && empty($passwordError)) {
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
                // Compare the plain password with the stored password
                if ($password === $user["pass"]) { // Use password_hash in production
                    // Store user info in the session
                    $_SESSION["user"] = $user["username"];
                    $_SESSION["user_id"] = $user["id"];
                    $_SESSION["user_email"] = $user["email"];

                    // Redirect to the dashboard page
                    header("Location: ../userdashboard.php");
                    exit();
                } else {
                    $passwordError = "Incorrect password.";
                }
            } else {
                $usernameError = "Username or email does not exist.";
            }
        } else {
            $serverError = "Error with SQL query.";
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Real-time validation for username or email
            $("#username").on("input", function () {
                var input = $(this).val();
                var usernamePattern = /^[a-zA-Z0-9_@]+$/;
                var emailPattern = /^[a-zA-Z0-9.]+@(gmail|yahoo|outlook)\.com$/;

                if (usernamePattern.test(input) || emailPattern.test(input)) {
                    $("#username_error").text(""); // Clear error message
                } else {
                    $("#username_error").text("Username can only contain letters, numbers, underscores, and the @ symbol, or email must end with @gmail.com, @yahoo.com, or @outlook.com.");
                }
            });

            // Real-time validation for password
            $("#password").on("input", function () {
                var password = $(this).val();
                if (password.length >= 8) {
                    $("#password_error").text(""); // Clear error message
                } else {
                    $("#password_error").text("Password must be at least 8 characters long.");
                }
            });
        });
    </script>
</head>
<body>
    <div class="login-form">
        <form action="login.php" method="POST">
            <h4>Login</h4>

            <!-- Username or Email input -->
            <input 
                name="username" 
                type="text" 
                class="form-control" 
                placeholder="Username or Email" 
                id="username" 
                value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" 
                required>
            <div class="error-message" id="username_error"><?php echo $usernameError; ?></div>

            <!-- Password input -->
            <input 
                name="password" 
                type="password" 
                class="form-control" 
                id="password" 
                placeholder="Password" 
                required>
            <div class="error-message" id="password_error"><?php echo $passwordError; ?></div>

            <!-- Login button -->
            <button name="submit" type="submit" class="btn">Login</button>

            <!-- Footer links -->
            <div class="footer">
                <a href="forgot_pass.php">Forgot your password?</a>
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

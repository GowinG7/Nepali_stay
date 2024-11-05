<?php
session_start(); // Start the session
include('../links.php');
require_once "dbconfig.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
    <title>Registration Page</title>
    

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
                    // Display session messages if set
                    if (isset($_SESSION['message'])) {
                        echo "<div class='alert alert-success'>{$_SESSION['message']}</div>";
                        unset($_SESSION['message']); // Clear the message after displaying
                    }

                    if (isset($_POST["submit"])) {
                        $fullName = $_POST["fullname"];
                        $email = $_POST["email"];
                        $password = $_POST["password"];
                        $passwordRepeat = $_POST["repeat_password"];
                        
                        $errors = array();
                        
                        // Modify Full Name Validation
                        if (!preg_match("/^[A-Za-z]+( [A-Za-z]+)*$/", $fullName)) {
                        array_push($errors, "Name should only contains letters, and space is allowed between words but not at the starting");
                          }


                        // Validate Email
                        if (!preg_match("/^[a-zA-Z0-9.]+@(gmail|yahoo|outlook)\.com$/", $email)) {
                            array_push($errors, "Email must contains only letters, numbers, periods, and end with @gmail.com, @yahoo.com, or @outlook.com.");
                        }

                        // Validate Password
                        if (strlen($password) < 8) {
                            array_push($errors, "Password must be at least 8 characters long.");
                        }
                        if ($password !== $passwordRepeat) {
                            array_push($errors, "Passwords do not match.");
                        }

                        // Check if email already exists
                        $sql = "SELECT * FROM users WHERE email = ?";
                        $stmt = mysqli_stmt_init($conn);
                        if (mysqli_stmt_prepare($stmt, $sql)) {
                            mysqli_stmt_bind_param($stmt, "s", $email);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            if (mysqli_num_rows($result) > 0) {
                                array_push($errors, "Email already exists!");
                            }
                        } else {
                            die("Something went wrong with the SQL statement.");
                        }

                        // Display errors or proceed to register
                        if (count($errors) > 0) {
                            foreach ($errors as $error) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                        } else {
                            // Insert the new user into the database with hashed password
                            $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
                            if (mysqli_stmt_prepare($stmt, $sql)) {
                                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                                mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $hashed_password);
                                if (mysqli_stmt_execute($stmt)) {
                                    $_SESSION['message'] = "Registration successful! You can now log in."; // Set session message
                                    header("Location: login.php"); // Redirect to login page
                                    exit; // Stop further execution after redirection
                                } else {
                                    echo "Error executing query: " . mysqli_stmt_error($stmt);
                                }
                            } else {
                                die("Something went wrong with the SQL statement.");
                            }
                        }
                    }
                    ?>
                    <form action="registration.php" method="post">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="fullname" placeholder="Full Name:" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email:" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password:" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Register</button>
                    </form>
                    <br>
                    <p>Already Registered? <a href="login.php">Login Here</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- Name Validation:
The regular expression "/^[A-Za-z]+( [A-Za-z]+)*$/" ensures:
Starts with a letter.
Contains only letters and spaces.
Allows only a single space between names (e.g., John Doe is valid, but John Doe is not).
Email Validation:
The regular expression "/^[a-zA-Z0-9.]+@(gmail|yahoo|outlook)\.com$/" ensures:
Only letters, numbers, and periods are allowed before the @ symbol.
The email ends with @gmail.com, @yahoo.com, or @outlook.com.-->
</html>

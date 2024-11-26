<?php
session_start(); // Start the session

// Include database configuration
require_once 'db_config.php'; // Ensure $con is initialized
require('../admin/links.php');

if (isset($_POST["btnsubmit"])) {
    // Get user inputs
    $identifier = trim($_POST["identifier"]); // Can be username or email
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Input validation
    if (empty($identifier) || empty($new_password) || empty($confirm_password)) {
        echo "All fields are required.";
        exit;
    } elseif ($new_password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Check if the user exists
    $qry = "SELECT * FROM user_creden WHERE username = ? OR email = ?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $qry)) {
        mysqli_stmt_bind_param($stmt, "ss", $identifier, $identifier);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($result)) {
            // User exists, proceed to update password
            $update_qry = "UPDATE user_creden SET pass = ? WHERE id = ?";
            $update_stmt = mysqli_stmt_init($conn);

            if (mysqli_stmt_prepare($update_stmt, $update_qry)) {
                mysqli_stmt_bind_param($update_stmt, "si", $new_password, $user["id"]);
                if (mysqli_stmt_execute($update_stmt)) {
                    echo "Password updated successfully.";
                } else {
                    echo "Error updating password.";
                }
            } else {
                echo "Error preparing the update query.";
            }
        } else {
            echo "No user found with the provided email or username.";
        }
    } else {
        echo "Error preparing the query.";
    }

    // Close the connection
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .form-container {
            width: 100%;
            max-width: 400px;
            margin: 80px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 24px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 14px;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-submit:hover {
            background-color: #056b0a;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Forgot Password</h1>
        <form method="POST" action="forgot_pass.php">
            <div class="form-group">
                <label for="identifier">Username or Email</label>
                <input type="text" id="identifier" name="identifier" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" name="btnsubmit" class="btn-submit">Update Password</button>
        </form>
    </div>
</body>
</html>

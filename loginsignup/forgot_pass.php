<?php
session_start(); // Start the session
require_once 'db_config.php'; // Ensure $conn is initialized
require('../admin/links.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    unset($_SESSION['message']);

    $identifier = trim($_POST["identifier"]);
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Input validation
    if (empty($identifier) || empty($new_password) || empty($confirm_password)) {
        $_SESSION['message'] = ["type" => "error", "text" => "All fields are required."];
    } elseif ($new_password !== $confirm_password) {
        $_SESSION['message'] = ["type" => "error", "text" => "Passwords do not match."];
    } elseif (strlen($new_password) < 8) {
        $_SESSION['message'] = ["type" => "error", "text" => "Password must be at least 8 characters long."];
    } else {
        // Check if user exists based on username or email
        $qry = "SELECT * FROM user_creden WHERE username = ? OR email = ?";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $qry)) {
            mysqli_stmt_bind_param($stmt, "ss", $identifier, $identifier);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($user = mysqli_fetch_assoc($result)) {
                // Check if the provided security question and answer match
                if ($user['security_question'] == $_POST['question'] && $user['security_answer'] == $_POST['answer']) {
                    // Update the password directly without hashing (as per your request)
                    $update_qry = "UPDATE user_creden SET pass = ? WHERE id = ?";
                    $update_stmt = mysqli_stmt_init($conn);

                    if (mysqli_stmt_prepare($update_stmt, $update_qry)) {
                        mysqli_stmt_bind_param($update_stmt, "si", $new_password, $user["id"]);
                        if (mysqli_stmt_execute($update_stmt)) {
                            $_SESSION['message'] = ["type" => "success", "text" => "Password updated successfully."];
                            header("Location: forgot_pass.php");
                            exit;
                        } else {
                            $_SESSION['message'] = ["type" => "error", "text" => "Error updating password. Please try again later."];
                        }
                    }
                } else {
                    $_SESSION['message'] = ["type" => "error", "text" => "Security question and answer do not match."];
                }
            } else {
                $_SESSION['message'] = ["type" => "error", "text" => "No user found with the provided email or username."];
            }
        } else {
            $_SESSION['message'] = ["type" => "error", "text" => "Error preparing the query."];
        }

        mysqli_close($conn);
    }
    header("Location: forgot_pass.php");
    exit;
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

        .message {
            text-align: center;
            font-size: 16px;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        h1 {
            text-align: center;
            font-weight: 600;
            font-size: 24px;
            color: grey;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 16px;
            color: #0e0707;
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
            border-color: #34e43a;
            outline: none;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: rgb(16, 139, 98);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-submit:hover {
            background-color: #056b0a;
        }

        .footer {
            margin-top: 15px;
            font-size: 18px;
            color: grey;
            text-align: center;
        }

        .footer a {
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: none;
            color: purple;
        }

        .footer hr {
            border: none;
            height: 1px;
            background: #ddd;
            margin: 15px 0;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {
        // Real-time validation for Identifier
        $("#identifier").on("blur keyup", function () {
            $(".identifier-error").remove();
            let identifier = $(this).val().trim();
            let usernameRegex = /^[a-zA-Z0-9_@]+$/;
            let emailRegex = /^[a-z0-9.]+@(gmail\.com|yahoo\.com|outlook\.com)$/;

            if (identifier !== "" && (!usernameRegex.test(identifier) && !emailRegex.test(identifier))) {
                $(this).after('<span class="identifier-error" style="color:red;">Enter a valid username or email.</span>');
            }
        });

        // Real-time validation for New Password (updated)
        $("#new_password").on("blur keyup", function () {
            $(".password-error").remove();
            let newPassword = $(this).val().trim();

            // Only check for length (at least 8 characters)
            if (newPassword.length < 8) {
                $(this).after('<span class="password-error" style="color:red;">Password must be at least 8 characters long.</span>');
            }
        });

        // Real-time validation for Confirm Password
        $("#confirm_password").on("blur keyup", function () {
            $(".confirm-password-error").remove();
            let newPassword = $("#new_password").val().trim();
            let confirmPassword = $(this).val().trim();

            if (confirmPassword !== "" && newPassword !== confirmPassword) {
                $(this).after('<span class="confirm-password-error" style="color:red;">Passwords do not match.</span>');
            }
        });

        // Auto-hide message after 3 seconds
        setTimeout(function () {
            $(".message").fadeOut("slow");
        }, 3000);
    });
    </script>
</head>
<body>
    <div class="form-container">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message <?php echo $_SESSION['message']['type']; ?>">
                <?php
                echo $_SESSION['message']['text'];
                unset($_SESSION['message']);
            ?>
        </div>
    <?php endif; ?>
    <h1>Reset Password</h1>
    <form  method="post">
        <div class="form-group">
            <label for="identifier">Username or Email</label>
            <input type="text" id="identifier" name="identifier" placeholder="Enter your username or email" required>
        </div>
        <div class="form-group">
            <label for="question">Choose Security Question:</label>
            <select id="question" name="question" required style="color:grey" >
                <option value="color">Favourite Color</option>
                <option value="food">Favourite Food</option>
                <option value="fruit">Favourite Fruit</option>
                <option value="pet">Favourite Pet</option>
                <option value="subject">Favourite Subject</option>
                <option value="place">Favourite Place</option>
                <option value="laptop">Favourite Laptop</option>
            </select>
        </div>
        <div class="form-group">
            <label for="answer">Enter Answer:</label>
            <input type="text" id="answer" name="answer" placeholder="Enter your answer" required>
        </div>
        <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" placeholder="Enter new password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password" required>
        </div>
        <button type="submit" class="btn-submit">Change Password</button>
    </form>
    <div class="footer">
        <hr>
        <p>Now you can  <a href="login.php">Log in</a></p>
    </div>
</div>
</body>
</html>

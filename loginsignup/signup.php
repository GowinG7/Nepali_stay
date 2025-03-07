<?php
session_start();
require_once('db_config.php');
require('../admin/links.php');

$successMessage = ""; // Variable to hold success message
$errorMessages = "";  // Variable to hold error messages

if (isset($_POST["submit"])) {
    // Collect form data
    $fullName = $_POST["full_name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $phone = $_POST["phone"];
    $password = $_POST["pass"];
    $passwordRepeat = $_POST["cpass"];
    $security_question = $_POST["question"];
    $security_answer = $_POST["answer"];

    $errors = array();

    // Validation checks
    if (!preg_match("/^[A-Za-z]+( [A-Za-z]+)*$/", $fullName)) {
        array_push($errors, "Name should only contain letters, and spaces are allowed between words but not at the start.");
    }
    if (!preg_match("/^[a-zA-Z0-9_@]+$/", $username)) {
        array_push($errors, "Username can only contain letters, numbers, underscores, and the @ symbol.");
    }
    if (!preg_match("/^[a-z0-9.]+@(gmail|yahoo|outlook)\.com$/", $email)) {
        array_push($errors, "Email must contains a-z,0-9,.(dot/peroids) and end with @gmail.com, @yahoo.com, or @outlook.com.");
    }
    // if (!preg_match("/^\d{10}$/", $phone)) {
    //     array_push($errors, "Phone number must be exactly 10 digits.");
    // }
    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long.");
    }
    if (empty($security_answer)) {
        array_push($errors, "Security answer cannot be empty.");
    }
    
    if ($password !== $passwordRepeat) {
        array_push($errors, "Passwords do not match.");
    }

    // Check for existing email
    $sql = "SELECT * FROM user_creden WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            array_push($errors, "Registered failed! Email is already used - Use another email while signup");
        }
        mysqli_stmt_close($stmt);
    }

    // Check for existing username
    $sql = "SELECT * FROM user_creden WHERE username = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            array_push($errors, "Registered failed! Username is already used- create other one");
        }
        mysqli_stmt_close($stmt);
    }

    // Insert data if no errors
    if (count($errors) === 0) {
        $sql = "INSERT INTO `user_creden`(`name`, `username`, `email`, `phone`, `pass`,`security_question`,`security_answer`) VALUES(?, ?, ?, ?, ?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssss", $fullName, $username, $email, $phone, $password, $security_question, $security_answer);
            if (mysqli_stmt_execute($stmt)) {
                $successMessage = "Account created successfully! You can now log in.";
            } else {
                array_push($errors, "Error creating account: " . mysqli_stmt_error($stmt));
            }
        }
    }

    // Convert errors to alert format
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            $errorMessages .= "<p>" . $error . "</p>";
        }
    }

    // Store success or error message in session
    $_SESSION['successMessage'] = $successMessage;
    $_SESSION['errorMessages'] = $errorMessages;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link rel="stylesheet" href="signup.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="form-container">
        <h1>Create Account</h1>

        <!-- Display Success or Error Messages -->
        <?php if (!empty($_SESSION['successMessage'])): ?>
            <div class="alert alert-success">
                <h4><?php echo $_SESSION['successMessage']; ?></h4>
            </div>
            <?php unset($_SESSION['successMessage']); ?>
        <?php elseif (!empty($_SESSION['errorMessages'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['errorMessages']; ?>
            </div>
            <?php unset($_SESSION['errorMessages']); ?>
        <?php endif; ?>

        <form method="POST" action="signup.php" id="signup-form">
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" placeholder="Your full name (First, Middle, Last)" required>
                <div class="error-message" id="full_name_error"></div> <!-- Error message container -->
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="example:hello@123_" required>
                <div class="error-message" id="username_error"></div> <!-- Error message container -->
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="example:name@gmail.com" required>
                <div class="error-message" id="email_error"></div> <!-- Error message container -->
            </div>

            <div class="form-group">
                <label for="phone">Phone Number (Optional)</label>
                <input type="tel" id="phone" name="phone" pattern="[0-9]{10}"  >
                <div class="error-message" id="phone_error"></div> <!-- Error message container -->
            </div>

            <div class="form-group">
            <label for="question">Choose Security Question:</label>
            <select id="question" name="question" style="color:grey" required>
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
            <div class="error-message" id="answer_error"></div>
        </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" id="pass" name="pass" placeholder="Enter password" required>
                    <div class="error-message" id="pass_error"></div> <!-- Error message container -->
                </div>

                <div class="form-group">
                    <label for="cpass">Confirm Password</label>
                    <input type="password" id="cpass" name="cpass" placeholder="Confirm password" required>
                    <div class="error-message" id="cpass_error"></div> <!-- Error message container -->
                </div>
            </div>

            <button type="submit" class="btn-submit" name="submit">Sign Up</button>
        </form>

        <div class="form-footer">
            Already have an account? 
            <a href="login.php">Log In</a>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Hide messages after 3 seconds
            setTimeout(function () {
                $(".alert").fadeOut("slow");
            }, 4000);

            // Field validations
            $('#full_name').on('blur', function () {
                var fullName = $(this).val();
                if (!/^[A-Za-z]+( [A-Za-z]+)*$/.test(fullName)) {
                    $('#full_name_error').text('Name should only contain letters, and spaces are allowed between words but not at the start.').show();
                } else {
                    $('#full_name_error').hide();
                }
            });

            $('#username').on('blur', function () {
                var username = $(this).val();
                if (!/^[a-zA-Z0-9_@]+$/.test(username)) {
                    $('#username_error').text('Username can only contain letters, numbers, underscores, and the @ symbol.').show();
                } else {
                    $('#username_error').hide();
                }
            });

            $('#email').on('blur', function () {
                var email = $(this).val();
                if (!/^[a-z0-9.]+@(gmail|yahoo|outlook)\.com$/.test(email)) {
                    $('#email_error').text('Email must contains only letters(a-z),numbers(0-9)and periods or dot(.) and email must end with @gmail.com, @yahoo.com, or @outlook.com.').show();
                } else {
                    $('#email_error').hide();
                }
            });

         /*   $('#phone').on('blur', function () {
                var phone = $(this).val();
                if (!/^\d{10}$/.test(phone)) {
                    $('#phone_error').text('Phone number must be exactly 10 digits.').show();
                } else {
                    $('#phone_error').hide();
                }
            }); */

            $('#pass').on('blur', function () {
                var pass = $(this).val();
                if (pass.length < 8) {
                    $('#pass_error').text('Password must be at least 8 characters long.').show();
                } else {
                    $('#pass_error').hide();
                }
            });
            $('#answer').on('blur', function () {
            var answer = $(this).val().trim(); // Trim to remove extra spaces
            if (answer === '') {
            $('#answer_error').text('Security answer cannot be empty.').show();
            } else {
            $('#answer_error').hide();
            }
            });



            $('#cpass').on('blur', function () {
                var cpass = $(this).val();
                if (cpass !== $('#pass').val()) {
                    $('#cpass_error').text('Passwords do not match.').show();
                } else {
                    $('#cpass_error').hide();
                }
            });
        });
    </script>
</body>
</html>
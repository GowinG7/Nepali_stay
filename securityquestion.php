<?php
include('links.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Question</title>
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
            margin:21px;
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
        .form-group select, .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-group input:focus, .form-group select:focus {
            border-color: #34e43a;
            outline: none;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: rgb(16, 139, 98);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
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
</head>
<body>

<div class="form-container">
    <h1>Security Question</h1>
    <form method="post" action="loginsignup/forgot_pass.php" >
        <div class="form-group">
            <label for="email">Your identity:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email or username for your identity" required>
        </div>
        <div class="form-group">
            <label for="question">Choose Security Question:</label>
            <select id="question" name="question" required>
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
            <label for="security_answer">Enter Answer:</label>
            <input type="text" id="security_answer" name="security_answer" placeholder="Enter your answer" required>
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
        <p><a href="loginsignup/login.php">Go back to Login</a></p>
    </div>
</div>

</body>
</html>

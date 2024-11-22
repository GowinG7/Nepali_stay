<?php
require_once('admin/db_config.php');
require('admin/essentials.php');
$settings_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
$values = [1];
$settings_r = mysqli_fetch_assoc(select($settings_q,$values,'i'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="index.css"/>
    
</head>
<body>
    
   <header>
        <nav>
            <div class="logo">  
                <h3 class="logo-txt">
                    <img src="userloginreg/Logo.jpg" alt="Logo" class="logo-img"> <?php echo $settings_r['site_title'] ?>
                </h3> 
            </div>
            <div class="menu">
                <h2>Online hotel room booking site</h2>
            </div>
        </nav>

        <main>
            <section>
                <h3>Welcome To Nepal</h3>
                <h1>Come and visit |<span class="change_content">  </span> | </h1>
                <p>"Choosing <b><?php echo $settings_r['site_title'] ?> <i>once</i></b> is not enough"</p>
                <a href="userloginreg/login.php" class="button1">User Login</a> <!-- yeha pailai login.php ma redirected grya xa so paxi session ma pardena raixa khaali xdney -->
                <a href="admin/index.php" class="button2">Admin Login</a>
            </section>
        </main>
   </header>
</body>
</html>  

<?php
 require('essentials.php');
 require('db_config.php'); 
 
 //yedi aba admin panel ko login garerw admin dashboard ma xa tara  pani teha bata back grda admin login ma aauxa baney tyo session check gari dashboard mai redirect grney
 session_start();
  if((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true)){
    redirect('bookings.php');
   } //aba yeti gareC jaba samma logout garinnna aru page ma janna 
 #imp note: eutai file waa page ma barambar session start grna mildaina matlab euta session_start(); bayeC aru ma pani hunu bayena
   
 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Login Panel</title>
        <?php require('links.php'); ?>
        <style>
            div.login-form{
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%,-50%);
                width: 400px;

            } 
        </style>
    </head>
    <body class="bg-light">

            <div class="login-form text-center rounded bg-white shadow overflow-hidden">
                <form method="POST">
                    <h4 class="bg-dark text-white py-3">Admin Login Panel</h4>
                    <div class="p-4">
                    <div class="mb-3">
                        <input name="admin_name" required type="text" class="form-control shadow-none text-center" placeholder="Admin Name">
                    </div>
                    <div class="mb-4">
                        <input name="admin_pass" required  type="password"  class="form-control shadow-none text-center" placeholder="Password">
                    </div>
                    <button name="login" type="submit" class="btn text-white custom-bg shadow-none">LOGIN</button>
                    </div>
                </form>
            </div> 
        </body>
<!-- required= field bornai parxa
 post gare paxi form ko value haru pass hunxa login button click gareC-->
 <?php
 if(isset($_POST['login'])){
     $frm_data = filteration($_POST);

     $query = "SELECT * FROM `admin_cred` WHERE `admin_name`=? AND `admin_pass`=? ";
     // prepare statement: query ko prepare grna, statement hunxa ani tesko  parameter lai binds grna ani execute grna ani result lai get grna  
     $values = [$frm_data['admin_name'], $frm_data['admin_pass']];
     $datatypes = "ss"; //string type ko xa values duitai admin_name rw admin_pass
 
     $res = select($query, $values, "ss"); //function call(db_config ma xa tesbata return bayO..ra yeha res variable ma stored bayo tyo ra yeha ko res variable xutta xutaaie ho)
     if($res->num_rows==1){  //object vayeC ->
         $row = mysqli_fetch_assoc($res);
         $_SESSION['adminLogin'] = true;
         $_SESSION['adminId'] = $row['sr_no'];
         redirect('bookings.php');//function call (essentials.php ma xa)
     } 
     else{
         alert('error', 'Login failed - Invalid Credentials'); //type error msg-->yeta patiko
     }
      }
 ?>


    <?php require('scripts.php'); ?>
    </body>
</html>
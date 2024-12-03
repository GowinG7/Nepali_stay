<?php
require('links.php');

require('essentials.php');
adminLogin(); //essentials file ma xa 

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Panel - Dashboard</title> 
    </head>
    <body class="bg-light">
     
    <?php require('header.php'); ?>


     <div class="container-fluid" id="main-content">
      <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden"> 
          <h1>This is admin dashboard</h1>
        </div>
      </div>
     </div>

    <?php require('scripts.php');?> 
    </body>
</html>
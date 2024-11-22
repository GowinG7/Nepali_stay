
<?php
require('essentials.php');
require('db_config.php');
adminLogin(); //essentials file ma xa 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Panel - Users</title>
        <?php
        require('links.php');
        ?>  
    </head>
    <body class="bg-light">
     
    <?php require('header.php'); ?>


     <div class="container-fluid" id="main-content">
        <div class="row">
          <div class="col-lg-10 ms-auto p-4 overflow-hidden"> 
            <h3 class="mb-4">USERS</h3>
            
            <div class="card border-0 shadow-sm mb-4">
              <div class="card-body">

                <div class="text-end mb-4">  
                  <!-- Button trigger modal 
                  <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-room">
                    <i class="bi bi-plus-square"></i> Add
                  </button>
                </div>-->

              <div class="table-responsive">
                  <table class="table table-hover border text-center" style="min-width: 1300px;">
                    <thead >
                      <tr class="bg-dark text-light">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Location</th>
                        <th scope="col">Verified</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody id="users-data">
                  
                    </tbody>
                  </table> 
              </div>

              </div>
            </div>
              
          </div>
        </div>
      </div>

     


  <?php require('scripts.php');?>

  <script src="scripts/users.js"></script>
       
  </body>
</html>
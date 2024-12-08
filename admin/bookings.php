
<?php
require('essentials.php');
require('db_config.php');
adminLogin(); //essentials file ma xa 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Panel - Bookings</title>
        <?php
        require('links.php');
        ?>  
    </head>
    <body class="bg-light">
     
    <?php require('header.php'); ?>


     <div class="container-fluid" id="main-content">
        <div class="row">
          <div class="col-lg-10 ms-auto p-4 overflow-hidden"> 
            <h3 class="mb-4">Bookings</h3>
            
            <div class="card border-0 shadow-sm mb-4">
              <div class="card-body">
                  <!-- for search box in users section of the admin panel -->
                <div class="text-end mb-4">  
                   <!--(function users.js ma) oninput event handler used grya xau jaba yesma kei data input hunxa taba yo function call huna paryO -->  
                  <input type="text" oninput="search_bookings(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search">
                </div>

              <div class="table-responsive">
                  <table class="table table-hover border text-center" style="min-width: 1300px;">
                    <thead >
                      <tr class="bg-dark text-light">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone no.</th>
                        <th scope="col">Email</th>
                        <th scope="col">Room Type</th>
                        <th scope="col">Check-in</th>
                        <th scope="col">Check-out</th>
                        <th scope="col">Total Days</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">verified</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody id="table-data">
                  
                    </tbody>
                  </table> 
              </div>

              </div>
            </div>
              
          </div>
        </div>
      </div>

     


  <?php require('scripts.php');?>

  <script src="scripts/bookings.js"></script>
       
  </body>
</html>
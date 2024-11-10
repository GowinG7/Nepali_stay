
<?php
require('essentials.php');
require('db_config.php');
adminLogin(); //essentials file ma xa 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Panel - Features and Facilities</title>
        <?php 
        require('links.php')
        ?>  
    </head>
    <body class="bg-light">
     
    <?php require('header.php'); ?>


     <div class="container-fluid" id="main-content">
        <div class="row">
          <div class="col-lg-10 ms-auto p-4 overflow-hidden"> 
            <h3 class="mb-4">FEATURES AND FACILITIES</h3>
            <!-- For features card-->
            <div class="card border-0 shadow-sm mb-4">
              <div class="card-body">

                <div class="d-flex align-items-center justify-content-between mb-3">
                  <h5 class="card-title m-0">Features</h5>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#feature-s">
                    <i class="bi bi-plus-square"></i> Add
                  </button>
                </div>

              <div class="table-responsive-md" style="height: 350px; overflow: scroll;">
                  <table class="table table-hover border">
                    <thead >
                      <tr class="bg-dark text-light">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody id="features-data">
                  
                    </tbody>
                  </table> 
              </div>

              </div>
            </div>
            <!-- For facilities card -->
            <div class="card border-0 shadow-sm mb-4">
              <div class="card-body">

                <div class="d-flex align-items-center justify-content-between mb-3">
                  <h5 class="card-title m-0">Facilites</h5>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#facility-s">
                    <i class="bi bi-plus-square"></i> Add
                  </button>
                </div>

              <div class="table-responsive-md" style="height: 350px; overflow: scroll;">
                  <table class="table table-hover border">
                    <thead  >
                      <tr class="bg-dark text-light">
                        <th scope="col">#</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Name</th>
                        <th scope="col" width="40%" >Description</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody id="facilities-data">
                  
                    </tbody>
                  </table> 
              </div>

              </div>
            </div>
              
          </div>
        </div>
      </div>

        <!-- Features Model -->
        <div class="modal fade" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form id="feature_s_form"> 
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Add Feature</h5>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Name</label>
                    <input type="text" id="feature_name" class="form-control shadow-none" required>
                  </div>
              
                </div>
                <div class="modal-footer">
                  <!-- when cancel button is click it clear the input field cause here '' no value inside the quotes -->
                  <button type="reset"  class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                </div>
              </div>
            </form> 
          </div>
        </div>

        <!-- Facility model -->
        <div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form id="facility_s_form"> 
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Add Facility</h5>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Name</label>
                    <input type="text" name="facility_name"  class="form-control shadow-none" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-bold">Icon</label>
                    <input type="file" name="facility_icon"  accept=".svg" class="form-control shadow-none" required>
                  </div>
                  <div class="mb-3">
                  <label class="form-label">Description</label>
                  <textarea name="facility_desc" class="form-control shadow-none" rows="3" required></textarea>
                </div>
                </div>
                
                <div class="modal-footer">
                  <!-- when cancel button is click it clear the input field cause here '' no value inside the quotes -->
                  <button type="reset"  class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                </div>
              </div>
            </form> 
          </div>
        </div>


        <?php require('scripts.php');?>

        <script src="scripts/features_facilities.js"></script>

  </body>
</html>
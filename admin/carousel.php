
<?php
require('essentials.php');
adminLogin(); //essentials file ma xa 

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Panel - Carousel</title>
        <?php 
        require('links.php')
        ?>  
    </head>
    <body class="bg-light">
     
    <?php require('header.php'); ?>


     <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden"> 
        <h3 class="mb-4">CAROUSEL</h3>


        <!-- Carousel section -->
        <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0">Images</h5>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#carousel-s">
              <i class="bi bi-plus-square"></i> Add
            </button>
          </div>
          <div class="row" id="carousel-data">

          </div>
        </div>
        </div>

        <!-- Carousel Modal -->
        <div class="modal fade" id="carousel-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="carousel_s_form"> 
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Add Image</h5>
                </div>
                <div class="modal-body">
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Picture</label>
                    <input type="file" name="carousel_picture" id="carousel_picture_inp" accept=".jpg,.png,.webp,.jpeg" class="form-control shadow-none" required>
                </div>
                </div>
                <div class="modal-footer">
                <!-- when cancel button is click it clear the input field cause here '' no value inside the quotes -->
                <button type="button" onclick=" carousel_picture.value=''" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                </div>
            </div>
            </form> 
        </div>
        </div>


        <?php require('scripts.php');?>
        <script src="scripts/carousel.js"></script>

  </body>
</html>
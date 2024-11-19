
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
                  <table class="table table-hover border text-center" style="min-width: 1300px">
                    <thead >
                      <tr class="bg-dark text-light">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody id="room-data">
                  
                    </tbody>
                  </table> 
              </div>

              </div>
            </div>
              
          </div>
        </div>
      </div>

        <!-- Add room Model -->
        <div class="modal fade" id="add-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg  ">
            <form id="add_room_form" autocomplete="off" > 
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Add Room</h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class=" col-md-6 mb-3">
                    <label class="form-label fw-bold">Name</label>
                    <input type="text" name="name" class="form-control shadow-none" required>
                  </div>
                  <div class=" col-md-6 mb-3">
                    <label class="form-label fw-bold">Area</label>
                    <input type="number" min="1" name="area" class="form-control shadow-none" required>
                  </div>
                  <div class=" col-md-6 mb-3">
                    <label class="form-label fw-bold">Price</label>
                    <input type="number" name="price" class="form-control shadow-none" required>
                  </div>
                  <div class=" col-md-6 mb-3">
                    <label class="form-label fw-bold">Quantity</label>
                    <input type="number" name="quantity" class="form-control shadow-none" required>
                  </div>
                  <div class="col-12 mb-3">
                    <label class="form-label fw-bold">Features</label>
                    <div class="row">
                      <?php
                      $res = selectAll('features');
                      while($opt = mysqli_fetch_assoc($res)){
                        echo"
                         <div class='col-md-3 mb-1'>
                          <label>
                            <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                            $opt[name]
                            </label>
                         </div>
                         ";
                      }
                      ?>
                    </div>
                  </div>
                  <div class="col-12 mb-3">
                    <label class="form-label fw-bold">Facilites</label>
                    <div class="row">
                      <?php
                      $res = selectAll('facilities');
                      while($opt = mysqli_fetch_assoc($res)){
                        echo"
                         <div class='col-md-3 mb-1'>
                          <label>
                            <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                            $opt[name]
                            </label>
                         </div>
                         ";
                      }
                      ?>
                    </div>
                  </div>
                  <div class="col-12 mb-3">
                    <label class="form-label fw-bold">Description</label>
                      <textarea name="description" rows="4" class="form-control shadow-none" required></textarea>
                  </div>
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
        <!-- Edit room Model -->
        <div class="modal fade" id="edit-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg  ">
            <form id="edit_room_form" autocomplete="off" > 
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Room</h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class=" col-md-6 mb-3">
                    <label class="form-label fw-bold">Name</label>
                    <input type="text" name="name" class="form-control shadow-none" required>
                  </div>
                  <div class=" col-md-6 mb-3">
                    <label class="form-label fw-bold">Area</label>
                    <input type="number" min="1" name="area" class="form-control shadow-none" required>
                  </div>
                  <div class=" col-md-6 mb-3">
                    <label class="form-label fw-bold">Price</label>
                    <input type="number" name="price" class="form-control shadow-none" required>
                  </div>
                  <div class=" col-md-6 mb-3">
                    <label class="form-label fw-bold">Quantity</label>
                    <input type="number" name="quantity" class="form-control shadow-none" required>
                  </div>
                  <div class="col-12 mb-3">
                    <label class="form-label fw-bold">Features</label>
                    <div class="row">
                      <?php
                      $res = selectAll('features');
                      while($opt = mysqli_fetch_assoc($res)){
                        echo"
                         <div class='col-md-3 mb-1'>
                          <label>
                            <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                            $opt[name]
                            </label>
                         </div>
                         ";
                      }
                      ?>
                    </div>
                  </div>
                  <div class="col-12 mb-3">
                    <label class="form-label fw-bold">Facilites</label>
                    <div class="row">
                      <?php
                      $res = selectAll('facilities');
                      while($opt = mysqli_fetch_assoc($res)){
                        echo"
                         <div class='col-md-3 mb-1'>
                          <label>
                            <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                            $opt[name]
                            </label>
                         </div>
                         ";
                      }
                      ?>
                    </div>
                  </div>
                  <div class="col-12 mb-3">
                    <label class="form-label fw-bold">description</label>
                      <textarea name="description" rows="4" class="form-control shadow-none" required></textarea>
                  </div>
                  <!-- yo room_id tesko room ko id hunxa joslai edit grna khojya hunxau, js ko through room naam ko id ko input field ma value aauxa  -->
                  <input type="hidden" name="room_id">
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

        <!--Manage room images modal-->
        <div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" >Room Name</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div id="image-alert"></div>
                <div class="border-bottom border-3 pb-3 mb-3" >
                  <form id="add_image_form">
                    <label class="form-label fw-bold">Add Image</label>
                    <input type="file" name="image" accept=".jpg,.png,.webp,.jpeg" class="form-control shadow-none mb-3" required>
                    <button  class="btn custom-bg text-white shadow-none" >ADD</button>
                    <input type="hidden" name="room_id" value="">
                  </form>
                </div>
                <div class="table-responsive-lg" style="height: 350px; overflow: scroll;">
                  <table class="table table-hover border">
                    <thead >
                      <tr class="bg-dark text-light sticky-top">
                        <th scope="col" width="60%">Image</th>
                        <th scope="col">Thumbnail</th>
                        <th scope="col">Delete</th>
                      </tr>
                    </thead>
                    <tbody id="room-image-data">
                  
                    </tbody>
                  </table> 
                </div>
              </div>
            </div>
          </div>
        </div>


      


  <?php require('scripts.php');?>

  <script src="scripts/rooms.js"></script>
       
  </body>
</html>
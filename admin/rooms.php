
<?php
require('essentials.php');
require('db_config.php');
adminLogin(); //essentials file ma xa 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Panel - Rooms</title>
        <?php 
        require('links.php')
        ?>  
    </head>
    <body class="bg-light">
     
    <?php require('header.php'); ?>


     <div class="container-fluid" id="main-content">
        <div class="row">
          <div class="col-lg-10 ms-auto p-4 overflow-hidden"> 
            <h3 class="mb-4">Rooms</h3>
            
            <div class="card border-0 shadow-sm mb-4">
              <div class="card-body">

                <div class="text-end mb-4">  
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-room">
                    <i class="bi bi-plus-square"></i> Add
                  </button>
                </div>

              <div class="table-responsive-lg" style="height: 450px; overflow: scroll;">
                  <table class="table table-hover border">
                    <thead >
                      <tr class="bg-dark text-light">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Area</th>
                        <th scope="col">Guests</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Area</th>
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
                      <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>
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

      


  <?php require('scripts.php');?>
  <script>
    let add_room_form = document.getElementById('add_room_form');

    add_room_form.addEventListener('submit',function(event){
      e.preventDefault();
      add_rooms();
    });

    function add_rooms()
    {
      //when uploading file through Ajax FormData() is used
      let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
      data.append('add_room','');
      data.append('name',add_room_form.elements['name'].value);
      data.append('area',add_room_form.elements['area'].value);
      data.append('price',add_room_form.elements['price'].value);
      data.append('quantity',add_room_form.elements['quantity'].value);
      data.append('desc',add_room_form.elements['desc'].value);

      let features = [];
      add_room_form.elements['features'].forEach(el =>{
        if(el.checked){
          features.push(el.value);
        }
      });

      let facilities = [];
      add_room_form.elements['facilities'].forEach(el =>{
        if(el.checked){
          facilities.push(el.value);
        }
      });

      data.append('features',JSON.stringify(features));
      data.append('facilities',JSON.stringify(facilities));
   
   
      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/rooms.php",true);


      /*xhr.onreadystatechange = function(){
      if(this.readyState==4 && this.status==200){
      //yesko satto short:*/
      xhr.onload = function(){
      var myModal = document.getElementById('add-room')
      var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
      modal.hide(); //general setting ko tyo form submit modal hide grna cancel wa sumbit bayepaxi

      if(this.responseText == 1 ){
      alert('success','New room added!');
      add_room_form.reset();

      }
      else{
      alert('error','Room added failed. Server Down!');
      }
      }
      xhr.send(data); //data is sent cause all the things(name,picture,add_member) are append in this variable
    }
  </script>
       
  </body>
</html>
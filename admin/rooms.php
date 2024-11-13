
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
        require('links.php');
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
  <script>
    let add_room_form = document.getElementById('add_room_form');

    add_room_form.addEventListener('submit',function(event){
      event.preventDefault();
      add_rooms();
    });
    //db table ma insert grney wala
    function add_rooms()
    {
      //when uploading file through Ajax FormData() is used
      let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
      data.append('add_room','');
      data.append('name',add_room_form.elements['name'].value);
      data.append('area',add_room_form.elements['area'].value);
      data.append('price',add_room_form.elements['price'].value);
      data.append('quantity',add_room_form.elements['quantity'].value);
      data.append('description',add_room_form.elements['description'].value);

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
      get_all_rooms(); // it updates the room list immediately after adding a new room

      }
      else{
      alert('error','Room added failed. Server Down!');
      }
      }
      xhr.send(data); //data is sent cause all the things(name,picture,add_member) are append in this variable
    }


    //db table bata admin panel ko rooms section ma fetch garna
    function get_all_rooms()
    {

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/rooms.php",true);
      xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');


      /*xhr.onreadystatechange = function(){
      if(this.readyState==4 && this.status==200){
      //yesko satto short:*/
      xhr.onload = function(){
        //room-data id line 51 ma xa tbody ma yo id ma rooms haru lyayerw rakhey ho
        document.getElementById('room-data').innerHTML = this.responseText;
 
      }
      xhr.send('get_all_rooms');
    }

    let edit_room_form = document.getElementById('edit_room_form');

    function edit_details(id)
    {
      //yo id ko behalf ma httprequest pathauna parxa
      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/rooms.php",true);
      xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

      /*xhr.onreadystatechange = function(){
      if(this.readyState==4 && this.status==200){
      //yesko satto short:*/
      xhr.onload = function(){
        let data = JSON.parse(this.responseText);

        edit_room_form.elements['name'].value = data.roomdata.name;
        edit_room_form.elements['area'].value = data.roomdata.area;
        edit_room_form.elements['price'].value = data.roomdata.price;
        edit_room_form.elements['quantity'].value = data.roomdata.quantity;
        edit_room_form.elements['description'].value = data.roomdata.description;
        
        edit_room_form.elements['room_id'].value = data.roomdata.id;

        edit_room_form.elements['features'].forEach(el =>{
          if(data.features.includes(Number(el.value))){
            el.checked = true;
          }
        });

        edit_room_form.elements['facilities'].forEach(el =>{
          if(data.facilities.includes(Number(el.value))){
            el.checked = true;
          }
        });
      }
      xhr.send('get_room='+id);
  }

     //room edit garepaxi submit grna 
     edit_room_form.addEventListener('submit',function(event){
      event.preventDefault();
      submit_edit_room();
    });

     //room lai edit garerw db table ma insert grney wala matlab upadte/edit grney
     function submit_edit_room()
    {
      //when uploading file through Ajax FormData() is used
      let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
      data.append('edit_room','');
      data.append('room_id',edit_room_form.elements['room_id'].value);
      data.append('name',edit_room_form.elements['name'].value);
      data.append('area',edit_room_form.elements['area'].value);
      data.append('price',edit_room_form.elements['price'].value);
      data.append('quantity',edit_room_form.elements['quantity'].value);
      data.append('description',edit_room_form.elements['description'].value);

      let features = [];
      edit_room_form.elements['features'].forEach(el =>{
        if(el.checked){
          features.push(el.value);
        }
      });

      let facilities = [];
      edit_room_form.elements['facilities'].forEach(el =>{
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
      console.log("Server response:", this.responseText);
      var myModal = document.getElementById('edit-room');
      var modal = bootstrap.Modal.getInstance(myModal); // Returns a Bootstrap modal instance
      modal.hide(); //general setting ko tyo form submit modal hide grna cancel wa sumbit bayepaxi

      if(this.responseText == 1 ){
      alert('success','Room data edited successfully');
      edit_room_form.reset(); //form submit bayeC form ko data clear huna paroo
      get_all_rooms(); //as the room data is edited it updated the room list and data immediately
      }
      else{
      alert('error','Room data edited failed. Server Down!');
      }
      };
      xhr.send(data); //data is sent cause all the things(name,picture,add_member) are append in this variable
    }


   //rooms ma status active rw inactive garauna baki code 
    function toggle_status(id,val)
    {

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/rooms.php",true);
      xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');


      /*xhr.onreadystatechange = function(){
      if(this.readyState==4 && this.status==200){
      //yesko satto short:*/
      xhr.onload = function(){
        if(this.responseText == 1){
          alert('success','Status toggled');
        }
        else{
          alert('success','Status toggled failed');
        }
      }
      xhr.send('toggle_status='+id+'&value='+val);
    }
  //admin panel bata room ko image add grna rooms section ma
    let add_image_form = document.getElementById('add_image_form');

    add_image_form.addEventListener('submit',function(e){
      e.preventDefault();
      add_image();
    });

    function add_image()
    {
      //when uploading file through Ajax FormData() is used
      let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
      data.append('image',add_image_form.elements['image'].files[0]);
      data.append('room_id',add_image_form.elements['room_id'].value);
      data.append('add_image','');

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/rooms.php",true);
      //picture pathauda setRequestHeader chaidaina

      /*xhr.onreadystatechange = function(){
      if(this.readyState==4 && this.status==200){
      //yesko satto short:*/
      xhr.onload = function(){
        
        if(this.responseText == 'inv_img'){
          alert('error','Only JPG, WEBP and PNG images are allowed','image-alert');
        }
        else if(this.responseText == 'inv_size' ){
          alert('error','Image size should be less than 2MB','image-alert');
        }
        else if(this.responseText == 'upd_failed'){
        alert('error','Image upload failed. Server Down!','image-alert');
        }
        else{
        alert('success','New image added!','image-alert');
        //new member add bayeC inputfield ko data blank huna parO
        room_images(add_image_form.elements['room_id'].value,document.querySelector("#room-images .modal-title").innerText);  
        add_image_form.reset();
        }
      }
      xhr.send(data); //data is sent cause all the things(name,picture,add_image) are append in this variable
    }

    function room_images(id,rname){
      document.querySelector("#room-images .modal-title").innerText = rname;
      add_image_form.elements['room_id'].value = id;
      add_image_form.elements['image'].value = '';


      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/rooms.php",true);
      xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
      /*xhr.onreadystatechange = function(){
      if(this.readyState==4 && this.status==200){
      //yesko satto short:*/
      xhr.onload = function(){
        document.getElementById('room-image-data').innerHTML = this.responseText;
      }
      xhr.send('get_room_images='+id);
    }

    function rem_image(img_id,room_id)
    {
      //when uploading file through Ajax FormData() is used
      let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
      data.append('image_id',img_id);
      data.append('room_id',room_id);
      data.append('rem_image','');

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/rooms.php",true);
      //picture pathauda setRequestHeader chaidaina

      /*xhr.onreadystatechange = function(){
      if(this.readyState==4 && this.status==200){
      //yesko satto short:*/
      xhr.onload = function(){
        
        if(this.responseText == 1){
          alert('success','Image removed successfully','image-alert');
          room_images(room_id,document.querySelector("#room-images .modal-title").innerText);  
   
        }
        else{
           alert('error','Image removal failed','image-alert');
        //new member add bayeC inputfield ko data blank huna parO
            add_image_form.reset();
        }
      }
      xhr.send(data); //data is sent cause all the things(name,picture,add_image) are append in this variable
    }

    function thumb_image(img_id,room_id)
    {
      //when uploading file through Ajax FormData() is used
      let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
      data.append('image_id',img_id);
      data.append('room_id',room_id);
      data.append('thumb_image','');

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/rooms.php",true);
      //picture pathauda setRequestHeader chaidaina

      /*xhr.onreadystatechange = function(){
      if(this.readyState==4 && this.status==200){
      //yesko satto short:*/
      xhr.onload = function(){
        
        if(this.responseText == 1){
          alert('success','Image Thumbnail Changed successfully','image-alert');
          room_images(room_id,document.querySelector("#room-images .modal-title").innerText);  
  
        }
        else{
           alert('error','Image Thumbnail update  failed','image-alert');
        }
      }
      xhr.send(data); //data is sent cause all the things(name,picture,add_image) are append in this variable
    }

    function remove_room(room_id)
    {
      if(confirm("Are you sure, you want to delete this room(along with room selected features and facilities will also be removed)?"))
    {
       //when uploading file through Ajax FormData() is used
      let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
      data.append('room_id',room_id);
      data.append('remove_room','');
      let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/rooms.php",true);
        //picture pathauda setRequestHeader chaidaina

        /*xhr.onreadystatechange = function(){
        if(this.readyState==4 && this.status==200){
        //yesko satto short:*/
        xhr.onload = function(){
          
          if(this.responseText == 1){
            alert('success','Room remove successfully');
            get_all_rooms();
          }
          else{
              alert('error','Room removal failed');
          }
        }
        xhr.send(data); //data is sent cause all the things(name,picture,add_image) are append in this variable

    }
    
          }



      window.onload = function(){
        get_all_rooms();
      }


 </script>
       
  </body>
</html>
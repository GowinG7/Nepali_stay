
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

        <script>
          let feature_s_form = document.getElementById('feature_s_form');
          let facility_s_form = document.getElementById('facility_s_form');

          feature_s_form.addEventListener('submit', function(e){
            e.preventDefault();
            add_feature();
          });
        //database ma fetch garauna
        function add_feature() 
          {
            //when uploading file through Ajax FormData() is used
            let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
            data.append('name',feature_s_form.elements['feature_name'].value);
            data.append('add_feature','');

            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/features_facilities.php",true);
           

            /*xhr.onreadystatechange = function(){
            if(this.readyState==4 && this.status==200){
            //yesko satto short:*/
            xhr.onload = function(){
            var myModal = document.getElementById('feature-s')
            var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
            modal.hide(); //general setting ko tyo form submit modal hide grna cancel wa sumbit bayepaxi

            if(this.responseText == 1 ){
              alert('success','New feature added!');
              //new member add bayeC inputfield ko data blank huna parO
              feature_s_form.elements['feature_name'].value = '';
              get_features();
            }
            else{
              alert('error','Feature added failed. Server Down!');
            }
            }
            xhr.send(data); //data is sent cause all the things(name,picture,add_member) are append in this variable
          } 

         //dynamic huda admin panel ma fetch garauna
        function get_features()
        {
        //get features data from database
          let xhr = new XMLHttpRequest();
          xhr.open("POST","ajax/features_facilities.php",true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

          /*xhr.onreadystatechange = function(){
          if(this.readyState==4 && this.status==200){
          //yesko satto short:*/
          xhr.onload = function(){
          document.getElementById('features-data').innerHTML = this.responseText;
          }

          xhr.send('get_features');
        }

        function rem_feature(val)
        {
          //remove features data from database so sr_no should be passed to delete
          let xhr = new XMLHttpRequest();
          xhr.open("POST","ajax/features_facilities.php",true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

          /*xhr.onreadystatechange = function(){
          if(this.readyState==4 && this.status==200){
          //yesko satto short:*/
          xhr.onload = function(){
          if(this.responseText==1){
          alert('success','feature removed!');
          get_features(); //feature remove bayeC feri call garinca get_features
          }
          else if(this.responseText == 'room_added'){
            alert('error','Feature is added in the room');
          }
          else{
          alert('error','Feature removal failed!');
          }

          }

          xhr.send('rem_feature='+val);
        }


        facility_s_form.addEventListener('submit', function(e){
            e.preventDefault();
            add_facility();
        });
        //database table ma rakhna
        function add_facility() 
          {
            //when uploading file through Ajax FormData() is used
            let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
            data.append('name',facility_s_form.elements['facility_name'].value);
            data.append('icon',facility_s_form.elements['facility_icon'].files[0]); //facility icon image file ho files[0] bnya jati pani choose baxa pailo image matra upload hunxa multiple image upload hunna
            data.append('desc',facility_s_form.elements['facility_desc'].value);
            data.append('add_facility','');

            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/features_facilities.php",true);
           

            /*xhr.onreadystatechange = function(){
            if(this.readyState==4 && this.status==200){
            //yesko satto short:*/
            xhr.onload = function(){
            var myModal = document.getElementById('facility-s')
            var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
            modal.hide(); //general setting ko tyo form submit modal hide grna cancel wa sumbit bayepaxi

            if(this.responseText == 'inv_img' ){
              alert('error','Only SVG images are allowed');
            }
            else if(this.responseText == 'inv_size' ){
              alert('error','Image size should be less than 1MB');
            }
            else if(this.responseText == 'upd_failed'){
              alert('error','Image upload failed');
            }
            else{
              alert('success','Facility added successfully');
              facility_s_form.reset();
              //get_members();
            }
            }
            xhr.send(data); //data is sent cause all the things(name,picture,add_member) are append in this variable
          } 
        
        //dynamic huda database table bata admin panel ma leuna
        function get_facility()
          {
            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/features_facilities.php",true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            /*xhr.onreadystatechange = function(){
            if(this.readyState==4 && this.status==200){
            //yesko satto short:*/
            xhr.onload = function(){
            document.getElementById('facilities-data').innerHTML = this.responseText;
            }

            xhr.send('get_facilities');
          }

        function rem_facility(val)
        {
            //remove features data from database so sr_no should be passed to delete
            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/features_facilities.php",true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            /*xhr.onreadystatechange = function(){
            if(this.readyState==4 && this.status==200){
            //yesko satto short:*/
            xhr.onload = function(){
            if(this.responseText==1){
            alert('success','facility removed!');
            get_facility(); //feature remove bayeC feri call garinca get_features
            }
            else if(this.responseText == 'room_added'){
              alert('error','Feature is added in the room');
            }
            else{
            alert('error','Facility removal failed!');
            }

            }

            xhr.send('rem_facility='+val);
        }



        window.onload = function(){ //upload image after the page loads
          get_features();
          get_facility();
         }

        </script>

  </body>
</html>
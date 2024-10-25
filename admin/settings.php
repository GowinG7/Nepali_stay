<?php
require('essentials.php');
adminLogin(); //essentials file ma xa 

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Panel - Settings</title>
        <?php 
        require('links.php')
        ?>  
    </head>
    <body class="bg-light">
     
    <?php require('header.php'); ?>


     <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden"> 
        <h3 class="mb-4">Settings</h3>

    <!-- General settings section -->
        <div class="card border-0 shadow-sm mb-4" >
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <h5 class="card-title m-0" >General Settings</h5>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#general-s">
                <i class="bi bi-pencil-square"></i>Edit
              </button>
            </div>
          <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
          <p class="card-text" id="site_title"></p>
          <h6 class="card-subtitle mb-1 fw-bold">About US</h6>
          <p class="card-text" id="site_about"></p>
         
          </div>
        </div>

        <!-- General settings Modal -->
      <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form id="general_s_form"> 
            <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">General Settings</h5>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                  <label class="form-label fw-bold">Site Title</label>
                  <input type="text" name="site_title" id="site_title_inp" class="form-control shadow-none" required>
              </div>
              <div class=" mb-3">
                <label class="form-label fw-bold">About us</label>
                <textarea name="site_about" id="site_about_inp" class="form-control shadow-none" rows="6" required></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" onclick="site_title.value = general_data.site_title, site_about.value = general_data.site_about" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn custom-bg text-white shadow none">Submit</button>
            </div>
          </div>
          </form> 
        </div>
      </div>

       <!-- Shutdown section -->
        <div class="card border-0 shadow-sm" > 
        <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <h5 class="card-title m-0" >Shutdown Website</h5>
          <div class="form-check form-switch">
            <form >
               <input onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox" id="shutdown-toggle">
            </form>
           
          </div>
          
        </div>
        <p class="card-text" >
          No customers will be allowed to book hotel room, when shutdown mode is turned on.
        </p>

        </div>
        </div>

        <!-- Contact details section -->
        <div class="card border-0 shadow-sm mb-4" >
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <h5 class="card-title m-0" >Contacts Settings</h5>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#contacts-s">
                <i class="bi bi-pencil-square"></i>Edit
              </button>
            </div>
            <div class="row">
                <!--left column -->
              <div class="col-lg-6">
                <div class="mb-4">
                 <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                 <p class="card-text" id="address"></p>  
                </div>
                <div class="mb-4">
                 <h6 class="card-subtitle mb-1 fw-bold">Google Map</h6>
                 <p class="card-text" id="gmap"></p>  
                </div>
                <div class="mb-4">
                 <h6 class="card-subtitle mb-1 fw-bold">Phone Numbers</h6>
                 <p class="card-text mb-1" >
                  <i class="bi bi-telephone-fill"></i>
                  <span id="pn1"></span> 
                 </p>
                 <p class="card-text" >
                  <i class="bi bi-telephone-fill"></i>
                  <span id="pn2"></span> 
                 </p>  
                </div>
                <div class="mb-4">
                 <h6 class="card-subtitle mb-1 fw-bold">E-mail</h6>
                 <p class="card-text" id="email"></p>  
                </div>
                </div>
                <!--right column -->
                <div class="col-lg-6">
                <div class="mb-4">
                 <h6 class="card-subtitle mb-1 fw-bold">Social Links</h6>
                 <p class="card-text mb-1" >
                 <i class="bi bi-facebook me-1"></i>
                  <span id="fb"></span> 
                 </p>
                 <p class="card-text " >
                  <i class="bi bi-instagram me-1"></i>
                  <span id="insta"></span> 
                 </p>  
                </div> 
                <div class="mb-4">
                 <h6 class="card-subtitle mb-1 fw-bold">iFrame</h6>
                 <iframe id="iframe" class="border p-2 w-100" loading="lazy"></iframe>
                </div> 
                </div>
              </div>
        
         
          </div>
        </div>



      </div>
    </div>
    </div>

  <?php require('scripts.php');?>
  
  <script>
    //AJAX with Javascript for fetching General Settings
    let general_data, contacts_data;
    
    let site_title_inp = document.getElementById('site_title_inp');
    let site_about_inp = document.getElementById('site_about_inp');

    let general_s_form = document.getElementById('general_s_form');

    function get_general(){
      let site_title = document.getElementById('site_title');
      let site_about = document.getElementById('site_about');

      let shutdown_toggle = document.getElementById('shutdown-toggle');

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/settings_crud.php",true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      /*xhr.onreadystatechange = function(){
        if(this.readyState==4 && this.status==200){
      //yesko satto short:*/
        xhr.onload = function(){
        console.log(this.responseText);  // Check the response in browser's console
        general_data = JSON.parse(this.responseText);

        if(general_data.error){
        console.log(general_data.error);
        } else {
        site_title.innerText = general_data.site_title;
        site_about.innerText = general_data.site_about;

        site_title_inp.value = general_data.site_title;
        site_about_inp.value = general_data.site_about;

        //yedi shutdown bayo baney value = 1 ani switches toggle ni on hunxa 
        //yedi value= 0 no shutdown and switches toogle off hunxa
        if(general_data.shutdown == 0){
          shutdown_toggle.checked = false;
          shutdown_toggle.value = 0;
        }
        else{
          shutdown_toggle.checked = true;
          shutdown_toggle.value = 1;
        }

        }
        }


      xhr.send('get_general');
    }

     general_s_form.addEventListener('submit',function(e){ //e = event occur , its target the form 
      e.preventDefault(); //submit baie page lai refresh  form ko defualt behaviour yo behaviour bata rokney
      upd_general(site_title_inp.value,site_about_inp.value);
    })

    //setting ko site title rw about ko edit wala form ko submit bata ajax bata data  fetch garauna ani upd_general() le update garauna
    function upd_general(site_title_val, site_about_val)
    {
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/settings_crud.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        /*xhr.onreadystatechange = function(){
        if(this.readyState==4 && this.status==200){
        //yesko satto short:*/
        xhr.onload = function(){

          var myModal = document.getElementById('general-s')
          var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
          modal.hide(); //general setting ko tyo form submit modal hide grna cancel wa sumbit bayepaxi

        console.log(this.responseText);  // Check the response in browser's console
        
          if(this.responseText == 1)
        {
          //alert() scripts.php ma xa
          alert('success','Changes saved!');
          get_general(); //fetched the data from the database and store in the admin general settings 
        }
        else
        {
          alert('error',"No changes made!");
        }
        }
       xhr.send('site_title='+site_title_val + '&site_about='+site_about_val+'&upd_general=1');

    }
  
    function upd_shutdown(val){
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/settings_crud.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        /*xhr.onreadystatechange = function(){
        if(this.readyState==4 && this.status==200){
        //yesko satto short:*/
        xhr.onload = function(){
        if(this.responseText == 1 && general_data.shutdown==0) //yedi paila zero thiyo rw ahele 1 vaye
        {
        //alert() scripts.php ma xa
        alert('success','Site has been Shutdown!');
         }
        else
        {
        alert('success',"Shutdown mode off!"); //Site shutdown hoss ya nahoss kunai pani error hoina so no error
        }
        get_general(); //fetched the data from the database and store in the admin general settings 
        }
        xhr.send('upd_shutdown='+val);

    }

    function get_contacts(){
      
      let contacts_p_id = ['address','gmap','pn1','pn2','email','fb','insta'];
      let iframe = document.getElementById('iframe');

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/settings_crud.php",true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      /*xhr.onreadystatechange = function(){
        if(this.readyState==4 && this.status==200){
      //yesko satto short:*/
        xhr.onload = function(){
         contacts_data = JSON.parse(this.responseText);
         contacts_data = Object.values(contacts_data);
         console.log(contacts_data);
          
        }


      xhr.send('get_contacts');
    }


   //window load bayeC yo function call huna parYo
    window.onload = function(){
      get_general();
      get_contacts();
    }

  </script>

  </body>
</html>
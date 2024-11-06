
<?php
require('essentials.php');
require('db_config.php');
adminLogin(); //essentials file ma xa 

if(isset($_GET['seen']))
{
  $frm_data = filteration($_GET);

  if($frm_data['seen']=='all'){
    $q = "UPDATE `user_queries` SET `seen`=? ";
    $values = [1];
    if(update($q,$values,'i')){
      alert('success', 'Marked as read');
    }
    else{
      alert('error','Failed to mark as read');
    }
  }
  else{
    $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=? ";
    $values = [1, $frm_data['seen']];
    if(update($q,$values,'ii')){
      alert('success', 'Marked as read');
    }
    else{
      alert('error','Failed to mark as read');
    }
  }
}

if(isset($_GET['del']))
{
  $frm_data = filteration($_GET);
  
  if($frm_data['del']=='all'){
    $q = "DELETE FROM `user_queries`";
    if(mysqli_query($con,$q)){
      alert('success', 'All Data deleted');
    }
    else{
      alert('error','All Data deleted failed');
    }
  }
  else{
    $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
    $values = [$frm_data['del']];
    if(update($q,$values,'i')){
      alert('success', 'Data deleted');
    }
    else{
      alert('error','Data deleted failed');
    }
  }
}

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

        <div class="d-flex align-items-center justify-content-between mb-3">
          <h5 class="card-title m-0">Features</h5>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#feature-s">
            <i class="bi bi-plus-square"></i> Add
          </button>
        </div>

        <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
          
          <div class="table-responsive-md" style="height: 450px; overflow: scroll;">
            <table class="table table-hover border">
              <thead class="sticky-top" >
                <tr class="bg-dark text-light">
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col" width="5%">Email</th>
                  <th scope="col" width="15%"> Subject</th>
                  <th scope="col" width="25%">Message</th>
                  <th scope="col" width="10%">Date</th>
                  <th scope="col">Action</th> <!--seen grney ki delete -->
                </tr>
              </thead>
              <tbody>
               <?php
               $q = "SELECT * FROM `user_queries` ORDER BY `sr_no` DESC";
               $data = mysqli_query($con, $q);
               $i = 1;
               while($row = mysqli_fetch_assoc($data))
               {
                 $seen = '';
                 if($row['seen']!=1){
                   $seen = "<a href='?seen=$row[sr_no]' class='btn btn-sm rouded-pill btn-primary'>Mark as read</a> <br>";
                 }
                 $seen .= "<a href='?del=$row[sr_no]' class='btn btn-sm rouded-pill btn-danger mt-2'>Delete</a>";

                 echo <<<query
                  <tr>
                   <td>$i</td>
                   <td>$row[name]</td>
                   <td>$row[email]</td>
                   <td>$row[subject]</td>
                   <td>$row[message]</td>
                   <td>$row[date]</td>
                   <td>$seen</td>
                  </tr>
                query;
                 $i++;
               }
               ?>
              </tbody>
            </table> 
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
                    <input type="text" name="feature_name" class="form-control shadow-none" required>
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

            feature_s_form.addEventListener('submit', function(e){
             e.preventDefault();
             add_member();
            });

          function add_feature()
          {
            //when uploading file through Ajax FormData() is used
            let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
            data.append('name',feature_s_form.elements['feature_name'].value);
            data.append('picture',member_picture_inp.files[0]);
            data.append('add_member','');

            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/settings_crud.php",true);
            //picture pathauda setRequestHeader chaidaina

            /*xhr.onreadystatechange = function(){
            if(this.readyState==4 && this.status==200){
            //yesko satto short:*/
            xhr.onload = function(){
            var myModal = document.getElementById('team-s')
            var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
            modal.hide(); //general setting ko tyo form submit modal hide grna cancel wa sumbit bayepaxi

            if(this.responseText == 'inv_img'){
            alert('error','Only JPG and PNG images are allowed');
            }
            else if(this.responseText == 'inv_size' ){
            alert('error','Image size should be less than 2MB');
            }
            else if(this.responseText == 'upd_failed'){
            alert('error','Image upload failed. Server Down!');
            }
            else{
            alert('success','New member added!');
            //new member add bayeC inputfield ko data blank huna parO
            member_name_inp.value = '';
            member_picture_inp.value = '';
            get_members();
            }
            }

            xhr.send(data); //data is sent cause all the things(name,picture,add_member) are append in this variable
          } 

        </script>

  </body>
</html>
<?php session_start()?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>FACILITIES </title>


  <?php require('links.php'); ?>
  <style>
    .pop:hover {
      border-top-color: var(--teal) !important;
      transform: scale(1.03);
      transition: all 0.3s;

    }
  </style>
  <style>
    

    @media screen and (max-width:575px) {
      .availability-form {
        margin-top: 25px;
        padding: 0 35px;
      }
    }

    body {
      background-color: whitesmoke;
      /* Replace with your chosen color code */
    }

    .custom-navbar {
      background-color: #65d9ee;
      /* Dark Blue color */
       }
      /*for making footer same as the navbar*/
      
    .container-fluid-footer {
    background-color: #65d9ee; /* change this to your desired background color */
      }
  
  </style>
</head>


<body>
  <?php require('header.php'); ?>

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">OUR FACILITIES</h2>
    <div class="h-line" style="width: 150px; height: 1.6px; background-color: black; margin: 10px auto;"></div>
   
  </div>

  <div class="container">
    <div class="row">
    <!--Dynamically fetch garayeka xau-->
      <?php
      $res = selectAll('facilities');
      $path = FACILITIES_IMG_PATH;
      while ($row = mysqli_fetch_assoc($res)) {
        echo <<<data
          <div class="col-lg-4 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
              <div class="d-flex align-items-center mb-2">
                <img src="$path$row[icon]" width="40px">
                <h5 class="m-0 ms-3 ">$row[name]</h5>
              </div>
              <p>$row[desc]</p>
            </div>
          </div>
         data;
      }
      ?>

    

    </div>
  </div>


  <?php require('footer.php'); ?>
  <!-- Start PHP code.
    //require('footer.php');: Include and execute footer.php.
      End PHP code.-->


</body>

</html>
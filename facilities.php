<?php session_start()?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>FACILITIES </title>


  <?php require('links.php'); 
  
  if (!isset($_SESSION["user_id"])) {
   
    // Redirect to login page if session is not set
    header("Location: loginsignup/login.php");
    exit();
    }
  ?>
  <style>
      /* Ensure full height for the html and body */
      html, body {
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
      background-color: whitesmoke; /* Replace with your chosen background color */
      }

      /* Flexbox for the main body layout */
      body {
      min-height: 100vh;
      }

      /* Content container to fill available space */
      .container {
      flex: 1; /* Ensures content stretches to push the footer to the bottom */
      }

      /* Hover effect for the facilities box */
      .pop:hover {
      border-top-color: var(--teal) !important;
      transform: scale(1.03);
      transition: all 0.3s;
      }

      /* Navbar styling */
      .custom-navbar {
      background-color: #65d9ee; /* Dark Blue color */
      }

      /* Footer styling */
      .container-fluid-footer {
      background-color: #65d9ee; /* Matches navbar color */
      text-align: center;
      padding: 10px 0;
      margin-top: auto; /* Ensures the footer sticks to the bottom */
      }

      /* Optional media query for smaller screens */
      @media screen and (max-width: 575px) {
      .container-fluid-footer {
      padding: 15px 0; /* Adjust spacing for better display */
      }
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
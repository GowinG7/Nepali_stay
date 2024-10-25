<!DOCTYPE html>
<html lang="en">

<head>
  <title>NEPALI STAY -ABOUT </title>


  <?php require('links.php'); ?>
  
  <style>
    /*only for the about us top border color 100+ Rooms like mini cards*/ 
    .box{
       border-top-color: var(--teal) !important;
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


<body class="bg-light">
  <?php require('header.php'); ?>
   
  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">ABOUT US</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
      Lorem ipsum dolor, sit amet consectetur adipisicing elit.
       Excepturi commodi voluptate recusandae nam magnam aperiam 
       consequuntur, officia cumque. Dignissimos deserunt harum expedita error animi cupiditate corrupti, culpa deleniti tempore sint.
    </p>
  </div>

    <div class="container">
      <div class="row justify-content-between align-items-center">
        <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
          <h3 class="mb-3">Lorem ipsum dolor sit amet.</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Beatae officia delectus commodi consequatur facilis animi 
            veniam! Lorem, ipsum dolor sit amet consectetur adipisicing 
            elit. Est, possimus!
          </p>
          </div>

          <div class="col-lg-5 col-md-5 mb-4 order-lg-1 order-md-2 order-1">
            <img src="images/about/one.jpg" class="w-100" height="450px" >
          </div>
        </div>

    <div class="container mt-5">
      <div class="row">
      <div class="col-lg-3 col-md-6 mb-4 px-4">
          <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/one.jpg" width="70px">
          <h4 class="mt-3">100+ Rooms</h4>
    </div>
  </div>

      <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
      <img src="images/about/one.jpg" width="70px">
      <h4 class="mt-3">100+ Rooms</h4>
      </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
      <img src="images/about/one.jpg" width="70px">
      <h4 class="mt-3">100+ Rooms</h4>
      </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
      <img src="images/about/one.jpg" width="70px">
      <h4 class="mt-3">100+ Rooms</h4>
      </div>
      </div>

      </div>
  </div>
  

  <h3 class="my-5 fw-bold h-font text-center">MANAGEMENT TEAM</h3>

  <?php require('footer.php'); ?>
  <!-- Start PHP code.
    //require('footer.php');: Include and execute footer.php.
      End PHP code.-->


</body>

</html>
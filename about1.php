<!DOCTYPE html>
<html lang="en">

<head>
  <title>NEPALI STAY -ABOUT </title>


  <?php require('links.php'); ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <style>
    /*only for the about us top border color 100+ Rooms like mini cards*/ 
    .box{
       border-top-color: var(--teal) !important;
    }
  </style>
  <style>
    @media screen and (max-width: 575px) {
      .availability-form {
        margin-top: 150px;
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
            <img src="images/about/about.jpg" class="w-100" height="450px" >
          </div>
        </div>
      </div>

  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/hotel.svg" width="70px" alt="Rooms Icon">
          <h4 class="mt-3">20+ ROOMS</h4>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/customers.svg" width="70px" alt="Customers Icon">
          <h4 class="mt-3">200+ CUSTOMERS</h4>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/rating.svg" width="70px" alt="Rating Icon">
          <h4 class="mt-3">100+ REVIEWS</h4>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/staff.svg" width="70px" alt="Staff Icon">
          <h4 class="mt-3">10+ STAFFS</h4>
        </div>
      </div>
    </div>
  </div>

  

  <h3 class="my-5 fw-bold h-font text-center">MANAGEMENT TEAM</h3>
   
    <div class="container px-4">
     <!-- Swiper -->
      <div class="swiper mySwiper">
          <div class="swiper-wrapper mb-5">
            <div class="swiper-slide bg-white text-center overflow-hidden rounded">
              <img src="images/about/team.jpg" class="w-100">
              <h5 class="mt-2">Random User</h5>  
            </div>
            <div class="swiper-slide bg-white text-center overflow-hidden rounded">
              <img src="images/about/one.jpg" class="w-100">
              <h5 class="mt-2">Random User</h5>  
            </div>
            <div class="swiper-slide bg-white text-center overflow-hidden rounded">
              <img src="images/about/one.jpg" class="w-100">
              <h5 class="mt-2">Random User</h5>  
            </div>
            <div class="swiper-slide bg-white text-center overflow-hidden rounded">
              <img src="images/about/team.jpg" class="w-100">
              <h5 class="mt-2">Random User</h5>  
            </div>
          </div>

            
        <div class="swiper-pagination"></div>
      </div>
    </div>


  <?php require('footer.php'); ?>
  <!-- Start PHP code.
    //require('footer.php');: Include and execute footer.php.
      End PHP code.-->


      <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

   <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4,
        spaceBetween: 40,
       pagination: {
        el: ".swiper-pagination",
       },
       breakpoints: {
        320: {
          slidesPerView: 1,
        },
        460: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        }

      }
      });
    </script>

</body>

</html>
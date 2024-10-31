<!DOCTYPE html>
<html lang="en">

<head>
  <title>NEPALI STAY -HOME</title>

  <?php require('links.php'); ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <style>
    /*these two css are only used in this file*/
    .availability-form {
      margin-top: -50px;
      z-index: 2;
      position: relative;
    }

    @media screen and (max-width:575px) {
      .availability-form {
        margin-top: 25px;
        padding: 0 35px;
      }
    }

    body {
      background-color: #d8d3ec;
      /* Replace with your chosen color code */
    }

    .custom-navbar {
      background-color: rgb(78, 171, 207);
      /* Dark Blue color */
    }
      /*to make the footer as same as the navbar bg color */
      .container-fluid-footer{
        background-color: rgb(78, 171, 207);
      }
    
  </style>


</head>


<body>
  <?php require('header.php'); ?>


  <!-- Carousel -->
  <div class="container-fluid px-lg-4 mt-4">
    <!-- Swiper -->
    <div class="swiper swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="images\Carousel(Slideshow)/1.png" class="w-100 d-block">
        </div>
        <div class="swiper-slide">
          <img src="images\Carousel(Slideshow)/2.png" class="w-100 d-block">
        </div>
        <div class="swiper-slide">
          <img src="images\Carousel(Slideshow)/3.png" class="w-100 d-block">
        </div>
        <div class="swiper-slide">
          <img src="images\Carousel(Slideshow)/4.png" class="w-100 d-block">
        </div>
        <div class="swiper-slide">
          <img src="images\Carousel(Slideshow)/7.png" class="w-100 d-block">
        </div>
        <div class="swiper-slide">
          <img src="images\Carousel(Slideshow)/8.png" class="w-100 d-block">
        </div>
        <div class="swiper-slide">
          <img src="images\Carousel(Slideshow)/9.png" class="w-100 d-block">
        </div>
      </div>
    </div>
  </div>

  <!--check availability-->
  <div class="container availability-form">
    <div class="row justify-content-center">
      <div class="col-lg-8 bg-white shadow p-4 rounded">
        <h5 class="mb-4"> Check Booking availability</h5>
        <form>
          <div class="row align-items-end">
            <div class="col-lg-6 mb-3">
              <label class="form-label" style="font-weight:500;">Check-in</label>
              <input type="date" class="form-control shadow-none">
            </div>
            <div class="col-lg-6 mb-3">
              <label class="form-label" style="font-weight:500;">Check-out</label>
              <input type="date" class="form-control shadow-none">
            </div>
            <!--<div class="col-lg-3 mb-3">
            <label class="form-label" style="font-weight:500;">Adult</label>
            <select class="form-select shadow-none" >
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>   
          <div class="col-lg-2 mb-3">
            <label class="form-label" style="font-weight:500;">Children</label>
            <select class="form-select shadow-none" >
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>      -->
            <!--In bootstrap there can be 12 columns in 1 row-->
            <button type="submit" class="btn btn-primary">Check Availability</button>

          </div>
        </form>
      </div>
    </div>
  </div>


  <!--Our Rooms-->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>
  <!--Rooms card-->
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow" style="max-width:350px; margin: auto;">
          <img src="images/Rooms/1.png" class="card-img-top">
          <div class="card-body">
            <h5>Simple Room Name</h5>
            <h6 class="mb-4">Rs.200 per night</h6>
            <div class="features mb-4">
              <h6 class="mb-1">Features</h6>
              <span class="badge bg-light text-dark text-wrap lh-base">
                2 Rooms
              </span>
              <span class="badge bg-light text-dark text-wrap lh-base">
                1 Bathroom
              </span>
              <span class="badge bg-light text-dark text-wrap lh-base">
                1 Balcony
              </span>
              <span class="badge bg-light text-dark text-wrap lh-base">
                3 sofa
              </span>
            </div>
            <div class="facilities mb-4">
              <h6 class="mb-1">Features</h6>
              <span class="badge bg-light text-dark text-wrap lh-base">
                WiFi
              </span>
              <span class="badge bg-light text-dark text-wrap lh-base">
                Television
              </span>
              <span class="badge bg-light text-dark text-wrap lh-base">
                AC
              </span>
              <span class="badge bg-light text-dark text-wrap lh-base">
                Room heater
              </span>
            </div>

            <div class="rating mb-4">
              <h6 class="mb-1">Rating</h6>
              <span class="badge rounded-pill bg-light">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </span>

            </div>
            <div class="d-flex justify-content-evenly mb-2">
              <!-- Updated background color for visibility -->
              <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book now</a>
              <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
            </div>

          </div>
        </div>
      </div>


      <!--Rooms card-->
      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow" style="max-width:350px; margin: auto;">
          <img src="images/Rooms/1.png" class="card-img-top">
          <div class="card-body">
            <h5>Simple Room Name</h5>
            <h6 class="mb-4">Rs.200 per night</h6>
            <div class="features mb-4">
              <h6 class="mb-1">Features</h6>
              <span class="badge bg-light text-dark text-wrap lh-base">
                2 Rooms
              </span>
              <span class="badge bg-light text-dark text-wrap lh-base">
                1 Bathroom
              </span>
              <span class="badge bg-light text-dark text-wrap lh-base">
                1 Balcony
              </span>
              <span class="badge bg-light text-dark text-wrap lh-base">
                3 sofa
              </span>
            </div>
            <div class="facilities mb-4">
              <h6 class="mb-1">Features</h6>
              <span class="badge bg-light text-dark text-wrap lh-base">
                WiFi
              </span>
              <span class="badge bg-light text-dark text-wrap lh-base">
                Television
              </span>
              <span class="badge bg-light text-dark text-wrap lh-base">
                AC
              </span>
              <span class="badge bg-light text-dark text-wrap lh-base">
                Room heater
              </span>

            </div>
            <div class="rating mb-4">
              <h6 class="mb-1">Rating</h6>
              <span class="badge rounded-pill bg-light">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </span>
            </div>
            <div class="d-flex justify-content-evenly mb-2">
              <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book now</a>
              <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
            </div>
          </div>
        </div>
      </div>

      <!--Rooms card-->
      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow" style="max-width:350px; margin: auto;">
          <img src="images/Rooms/1.png" class="card-img-top">
          <div class="card-body">
            <h5>Simple Room Name</h5>
            <h6 class="mb-4">Rs.200 per night</h6>
            <div class="features mb-4">
              <h6 class="mb-1">Features</h6>
              <span class="badge bg-light text-dark text-wrap lh-base">
                2 Rooms
              </span>
              <span class="badge bg-light text-dark text-wrap lh-base">
                1 Bathroom
              </span>
              <span class="badge bg-light text-dark text-wrap lh-base">
                1 Balcony
              </span>
              <span class="badge bg-light text-dark text-wrap lh-base">
                3 sofa
              </span>
            </div>
            <div class="facilities mb-4">
              <h6 class="mb-1">Features</h6>
              <span class="badge bg-light text-dark text-wrap lh-base">
                WiFi
              </span>
              <span class="badge bg-light text-dark text-wrap lh-base">
                Television
              </span>
              <span class="badge bg-light text-dark text-wrap lh-base">
                AC
              </span>
              <span class="badge bg-light text-dark text-wrap lh-base">
                Room heater
              </span>

            </div>
            <div class="rating mb-4">
              <h6 class="mb-1">Rating</h6>
              <span class="badge rounded-pill bg-light">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </span>
            </div>
            <div class="d-flex justify-content-evenly mb-2">
              <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book now </a>
              <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
            </div>
          </div>
        </div>
      </div>



      <div class="col-lg-12 text-center mt-5">
        <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms >>></a>
      </div>

    </div>
  </div>

  <!--Facilities section-->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>
  <div class="container">
    <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">

      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
        <img src="images/Facilities/wifi.jpg" width="80px">
        <h5 class="mt-3">WiFi</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
        <img src="images/Facilities/wifi.jpg" width="80px">
        <h5 class="mt-3">WiFi</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
        <img src="images/Facilities/wifi.jpg" width="80px">
        <h5 class="mt-3">WiFi</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
        <img src="images/Facilities/wifi.jpg" width="80px">
        <h5 class="mt-3">WiFi</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
        <img src="images/Facilities/wifi.jpg" width="80px">
        <h5 class="mt-3">WiFi</h5>
      </div>
      <div class="col-lg-12 text-center mt-5">
        <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities</a></a>

      </div>
    </div>
  </div>

  <!--Testimonials :testimonial refers to a written statement or review provided by a guest or customer about 
  their experience with a particular hotel-->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Review and Feedbacks</h2>
  <div class="container mt-5">
    <!-- Swiper -->
    <div class="swiper swiper-testimonials">
      <div class="swiper-wrapper mb-5">
        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
            <img src="images/Features/star.png" width="30px">
            <h6 class="m-0 ms-2">Random user1</h6>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam natus, eos facilis laborum, ipsam culpa
            aliquam distinctio autem voluptatem velit quibusdam tempora corporis. Dicta quae ex soluta a nesciunt vel.
          </p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
          </div>
        </div>
        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
            <img src="images/Features/star.png" width="30px">
            <h6 class="m-0 ms-2">Random user1</h6>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam natus, eos facilis laborum, ipsam culpa
            aliquam distinctio autem voluptatem velit quibusdam tempora corporis. Dicta quae ex soluta a nesciunt vel.
          </p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
          </div>
        </div>
        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
            <img src="images/Features/star.png" width="30px">
            <h6 class="m-0 ms-2">Random user1</h6>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam natus, eos facilis laborum, ipsam culpa
            aliquam distinctio autem voluptatem velit quibusdam tempora corporis. Dicta quae ex soluta a nesciunt vel.
          </p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
          </div>
        </div>



      </div>
      <div class="swiper-pagination"></div>
    </div>
    <div class="col-lg-12 text-center mt-5">
      <a href="#" class="btn btn-sm btn-outline-dark rounded- fw-bold shadow-none">Know More</a>
    </div>
  </div>


  <!--Reach Us (google map embed)-->
  <?php
  $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
  $values = [1];
  //euta matra row fetch grnu xa tei vayerw yei  dynamic banauney kaam gariraxau
  $contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
   
  ?>

  <h2 class="mt-5 pt-4 mb-4  text-center fw-bold h-font">REACH US</h2>
  <div class="container mb-4">
    <div class="row">
      <div class=" col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
        <iframe class="w-100 rounded" height="320"
          src="<?php echo $contact_r['iframe'] ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="bg-white p-4 rounded mb-4">
          <h5>Call us</h5>
          <a href="tel: +<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn1'] ?> 
            <!-- phone no. ko + thiyena uta so yeta + lekhna parya ..ajax ma kei special character haru send mildaina server ma teslai json ko through send grna prxa so-->
          </a>
          <br>
        <!-- yo phone number compulsory xaina so dina ni sakxan nadina pani so-->
         <?php
          if($contact_r['pn2']!=''){
           echo <<<data
            <a href="tel: +$contact_r[pn2]" class="d-inline-block text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i> +$contact_r[pn2]
            </a>
            data;
          }
         ?>
          
          <br><br>
          <a href="mailto:godhulichulo1@gmail.com" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-envelope-fill"></i> godhulichulo1@gmail.com
          </a>
        </div>

        <div class="bg-white p-4 rounded mb-4">
          <h5>Follow us</h5>

          <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-3">
            <span class="badge bg-light text-dark fs-6 p-2">
              <i class="bi bi-facebook"></i> Facebook
            </span>
          </a>
          <br>
          <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block mb-3">
            <span class="badge bg-light text-dark fs-6 p-2">
              <i class="bi bi-facebook"></i> Instagram
            </span>
          </a>
        </div>

      </div>

    </div>
  </div>

  <?php require('footer.php'); ?>
  <!-- Start PHP code.
    //require('footer.php');: Include and execute footer.php.
      End PHP code.-->

  <!-- Swiper and Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper for homepage background -->
  <script>
    var swiper = new Swiper(".swiper-container", {
      spaceBetween: 30,
      effect: "fade",
      loop: true,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      }
    });
  </script>
  <!-- Initialize Swiper for testimonials -->
  <script>
    var swiper = new Swiper(".swiper-testimonials", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      slidesPerView: "3", //Only 3 ota slides ma matra
      loop: true,
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: false,
      },
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
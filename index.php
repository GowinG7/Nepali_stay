<?php
require('admin/db_config.php');
require('admin/essentials.php');
require('links.php'); 

?>

<?php

$about_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
$values = [1];
$about_r = mysqli_fetch_assoc(select($about_q,$values,'i'));
$settings_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
$settings_r = mysqli_fetch_assoc(select($settings_q,$values,'i'));

if($settings_r['shutdown']==1){
  echo <<<alertbar
    <div class='bg-danger text-center p-2 fw-bold'>
      <i class="bi bi-exclamation-triangle-fill"></i>
      Bookings are temporarily Closed!
    </div>
  alertbar;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>USER DASHBOARD</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <style>
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
    }

    .custom-navbar {
      background-color: rgb(78, 171, 207);
    }

    .container-fluid-footer {
      background-color: rgb(78, 171, 207);
    }

    
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav id="nav-bar" class="navbar navbar-expand-lg navbar-light custom-navbar px-lg-4">
    <div class="container-fluid">
      <a class="navbar-brand me-5 fw-bold fs-3 h-font rounded shadow">
        <?php echo $settings_r['site_title']; ?>
        <img src="images/Logo.jpg" alt="Logo" style="height:60px; width:60px;">
      </a>
      <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
        <li class="nav-item">
          <a class="nav-link  me-2"  href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="index.php">Rooms</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="index.php">Facilities</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="index.php">Contact us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="index.php">About</a>
        </li>
        
      </ul>
      <a href="loginsignup/login.php" class="btn btn-primary me-2" style="color:black;background-color:white;border:2px solid grey">Login</a>
      <a href="loginsignup/signup.php" class="btn btn-primary" style="color:black;background-color:white;border:2px solid grey">Register</a>
    </div>
  </nav>

  <!-- Carousel -->
  <div class="container-fluid px-lg-4 mt-4">
    <div class="swiper swiper-container">
      <div class="swiper-wrapper">
        <?php
        $res = selectAll('carousel');
        while ($row = mysqli_fetch_assoc($res)) {
          $path = CAROUSEL_IMG_PATH;
          echo <<<data
            <div class="swiper-slide">
              <img src="$path$row[image]" class="w-100 d-block">
            </div>
          data;
        }
        ?>
      </div>
    </div>
  </div>

  <!-- Our Rooms Section -->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>
  <div class="container">
    <div class="row">
      <?php

            $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=?  ORDER BY `id` DESC LIMIT 3" ,[1,0],'ii');

            while ($room_data = mysqli_fetch_assoc($room_res)) {
            //get features of room
            $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f 
            INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
            WHERE rfea.room_id = '$room_data[id]'");

            $features_data = "";
            while ($fea_row = mysqli_fetch_assoc($fea_q)) {
            $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
            $fea_row[name]
            </span>";
            }
            //get facilities of room
            $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f
            INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
            WHERE rfac.room_id = '$room_data[id]'");

            $facilities_data = "";
            while ($fac_row = mysqli_fetch_assoc($fac_q)) {
            $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
            $fac_row[name]
            </span>";
            }
            //get thumbnail of image
            $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
            $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` 
            WHERE `room_id`='$room_data[id]'
            AND `thumb`='1'");

            if (mysqli_num_rows($thumb_q) > 0) {
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
            }

            $book_btn = "";
            if(!$settings_r['shutdown']==1){
            $user = 0;
            if (isset($_SESSION['user']) && $_SESSION['user'] == true) {
                $user = 1;
            }
            $book_btn = "<button onclick='checkLoginToBook($user,$room_data[id])' class='btn btn-sm text-white custom-bg shdaow-none'>Book Now</button>";
            }


        echo <<<data
          <div class="col-lg-4 col-md-6 my-3">
            <div class="card border-0 shadow" style="max-width:350px; margin: auto;">
              <img src="$room_thumb" class="card-img-top">
              <div class="card-body">
                <h5> $room_data[name]</h5>
                <h6 class="mb-4">Rs.$room_data[price]</h6>
                <div class="features mb-4">
                <h6 class="mb-1">Features</h6>
                 $features_data
              </div>
                <div class="facilities mb-4">
                  <h6 class="mb-1">Facilities</h6>
                  $facilities_data
                </div>

                <div class="d-flex justify-content-evenly mb-2">
                  $book_btn  
                <a href="javascript:void(0);" onclick="showLoginAlert()" class="btn btn-sm btn-outline-dark shadow-none">
                More details
                </a>

                </div>
               

              </div>
            </div>
          </div>
        data;
      }
      ?>

      <div class="col-lg-12 text-center mt-5">
      <a href="javascript:void(0);" onclick="showLoginAlert()" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms >>></a>
      </div>
    </div>
  </div>

        <!--Facilities section-->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>
  <div class="container">
    <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
     <!--Dynamically fetch garayeka xau-->
     <?php
     $res = mysqli_query($con, "SELECT * FROM facilities ORDER BY id DESC LIMIT 5");
      $path = FACILITIES_IMG_PATH;

      while ($row = mysqli_fetch_assoc($res)) {
        echo <<<data
          <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
            <img src="$path$row[icon]" width="40px">
            <h5 class="mt-3 ">$row[name]</h5>
          </div>
         data;
      }
      ?>

      <div class="col-lg-12 text-center mt-1">
      <a href="javascript:void(0);" onclick="showLoginAlert()" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">
        More facilities>>>
      </a>

      </div>
    </div>
  </div>

 
  <!--Reach Us (google map embed)-->
  <?php
  $contact_q = "SELECT * FROM contact_details WHERE sr_no=?";
  $values = [1];
  //euta matra row fetch grnu xa tei vayerw yei  dynamic banauney kaam gariraxau
  $contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
   
  ?>

  <h2 class="mt-5 pt-4 mb-4  text-center fw-bold h-font">REACH US</h2>
  <div class="container mb-4">
    <div class="row">
      <div class=" col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
        <iframe class="w-100 rounded" height="320px"
          src="<?php echo $contact_r['iframe'] ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="bg-white p-4 rounded mb-4">
          <h5>Call us</h5>
          <a href="tel: +977-<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i> +977-<?php echo $contact_r['pn1'] ?> 
            <!-- phone no. ko + thiyena uta so yeta + lekhna parya ..ajax ma kei special character haru send mildaina server ma teslai json ko through send grna prxa so-->
          </a>
          <br>
        <!-- yo phone number compulsory xaina so dina ni sakxan nadina pani so-->
         <?php
          if(!empty($contact_r['pn2'])){
           $pn2 = htmlspecialchars($contact_r['pn2']); //if data xa baney matra display natra null
           echo <<<data
            <a href="tel: +977-$contact_r[pn2]" class="d-inline-block text-decoration-none text-dark">
             <i class="bi bi-telephone-fill"></i> +977-$contact_r[pn2]
            </a>
            data;
          }
         ?>
          
          <br><br>
          <a href="mailto:<?php echo $contact_r['email']?>" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-envelope-fill"></i> <?php echo $contact_r['email']?>
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

  <!-- Footer -->
    <div class="container-fluid-footer">
    <div class="row text-center text-md-start">
    <div class="col-lg-4 col-md-6 col-sm-12 p-3">
    <h3 class="h-font fw-bold fs-3">
    <?php echo $about_r['site_title']?></h3>
    <p> <?php echo $about_r['site_about']?> </p>
    
    
    </div>
    <div class="col-lg-4 col-md-3 col-sm-6 p-2">
    <h5 class="mb-1">Links</h5>
    <a href="index.php" class="d-inline-block mb-1 text-dark text-decoration-none">Home</a><br>
    <a href="index.php" class="d-inline-block mb-1 text-dark text-decoration-none">Rooms</a><br>
    <a href="index.php" class="d-inline-block mb-1 text-dark text-decoration-none">Facilities</a><br>
    <a href="index.php" class="d-inline-block mb-1 text-dark text-decoration-none">Contact Us</a><br>
    <a href="index.php" class="d-inline-block mb-1 text-dark text-decoration-none">About</a>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-6 p-4">
    <h5 class="mb-3">Follow Us</h5>
    <a href="#" class="d-inline-block text-dark text-decoration-none mb-2">
    <i class="bi bi-facebook me-1"></i> Facebook
    </a><br>
    <a href="#" class="d-inline-block text-dark text-decoration-none">
    <i class="bi bi-instagram me-1"></i> Instagram
    </a>
    </div>
    </div>
    </div>

    <div>
    <h6 class="text-center bg-dark text-white h-font p-3 m-0">
    Designed and Developed by Gobinda and Yogesh<br>&copy; Copyright reserved
    </h6>
    </div>
 
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".swiper-container", {
      spaceBetween: 30,
      centeredSlides: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
</script>

  
  
<script>
    function showLoginAlert() {
        alert("Please log in to see more details.");
    }

  function checkLoginToBook(isLoggedIn, roomId) {
      if (isLoggedIn === 1) { // Check if the user is logged in
      if (roomId) { // Ensure roomId is valid
          window.location.href = "confirm_booking.php?id=" + roomId;
      } else {
          alert("Invalid room selected. Please try again.");
      }
      } else {
      if (confirm("You are not logged in, log in to book now ?")) {
          window.location.href = "loginsignup/login.php"; // Redirect to login page
      }
      }
    }

    
</script>

</body>

</html>

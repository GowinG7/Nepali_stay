<?php session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title> ROOM DETAILS</title>


  <?php require('links.php'); ?>

    <style>
      @media screen and (max-width: 575px) {
        .availability-form {
          margin-top: 25px;
          padding: 0 35px;
        }
      }

      body {
        background-color: rgb(240, 237, 237);
      }

      .custom-navbar {
        background-color: rgb(169, 134, 209);
      }

      .container-fluid-footer {
        width: 100%;
        background-color: rgb(169, 134, 209);
      }
    
      .breadcrumb-link {
      color: gray; /* Default text color */
      text-decoration: none; /* Remove underline */
      transition: transform 0.3s ease, color 0.3s ease; /* Smooth zoom and color transition */
      }
      .breadcrumb-link:hover {
      transform: scale(1.2); /* Slightly enlarge the link */
      color: #6a1b9a; /* Change color on hover */
      }
</style>  
    
</head>

<body>
  <?php require('header.php'); ?>
  
   <?php
   if (!isset($_GET['id'])) {
     redirect('rooms.php');
    }

   $data = filteration($_GET);

   $room_res = select("SELECT * FROM `rooms`  WHERE `id`=? AND `status`=? AND `removed`=?",[$data['id'],1,0],'iii');

   if(mysqli_num_rows($room_res)==0){
     redirect('rooms.php');
   }

   $room_data = mysqli_fetch_assoc($room_res);
   ?>


  <div class="container">
    <div class="row mb-5">

      <div class="col-12 my-5 mb-4 px-4">
        <h2 class="fw-bold "><?php echo $room_data['name'] ?></h2>
        <div style="font-size: 18px;">
          <a href="userdashboard.php" class="breadcrumb-link">HOME</a>
          <span class="text-secondary"> > </span>
          <a href="rooms.php" class="breadcrumb-link">ROOMS</a>
        </div>
      </div>

      <!-- Carousel in the room details of the rooms section -->
      <div class="col-lg-7 col-md-12 px-4 ">
        <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <?php 
             //carousel ko kamti ma ni euta ko class active huna parxa natra carousel dekhinnna
              $room_img = ROOMS_IMG_PATH . "thumbnail.jpg";
              $img_q = mysqli_query($con, "SELECT * FROM `room_images` 
                WHERE `room_id`='$room_data[id]'");
    
              if (mysqli_num_rows($img_q) > 0) {
                $active_class = 'active';
                while($img_res = mysqli_fetch_assoc($img_q))
                {
                  echo"
                <div class='carousel-item $active_class'>
                  <img src='".ROOMS_IMG_PATH.$img_res['image']."' class='d-block w-100'>
                </div>
                ";
                $active_class = '';
                }
             
              }
              else{
              echo "<div class='carousel-item active'>
              <img src='$room_img' class='d-block w-100'>
              </div>";
              }
            ?>

           </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
            </button>
        </div>
      </div>

      <div class="col-lg-5 col-md-12 px-4">
        <div class="card mb-4 border-0 shadow-sm rounded-3">
          <div class="card-body">
            <?php
              echo <<<price
                <h4 class="mb-1">Rs.$room_data[price] per night</h4>
              price;

              echo <<<rating
                <div class="mb-4">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                rating;


              $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f 
                INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
                WHERE rfea.room_id = '$room_data[id]'");

              $features_data = "";
              while ($fea_row = mysqli_fetch_assoc($fea_q)) {
              $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                $fea_row[name]
              </span>";
              }
              echo <<<features
              <div class="mb-2 mt-2">
                <h6 class="mb-1">Features</h6>
                $features_data
              </div>
              features;

              $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f
                INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
                WHERE rfac.room_id = '$room_data[id]'");

              $facilities_data = "";
              while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                  $fac_row[name]
                </span>";
              }
              echo <<<facilities
                <div class="mb-2">
                  <h6 class="mb-1">Facilities</h6>
                  $facilities_data
                </div>
              facilities;


                echo <<<area
                <div class="mb-2">
                  <h6 class="mb-1">Area</h6>
                  <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                    $room_data[area] sq.ft.
                  </span> 
                </div>
                area;


                $book_btn = "";
            if (!$settings_r['shutdown'] == 1) {
              $user = 0;
              if (isset($_SESSION['user']) && $_SESSION['user'] == true) {
                $user = 1;
              }
              echo <<<book
               <button onclick='checkLoginToBook($user,$room_data[id])' class="btn w-100 text-white custom-bg shadow-none mb-1">Book Now</button> 
              book;
            }
            ?>
            </div>
          </div>
      </div>
    
    </div>
  <!--for Room description in the room details section -->
    <div class="col-12  mt-5 px-4">   
      <div class="mb-5">
      <h3>Description</h3>
        <p style="font-size:19px">
          <?php echo $room_data['description']; ?>
        </p> 
      </div> 
    </div>
  <!-- For review rating in the room more details -->
    <div>
      <h5 class="mb-3">Reviews & Ratings</h5>
      <div>
        <div class="d-flex align-items-center mb-3">
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
    
  </div>

    

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
     function checkLoginToBook(isLoggedIn, roomId) {
      if (isLoggedIn === 1) { // Check if the user is logged in
      if (roomId) { // Ensure roomId is valid
          window.location.href = "confirm_booking.php?id=" + roomId;
      } else {
          alert("Invalid room selected. Please try again.");
      }
      } else {
      if (confirm("You are not logged in. Would you like to log in now?")) {
          window.location.href = "login.php"; // Redirect to login page
      }
      }
    }
  </script>
  
</body>

</html>
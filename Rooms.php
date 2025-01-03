<?php
session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>ROOMS</title>

  <?php require('links.php');

  if (!isset($_SESSION["user_id"])) {
    // Redirect to login page if session is not set
    header("Location: loginsignup/login.php");
    exit();
  }
  ?>

  <style>
    @media screen and (max-width: 575px) {
      .availability-form {
        margin-top: 25px;
        padding: 0 35px;
      }
    }

    body {
      background-color: whitesmoke;
    }

    .custom-navbar {
      background-color: rgb(169, 134, 209);
    }

    .container-fluid-footer {
      background-color: rgb(169, 134, 209);
    }
  </style>


</head>

<body>
  <?php require('header.php'); ?>

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">OUR ROOMS</h2>
    <div class="h-line" style="width: 150px; height: 1.6px; background-color: black; margin: 10px auto;"></div>
  </div>


  <div class="container-fluid">
    <div class="row">

      <!-- Rooms cards -->
      <div class="col-lg-12 col-md-12 px-4">

        <?php



        // Fetch rooms with status 1 and removed 0
        $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=?", [1, 0], 'ii');

        while ($room_data = mysqli_fetch_assoc($room_res)) {
          // Get features of room
          $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f 
                  INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
                  WHERE rfea.room_id = '$room_data[id]'");

          $features_data = "";
          while ($fea_row = mysqli_fetch_assoc($fea_q)) {
            $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                  $fea_row[name]
                </span>";
          }

          // Get facilities of room
          $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f
          INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
          WHERE rfac.room_id = '$room_data[id]'");

          $facilities_data = "";
          while ($fac_row = mysqli_fetch_assoc($fac_q)) {
            $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
            $fac_row[name]
            </span>";
          }

          // Get thumbnail of image
          $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
          $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` 
              WHERE `room_id`='$room_data[id]'
              AND `thumb`='1'");

          if (mysqli_num_rows($thumb_q) > 0) {
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
          }

          // Check booking availability
          $book_btn = "";
        
          if (!$settings_r['shutdown'] == 1) {
            $user = 0;
            if (isset($_SESSION['user']) && $_SESSION['user'] == true) {
              $user = 1;
            }
            $book_btn = "<button onclick='checkLoginToBook($user,$room_data[id])' class='btn btn-sm w-100 text-white custom-bg shadow-none mb-2'>Book Now</button>";
            $more_details = "<a href='room_details.php?id=$room_data[id]' class='btn btn-sm w-100 btn-outline-dark shadow-none'>More details</a>";

          }

         // Display Book Now button 
         if ($room_data['room_status'] == 'Room Booked') {
          $book_btn = "<button  class='btn btn-sm w-100 text-white custom-bg shadow-none mb-2' disabled>Book Now</button>";
           // Disable "More Details" link by setting href to "#" when room is booked
           $more_details = "<a href='#' class='btn btn-sm w-100 btn-outline-dark shadow-none disabled' tabindex='-1' aria-disabled='true'>More details</a>";

         
        }


          


          // Print room card
          echo <<<data
            <div class="card mb-4 border-0 shadow">
              <div class="row g-0 p-3 align-items-center">
                <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                  <img src="$room_thumb" class="img-fluid rounded">
                </div>
                <div class="col-md-5 px-lg-3 px-md-3 px-0">
                  <h5 class="mb-3">$room_data[name]</h5>
                  <div class="features mb-3">
                    <h6 class="mb-1">Features</h6>
                    $features_data
                  </div>
                  <div class="facilities mb-3">
                    <h6 class="mb-1">Facilities</h6>
                    $facilities_data
                  </div>
                  <div class="room-info mb-3">
                    <h6>Total Room: $room_data[total_rooms]</h6>
                    <h6>Status: $room_data[room_status]</h6>
                  </div>
                </div>
                <div class="col-md-2 text-center">
                  <h6 class="mb-4">Rs.$room_data[price] per night</h6>
                     
                    $book_btn
                    $more_details           
                </div>
                </div>
            </div>
          data;
        }
        ?>

      </div>

    </div>
  </div>

  

  <?php require('footer.php'); ?>
</body>

</html>

<?php
session_start()?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title> ROOMS</title>

  <?php require('links.php'); ?>

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
      <!-- left side filter section in rooms page
      <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 ps-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
          <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="mt-2">FILTERS</h4>
            <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown"
              aria-controls="filterDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
              <div class="border bg-light p-3 rounded mb-3">
                <h5 class="mb-3" style="font-size:18px;">CHECK AVAILABILITY</h5>
                <label class="form-label">Check-in</label>
                <input type="date" class="form-control shadow-none mb-3">
                <label class="form-label">Check-out</label>
                <input type="date" class="form-control shadow-none">
              </div>

              <div class="border bg-light p-3 rounded mb-3">
                <h5 class="mb-3" style="font-size:18px;">FACILITIES</h5>
                <div class="mb-2">
                  <input type="checkbox" id="f1" class="form-check-input shadow-none me-3">
                  <label class="form-check-label" for="f1">Facility-one</label>
                </div>
                <div class="mb-2">
                  <input type="checkbox" id="f2" class="form-check-input shadow-none me-3">
                  <label class="form-check-label" for="f2">Facility-two</label>
                </div>
                <div class="mb-2">
                  <input type="checkbox" id="f3" class="form-check-input shadow-none me-3">
                  <label class="form-check-label" for="f3">Facility-three</label>
                </div>
              </div>
            </div>
          </div>
        </nav>
      </div> -->
      <!-- Rooms cards -->
      <div class="col-lg-12 col-md-12 px-4">

        <?php
          //rooms table bata status 1(active bako) ani removed ko value 0(admin panel bata remove nagaraiyeko if remove grya vaye 1 hunxa ) 
          //:- remember - rooms table bata data hataiyeko xaina (tara room_features,room_facilities bata hataiyeko xa if deleted)admin panel m=ko room bata delte grda ni  :-
          $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=?",[1,0],'ii');

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
            $book_btn = "<button onclick='checkLoginToBook($user,$room_data[id])'  class='btn btn-sm w-100 text-white custom-bg shadow-none mb-2'>Book Now</button>";
              }     

          //print room card
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
                  </div>
                  <div class="col-md-2 text-center">
                    <h6 class="mb-4">Rs.$room_data[price] per night</h6>
                      $book_btn
                    <a href="room_details.php?id=$room_data[id]" class="btn btn-sm w-100 btn-outline-dark shadow-none">More details</a>
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
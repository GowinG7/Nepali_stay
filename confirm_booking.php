<?php 
session_start();
require('links.php');
require('config.php');

if (isset($_POST["pay_now"])) {
  // Collecting form data
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $room_name = $_POST['roomname'];
  $checkin = $_POST['checkin'];
  $checkout = $_POST['checkout'];

  
  // Database connection
  $con = mysqli_connect("localhost", "root", "", "nepali_stay");

  if (!$con) {
      die("Connection failed: " . mysqli_connect_error());
  }

  // Prepare and execute query
  $query = "INSERT INTO `booking` (`name`, `phone`, `email`, `roomname`, `checkin`, `checkout`) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($query);

  if ($stmt === false) {
      die("Failed to prepare statement: " . $con->error);
  }

  $stmt->bind_param("ssssss", $name, $phone, $email, $room_name, $checkin, $checkout);
  
  if ($stmt->execute()) {
    // Booking was successful
    echo "<script>alert('Booking confirmed successfully!. You will receive the confirmation from admin in email shortly');</script>";
} else {
    // Booking failed
    echo "<script>alert('Error confirming booking. Please try again later.');</script>";
}


  $stmt->close();
  mysqli_close($con);

   
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title> CONFIRM BOOKING</title>
  
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
   
   /*
    Check room id from url is present or not
    Shutdown mode is active or not
    User is logged in or not
   */
      // Check room id from the URL, shutdown mode, and user login status
      if (!isset($_GET['id']) || $settings_r['shutdown'] == true) {
      redirect('rooms.php'); // Redirect to rooms if id is missing or shutdown is active.
      } else if (!(isset($_SESSION['user_id']) && $_SESSION['user_id'] == true)) {
      redirect('rooms.php'); // Redirect to rooms if user is not logged in.
      }

      // Filter and get the room and user data
      $data = filteration($_GET);

      $room_res = select(
      "SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?", 
      [$data['id'], 1, 0], 
      'iii'
      );

      if (mysqli_num_rows($room_res) == 0) {
      redirect('rooms.php'); // Redirect if room is not available.
      }

      $room_data = mysqli_fetch_assoc($room_res);

      // Store room data in session for booking confirmation
      $_SESSION['room'] = [
      "id" => $room_data['id'],
      "name" => $room_data['name'],
      "price" => $room_data['price'],
      "payment" => null,
      "available" => false,
      ];

      // Fetch user data based on session user ID
      $user_res = select(
      "SELECT * FROM `user_creden` WHERE `id`=? LIMIT 1", 
      [$_SESSION['user_id']], 
      "i"
      );
      $user_data = mysqli_fetch_assoc($user_res);
   ?>


      <div class="container">
        <div class="row mb-5">
          <div class="col-12 my-5 mb-4 px-4">
            <h2 class="fw-bold">CONFIRM BOOKING</h2>
            <div style="font-size: 18px;">
              <a href="userdashboard.php" class="breadcrumb-link">HOME</a>
              <span class="text-secondary"> > </span>
              <a href="rooms.php" class="breadcrumb-link">ROOMS</a>
              <span class="text-secondary"> > </span>
              <a href="#" class="breadcrumb-link">CONFIRM</a>
            </div>
          </div>
          
          

          <!-- Begin Row for Booking Details -->
          <div class="row">
            <!-- Room Details (Left Column) -->
            <div class="col-lg-7 col-md-12 px-4">
              <?php 
                $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
                $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` 
                  WHERE `room_id`='$room_data[id]'
                  AND `thumb`='1'");

                if (mysqli_num_rows($thumb_q) > 0) {
                  $thumb_res = mysqli_fetch_assoc($thumb_q);
                  $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
                }

                echo <<<data
                <div class="card p-3 shadow-sm rounded">
                  <img src="$room_thumb" class="img-fluid rounded mb-3">
                  <h5>$room_data[name]</h5>
                  <h6>Rs.$room_data[price] per night</h6>
                </div>
                data;
              ?>
            </div>

            <!-- Booking Form (Right Column) -->
            <div class="col-lg-5 col-md-12 px-4">
              <div class="card mb-4 border-0 shadow-sm rounded-3">
                <div class="card-body">
                  <form action="confirm_booking.php" method="POST"  id="booking_form">
                    <h6 class="mb-3">Booking Details</h6>
                    <div class="row">
                      <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input name="name" type="text" value="<?php echo $user_data['name'] ?>" class="form-control shadow-none" readonly>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Phone Number</label>
                        <input name="phone" type="number" value="<?php echo $user_data['phone'] ?>" class="form-control shadow-none" readonly>
                      </div>
                      <div class="col-md-12 mb-3">
                        <label class="form-label">Email</label>
                        <input name="email" type="email"value="<?php echo $user_data['email']?>" class="form-control shadow-none" readonly>
                      </div>
                      <div class="col-md-12 mb-3">
                      <label class="form-label">Room Name</label>
                      <input name="roomname" type="text" value="<?php echo $room_data['name']; ?>" class="form-control shadow-none" readonly>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Check-in</label>
                        <input name="checkin" onchange="check_availability()" type="date" class="form-control shadow-none" required>
                      </div>
                      <div class="col-md-6 mb-4">
                        <label class="form-label">Check-out</label>
                        <input name="checkout" onchange="check_availability()" type="date" class="form-control shadow-none" required>
                      </div>
                      <div class="col-12">
                        <div class="spinner-border text-info mb-3 d-none" id="info_loader" role="status">
                          <span class="sr-only">Loading...</span>
                        </div>
                        <h6 class="mb-3 text-danger" id="pay_info">Provide check-in & check-out date</h6>
                        <button type="submit" name="pay_now" class="btn w-100 text-white custom-bg shadow-none mb-1" disabled>Confirm booking</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- End Row for Booking Details -->

        </div>
      </div>

    

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    //for directing to the confirm booking page if login with room info
    function checkLoginToBook(status,room_id){
      if(status == 1){
      window.location.href = "confirm_booking.php?room_id="+room_id;
      }
      else{
      alert("You are not logged in. Please login to book a room");
      }
    }
  </script>

  <script>
    
    //for booking form managing
    let booking_form = document.getElementById('booking_form');
    let info_loader = document.getElementById('info_loader');
    let pay_info = document.getElementById('pay_info');

    function check_availability()
    {
      let checkin_val = booking_form.elements['checkin'].value;
      let checkout_val = booking_form.elements['checkout'].value;

      booking_form.elements['pay_now'].setAttribute('disabled',true);

      if(checkin_val!='' && checkout_val!='')
      {
        pay_info.classList.add('d-none');
        pay_info.classList.replace('text-dark','text-danger');
        info_loader.classList.remove('d-none');

        let data = new FormData();

        data.append('check_availability','');
        data.append('check_in',checkin_val);
        data.append('check_out',checkout_val);

        let xhr = new XMLHttpRequest();
        xhr.open("POST","admin/ajax/confirm_booking.php",true);

        xhr.onload = function(){
          let data = JSON.parse(this.responseText);
          if(data.status == 'check_in_out_equal'){
          pay_info.innerText = "You cannot check-out on the same day";
          }
          else if(data.status == 'check_out_earlier'){
          pay_info.innerText = "Checkout date cannot be earlier than check-in date";
          }
          else if(data.status == 'check_in_earlier'){
          pay_info.innerText = "Check-in date is earlier than today's date";
          }
          else if(data.status == 'unavailable'){
          pay_info.innerText = "Room not available for this check-in date";
          }
          else{
            pay_info.innerHTML = "No. of Days: "+ data.days +"<br>Total Amount to Pay: Rs."+data.payment;
            pay_info.classList.remove('text-danger','text-dark');
            booking_form.elements['pay_now'].removeAttribute('disabled');
          }
          pay_info.classList.remove('d-none');
          info_loader.classList.add('d-none');
        }
        xhr.send(data);
      }
    }

  </script>
  
</body>

</html>
<?php
require('admin/db_config.php');
require('admin/essentials.php');

?>


<?php


$settings_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
$values = [1];
$settings_r = mysqli_fetch_assoc(select($settings_q,$values,'i'));

if($settings_r['shutdown']==1){
  echo <<<alertbar
    <div class='bg-danger text-center p-2 fw-bold'>
      <i class="bi bi-exclamation-triangle-fill"></i>
      Bookings are temporarily Closed!
    <div>
  alertbar;

}
?>

<!--Nav bar
nav bar ko tag lai active dekhauna active tag ko used hunxa tara dynamically active dekhauna xa using js
  yeha nav bar ko id diyerw footer ma js ko code-->
<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light custom-navbar px-lg-">
  <div class="container-fluid ">
    <a class="navbar-brand me-5 fw-bold fs-3 h-font rounded shadow"><?php echo $settings_r['site_title']?> <img src="images/Logo.jpg" alt="Logo" style="height:60px; width:60px;"></a>
 
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
        <li class="nav-item">
          <a class="nav-link  me-2"  href="userdashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="Rooms.php">Rooms</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="facilities.php">Facilities</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="Contact.php">Contact us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="about1.php">About</a>
        </li>
      </ul>
      
      <div class="d-flex">
        <?php if (isset($_SESSION["user"])): // Check if the user is logged in ?>
          <a href="logout.php" class="btn btn-outline-dark shadow-none me-lg-3 me-2 mt-1">Log Out</a>
        <?php endif; // Close the if statement ?>
      </div>
    </div>
  </div>
</nav>





<!--User Login in nav-bar-->
<!-- User Login Modal 
<div class="modal fade" id="LoginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="login.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center">
            <i class="bi bi-person-circle fs-3 me-2"></i>
            User Login
          </h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="email" class="form-control shadow-none" required>
          </div>
          <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control shadow-none" required>
          </div>
          <div class="d-flex align-items-center justify-content-between mb-2">
            <button type="submit" class="btn btn-dark shadow-none">LOGIN</button>
            <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot Password?</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

User Registration Modal   
<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="register-form" enctype="multipart/form-data" method="post" action="your_php_script.php">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center">
            <i class="bi bi-person-lines-fill fs-3 me-2"></i>
            User Registration
          </h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
            Note: Your details must match with your ID (Nagrita, Passport, Driving license) that will be required during check-in.
          </span>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 ps-0 mb-3">
                <label class="form-label">Name</label>
                <input name="name" type="text" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 p-0 mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 ps-0 mb-3">
                <label class="form-label">Phone Number</label>
                <input name="phonenum" type="number" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 p-0 mb-3">
                <label class="form-label">Photo</label>
                <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none" required>
              </div>
              <div class="col-md-12 p-0 mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
              </div>
              <div class="col-md-6 ps-0 mb-3">
                <label class="form-label">Date of Birth</label>
                <input name="dob" type="date" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 p-0 mb-3">
                <label class="form-label">Password</label>
                <input name="pass" type="password" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 p-0 mb-3">
                <label class="form-label">Confirm Password</label>
                <input name="cpass" type="password" class="form-control shadow-none" required>
              </div>
            </div>
          </div>
          <div class="text-center my-1">
            <button type="submit" name="register" class="btn btn-dark shadow-none">REGISTER</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div> -->
 
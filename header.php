<?php
session_start(); // Start the session

// Check if the logout button was pressed
if (isset($_POST['logout'])) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: login_register/login.php"); // Redirect to the login page
    exit; // Ensure no further code is executed
}
?>

<!-- Nav bar -->
<nav class="navbar navbar-expand-lg navbar-light custom-navbar px-lg-">
  <div class="container-fluid">
    <a class="navbar-brand me-5 fw-bold fs-3 h-font rounded shadow" href="index.php">NEPALI STAY <img src="images/Logo.jpg" alt="Logo" style="height:60px; width:60px;"></a>

    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
        <li class="nav-item">
          <a class="nav-link active me-2" aria-current="page" href="index.php">Home</a>
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
          <a class="nav-link me-2" href="About.php">About</a>
        </li>
      </ul>

      <ul class="navbar-nav">
        <!-- Logout Button as a Navbar Item -->
        <?php if (isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true): ?>
          <li class="nav-item">
            <form method="POST" action="">
              <button type="submit" name="logout" class="btn btn-danger">Logout</button>
            </form>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

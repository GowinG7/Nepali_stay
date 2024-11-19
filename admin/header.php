
<?php
require_once('db_config.php');
$settings_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
$values = [1];
$settings_r = mysqli_fetch_assoc(select($settings_q,$values,'i'));
?>

<div  class="container-fluid bg-dark text-light p-3 d-flex align-items-center justify-content-between sticky-top">
    <h3 class="mb-0 h-font"><u><?php echo $settings_r['site_title']?></u></h3>
    <a href="logout.php" class="btn btn-light btn-sm">Log Out</a>
    </div>
    <div id="dashboard-menu" class="col-lg-2 bg-dark border-top border-3 border-secondary" >
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid flex-lg-column align-items-stretch">
        <h4 class="mt-2 text-light">ADMIN PANEL</h4>
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#adminDropdown"
            aria-controls="filterDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="adminDropdown">
            <ul class="nav nav-pills flex-column">
            
            <li class="nav-item">
            <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white" href="rooms.php">Rooms</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white" href="features_facilities.php">Features and Facilities</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white" href="user_queries.php">User Queries</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white" href="carousel.php">Carousel</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white" href="settings.php">Settings</a>
            </li>
            
            </ul>
        </div>
        </div>
    </nav>
    </div>
<?php
require('essentials.php');
require('db_config.php');
adminLogin(); //admin login check
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Dashboard - Nepali Stay</title>
        <?php require('links.php'); ?>  
    </head>
    <body style="background-color:lightgray" >

    <!-- Include Header and Sidebar -->
    <?php require('header.php'); ?>

    <!-- Main Content -->
    <div class="container-fluid" id="main-content"  >
        <div class="row" >
            <!-- Content Area, Offset to avoid overlap with sidebar -->
            <div class="col-lg-10 ms-auto p-4 overflow-hidden" > 
                <h3 class="mb-4">Dashboard - Nepali Stay</h3>
                
                <!-- Dashboard Cards and Content Here -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body" style="background-color: lightgray">
                        <div class="row" >
                            <!-- Room Types Card -->
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card border-0 shadow-sm" style="background-color:whitesmoke">
                                    <div class="card-header">
                                        <h5>Room Types</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul>
                                            <li>Simple Room</li>
                                            <li>Luxury Room</li>
                                            <li>Double Bed Room</li>
                                            <li>Single Room</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Staff Card -->
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card border-0 shadow-sm" style="background-color:whitesmoke">
                                    <div class="card-header">
                                        <h5>Total Staff</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>Total Staff: 12</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional content can be added here -->
            </div>
        </div>
    </div>

    <!-- Include Scripts -->
    <?php require('scripts.php'); ?>

    <script>
        // Add active class to current menu item
        function setActive() {
            navbar = document.getElementById('dashboard-menu');
            let a_tags = navbar.getElementsByTagName('a');
            for (let i = 0; i < a_tags.length; i++) {
                let file = a_tags[i].href.split('/').pop();
                let file_name = file.split('.')[0];

                if (document.location.href.indexOf(file_name) >= 0) {
                    a_tags[i].classList.add('active');
                }
            }
        }
        setActive();
    </script>

    </body>
</html>

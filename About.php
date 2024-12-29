<!DOCTYPE html>
<html lang="en">
<head>
  <title> About</title>

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
        margin-top: 150px;
        padding: 0 35px;
      }
    }
    
    body {
      background-color: whitesmoke;
      /* Replace with your chosen color code */
    }
    
    .custom-navbar {
      background-color: rgb(87, 219, 213);
      /* Dark Blue color */
    }
    
    .container-fluid-footer {
      background-color: rgb(87, 219, 213); /* change this to your desired background color */
    }
    
    .about-section {
      margin: 30px auto; /* Center container with automatic margins */
      max-width: 1200px; /* Set a maximum width for better alignment */
      padding: 0 15px; /* Add padding to avoid content touching the edges */
    }
    
    .about-text {
      margin-bottom: 20px;
    }
    
    .about-text ul {
      list-style-type: disc;
      margin-left: 20px;
    }
    
    .about-images img {
      width: 100%;
      height: auto;
      margin-bottom: 15px;
    }
    
    .h-line {
      width: 150px;
      height: 1.6px;
      background-color: black;
      margin: 10px auto;
    }
  </style>
</head>

<body>
  <?php require('header.php'); ?>

  <div class="container about-section">
    <h2 class="fw-bold h-font text-center">ABOUT US</h2>
    <div class="h-line"></div>

    <div class="row">
      <div class="col-lg-6 col-md-12">
        <p class="about-text">
          <b>Introduction to Nepali Stay</b><br>
          Welcome to Nepali Stay, your trusted platform for booking hotel rooms in Nepal. We aim to make the process of finding and booking a hotel room as simple and straightforward as possible. Whether you're planning a quick getaway or an extended vacation, Nepali Stay offers a range of options to suit your needs, all in one place.
        </p>

        <p class="about-text">
          <b>Our Vision and Mission</b><br>
          At Nepali Stay, our vision is to redefine the way travelers book hotel rooms in Nepal by providing a hassle-free and enjoyable experience. Our mission is to connect travelers with their ideal accommodations by offering a user-friendly platform that is accessible to everyone, regardless of their technical skills or familiarity with online booking.
        </p>

        <p class="about-text">
          <b>Core Values</b><br>
          <ul>
            <li><b>Simplicity:</b> We believe booking a room should be easy and stress-free for everyone.</li>
            <li><b>Transparency:</b> We provide clear and accurate information about available rooms, prices, and amenities to help users make informed decisions.</li>
            <li><b>Affordability:</b> We work hard to offer competitive room rates by minimizing high commission fees, ensuring the best value for our users.</li>
            <li><b>Customer Focus:</b> Our users’ satisfaction is our top priority. We strive to deliver a smooth and seamless booking experience.</li>
          </ul>
        </p>

        <p class="about-text">
          <b>Services and Features</b><br>
          <ul>
            <li><b>User-Friendly Platform:</b> Designed with a clean and intuitive interface, our platform allows users of all backgrounds to navigate effortlessly and find what they need.</li>
            <li><b>Comprehensive Room Information:</b> We offer detailed information on room availability, prices, and amenities, helping users to make the best choices.</li>
            <li><b>Competitive Pricing:</b> By reducing high commission fees, we provide more affordable room options for our users.</li>
            <li><b>24/7 Availability:</b> Our platform is available around the clock, ensuring users can book rooms whenever they need.</li>
          </ul>
        </p>

        <p class="about-text">
          <b>Why Choose Us?</b><br>
          Choosing Nepali Stay means choosing comfort, convenience, and affordability. We stand out in the market by prioritizing user experience and ensuring transparency in all our services. Our commitment to providing a seamless booking experience means you can trust us to make your stay in Nepal comfortable, convenient, and memorable.
        </p>
       
      </div>

      <div class="col-lg-6 col-md-12 about-images">
        <img src="images/Rooms/1.png" >
        <img src="images/Carousel(slideshow)/2.png"  >
        <img src="images/Rooms/7.png" >
       
      </div>
    </div>
  </div>

  <?php require('footer.php'); ?>
</body>
</html>

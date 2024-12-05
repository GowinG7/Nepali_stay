<?php
session_start(); // Start the session

require('config.php');
//Ensure `user_id` is set in the session
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    
    // Fetch the name from the `user_creden` table
    $query = "SELECT name FROM user_creden WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($name);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
} else {
    // Redirect to login page if session is not set
    header("Location: ../loginsignup/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>NEPALI STAY -HOME</title>

  <?php require('links.php'); ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <style>
    /*these two css are only used in this file*/
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
      /* Replace with your chosen color code */
    }

    .custom-navbar {
      background-color: rgb(78, 171, 207);
      /* Dark Blue color */
    }
      /*to make the footer as same as the navbar bg color */
      .container-fluid-footer{
        background-color: rgb(78, 171, 207);
      }

    .dashboard-container {
    color: green; /* Text color */
    position: absolute; /* Allows precise positioning */
    top: 20px; /* Distance from the top */
    right: 20px; /* Distance from the right */
    background-color: #f0f9f0; /* Optional: Light green background */
    padding: 10px; /* Optional: Padding around the text */
    border-radius: 5px; /* Optional: Rounded corners */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional: Subtle shadow */
    }

    
  </style>

      <script>
        document.addEventListener("DOMContentLoaded", function () {
        const dashboardContainer = document.querySelector(".dashboard-container");
        setTimeout(() => {
          if (dashboardContainer) {
              dashboardContainer.style.display = "none";
          }
        }, 3000); // 3000ms = 3 seconds
        });

      </script>

</head>


<body>
  <?php require('header.php'); ?>
  <div class="dashboard-container">
   <h3>Welcome, <?php echo htmlspecialchars($name); ?> in our System</h3>
  </div>
  

  <!-- Carousel -->
  <div class="container-fluid px-lg-4 mt-4">
    <!-- Swiper -->
    <div class="swiper swiper-container">
      <div class="swiper-wrapper">
        <?php
        //dynamic banako xau
      
        $res = selectAll('carousel');
        while($row = mysqli_fetch_assoc($res))
        {
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

  <!--check availability-->
  <div class="container availability-form">
    <div class="row justify-content-center">
      <div class="col-lg-8 bg-white shadow p-4 rounded">
        <h5 class="mb-4"> Check Booking availability</h5>
        <form>
          <div class="row align-items-end">
            <div class="col-lg-6 mb-3">
              <label class="form-label" style="font-weight:500;">Check-in</label>
              <input type="date" class="form-control shadow-none">
            </div>
            <div class="col-lg-6 mb-3">
              <label class="form-label" style="font-weight:500;">Check-out</label>
              <input type="date" class="form-control shadow-none">
            </div>
            <!--<div class="col-lg-3 mb-3">
            <label class="form-label" style="font-weight:500;">Adult</label>
            <select class="form-select shadow-none" >
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>   
          <div class="col-lg-2 mb-3">
            <label class="form-label" style="font-weight:500;">Children</label>
            <select class="form-select shadow-none" >
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>      -->
            <!--In bootstrap there can be 12 columns in 1 row-->
            <button type="submit" class="btn btn-primary">Check Availability</button>

          </div>
        </form>
      </div>
    </div>
  </div>


  <!--Our Rooms-->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>
  <!--Rooms card-->
  <div class="container">
    <div class="row">

       <?php
          //rooms table bata status 1(active bako) ani removed ko value 0(admin panel bata remove nagaraiyeko if remove grya vaye 1 hunxa ) 
          //:- remember - rooms table bata data hataiyeko xaina (tara room_features,room_facilities bata hataiyeko xa if deleted)admin panel m=ko room bata delte grda ni  :-
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
          $book_btn = "<a href='#' class='btn btn-sm text-white custom-bg shdaow-none'>Book Now</a>";
         }

          //print room card
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
                        <h6 class="mb-1">Features</h6>
                        $facilities_data
                      </div>

                      <div class="rating mb-4">
                        <h6 class="mb-1">Rating</h6>
                        <span class="badge rounded-pill bg-light">
                          <i class="bi bi-star-fill text-warning"></i>
                          <i class="bi bi-star-fill text-warning"></i>
                          <i class="bi bi-star-fill text-warning"></i>
                          <i class="bi bi-star-fill text-warning"></i>
                        </span>
                      </div>
                      <div class="d-flex justify-content-evenly mb-2">
                        $book_btn  
                      <a href="room_details.php?id=$room_data[id]" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
                      </div>

                    </div>
                  </div>
                </div>
            data;
          }

        ?>

      <div class="col-lg-12 text-center mt-5">
        <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms >>></a>
      </div>

    </div>
  </div>

  <!--Facilities section-->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>
  <div class="container">
    <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
     <!--Dynamically fetch garayeka xau-->
     <?php
     $res = mysqli_query($con, "SELECT * FROM `facilities` ORDER BY `id` DESC LIMIT 5");
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
        <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities</a></a>

      </div>
    </div>
  </div>

  <!--Testimonials :testimonial refers to a written statement or review provided by a guest or customer about 
  their experience with a particular hotel-->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">TESTIMONIALS</h2>
  <div class="container mt-5">
    <!-- Swiper -->
    <div class="swiper swiper-testimonials">
      <div class="swiper-wrapper mb-5">
        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
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
        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
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
        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
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
      <div class="swiper-pagination"></div>
    </div>
    <div class="col-lg-12 text-center mt-5">
      <a href="about1.php" class="btn btn-sm btn-outline-dark rounded- fw-bold shadow-none">Know More</a>
    </div>
  </div>


  <!--Reach Us (google map embed)-->
  <?php
  $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
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

  <?php require('footer.php'); ?>
  <!-- Start PHP code.
    //require('footer.php');: Include and execute footer.php.
      End PHP code.-->

  <!-- Swiper and Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper for homepage background -->
  <script>
    var swiper = new Swiper(".swiper-container", {
      spaceBetween: 30,
      effect: "fade",
      loop: true,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      }
    });
  </script>
  <!-- Initialize Swiper for testimonials -->
  <script>
    var swiper = new Swiper(".swiper-testimonials", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      slidesPerView: "3", //Only 3 ota slides ma matra
      loop: true,
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: false,
      },
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
        },
        460: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        }

      }
    });
  </script>

</body>

</html>
<!-- Footer 
<div class="container-fluid-footer">
  <div class="row text-center text-md-start">
    <div class="col-lg-4 col-md-6 col-sm-12 p-3">
      <h3 class="h-font fw-bold fs-3">
        NEPALI STAY 
        <br>
        <img src="images/Logo.jpg" alt="Logo" style="height:130px; width:135px; margin-top:7px;">
      </h3>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-6 p-2">
      <h5 class="mb-1">Links</h5>
      <a href="index.php" class="d-inline-block mb-1 text-dark text-decoration-none">Home</a><br>
      <a href="Rooms.php" class="d-inline-block mb-1 text-dark text-decoration-none">Rooms</a><br>
      <a href="facilities.php" class="d-inline-block mb-1 text-dark text-decoration-none">Facilities</a><br>
      <a href="Contact.php" class="d-inline-block mb-1 text-dark text-decoration-none">Contact Us</a><br>
      <a href="About.php" class="d-inline-block mb-1 text-dark text-decoration-none">About</a>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-6 p-4">
      <h5 class="mb-3">Follow Us</h5>
      <a href="#" class="d-inline-block text-dark text-decoration-none mb-2">
        <i class="bi bi-facebook me-1"></i> Facebook
      </a><br>
      <a href="#" class="d-inline-block text-dark text-decoration-none">
        <i class="bi bi-instagram me-1"></i> Instagram
      </a>
    </div>
  </div>
</div>

<div>
  <h6 class="text-center bg-dark text-white h-font p-3 m-0">
    Designed and Developed by Gobinda and Yogesh<br>&copy; Copyright reserved
  </h6>
</div>
-->
<?php
$about_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
$about_r = mysqli_fetch_assoc(select($about_q,$values,'i'));
?>

<div class="container-fluid-footer ">
  <div class="row">
    <div class="col-lg-4 col-md-6 p-4">
      <h3 class="h-font fw-bold fs-3 "><?php echo $settings_r['site_title']?></h3>
      <p><?php echo $about_r['site_about']?>  </p>
    </div>
    <div class="col-lg-4 col-md-6 p-4">
      <h5 class="mb-3" >Links</h5>
      <a href="userdashboard.php" class="d-inline-block mb-1 text-dark text-decoration-none">Home</a><br>
      <a href="Rooms.php" class="d-inline-block mb-1 text-dark text-decoration-none">Rooms</a><br>
      <a href="facilities.php" class="d-inline-block mb-1 text-dark text-decoration-none">Facilities</a><br>
      <a href="Contact.php" class="d-inline-block mb-1 text-dark text-decoration-none">Contact Us</a><br>
      <a href="about1.php" class="d-inline-block mb-1 text-dark text-decoration-none">About</a>
    </div>

    <?php //this is for making dynamic
    $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
    $values = [1];
    //euta matra row fetch grnu xa tei vayerw yei  dynamic banauney kaam gariraxau
    $contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
    ?>
    <!--jata dynamic banauna xa tesko mathi tyakkai-->
    <div class="col-lg-4 p-4">
    <h5 class="mb-3">Follow Us</h5>
      <a href=" <?php echo $contact_r['fb']?>" class="d-inline-block text-dark text-decoration-none mb-2">
        <i class="bi bi-facebook "></i> 
      </a><br>
      <a href="<?php echo $contact_r['insta']?>" class="d-inline-block text-dark text-decoration-none">
        <i class="bi bi-instagram"></i> 
      </a> 
    </div>
  </div>
</div>

<div>
  <h6 class="text-center bg-dark text-white h-font p-3 m-0">
    Designed and Developed by Gobinda and Yogesh<br>&copy; Copyright reserved
  </h6>
</div>

<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

<!-- selected anchor tag active grna lekhya code  -->
<script>
  function setActive()
  {
    navbar = document.getElementById('nav-bar'); //nav bar lai fetch grney nav-bar ko help ma
    let a_tags = navbar.getElementsByTagName('a'); //nav-bar id dwara jati pani nav bar ma anchor tag xan tyo sablai fetch grney

    for(i=0; i<a_tags.length; i++){
      let file = a_tags[i].href.split('/').pop();
      let file_name = file.split('.')[0];

      if(document.location.href.indexOf(file_name) >=0 ){
        a_tags[i].classList.add('active');
      }
    }
  }
  setActive();
</script>
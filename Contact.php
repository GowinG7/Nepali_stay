<!DOCTYPE html>
<html lang="en">

<head>
  <title>NEPALI STAY - CONTACT</title>

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
      background-color: rgb(94, 139, 235);
    }

    .container-fluid-footer {
      background-color: rgb(94, 139, 235);
    }
    .custom-alert{ /*essentials.php ko alert wala*/
  position: fixed;
  top: 80px;   /*xoppya thiyo so ...(also for alert used in settings.php yesko alert() scripts.php ma xa*/
  right: 25px;
   }
  </style>

<script>
function validateForm() {
    const name = document.forms["contactForm"]["name"].value;
    const email = document.forms["contactForm"]["email"].value;
    const subject = document.forms["contactForm"]["subject"].value;
    const message = document.forms["contactForm"]["message"].value;

    // Validate Name
    const nameRegex = /^[A-Za-z]+( [A-Za-z]+)*$/;
    if (!nameRegex.test(name)) {
        alert("Name should only contain letters and spaces.");
        return false;
    }

    // Validate Email
    const emailRegex = /^[a-z0-9.]+@(gmail|yahoo|outlook)\.com$/;
    if (!emailRegex.test(email)) {
        alert("Email must be in lowercase and end with @gmail.com, @yahoo.com, or @outlook.com, containing only a-z, 0-9, and .");
        return false;
    }

    // Validate Subject
    if (subject.trim() === "") {
        alert("Subject cannot be empty.");
        return false;
    }

    // Validate Message
    if (message.trim() === "") {
        alert("Message cannot be empty.");
        return false;
    }

    return true;
}
</script>

</head>

<body>
  <?php require('header.php'); ?>

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">CONTACT US</h2>
    <div class="h-line" style="width: 150px; height: 1.6px; background-color: black; margin: 10px auto;"></div>
    <pre class="text-center mt-3 fs-5">
      If you have any quiries and the problems please feel free to contact us. We responds within 24hrs.
    </pre>
  </div>

  <?php
    $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=? ";
    $values = [1];
    $contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
  ?>

  <div class="container">
    <div class="row">
      <!-- Make columns stack vertically on small screens -->
      <div class="col-lg-6 col-md-6 col-12 mb-5 px-4 ">
        <!-- Added w-100 to make it full width on small screens -->
        <div class="bg-white rounded shadow p-4">
          <iframe class="w-100 rounded" height="320px" src="<?php echo $contact_r['iframe']?>"></iframe>
          <h5>Address</h5>
          <a href="<?php echo $contact_r['gmap']?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
            <i class="bi bi-geo-alt-fill"></i><?php echo $contact_r['address']?>
          </a>

          <h5 class="mt-4">Call us</h5>
          <a href="tel: +<?php echo $contact_r['pn1']?>" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i> +977-<?php echo $contact_r['pn1']?>
          </a>
          <br>
          <?php
          if(!empty($contact_r['pn2'])){
            $pn2 = htmlspecialchars($contact_r['pn2']);//if data xa baney matra
            echo <<<data
              <a href="tel: +<?php echo $contact_r[pn2]?>" class="d-inline-block mb-2 text-decoration-none text-dark">
               <i class="bi bi-telephone-fill"></i> +977-<?php echo $contact_r[pn2]?>
              </a>
              data;
          }
          ?>
         

          <h5 class="mt-4">Email</h5>
          <a href="mailto: <?php echo $contact_r['email']?>" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-envelope-fill"></i> <?php echo $contact_r['email']?>
          </a>

          <h5 class="mb-3">Follow us</h5>
          <a href="<?php echo $contact_r['fb']?>" class="d-inline-block  text-dark fs-5 me-2">
            <i class="bi bi-facebook me-1"></i>
          </a>
          <a href="<?php echo $contact_r['insta']?>" class="d-inline-block  text-dark fs-5">
            <i class="bi bi-instagram me-1"></i>
          </a>
        </div>
      </div>

      <div class="col-lg-6 col-md-6 col-12 mb-5 px-4 ">
        <!-- Added w-100 to make it full width on small screens -->
        <div class="bg-white rounded shadow p-4">
          <form  name="contactForm" method="POST" onsubmit="return validateForm()">
            <h5>Send a message</h5>
            <div class="mt-3">
              <label class="form-label" style="font-weight:500;">Name</label>
              <input name="name" type="text" class="form-control shadow-none" required>
            </div>

            <div class="mt-3">
              <label class="form-label" style="font-weight:500;">Email</label>
              <input name="email" type="Email" class="form-control shadow-none" required>
            </div>

            <div class="mt-3">
              <label class="form-label" style="font-weight:500;">Subject</label>
              <input name="subject" type="text" class="form-control shadow-none" required>
            </div>

            <div class="mt-3">
              <label class="form-label" style="font-weight:500;">Message</label>
              <textarea name="message" class="form-control shadow-none" rows="5" style="resize:none;"></textarea>
              <button name="send" type="submit" class="btn text-white custom-bg mt-3">Send</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php
   if(isset($_POST['send']))
   {
    $frm_data = filteration($_POST); //sr_no auto increment baxa rw primary key pani ho so query ma insert grna parena
    $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES(?,?,?,?)";
    $values = [$frm_data['name'], $frm_data['email'], $frm_data['subject'], $frm_data['message']];
    $res = insert($q, $values, 'ssss');
    if($res==1){
      alert('success','Mail sent.'); // function banako xa admin ko essentails ma
    }
    else{
      alert('error','Mail not sent.');
    }
   }
  ?>

  <?php require('footer.php'); ?>
</body>

</html>

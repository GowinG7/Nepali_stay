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
  </style>
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

  <div class="container">
    <div class="row">
      <!-- Make columns stack vertically on small screens -->
      <div class="col-lg-6 col-md-6 col-12 mb-5 px-4 ">
        <!-- Added w-100 to make it full width on small screens -->
        <div class="bg-white rounded shadow p-4">
          <iframe class="w-100 rounded" height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1767.492113834959!2d84.3955838013265!3d27.625005136718514!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3994fb7c551279b1%3A0x8ee7bd7338e56fbe!2sGodhuli%20Chulo!5e0!3m2!1sen!2snp!4v1724998887858!5m2!1sen!2snp"></iframe>
          <h5>Address</h5>
          <a href="https://maps.app.goo.gl/EFNDWwCtMuyfn2Pg9" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
            <i class="bi bi-geo-alt-fill"></i>Bharatpur Chowkbazar, Chitwan
          </a>

          <h5 class="mt-4">Call us</h5>
          <a href="tel: +977-9869610199" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i> +977-9869610199
          </a>
          <br>
          <a href="tel: +977-9869610199" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i> +977-9860117590
          </a>

          <h5 class="mt-4">Email</h5>
          <a href="mailto:godhulichulo1@gmail.com" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-envelope-fill"></i> godhulichulo1@gmail.com
          </a>

          <h5 class="mb-3">Follow us</h5>
          <a href="#" class="d-inline-block  text-dark fs-5 me-2">
            <i class="bi bi-facebook me-1"></i>
          </a>
          <a href="#" class="d-inline-block  text-dark fs-5">
            <i class="bi bi-instagram me-1"></i>
          </a>
        </div>
      </div>

      <div class="col-lg-6 col-md-6 col-12 mb-5 px-4 ">
        <!-- Added w-100 to make it full width on small screens -->
        <div class="bg-white rounded shadow p-4">
          <form action="">
            <h5>Send a message</h5>
            <div class="mt-3">
              <label class="form-label" style="font-weight:500;">Name</label>
              <input type="text" class="form-control shadow-none" required>
            </div>

            <div class="mt-3">
              <label class="form-label" style="font-weight:500;">Email</label>
              <input type="Email" class="form-control shadow-none" required>
            </div>

            <div class="mt-3">
              <label class="form-label" style="font-weight:500;">Subject</label>
              <input type="text" class="form-control shadow-none" required>
            </div>

            <div class="mt-3">
              <label class="form-label" style="font-weight:500;">Message</label>
              <textarea class="form-control shadow-none" rows="5" style="resize:none;"></textarea>
              <button type="submit" class="btn text-white custom-bg mt-3">Send</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php require('footer.php'); ?>
</body>

</html>

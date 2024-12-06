<?php session_start()?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> CONTACT</title>

  <?php require('links.php'); ?>

  <style>
    body {
      background-color: whitesmoke;
    }

    .custom-navbar,
    .container-fluid-footer {
      background-color: rgb(94, 139, 235);
    }

    .custom-alert {
      position: fixed;
      top: 80px;
      right: 25px;
    }

    .availability-form {
      margin-top: 25px;
      padding: 0 35px;
    }

    /* Responsive styling */
    @media screen and (max-width: 575px) {
      .availability-form {
        margin-top: 25px;
        padding: 0 15px;
      }
    }
  </style>
  
</head>

<body>
  <?php require('header.php'); ?>

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">CONTACT US</h2>
    <div class="h-line" style="width: 150px; height: 1.6px; background-color: black; margin: 10px auto;"></div>
    <p class="text-center mt-3 fs-5">
      If you have any queries or problems, please feel free to contact us. We respond within 24 hours.
    </p>
  </div>

  <?php
  // Query to fetch contact details
  $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
  $values = [1];
  $contact_result = select($contact_q, $values, 'i');
  $contact_r = mysqli_fetch_assoc($contact_result);

  ?>

  <div class="container">
    <div class="row">
      <!-- Contact information column -->
      <div class="col-lg-6 col-md-6 col-12 mb-5 px-4">
        <div class="bg-white rounded shadow p-4">
          <iframe class="w-100 rounded" height="320px" src="<?php echo htmlspecialchars($contact_r['iframe']); ?>"></iframe>
          <h5>Address</h5>
          <a href="<?php echo htmlspecialchars($contact_r['gmap']); ?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
            <i class="bi bi-geo-alt-fill"></i> <?php echo htmlspecialchars($contact_r['address']); ?>
          </a>

          <h5 class="mt-4">Call us</h5>
          <a href="tel:+977-<?php echo htmlspecialchars($contact_r['pn1']); ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i> +977-<?php echo htmlspecialchars($contact_r['pn1']); ?>
          </a>
          <br>
          <?php if (!empty($contact_r['pn2'])): ?>
            <a href="tel:+977-<?php echo htmlspecialchars($contact_r['pn2']); ?>" class="d-inline-block text-decoration-none text-dark">
              <i class="bi bi-telephone-fill"></i> +977-<?php echo htmlspecialchars($contact_r['pn2']); ?>
            </a>
          <?php endif; ?>

          <h5 class="mt-4">Email</h5>
          <a href="mailto:<?php echo htmlspecialchars($contact_r['email']); ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-envelope-fill"></i> <?php echo htmlspecialchars($contact_r['email']); ?>
          </a>

          <h5 class="mb-3">Follow us</h5>
          <a href="<?php echo htmlspecialchars($contact_r['fb']); ?>" class="d-inline-block text-dark fs-5 me-2">
            <i class="bi bi-facebook me-1"></i>
          </a>
          <a href="<?php echo htmlspecialchars($contact_r['insta']); ?>" class="d-inline-block text-dark fs-5">
            <i class="bi bi-instagram me-1"></i>
          </a>
        </div>
      </div>

     <!-- Contact form column -->
    <div class="col-lg-6 col-md-6 col-12 mb-5 px-4">
      <div class="bg-white rounded shadow p-4">
        <form name="contactForm" method="POST" onsubmit="return validateForm()">
          <h5>Send a message</h5>
          <div class="mt-3">
            <label for="name" class="form-label" style="font-weight: 500;">Name</label>
            <input id="name" name="name" type="text" class="form-control shadow-none" placeholder="Your Name" required>
            <small id="nameError" class="text-danger"></small>
          </div>

          <div class="mt-3">
            <label for="email" class="form-label" style="font-weight: 500;">Email</label>
            <input id="email" name="email" type="email" class="form-control shadow-none" placeholder="Your Email" required>
            <small id="emailError" class="text-danger"></small>
          </div>

          <div class="mt-3">
            <label for="subject" class="form-label" style="font-weight: 500;">Subject</label>
            <input id="subject" name="subject" type="text" class="form-control shadow-none" placeholder="Subject" required>
            <small id="subjectError" class="text-danger"></small>
          </div>

          <div class="mt-3">
            <label for="message" class="form-label" style="font-weight: 500;">Message</label>
            <textarea id="message" name="message" class="form-control shadow-none" rows="5" placeholder="Your Message" style="resize: none;"></textarea>
            <small id="messageError" class="text-danger"></small>
            <button name="send" type="submit" class="btn text-white custom-bg mt-3">Send</button>
          </div>
        </form>
      </div>
    </div>

    <script>
      // Add event listeners for real-time validation
      document.getElementById("name").addEventListener("input", validateName);
      document.getElementById("email").addEventListener("input", validateEmail);
      document.getElementById("subject").addEventListener("input", validateSubject);
      document.getElementById("message").addEventListener("input", validateMessage);

      // Validation patterns
      const namePattern = /^[a-zA-Z\s]+$/;
      const emailPattern = /^[a-z0-9\.]+@(gmail\.com|outlook\.com|yahoo\.com)$/;
      const subjectPattern = /^[a-zA-Z\s]+$/;
      const messagePattern = /^[a-zA-Z0-9\s]+$/;

      // Name validation
      function validateName() {
        const name = document.getElementById("name").value.trim();
        const error = document.getElementById("nameError");
        if (!namePattern.test(name)) {
          error.textContent = "Name should contain only alphabets and spaces.";
        } else {
          error.textContent = "";
        }
      }

      // Email validation
      function validateEmail() {
        const email = document.getElementById("email").value.trim();
        const error = document.getElementById("emailError");
        if (!emailPattern.test(email)) {
          error.textContent = "Email should only contains a-z,0-9 and period/dot(.) end with @gmail.com, @outlook.com, or @yahoo.com.";
        } else {
          error.textContent = "";
        }
      }

      // Subject validation
      function validateSubject() {
        const subject = document.getElementById("subject").value.trim();
        const error = document.getElementById("subjectError");
        if (!subjectPattern.test(subject)) {
          error.textContent = "Subject should contain only letters.";
        } else {
          error.textContent = "";
        }
      }

      // Message validation
      function validateMessage() {
        const message = document.getElementById("message").value.trim();
        const error = document.getElementById("messageError");
        if (!messagePattern.test(message)) {
          error.textContent = "Message should contain only letters, numbers, and spaces.";
        } else {
          error.textContent = "";
        }
      }

      // Final form validation before submission
      function validateForm() {
        validateName();
        validateEmail();
        validateSubject();
        validateMessage();

        // Check if there are errors
        const errors = document.querySelectorAll(".text-danger");
        for (let error of errors) {
          if (error.textContent !== "") {
            alert("Please fix the errors in the form before submitting.");
            return false;
          }
        }

        return true; // Allow form submission if all fields are valid
      }
    </script>


    </div>
  </div>

    <script>
    // Auto-dismiss alerts after 5 seconds
    document.addEventListener("DOMContentLoaded", () => {
      const alert = document.querySelector(".custom-alert");
      if (alert) {
        setTimeout(() => {
          alert.classList.add("fade");
          setTimeout(() => alert.remove(), 500); // Wait for fade-out transition
        }, 2000); // 2 seconds
      }
    });
    </script>
    <script>
  // Reset form to prevent resubmission
  window.addEventListener("load", function () {
    if (window.history.replaceState) {
      // Clear form data without reloading
      window.history.replaceState(null, null, window.location.href);
    }
  });
    </script>

    <?php
    if (isset($_POST['send'])) {
        // Sanitize and validate input
        $frm_data = filteration($_POST);

        // Validation errors array
        $errors = [];

        // Name validation: only letters and spaces
        if (!preg_match("/^[a-zA-Z\s]+$/", $frm_data['name'])) {
            $errors[] = "Name should contain only alphabets and spaces.";
        }

        // Email validation: only valid domains
        if (!preg_match("/^[a-z0-9\.]+@(gmail\.com|outlook\.com|yahoo\.com)$/", $frm_data['email'])) {
            $errors[] = "Email should be valid and end with @gmail.com, @outlook.com, or @yahoo.com.";
        }

        // Subject validation: only letters
        if (!preg_match("/^[a-zA-Z\s]+$/", $frm_data['subject'])) {
            $errors[] = "Subject should contain only letters.";
        }

        // Message validation: letters, numbers, and spaces
        if (!preg_match("/^[a-zA-Z0-9\s]+$/", $frm_data['message'])) {
            $errors[] = "Message should contain only letters, numbers, and spaces.";
        }

        // If there are errors, show an alert and do not proceed
        if (!empty($errors)) {
            foreach ($errors as $error) {
                alert('error', $error);
            }
        } else {
            // If no errors, proceed with database insertion
            $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES(?,?,?,?)";
            $values = [$frm_data['name'], $frm_data['email'], $frm_data['subject'], $frm_data['message']];
            $res = insert($q, $values, 'ssss');

            if ($res == 1) {
                alert('success', 'Message sent successfully!');
            } else {
                alert('error', 'Message sent failed!');
            }
        }
    }
    ?>


  </body>

</html>

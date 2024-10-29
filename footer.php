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


<div class="container-fluid-footer ">
  <div class="row">
    <div class="col-lg-4 col-md-6 p-4">
      <h3 class="h-font fw-bold fs-3 ">Nepali Stay</h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
        Tenetur nulla saepe perspiciatis porro dolorum recusandae quas? 
        Consectetur dicta delectus nulla! Nihil perspiciatis dolores enim dolorem natus tempore debitis facere assumenda.
      </p>
    </div>
    <div class="col-lg-4 col-md-6 p-4">
      <h5 class="mb-3" >Links</h5>
      <a href="index.php" class="d-inline-block mb-1 text-dark text-decoration-none">Home</a><br>
      <a href="Rooms.php" class="d-inline-block mb-1 text-dark text-decoration-none">Rooms</a><br>
      <a href="facilities.php" class="d-inline-block mb-1 text-dark text-decoration-none">Facilities</a><br>
      <a href="Contact.php" class="d-inline-block mb-1 text-dark text-decoration-none">Contact Us</a><br>
      <a href="About.php" class="d-inline-block mb-1 text-dark text-decoration-none">About</a>
    </div>
    <div class="col-lg-4 p-4">
    <h5 class="mb-3">Follow Us</h5>
      <a href="#" class="d-inline-block text-dark text-decoration-none mb-2">
        <i class="bi bi-facebook "></i> Facebook
      </a><br>
      <a href="#" class="d-inline-block text-dark text-decoration-none">
        <i class="bi bi-instagram"></i> Instagram
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

<script>

  let register_form = document.getElementById('register-form');

  register_form.addEventListener('submit', (e)=>{   //here e is function
    e.preventDefault();

    let data = new FormData();

    data.append('name', register_form.elements['name'].value);
    data.append('email', register_form.elements['email'].value);
    data.append('phonenum', register_form.elements['phonenum'].value);
    data.append('address', register_form.elements['address'].value);
    data.append('dob', register_form.elements['dob'].value);
    data.append('pass', register_form.elements['pass'].value);
    data.append('cpass', register_form.elements['cpass'].value);
    data.append('profile', register_form.elements['profile'].files[0]);  //jati pani file select gryo tyo madhey 1st file matra janey
    data.append('register','');

    var myModal = document.getElementById('registerModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php",true);
    
    /*xhr.onreadystatechange = function(){
      if(this.readyState==4 && this.status==200){
    //yesko satto short:*/
      xhr.onload = function(){
        if(this.resposeText == 'pass_mismatch'){
          alert('error',"Password Mismatch");
        }
        else if(this.responseText == 'email_already'){
          alert('error',"Email Already Registered");
        }
        else if(this.responseText == 'phone_already'){
          alert('error',"Phone Number Already Registered");
        }
        else if(this.responseText == 'inv_img'){
          alert('error',"Invalid Image");
        }
        else if(this.responseText == 'upd_failed')
        {
          alert ('error',"Image upload failed");
        }
        else if(this.responseText == 'ins_failed'){
          alert ('error',"Registration failed! Server down!");
        }
        else{
          alert('sucess',"Registration successful");
        }

      
      }

    xhr.send(data);
 
  });

</script>
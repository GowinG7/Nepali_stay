<!-- Scripts tag for bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

<script>
    //settings.php ma upd_general() function ma alert ko lagi used bayeko xa
    function alert(type,msg){
        let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML = `
            <div class="alert ${bs_class} alert-dismissible fade show custom-alert role="alert">
            <strong class="me-3">${msg}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
            </div>
        `;
        document.body.append(element);
        setTimeout(remAlert,2000); //remove wala alert 2 sec(2000miliseconds) paxi dekhau ney
    }
    //tyo alert grda teha gayerw cross ma click nai grna parthiyo tara aba aafai hatxa
    function remAlert(){
      document.getElementsByClassName('alert')[0].remove();
    }

    </script>

    <script>
  function setActive()
  {
    navbar = document.getElementById('dashboard-menu'); //nav bar lai fetch grney nav-bar ko help ma
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
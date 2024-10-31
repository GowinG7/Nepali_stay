

//AJAX with Javascript for fetching General Settings

let carousel_s_form = document.getElementById('carousel_s_form');
let carousel_picture_inp = document.getElementById('carousel_picture_inp');



carousel_s_form.addEventListener('submit', function(e){
  e.preventDefault();
  add_image();
});

function add_image()
{
  //when uploading file through Ajax FormData() is used
  let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
  data.append('picture',carousel_picture_inp.files[0]);
  data.append('add_image','');

  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/carousel_crud.php",true);
   //picture pathauda setRequestHeader chaidaina

    /*xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
    //yesko satto short:*/
    xhr.onload = function(){
      var myModal = document.getElementById('carousel-s')
      var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
      modal.hide(); //general setting ko tyo form submit modal hide grna cancel wa sumbit bayepaxi
      
      if(this.responseText == 'inv_img'){
        alert('error','Only JPG and PNG images are allowed');
      }
      else if(this.responseText == 'inv_size' ){
        alert('error','Image size should be less than 2MB');
    }
    else if(this.responseText == 'upd_failed'){
      alert('error','Image upload failed. Server Down!');
    }
    else{
      alert('success','New image added!');
      //new member add bayeC inputfield ko data blank huna parO
      carousel_picture_inp.value = '';
      get_carousel();
    }
  }

   xhr.send(data); //data is sent cause all the things(name,picture,add_image) are append in this variable
}   //data sent bayeC database ma request janxa so settings_crud.php ma request manage grna parxa

function get_carousel(){
  //get member data from database
  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/settings_crud.php",true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  /*xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
  //yesko satto short:*/
    xhr.onload = function(){
      document.getElementById('team-data').innerHTML = this.responseText;
    }

  xhr.send('get_carousel');
}

function rem_member(val)
{
  //remove member data from database so sr_no should be passed to delete
  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/settings_crud.php",true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  /*xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
  //yesko satto short:*/
    xhr.onload = function(){
      if(this.responseText==1){
        alert('success','Member removed!');
        get_carousel();
      }
      else{
        alert('error','Member removal failed!');
      }
    
    }

  xhr.send('rem_member='+val);
}

//window load bayeC yo function call huna parYo
window.onload = function () {
  get_carousel();
}

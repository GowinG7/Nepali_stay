

//AJAX with Javascript for fetching General Settings
let general_data, contacts_data;

let general_s_form = document.getElementById('general_s_form');
let site_title_inp = document.getElementById('site_title_inp');
let site_about_inp = document.getElementById('site_about_inp');

let contacts_s_form = document.getElementById('contacts_s_form');

let team_s_form = document.getElementById('team_s_form');
let member_name_inp =document.getElementById('member_name_inp');
let member_picture_inp = document.getElementById('member_picture_inp');

function get_general(){
  let site_title = document.getElementById('site_title');
  let site_about = document.getElementById('site_about');

  let shutdown_toggle = document.getElementById('shutdown-toggle');

  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/settings_crud.php",true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  /*xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
  //yesko satto short:*/
    xhr.onload = function(){
    console.log(this.responseText);  // Check the response in browser's console
    general_data = JSON.parse(this.responseText);

    if(general_data.error){
    console.log(general_data.error);
    } else {
    site_title.innerText = general_data.site_title;
    site_about.innerText = general_data.site_about;

    site_title_inp.value = general_data.site_title;
    site_about_inp.value = general_data.site_about;

    //yedi shutdown bayo baney value = 1 ani switches toggle ni on hunxa 
    //yedi value= 0 no shutdown and switches toogle off hunxa
    if(general_data.shutdown == 0){
      shutdown_toggle.checked = false;
      shutdown_toggle.value = 0;
    }
    else{
      shutdown_toggle.checked = true;
      shutdown_toggle.value = 1;
    }

    }
    }


  xhr.send('get_general');
}

 general_s_form.addEventListener('submit',function(e){ //e = event occur , its target the form 
  e.preventDefault(); //submit baie page lai refresh  form ko defualt behaviour yo behaviour bata rokney
  upd_general(site_title_inp.value,site_about_inp.value);
})

//setting ko site title rw about ko edit wala form ko submit bata ajax bata data  fetch garauna ani upd_general() le update garauna
function upd_general(site_title_val, site_about_val)
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    /*xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
    //yesko satto short:*/
    xhr.onload = function(){
      var myModal = document.getElementById('general-s')
      var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
      modal.hide(); //general setting ko tyo form submit modal hide grna cancel wa sumbit bayepaxi

    console.log(this.responseText);  // Check the response in browser's console
    
      if(this.responseText == 1)
    {
      //alert() scripts.php ma xa
      alert('success','Changes saved!');
      get_general(); //fetched the data from the database and store in the admin general settings 
    }
    else
    {
      alert('error',"No changes made!");
    }
    }
   xhr.send('site_title='+site_title_val + '&site_about='+site_about_val+'&upd_general=1');

}

function upd_shutdown(val){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    /*xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
    //yesko satto short:*/
    xhr.onload = function(){
    if(this.responseText == 1 && general_data.shutdown==0) //yedi paila zero thiyo rw ahele 1 vaye
    {
    //alert() scripts.php ma xa
    alert('success','Site has been Shutdown!');
     }
    else
    {
    alert('success',"Shutdown mode off!"); //Site shutdown hoss ya nahoss kunai pani error hoina so no error
    }
    get_general(); //fetched the data from the database and store in the admin general settings 
    }
    xhr.send('upd_shutdown='+val);

}

function get_contacts(){
  
  let contacts_p_id = ['address','gmap','pn1','pn2','email','fb','insta'];
  let iframe = document.getElementById('iframe');

  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/settings_crud.php",true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  /*xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
  //yesko satto short:*/
    xhr.onload = function(){
     contacts_data = JSON.parse(this.responseText);
     contacts_data = Object.values(contacts_data);
     
     for(i=0;i<contacts_p_id.length;i++){  //iframe samma 8 ota xa tara s.n le grda 9 ota
      document.getElementById(contacts_p_id[i]).innerText = contacts_data[i+1]; 
     }
      
     iframe.src =contacts_data[8];
     //uta mathi edit wala ma 2 ota thiyo so jhyappa comma lekhdai vayo
     //tara yeha 8-9 ota xa so mathi jasari banauna bnda function lekherw 
     contacts_inp(contacts_data); //line 381

    }


  xhr.send('get_contacts');
}

function contacts_inp(data)
{
  let contacts_inp_id = ['address_inp','gmap_inp','pn1_inp','pn2_inp','email_inp','fb_inp','insta_inp','iframe_inp'];
  
  for(i=0;i<contacts_inp_id.length;i++){
    document.getElementById(contacts_inp_id[i]).value = data[i+1];
  }
}

contacts_s_form.addEventListener('submit', function(e){
  e.preventDefault();
  upd_contacts();
});

function upd_contacts()
{
  let index =['address','gmap','pn1','pn2','email','fb','insta','iframe'];
  let contacts_inp_id = ['address_inp','gmap_inp','pn1_inp','pn2_inp','email_inp','fb_inp','insta_inp','iframe_inp'];
  
  let data_str = "";
  for(i=0;i<index.length;i++){
    data_str += `${index[i]}=${document.getElementById(contacts_inp_id[i]).value}&`;
  }
  data_str += "upd_contacts";

  //aba ajax query
  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/settings_crud.php",true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function(){        
    var myModal = document.getElementById('contacts-s')
    var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
    modal.hide(); //general setting ko tyo form submit modal hide grna cancel wa sumbit bayepaxi

    if(this.responseText == 1 ) //yedi paila zero thiyo rw ahele 1 vaye
    {
     //alert() scripts.php ma xa
     alert('success','Changes saved!');
     get_contacts(); //tyo form refresh or renew huna call grya
     }
    else
    {
    alert('success',"No changes are made!"); //Site shutdown hoss ya nahoss kunai pani error hoina so no error
    } 
    }

  xhr.send(data_str);
}

team_s_form.addEventListener('submit', function(e){
  e.preventDefault();
  add_member();
});

function add_member()
{
  //when uploading file through Ajax FormData() is used
  let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
  data.append('name',member_name_inp.value);
  data.append('picture',member_picture_inp.files[0]);
  data.append('add_member','');

  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/settings_crud.php",true);
   //picture pathauda setRequestHeader chaidaina

    /*xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
    //yesko satto short:*/
    xhr.onload = function(){
      var myModal = document.getElementById('team-s')
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
      alert('success','New member added!');
      //new member add bayeC inputfield ko data blank huna parO
      member_name_inp.value = '';
      member_picture_inp.value = '';
      get_members();
    }
  }

   xhr.send(data); //data is sent cause all the things(name,picture,add_member) are append in this variable
}   //data sent bayeC database ma request janxa so settings_crud.php ma request manage grna parxa

function get_members(){
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

  xhr.send('get_members');
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
        get_members();
      }
      else{
        alert('error','Member removal failed!');
      }
    
    }

  xhr.send('rem_member='+val);
}

//window load bayeC yo function call huna parYo
window.onload = function(){
  get_general();
  get_contacts();
  get_members();
}


    let add_room_form = document.getElementById('add_room_form');

    add_room_form.addEventListener('submit',function(event){
    event.preventDefault();
    add_rooms();
    });
    //db table ma insert grney wala
    function add_rooms()
    {
    //when uploading file through Ajax FormData() is used
    let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
    data.append('add_room','');
    data.append('name',add_room_form.elements['name'].value);
    data.append('area',add_room_form.elements['area'].value);
    data.append('price',add_room_form.elements['price'].value);
    data.append('quantity',add_room_form.elements['quantity'].value);
    data.append('description',add_room_form.elements['description'].value);

    let features = [];
    add_room_form.elements['features'].forEach(el =>{
        if(el.checked){
        features.push(el.value);
        }
    });

    let facilities = [];
    add_room_form.elements['facilities'].forEach(el =>{
        if(el.checked){
        facilities.push(el.value);
        }
    });

    data.append('features',JSON.stringify(features));
    data.append('facilities',JSON.stringify(facilities));


    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);


    /*xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
    //yesko satto short:*/
    xhr.onload = function(){
    var myModal = document.getElementById('add-room')
    var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
    modal.hide(); //general setting ko tyo form submit modal hide grna cancel wa sumbit bayepaxi

    if(this.responseText == 1 ){
    alert('success','New room added!');
    add_room_form.reset();
    get_all_rooms(); // it updates the room list immediately after adding a new room

    }
    else{
    alert('error','Room added failed. Server Down!');
    }
    }
    xhr.send(data); //data is sent cause all the things(name,picture,add_member) are append in this variable
    }


    //db table bata admin panel ko rooms section ma fetch garna
    function get_all_rooms()
    {

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);
    xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');


    /*xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
    //yesko satto short:*/
    xhr.onload = function(){
        //room-data id line 51 ma xa tbody ma yo id ma rooms haru lyayerw rakhey ho
        document.getElementById('room-data').innerHTML = this.responseText;

    }
    xhr.send('get_all_rooms');
    }

    let edit_room_form = document.getElementById('edit_room_form');

    function edit_details(id)
    {
    //yo id ko behalf ma httprequest pathauna parxa
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    /*xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
    //yesko satto short:*/
    xhr.onload = function(){
        let data = JSON.parse(this.responseText);

        edit_room_form.elements['name'].value = data.roomdata.name;
        edit_room_form.elements['area'].value = data.roomdata.area;
        edit_room_form.elements['price'].value = data.roomdata.price;
        edit_room_form.elements['quantity'].value = data.roomdata.quantity;
        edit_room_form.elements['description'].value = data.roomdata.description;
        
        edit_room_form.elements['room_id'].value = data.roomdata.id;

        edit_room_form.elements['features'].forEach(el =>{
        if(data.features.includes(Number(el.value))){
            el.checked = true;
        }
        });

        edit_room_form.elements['facilities'].forEach(el =>{
        if(data.facilities.includes(Number(el.value))){
            el.checked = true;
        }
        });
    }
    xhr.send('get_room='+id);
    }

    //room edit garepaxi submit grna 
    edit_room_form.addEventListener('submit',function(event){
    event.preventDefault();
    submit_edit_room();
    });

    //room lai edit garerw db table ma insert grney wala matlab upadte/edit grney
    function submit_edit_room()
    {
    //when uploading file through Ajax FormData() is used
    let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
    data.append('edit_room','');
    data.append('room_id',edit_room_form.elements['room_id'].value);
    data.append('name',edit_room_form.elements['name'].value);
    data.append('area',edit_room_form.elements['area'].value);
    data.append('price',edit_room_form.elements['price'].value);
    data.append('quantity',edit_room_form.elements['quantity'].value);
    data.append('description',edit_room_form.elements['description'].value);

    let features = [];
    edit_room_form.elements['features'].forEach(el =>{
        if(el.checked){
        features.push(el.value);
        }
    });

    let facilities = [];
    edit_room_form.elements['facilities'].forEach(el =>{
        if(el.checked){
        facilities.push(el.value);
        }
    });

    data.append('features',JSON.stringify(features));
    data.append('facilities',JSON.stringify(facilities));


    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);


    /*xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
    //yesko satto short:*/
    xhr.onload = function(){
    console.log("Server response:", this.responseText);
    var myModal = document.getElementById('edit-room');
    var modal = bootstrap.Modal.getInstance(myModal); // Returns a Bootstrap modal instance
    modal.hide(); //general setting ko tyo form submit modal hide grna cancel wa sumbit bayepaxi

    if(this.responseText == 1 ){
    alert('success','Room data edited successfully');
    edit_room_form.reset(); //form submit bayeC form ko data clear huna paroo
    get_all_rooms(); //as the room data is edited it updated the room list and data immediately
    }
    else{
    alert('error','Room data edited failed. Server Down!');
    }
    };
    xhr.send(data); //data is sent cause all the things(name,picture,add_member) are append in this variable
    }


    //rooms ma status active rw inactive garauna baki code 
    function toggle_status(id,val)
    {

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);
    xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');


    /*xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
    //yesko satto short:*/
    xhr.onload = function(){
        if(this.responseText == 1){
            alert('success', 'Status toggled');
            get_all_rooms();
        }
        else{
        alert('success','Status toggled failed');
        }
    }
    xhr.send('toggle_status='+id+'&value='+val);
    }
    //admin panel bata room ko image add grna rooms section ma
    let add_image_form = document.getElementById('add_image_form');

    add_image_form.addEventListener('submit',function(e){
    e.preventDefault();
    add_image();
    });

    function add_image()
    {
    //when uploading file through Ajax FormData() is used
    let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
    data.append('image',add_image_form.elements['image'].files[0]);
    data.append('room_id',add_image_form.elements['room_id'].value);
    data.append('add_image','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);
    //picture pathauda setRequestHeader chaidaina

    /*xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
    //yesko satto short:*/
    xhr.onload = function(){
        
        if(this.responseText == 'inv_img'){
        alert('error','Only JPG, WEBP and PNG images are allowed','image-alert');
        }
        else if(this.responseText == 'inv_size' ){
        alert('error','Image size should be less than 2MB','image-alert');
        }
        else if(this.responseText == 'upd_failed'){
        alert('error','Image upload failed. Server Down!','image-alert');
        }
        else{
        alert('success','New image added!','image-alert');
        //new member add bayeC inputfield ko data blank huna parO
        room_images(add_image_form.elements['room_id'].value,document.querySelector("#room-images .modal-title").innerText);  
        add_image_form.reset();
        }
    }
    xhr.send(data); //data is sent cause all the things(name,picture,add_image) are append in this variable
    }

    function room_images(id,rname){
    document.querySelector("#room-images .modal-title").innerText = rname;
    add_image_form.elements['room_id'].value = id;
    add_image_form.elements['image'].value = '';


    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);
    xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    /*xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
    //yesko satto short:*/
    xhr.onload = function(){
        document.getElementById('room-image-data').innerHTML = this.responseText;
    }
    xhr.send('get_room_images='+id);
    }

    function rem_image(img_id,room_id)
    {
    //when uploading file through Ajax FormData() is used
    let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
    data.append('image_id',img_id);
    data.append('room_id',room_id);
    data.append('rem_image','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);
    //picture pathauda setRequestHeader chaidaina

    /*xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
    //yesko satto short:*/
    xhr.onload = function(){
        
        if(this.responseText == 1){
        alert('success','Image removed successfully','image-alert');
        room_images(room_id,document.querySelector("#room-images .modal-title").innerText);  

        }
        else{
        alert('error','Image removal failed','image-alert');
        //new member add bayeC inputfield ko data blank huna parO
            add_image_form.reset();
        }
    }
    xhr.send(data); //data is sent cause all the things(name,picture,add_image) are append in this variable
    }

    function thumb_image(img_id,room_id)
    {
    //when uploading file through Ajax FormData() is used
    let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
    data.append('image_id',img_id);
    data.append('room_id',room_id);
    data.append('thumb_image','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);
    //picture pathauda setRequestHeader chaidaina

    /*xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
    //yesko satto short:*/
    xhr.onload = function(){
        
        if(this.responseText == 1){
        alert('success','Image Thumbnail Changed successfully','image-alert');
        room_images(room_id,document.querySelector("#room-images .modal-title").innerText);  

        }
        else{
        alert('error','Image Thumbnail update  failed','image-alert');
        }
    }
    xhr.send(data); //data is sent cause all the things(name,picture,add_image) are append in this variable
    }

    function remove_room(room_id)
    {
    if(confirm("Are you sure, you want to delete this room(along with room selected features and facilities will also be removed)?"))
    {
    //when uploading file through Ajax FormData() is used
    let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
    data.append('room_id',room_id);
    data.append('remove_room','');
    let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/rooms.php",true);
        //picture pathauda setRequestHeader chaidaina

        /*xhr.onreadystatechange = function(){
        if(this.readyState==4 && this.status==200){
        //yesko satto short:*/
        xhr.onload = function(){
        
        if(this.responseText == 1){
            alert('success','Room remove successfully');
            get_all_rooms();
        }
        else{
            alert('error','Room removal failed');
        }
        }
        xhr.send(data); //data is sent cause all the things(name,picture,add_image) are append in this variable

    }

        }



    window.onload = function(){
        get_all_rooms();
    }



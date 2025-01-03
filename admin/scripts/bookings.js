
    //db table bata admin panel ko users section ma fetch garna
    function get_bookings()
    {

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/bookings.php",true);
    xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

    /*xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
    //yesko satto short:*/
    xhr.onload = function(){
        //room-data id line 51 ma xa tbody ma yo id ma rooms haru lyayerw rakhey ho
        document.getElementById('table-data').innerHTML = this.responseText;

    }
    xhr.send('get_bookings');
    }

    
    //user le gareko booking  ma verified grna 
    //yeha bata ajax ko users.php ma request janxa
    function toggle_verify(id,val)
    {

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/bookings.php",true);
        xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');


        /*xhr.onreadystatechange = function(){
        if(this.readyState==4 && this.status==200){
        //yesko satto short:*/
        xhr.onload = function(){
            if(this.responseText == 1){
                alert('success', 'Booking Confirmed!');
                get_bookings();
            }
            else{
            alert('error','Booking Confirm failed!');
            }
        }
        xhr.send('toggle_verify='+id+'&value='+val);
    }
    
    function remove_bookings(booking_id)
    {
    if(confirm("Are you sure, you want to delete this booking?"))
    {
    //when uploading file through Ajax FormData() is used
    let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
    data.append('booking_id',booking_id);
    data.append('remove_bookings','');
    let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/bookings.php",true);
        //picture pathauda setRequestHeader chaidaina

        /*xhr.onreadystatechange = function(){
        if(this.readyState==4 && this.status==200){
        //yesko satto short:*/
        xhr.onload = function(){
        
        if(this.responseText == 1){
            alert('success','Booking remove successfully!');
            get_bookings();
        }
        else{
            alert('error','Booking removal failed!');
        }
        }
        xhr.send(data); //data is sent cause all the things(name,picture,add_image) are append in this variable

    }

        }
    //username ko basis ma seach garney users
    function search_bookings(name) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/bookings.php",true);
        xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    
        /*xhr.onreadystatechange = function(){
        if(this.readyState==4 && this.status==200){
        //yesko satto short:*/
        xhr.onload = function(){
            //room-data id line 51 ma xa tbody ma yo id ma rooms haru lyayerw rakhey ho
            document.getElementById('table-data').innerHTML = this.responseText;
    
        }
        xhr.send('search_bookings&name='+name);  
      }

    window.onload = function(){
        get_bookings(); //window load huney bitikaii get_users() call huney
    }



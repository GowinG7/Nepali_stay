
    //db table bata admin panel ko users section ma fetch garna
    function get_users()
    {

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/users.php",true);
    xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

    /*xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
    //yesko satto short:*/
    xhr.onload = function(){
        //room-data id line 51 ma xa tbody ma yo id ma rooms haru lyayerw rakhey ho
        document.getElementById('users-data').innerHTML = this.responseText;

    }
    xhr.send('get_users');
    }

    //users ma status active rw inactive garauna baki code 
    //yeha bata ajax ko users.php ma request janxa
    function toggle_status(id,val)
    {

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/users.php",true);
    xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');


    /*xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
    //yesko satto short:*/
    xhr.onload = function(){
        if(this.responseText == 1){
            alert('success', 'Status toggled');
            get_users();
        }
        else{
        alert('success','Status toggled failed');
        }
    }
    xhr.send('toggle_status='+id+'&value='+val);
    }

    //users ma verified grna 
    //yeha bata ajax ko users.php ma request janxa
    function toggle_verify(id,val)
    {

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/users.php",true);
        xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');


        /*xhr.onreadystatechange = function(){
        if(this.readyState==4 && this.status==200){
        //yesko satto short:*/
        xhr.onload = function(){
            if(this.responseText == 1){
                alert('success', 'User become Verified');
                get_users();
            }
            else{
            alert('success','verified failed');
            }
        }
        xhr.send('toggle_verify='+id+'&value='+val);
    }
    
    function remove_user(user_id)
    {
    if(confirm("Are you sure, you want to delete this user?"))
    {
    //when uploading file through Ajax FormData() is used
    let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
    data.append('user_id',user_id);
    data.append('remove_user','');
    let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/users.php",true);
        //picture pathauda setRequestHeader chaidaina

        /*xhr.onreadystatechange = function(){
        if(this.readyState==4 && this.status==200){
        //yesko satto short:*/
        xhr.onload = function(){
        
        if(this.responseText == 1){
            alert('success','User remove successfully');
            get_users();
        }
        else{
            alert('error','User removal failed');
        }
        }
        xhr.send(data); //data is sent cause all the things(name,picture,add_image) are append in this variable

    }

        }
    //username ko basis ma seach garney users
    function search_user(name) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/users.php",true);
        xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    
        /*xhr.onreadystatechange = function(){
        if(this.readyState==4 && this.status==200){
        //yesko satto short:*/
        xhr.onload = function(){
            //room-data id line 51 ma xa tbody ma yo id ma rooms haru lyayerw rakhey ho
            document.getElementById('users-data').innerHTML = this.responseText;
    
        }
        xhr.send('search_user&name='+name);  
      }

    window.onload = function(){
        get_users(); //window load huney bitikaii get_users() call huney
    }



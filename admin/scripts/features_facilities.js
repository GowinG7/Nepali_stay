
            let feature_s_form = document.getElementById('feature_s_form');
            let facility_s_form = document.getElementById('facility_s_form');

            feature_s_form.addEventListener('submit', function(e){
                e.preventDefault();
                add_feature();
            });
            //database ma fetch garauna
            function add_feature() 
            {
                //when uploading file through Ajax FormData() is used
                let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
                data.append('name',feature_s_form.elements['feature_name'].value);
                data.append('add_feature','');

                let xhr = new XMLHttpRequest();
                xhr.open("POST","ajax/features_facilities.php",true);
            

                /*xhr.onreadystatechange = function(){
                if(this.readyState==4 && this.status==200){
                //yesko satto short:*/
                xhr.onload = function(){
                var myModal = document.getElementById('feature-s')
                var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
                modal.hide(); //general setting ko tyo form submit modal hide grna cancel wa sumbit bayepaxi

                if(this.responseText == 1 ){
                alert('success','New feature added!');
                //new member add bayeC inputfield ko data blank huna parO
                feature_s_form.elements['feature_name'].value = '';
                get_features();
                }
                else{
                alert('error','Feature added failed. Server Down!');
                }
                }
                xhr.send(data); //data is sent cause all the things(name,picture,add_member) are append in this variable
            } 

            //dynamic huda admin panel ma fetch garauna
            function get_features()
            {
            //get features data from database
            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/features_facilities.php",true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            /*xhr.onreadystatechange = function(){
            if(this.readyState==4 && this.status==200){
            //yesko satto short:*/
            xhr.onload = function(){
            document.getElementById('features-data').innerHTML = this.responseText;
            }

            xhr.send('get_features');
            }

            function rem_feature(val)
            {
            //remove features data from database so sr_no should be passed to delete
            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/features_facilities.php",true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            /*xhr.onreadystatechange = function(){
            if(this.readyState==4 && this.status==200){
            //yesko satto short:*/
                xhr.onload = function () {
                    var responseText = this.responseText.trim();  // Remove any leading/trailing whitespace

                    if (responseText == 1) {
                        alert('success', 'feature removed successfully!');
                        get_features(); //feature remove bayeC feri call garinca get_features
                    }
                    else if(responseText == 'room_added'){
                        alert('error', 'Feature is added in the room!');
                    }
                    else{
                        alert('error', 'Feature removal failed!');
                    } 
                };

            xhr.send('rem_feature='+val);
            }


            facility_s_form.addEventListener('submit', function(e){
                e.preventDefault();
                add_facility();
            });
            //database table ma rakhna
            function add_facility() 
            {
                //when uploading file through Ajax FormData() is used
                let data = new FormData(); //FormData() always send data in multipart form and its RequestHeader is already set
                data.append('name',facility_s_form.elements['facility_name'].value);
                data.append('icon',facility_s_form.elements['facility_icon'].files[0]); //facility icon image file ho files[0] bnya jati pani choose baxa pailo image matra upload hunxa multiple image upload hunna
                data.append('desc',facility_s_form.elements['facility_desc'].value);
                data.append('add_facility','');

                let xhr = new XMLHttpRequest();
                xhr.open("POST","ajax/features_facilities.php",true);
            

                /*xhr.onreadystatechange = function(){
                if(this.readyState==4 && this.status==200){
                //yesko satto short:*/
                xhr.onload = function(){
                var myModal = document.getElementById('facility-s')
                var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
                modal.hide(); //general setting ko tyo form submit modal hide grna cancel wa sumbit bayepaxi

                if(this.responseText == 'inv_img' ){
                alert('error','Only SVG images are allowed');
                }
                else if(this.responseText == 'inv_size' ){
                alert('error','Image size should be less than 1MB');
                }
                else if(this.responseText == 'upd_failed'){
                alert('error','Image upload failed');
                }
                else{
                alert('success','Facility added successfully');
                facility_s_form.reset();
                //get_members();
                }
                }
                xhr.send(data); //data is sent cause all the things(name,picture,add_member) are append in this variable
            } 
            
            //dynamic huda database table bata admin panel ma leuna
            function get_facility()
            {
                let xhr = new XMLHttpRequest();
                xhr.open("POST","ajax/features_facilities.php",true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                /*xhr.onreadystatechange = function(){
                if(this.readyState==4 && this.status==200){
                //yesko satto short:*/
                xhr.onload = function(){
                document.getElementById('facilities-data').innerHTML = this.responseText;
                }

                xhr.send('get_facilities');
            }

            function rem_facility(val)
            {
                //remove features data from database so sr_no should be passed to delete
                let xhr = new XMLHttpRequest();
                xhr.open("POST","ajax/features_facilities.php",true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                /*xhr.onreadystatechange = function(){
                if(this.readyState==4 && this.status==200){
                //yesko satto short:*/
                xhr.onload = function () {
                    var responseText = this.responseText.trim();  // Remove any leading/trailing whitespace

                    if (responseText == 1) {
                        alert('success', 'facility removed!');
                        get_facility(); //feature remove bayeC feri call garinca get_features
                    }
                    else if (responseText == 'room_added') {
                        alert('error', 'Feature is added in the room');
                    }
                    else {
                        alert('error', 'Facility removal failed!');
                    }
                };

                xhr.send('rem_facility='+val);
            }



            window.onload = function(){ //upload image after the page loads
            get_features();
            get_facility();
            }

            
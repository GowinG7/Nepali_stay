 
 <?php
   
  /* alert ,success, error jasto function haru yesma rakhxau
 kinaki aba sabbai tira kati lekhney so 
  */


    //user login xa ki nai banerw check grna session 
   //bina login nagarii user le aru file kholna thalxa baney teslai login panel ma rediect grna 
   function adminLogin(){
      session_start();
     if(!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true)){
         echo "<script>
        window.location.href= 'index.php';
        </script>
        ";
     exit; //jaba hmle kunai url ma redirect gryeu exit call bayerw tala ko scripts bnda hoss
     } 
    // session_regenerate_id(true); //delete old session so its prevent from session hijacking

     }


      //yo function ma hmle jaba url pass grxau tyo url ma yo function le redirect grxa(laiijanxa)
    function redirect($url){
     echo "<script>
        window.location.href='$url';
        </script>";
        exit;
        }

 function alert($type,$msg){
     // If the $type is "success", set $bs_class to "alert-success"
    // Otherwise, set it to "alert-danger" for error or failure messages
   $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
    echo <<<alert
    <div class="alert $bs_class alert-dismissible fade show custom-alert role="alert">
        <strong class="me-3">$msg</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    alert; //intend milna parxa div ko

 }


<?php

/* yo file ma important kura haru rakheka xau baney essential ma sana tino 
  Main file for CRUD operation 
      dynamic queries, data filters sabb wala code hunxa */



$hname = 'localhost';
$uname = 'root'; //root username ko pass blank hunxa
$pass = '';
$db = 'nepali_stay';

$con=mysqli_connect($hname, $uname, $pass, $db);#here mysqli_connect function is stored in con variable 

if(!$con){
    die("Cannot Connect to Database" . mysqli_connect_error()); # die stop the scripts execution and any error occurs can be seen in mysqli_connect_error() function  
}
#yedi database connection bayena error dekhauxa yesma hmle bass databsae connect garaaka xau

function filteration($data)
{
    foreach ($data as $key => $value) {
        $data[$key] = trim($value);
        $data[$key] = stripslashes($value);
        $data[$key] = htmlspecialchars($value);
        $data[$key] = strip_tags($data[$key]);
    }
    return $data; //aba filter bayerw josle yo function call grya xa tehi janxa
     }
    /*  trim() #to remove extra spaces
        stripcslashes()  #remove backward slashes
        htmlspecialchars() #convert special charaters into html entities
        strip_tags()  #remove html tags -->like if we write html tags in input file it doesn't work
    */
    // called function

     function selectAll($table)
     {
    $con = $GLOBALS['con'];
    $res = mysqli_query($con, "SELECT * FROM $table");
    return $res;
     }

    function select($sql,$values,$datatypes){
        $con = $GLOBALS['con'];// $con variable function ko baira xa so yesma used grna mildaina tesaile $GLOBALS use garerw con variable fetch grya xau
        if($stmt= mysqli_prepare($con,$sql))
        {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values); //... splat operator dynamically bind_param ma value pass grna used hunxa (yeha duita xa paxi yo bnda badi ni value huna sakxa so)
        if(mysqli_stmt_execute($stmt)){
        $res =  mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        return $res; //uta select function gareko ma return grya result(index.php ma xa)
        }
        else{
        mysqli_stmt_close($stmt);
        die("Query cannot be executed - Select"); //k ma problem aako: yeha Select function dhekhako xau matlab select wala query prepare vaxaina
        }
        } 
        else{
        die("Query cannot prepared -Select");
        }
        }

         //settings_crud ma used vaxa
        function update($sql,$values,$datatypes)
        {
        $con = $GLOBALS['con'];// $con variable function ko baira xa so yesma used grna mildaina tesaile $GLOBALS use garerw con variable fetch grya xau
        if($stmt= mysqli_prepare($con,$sql))
        {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values); //... splat operator dynamically bind_param ma value pass grna used hunxa (yeha duita xa paxi yo bnda badi ni value huna sakxa so)
        if(mysqli_stmt_execute($stmt)){
        $res =  mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $res; //uta update function gareko ma return grya result(index.php ma xa)
        }
        else{
        mysqli_stmt_close($stmt);
        die("Query cannot be executed - Update"); //k ma problem aako: yeha update function dhekhako xau matlab select wala query prepare vaxaina
        }
        } 
        else{
        die("Query cannot be prepared -Update");
        }
        }

        function insert($sql,$values,$datatypes)
        {
        $con = $GLOBALS['con'];// $con variable function ko baira xa so yesma used grna mildaina tesaile $GLOBALS use garerw con variable fetch grya xau
        if($stmt= mysqli_prepare($con,$sql))
        {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values); //... splat operator dynamically bind_param ma value pass grna used hunxa (yeha duita xa paxi yo bnda badi ni value huna sakxa so)
        if(mysqli_stmt_execute($stmt)){
        $res =  mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $res; //uta update function gareko ma return grya result(index.php ma xa)
        }
        else{
        mysqli_stmt_close($stmt);
        die("Query cannot be executed - Insert"); //k ma problem aako: yeha update function dhekhako xau matlab select wala query prepare vaxaina
        }
        } 
        else{
        die("Query cannot be prepared - Insert");
        }
        }

        function delete($sql,$values,$datatypes)
        {
        $con = $GLOBALS['con'];// $con variable function ko baira xa so yesma used grna mildaina tesaile $GLOBALS use garerw con variable fetch grya xau
        if($stmt= mysqli_prepare($con,$sql))
        {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values); //... splat operator dynamically bind_param ma value pass grna used hunxa (yeha duita xa paxi yo bnda badi ni value huna sakxa so)
        if(mysqli_stmt_execute($stmt)){
        $res =  mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $res; //uta update function gareko ma return grya result(index.php ma xa)
        }
        else{
        mysqli_stmt_close($stmt);
        die("Query cannot be executed - Delete"); //k ma problem aako: yeha update function dhekhako xau matlab select wala query prepare vaxaina
        }
        } 
        else{
        die("Query cannot be prepared - Delete");
        }
        }


?>


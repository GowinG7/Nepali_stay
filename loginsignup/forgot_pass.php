<?php
if(isset($_POST["btnsubmit"])){
    $id=$_POST["id"];
    $name=$_POST["name"];
    $address=$_POST["address"];
    $phone_no=$_POST["phone_no"];
    $con=mysqli_connect("localhost","root","","nepali_stay");
    $qry="update  set name='".$name."',address='".$address."',phone_no='".$phone_no."' where id='".$id."' " ;
    $result=mysqli_query($con,$qry);
    if($result)
    echo "Data updated succesfully ";
    else
    echo "Error updating data";
    mysqli_close($con);

}
?>


<html>
    <body>
        <form method="POST">

            <input type="submit" name="" value="">
        </form>
    </body>
</html>
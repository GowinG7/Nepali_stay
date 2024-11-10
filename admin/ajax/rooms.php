<?php

    require('../db_config.php');
    require('../essentials.php');
    adminlogin();

    if(isset($_POST['add_room']))
    {
    $features = filteration(json_decode($_POST['features']));
    $facilities = filteration(json_decode($_POST['facilities']));

    $frm_data = filteration($_POST);
    $flag = 0;

    $q1 = "INSERT INTO `rooms`(`name`, `area`, `price`, `quantity`, `description`) VALUES(?,?,?,?,?)";
    $values = [$frm_data['name'], $frm_data['area'], $frm_data['price'], $frm_data['quantity'], $frm_data['description']];

    if(insert($q1,$values,'siiis')){
        $flag = 1;  
    }

    $room_id = mysqli_insert_id($con);

    $q2 = "INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?,?)";
    
    if($stmt = mysqli_prepare($con,$q2))
    {
        foreach($facilities as $f){
            mysqli_stmt_bind_param($stmt, 'ii', $room_id, $f);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
    }
    else{
        $flag = 0;
        die('query cannot be prepared - insert');
    }
    
   }
 
?>

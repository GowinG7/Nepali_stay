<?php
session_start();


require('../db_config.php');
require('../essentials.php');

date_default_timezone_set("Asia/Kathmandu");

if(isset($_POST['check_availability']))
{
    $frm_data = filteration($_POST);
    $status = "";
    $result = "";

     // Check in and out validations
     $today_date = new DateTime(date("Y-m-d"));
     $checkin_date = new DateTime($frm_data['check_in']);
     $checkout_date = new DateTime($frm_data['check_out']);

 

    if($checkin_date == $checkout_date)
    {
        $status = 'check_in_out_equal';
        $result = json_encode(["status" => $status]);
    }
    else if($checkout_date < $checkin_date)
    {
        $status = 'check_out_earlier';
        $result = json_encode(["status" => $status]);
    }
    else if($checkin_date < $today_date)
    {
        $status = 'check_in_earlier';
        $result = json_encode(["status" => $status]);
    }
    //check booking availability if status is blank else return the error
    if($status != ''){
        echo $result;
    }
    else{
        if($_SESSION['room'])  //confirm booking ma 
        
        //run query to check room is available or not
        
        $count_days = date_diff($checkin_date, $checkout_date)->days;
        $payment = $_SESSION['room']['price'] * $count_days;

        $_SESSION['room']['payment'] = $payment;
        $_SESSION['room']['available'] = true;

        $result = json_encode(["status"=>'available',"days"=>$count_days,"payment"=> $payment]);
        echo $result;
    }

}

?>
<?php
session_start();

require('../db_config.php');
require('../essentials.php');

//date_default_timezone_set("Asia/Nepal"); rakhda today date ma jheu garyo khali earlier earlier
 date_default_timezone_set('Asia/Kathmandu');  // Set the time zone to Kathmandu for Nepal


if(isset($_POST['check_availability']))
{
    $frm_data = filteration($_POST);
    $status = "";
    $result = "";

    // Ensure check-in and check-out dates are provided
    if(!isset($frm_data['check_in']) || !isset($frm_data['check_out'])) {
        $status = 'dates_missing';
        $result = json_encode(["status" => $status]);
        echo $result;
        exit;
    }

    // Check in and out validations
    $today_date = date("Y-m-d");
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

    // Check booking availability if status is blank else return the error
    if($status != ''){
        echo $result;
    } else {
        if(!isset($_SESSION['room'])) { 
            $status = 'room_not_selected';
            $result = json_encode(["status" => $status]);
            echo $result;
            exit;
        }

        // Confirm booking and check room availability
        $count_days = date_diff($checkin_date, $checkout_date)->days;
        $payment = $_SESSION['room']['price'] * $count_days;

        $_SESSION['room']['payment'] = $payment;
        $_SESSION['room']['available'] = true;

        $result = json_encode(["status" => 'available', "days" => $count_days, "payment" => $payment]);
        echo $result;
    }
}
?>

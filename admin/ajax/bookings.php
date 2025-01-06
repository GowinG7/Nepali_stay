<?php

    require('../db_config.php');
    require('../essentials.php');
    adminlogin();

    if (isset($_POST['get_bookings'])) {
        $res = selectAll('booking');
        if ($res === false) {
            die("Error executing query: " . mysqli_error($GLOBALS['conn']));
        }
    
        if (mysqli_num_rows($res) === 0) {
            echo "No bookings found.";
            exit;
        }
        // Set default time zone (optional, if needed)
        date_default_timezone_set("Asia/Kathmandu");  // Set the time zone to Kathmandu for Nepal         
        // Formatting the date for display -- it is today date
        $date = date("Y-m-d");
        $data = ""; // Initial value null
        $i = 1;
    
        
    
        while ($row = mysqli_fetch_assoc($res)) {
            
            // Check if booking has expired based on check-out date
            $checkout_date = $row['checkout'];
                
             // Check if booking is verified and set the status
             $booking_status = 'Booking Not Confirmed';  // Default status

             if ($row['verified'] == 1) {
             $booking_status = 'Room Booked';  // If verified
             }
                 
             if ($checkout_date <= $date) {
             $booking_status = 'Booking Expired';  // If the check-out date is today or in the past
             }


            // Delete button for unverified booking only
            $del_btn = "<button type='button' onclick='remove_bookings($row[sr_no])' class='btn btn-danger shadow-none btn-sm'> 
                <i class='bi bi-trash'></i> Delete
                </button>";
    
            // Verification toggle button
            $verified = "<button onclick='toggle_verify($row[sr_no],1)' class='btn btn-warning btn-sm shadow-none'>
                <i class='bi bi-x-lg'></i> Not-Confirm
                </button>";
    
            if ($row['verified']) {
                $verified = "<button onclick='toggle_verify($row[sr_no],0)' class='btn btn-success btn-sm shadow-none'>
                    <i class='bi bi-check-lg'></i> Confirmed
                    </button>";
                $del_btn = ""; // Hide delete button for verified users
            } 
    
    
          //  $date = date("d-m-Y", strtotime($row['datentime']));
    
            // Add the row to the data string
            $data .= " 
              <tr>
                <td>$i</td>
                <td>$row[name]</td>
                <td>$row[phone]</td>
                <td>$row[email]</td>
                <td>$row[roomname]</td>
                <td>$row[room_id]</td>
                <td>$row[checkin]</td>
                <td>$row[checkout]</td>
                <td>$row[days] night</td>
                <td>Rs.$row[payment]</td>
                <td>$verified</td>
                <td>$date</td>
                <td>$booking_status</td> 
                <td>$del_btn</td>
              </tr>
            ";
            $i++;
        }
        echo $data;
    }
    

    //request yeha aauxa toggle status ko users.js file bata 
    if(isset($_POST['toggle_verify']))
    {
    $frm_data = filteration($_POST);

    $q = "UPDATE `booking` SET `verified`=? WHERE `sr_no`=? ";
    $v = [$frm_data['value'], $frm_data['toggle_verify']];

    if(update($q,$v,'ii')){
        echo 1;
    }
    else{
        echo 0;
    }
    }

    //users.js bata yeha request aauxa
    if(isset($_POST['remove_bookings']))
    {
    $frm_data = filteration($_POST); //sirf 1 , 2 matra lekherw aaye ni filter grya xau
    
    $res = delete("DELETE FROM  `booking`  WHERE `sr_no`=? AND `verified`=?", [$frm_data['booking_id'],0], 'ii');

    if($res){
        echo 1;
    }
    else{
        echo 0;
    }

    }

    if (isset($_POST['search_bookings'])) {

        $frm_data = filteration($_POST);
         // LIKE operator is used to search data basis on given pattern value 
        $query = "SELECT * FROM `booking` WHERE `name` LIKE ? ";

        $res = select($query,["%$frm_data[name]%"],'s');
        $i = 1;
    
        $data = ""; //initial value null
    
        while ($row = mysqli_fetch_assoc($res)) {
            //jun unverified xa teha delete options
            $del_btn = "<button type='button' onclick='remove_user($row[sr_no])' class='btn btn-danger shadow-none btn-sm'> 
                <i class='bi bi-trash'></i> Delete
                </button>";
    
            $verified = "<span class='badge bg-warning'> <i class='bi bi-x-lg'></i> </span>"; 
    
            if($row['verified']){
              $verified = "<span class='badge bg-success'> <i class='bi bi-check-lg'></i> </span>";
              $del_btn = ""; //delete button nadekhinet matlab blank
            }
          
    
            $date = date("d-m-Y", strtotime($row['datentime']));
    
            //users.php ma bayeko tbody ko bitra data leuna xa so tesma dheraie row haru banai fetch grna
            $data .= " 
              <tr>
                <td>$i</td>
                <td>$row[name]</td>
                <td>$row[phone]</td>
                <td>$row[email]</td>
                <td>$row[roomname]</td>
                <td>$row[checkin]</td>
                <td>$row[checkout]</td>
                <td>$row[days] night</td>
                <td>Rs.$row[payment]</td>
                <td>$verified</td>
                <td>$date</td>
                <td>$del_btn</td>
              <tr>
            ";
                $i++;
            }
            echo $data;
        }
?>

<?php

    require('../db_config.php');
    require('../essentials.php');
    adminlogin();

    if(isset($_POST['get_general'])) {
        $q = "SELECT * FROM `settings` WHERE `sr_no`=?";
        $values = [1]; // Ensure that the value corresponds to the record you want
        $res = select($q, $values, "i");
    
        if($res) { // Ensure that the query was successful
            $data = mysqli_fetch_assoc($res);
            if($data) { // Ensure that there is data returned
                $json_data = json_encode($data);
                echo $json_data;
            } else {
                echo json_encode(["error" => "No data found"]);
            }
        } else {
            echo json_encode(["error" => "Query failed"]);
        }
    }


    if(isset($_POST['upd_general']))
    {
    $frm_data = filteration($_POST);

    $q = "UPDATE `settings` SET `site_title`=?, `site_about`=?  WHERE sr_no=? ";
    $values = [$frm_data['site_title'], $frm_data['site_about'], 1];
    $res = update($q, $values, 'ssi');//ssi first second string third int
    echo $res;
    }

    if(isset($_POST['upd_shutdown']))
    {
    $frm_data = ($_POST['upd_shutdown']==0) ? 1 : 0;

    $q = "UPDATE `settings` SET `shutdown`=? WHERE sr_no=? ";
    $values = [$frm_data, 1];
    $res = update($q, $values, 'ii');//duitaie integer value janxa 1 rw 0
    echo $res;
    }

    if(isset($_POST['get_contacts'])) {
        $q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
        $values = [1]; // Ensure that the value corresponds to the record you want
        $res = select($q, $values, "i");
    
        if($res) { // Ensure that the query was successful
            $data = mysqli_fetch_assoc($res);
            if($data) { // Ensure that there is data returned
                $json_data = json_encode($data);
                echo $json_data;
            } else {
                echo json_encode(["error" => "No data found"]);
            }
        } else {
            echo json_encode(["error" => "Query failed"]);
        }
    }
    
?>

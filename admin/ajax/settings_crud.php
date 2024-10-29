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

    if(isset($_POST['upd_contacts']))
    {
    $frm_data = filteration($_POST);

    $q = "UPDATE `contact_details` SET `address`=?,`gmap`=?,`pn1`=?,`pn2`=?,`email`=?,`fb`=?,`insta`=?,`iframe`=? WHERE sr_no=?"; //if 'sr_no'=? -- Single quotes treat sr_no as string not column
    $values = [$frm_data['address'], $frm_data['gmap'],$frm_data['pn1'],$frm_data['pn2'],$frm_data['email'],$frm_data['fb'],$frm_data['insta'],$frm_data['iframe'], 1];
    $res = update($q, $values, 'ssssssssi');//last ko 1 int aru 8 ota string
    echo $res;
    }

    if (isset($_POST['add_member'])) {
    $frm_data = filteration($_POST);

    $img_r = uploadImage($_FILES['picture'], ABOUT_FOLDER);

    if ($img_r == 'inv_img') {
        echo $img_r;
    } else if ($img_r == 'inv_size') {
        echo $img_r;
    } else if ($img_r == 'inv_failed') {
        echo $img_r;
    } else {
        $q = "INSERT INTO `team_details`(`name`, `picture`) VALUES (?,?)";
        $values = [$frm_data['name'], $img_r];
        $res = insert($q, $values, 'ss');
        echo $res;
    }
    }

    if(isset($_POST['get_members']))
    {
     //here we have to select all the data so  we have create selectAll() in db_config.php 
    $res = selectAll('team_details');

    while($row = mysqli_fetch_assoc($res))
    {
        $path = ABOUT_IMG_PATH;
       echo <<<data
        <div class="col-md-2 mb-3">
        <div class="card bg-dark text-white">
        <img src="$path$row[picture]" class="card-img" >
            <div class="card-img-overlay text-end">
            <button type="button" onclick="rem_member($row[sr_no])" class="btn btn-danger btn-sm shadow-none">
            <i class="bi bi-trash"></i>Delete
            </button>
            </div>
            <p class="card-text text-center px-3 py-2">$row[name]</p> 
        </div>
        </div>       
       data;
    }
    }
    
    if(isset($_POST['rem_member']))
    {
    $frm_data = filteration($_POST); //sirf 1 , 2 matra lekherw aaye ni filter grya xau
    $values = [$frm_data['rem_member']]; 
    //data directly db bata delete grna sakdainau kinaki hmle image pani delete grna prney hunxa if image not delete - server ma load prxa  rw server ma space badhai janxa
    //so we fetched image data here
    $pre_q = "SELECT `sr_no`, `name`, `picture` FROM `team_details` WHERE `sr_no`=?";
    $res = select($pre_q, $values, 'i');
    $img = mysqli_fetch_assoc($res);

    if(deleteImage($img['picture'],ABOUT_FOLDER)){
        $q = "DELETE FROM `team_details` WHERE `sr_no`=? ";
        $res = delete($q,$values,'i');
        echo $res;
    }
    else{
        echo 0;
    }
    }

?>

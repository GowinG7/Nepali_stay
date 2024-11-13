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
 
    //for facilities checked gareko wala
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

    //for features checked gareko wala
    $q3 = "INSERT INTO `room_features`(`room_id`, `features_id`) VALUES (?,?)";
    
    if($stmt = mysqli_prepare($con,$q3))
    {
        foreach($features as $f){
            mysqli_stmt_bind_param($stmt, 'ii', $room_id, $f);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
    }
    else{
        $flag = 0;
        die('query cannot be prepared - insert');
    }

    if($flag){
        echo 1;
      }
        else{
            echo 0;
        }
    }

    if(isset($_POST['get_all_rooms']))
    {
    $res = select("SELECT * FROM `rooms` WHERE `removed`=?",[0],'i' );
    $i = 1;

    $data = ""; //initial value null

    while($row = mysqli_fetch_assoc($res))
    {
        if($row['status']==1)
        {
            //toggle button onclick grda teha admin panel bata active rw inactive ma clcik grda status change garauna grya ho yesko code rooms.php ma xa
            $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>active</buton> ";
        }
        else{
            $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-warning btn-sm shadow-none'>inactive</button>";
        }
        //rooms.php ko line 51ma bayeko tbody ko bitra data leuna xa so tesma dheraie row haru fetch banai fetch grna
        $data .= " 
            <tr class='align-middle'>
            <td>$i</td>
            <td>$row[name]</td>
            <td>$row[area] sq. ft.</td>
            <td>Rs.$row[price]</td>
            <td>$row[quantity]</td>
            <td>$status</td>
            <td>
                <button type='button' onclick='edit_details($row[id])' class='btn btn-primary shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-room'>
                  <i class='bi bi-plus-square'></i> 
                </button>

                 <button type='button' onclick=\"room_images($row[id],'$row[name]')\" class='btn btn-info shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#room-images'>
                  <i class='bi bi-images'></i> 
                </button>
                <button type='button' onclick='remove_room($row[id])' class='btn btn-danger shadow-none btn-sm'>
                  <i class='bi bi-trash'></i> 
                </button>
            </td>
            </tr>
        ";
        $i++;
    }
    echo $data;
    }

    if(isset($_POST['get_room']))
    {
        $frm_data = filteration($_POST);

        $res1 = select("SELECT * FROM `rooms` WHERE `id`=?", [$frm_data['get_room']], 'i');
        $res2 = select("SELECT * FROM `room_features` WHERE `room_id`=?", [$frm_data['get_room']], 'i');
        $res3 = select("SELECT * FROM `room_facilities` WHERE `room_id`=?", [$frm_data['get_room']], 'i');

        $roomdata = mysqli_fetch_assoc($res1);
        $features = [];
        $facilities = [];
        
        if(mysqli_num_rows($res2)>0){
         while($row = mysqli_fetch_assoc($res2)){
            array_push($features, $row['features_id']);
         }
        }

        if(mysqli_num_rows($res3)>0){
         while($row = mysqli_fetch_assoc($res3)){
            array_push($facilities, $row['facilities_id']);
            }
           }

        $data = [
            "roomdata" => $roomdata, 
            "features" => $features,
             "facilities" => $facilities
            ];

    $data = json_encode($data);

    echo $data;
    }
    
    if(isset($_POST['edit_room']))
    {
        $features = filteration(json_decode($_POST['features']));
        $facilities = filteration(json_decode($_POST['facilities']));

        $frm_data = filteration($_POST);
        $flag = 0;

        $q1 = "UPDATE `rooms` SET `name`=?, `area`=?, `price`=?, `quantity`=?, `description`=? WHERE `id`=?";
        $values = [$frm_data['name'], $frm_data['area'], $frm_data['price'], $frm_data['quantity'], $frm_data['description'],$frm_data['room_id']];

        if(update($q1,$values,'siiisi')){
          $flag = 1;
        }

    $del_features = delete("DELETE FROM `room_features` WHERE `room_id`=?", [$frm_data['room_id']], 'i');
    $del_facilities = delete("DELETE FROM `room_facilities` WHERE `room_id`=?", [$frm_data['room_id']], 'i');

    if(!($del_facilities && $del_features)){
        $flag = 0;
    }

    //for facilities checked gareko wala
    $q2 = "INSERT INTO `room_facilities` (`room_id`, `facilities_id`) VALUES (?,?)";
    
    if($stmt = mysqli_prepare($con,$q2))
    {
        foreach($facilities as $f){
            mysqli_stmt_bind_param($stmt, 'ii', $frm_data['room_id'], $f);
            mysqli_stmt_execute($stmt);
        }
        $flag = 1;
        mysqli_stmt_close($stmt);
    }
    else{
        $flag = 0;
        die('query cannot be prepared - insert');
    }

    //for features checked gareko wala
    $q3 = "INSERT INTO `room_features`(`room_id`, `features_id`) VALUES (?,?)";
    
    if($stmt = mysqli_prepare($con,$q3))
    {
        foreach($features as $f){
            mysqli_stmt_bind_param($stmt, 'ii', $frm_data['room_id'], $f);
            mysqli_stmt_execute($stmt);
        }
        $flag = 1;
        mysqli_stmt_close($stmt);
    }
    else{
        $flag = 0;
        die('query cannot be prepared - insert');
    }

    if($flag){
        echo 1;
      }
        else{
            echo 0;
        }

    }

    if(isset($_POST['toggle_status']))
    {
    $frm_data = filteration($_POST);

    $q = "UPDATE `rooms` SET `status`=? WHERE `id`=? ";
    $v = [$frm_data['value'], $frm_data['toggle_status']];

    if(update($q,$v,'ii')){
        echo 1;
    }
    else{
        echo 0;
    }
    }

    if (isset($_POST['add_image'])) {
        $frm_data = filteration($_POST);
    
        $img_r = uploadImage($_FILES['image'], ROOMS_FOLDER);
    
        if ($img_r == 'inv_img') {
            echo $img_r;
        } else if ($img_r == 'inv_size') {
            echo $img_r;
        } else if ($img_r == 'inv_failed') {
            echo $img_r;
        } else {
            $q = "INSERT INTO `room_images`(`room_id`, `image`) VALUES (?,?)";
            $values = [$frm_data['room_id'], $img_r];
            $res = insert($q, $values, 'is');
            echo $res;
        }
    }

    if (isset($_POST['get_room_images'])) {
        $frm_data = filteration($_POST);
        $res = select("SELECT * FROM `room_images` WHERE `room_id` =?",[$frm_data['get_room_images']],'i');

        $path = ROOMS_IMG_PATH;

        while($row = mysqli_fetch_assoc($res))
        {
          
          if ($row['thumb'] == 1) {
            $thumb_btn = "<i class='bi bi-check-lg text-light bg-success px-2 py-1 rounded fs-5'></i>";
           }
           else{
            $thumb_btn = " <button onclick='thumb_image($row[sr_no],$row[room_id])' class='btn btn-secondary shadow-none'>
               <i class='bi bi-check-lg'></i>
               </button>";
           }
                        
        echo <<<data
            <tr class='align-middle'>
              <td><img src='$path$row[image]' class='img-fluid'></td>
              <td>$thumb_btn</td>
              <td>
                <button onclick='rem_image($row[sr_no],$row[room_id])' class='btn btn-danger shadow-none'>
                 <i class='bi bi-trash'></i>
                 </button>
              </td>
            </tr>
        data;
        }    
    }

    if(isset($_POST['rem_image']))
    {
    $frm_data = filteration($_POST); //sirf 1 , 2 matra lekherw aaye ni filter grya xau
    $values = [$frm_data['image_id'],$frm_data['room_id']]; 
    //data directly db bata delete grna sakdainau kinaki hmle image pani delete grna prney hunxa if image not delete - server ma load prxa  rw server ma space badhai janxa
    //so we fetched image data here
    $pre_q = "SELECT * FROM `room_images` WHERE `sr_no` = ? AND `room_id`=? ";
    $res = select($pre_q, $values, 'ii');
    $img = mysqli_fetch_assoc($res);

    if(deleteImage($img['image'],ROOMS_FOLDER)){
        $q = "DELETE FROM `room_images` WHERE `sr_no`=? AND `room_id`=? ";
        $res = delete($q,$values,'ii');
        echo $res;
    }
    else{
        echo 0;
    }
    }

    if(isset($_POST['thumb_image']))
    {
    $frm_data = filteration($_POST); //sirf 1 , 2 matra lekherw aaye ni filter grya xau
    
    $pre_q = "UPDATE `room_images` SET `thumb`=? WHERE `room_id`=? ";
    $pre_v = [0, $frm_data['room_id']];
    $pre_res = update($pre_q, $pre_v, 'ii');


    $q = "UPDATE `room_images` SET `thumb`=? WHERE `sr_no`=? AND `room_id`=? ";
    $v = [1, $frm_data['image_id'] , $frm_data['room_id']];
    $res = update($q, $v, 'iii');

    echo $res;

    }

    if(isset($_POST['remove_room']))
    {
    $frm_data = filteration($_POST); //sirf 1 , 2 matra lekherw aaye ni filter grya xau
    
    $res1 = select("SELECT * FROM `room_images` WHERE `room_id`=?",[$frm_data['room_id']],'i'); 

    while($row = mysqli_fetch_assoc($res1)){
        deleteImage($row['image'], ROOMS_FOLDER);
    }

    $res2 = delete("DELETE FROM `room_images` WHERE `room_id`=? ", [$frm_data['room_id']], 'i');
    $res3 = delete("DELETE FROM `room_features` WHERE `room_id`=? ", [$frm_data['room_id']], 'i');
    $res4 = delete("DELETE FROM `room_facilities` WHERE `room_id`=? ", [$frm_data['room_id']], 'i');
    $res5 = update("UPDATE  `rooms` SET `removed`=? WHERE `id`=? ", [1,$frm_data['room_id']], 'ii');


    if($res2 || $res3 || $res4 || $res5){
        echo 1;
    }
    else{
        echo 0;
    }

    }

    
 
?>

<?php

    require('../db_config.php');
    require('../essentials.php');
    adminlogin();



    if (isset($_POST['add_feature'])) {
    $frm_data = filteration($_POST);

    $q = "INSERT INTO `features`( `name`) VALUES (?)";
    $values = [$frm_data['name']];
    $res = insert($q, $values, 's');
    echo $res;
    }

    if(isset($_POST['get_features']))
    //get_features naam ko index features_facilities.php file bata yeha aauxa
    {
     //here we have to select all the data so  we have create selectAll() in db_config.php 
    $res = selectAll('features');
    $i = 1;

    while($row = mysqli_fetch_assoc($res))
    {
       echo <<<data
        <tr>
            <td>$i</td>
            <td>$row[name]</td>
            <td>
                <button type="button" onclick="rem_feature($row[id])" class="btn btn-danger btn-sm shadow-none">
                 <i class="bi bi-trash"></i>Delete
                </button>
            </td>
        </tr>     
       data;
        $i++;
    }
    }
    
    if(isset($_POST['rem_feature']))
    {
        $frm_data = filteration($_POST); //sirf 1 , 2 matra lekherw aaye ni filter grya xau
        $values = [$frm_data['rem_feature']]; 

        $q = "DELETE FROM `features` WHERE `id`=? ";
        $res = delete($q,$values,'i');
        echo $res;
    }


    if (isset($_POST['add_facility'])) {
        $frm_data = filteration($_POST);
    
        $img_r = uploadSVGImage($_FILES['icon'], FACILITES_FOLDER);
    
        if ($img_r == 'inv_img') {
            echo $img_r;
        } else if ($img_r == 'inv_size') {
            echo $img_r;
        } else if ($img_r == 'inv_failed') {
            echo $img_r;
        } else {
            $q = "INSERT INTO `facilities`(`icon`,`name`, `desc`) VALUES (?,?,?)";
            $values = [$img_r,$frm_data['name'], $frm_data['desc']];
            $res = insert($q, $values, 'sss');
            echo $res;
        }
        }
    //table ko name facilities xa so cause db ko table bata fetch grnu xa so
    if(isset($_POST['get_facilities']))
    //get_features naam ko index features_facilities.php file bata yeha aauxa
        {
            //here we have to select all the data so  we have create selectAll() in db_config.php 
        $res = selectAll('facilities'); //tbody ma id facilities diyerw xodya xau so tei
        $i = 1;
        //image lai kun chaie path bata leauna xa
        $path = FACILITIES_IMG_PATH;

            while($row = mysqli_fetch_assoc($res))
            {
                echo <<<data
                <tr class = "align-middle" >
                    <td>$i</td>
                    <td> <img src="$path$row[icon]" width="100px"> </td>
                    <td>$row[name]</td>
                    <td>$row[desc]</td>
                    <td>
                        <button type="button" onclick="rem_facility($row[id])" class="btn btn-danger btn-sm shadow-none">
                            <i class="bi bi-trash"></i>Delete
                        </button>
                    </td>
                </tr>     
                data;
                $i++;
            }
        }

    if(isset($_POST['rem_facility']))
    {
        $frm_data = filteration($_POST); //sirf 1 , 2 matra lekherw aaye ni filter grya xau
        $values = [$frm_data['rem_facility']]; 

        //data directly db bata delete grna sakdainau kinaki hmle image pani delete grna prney hunxa if image not delete - server ma load prxa  rw server ma space badhai janxa
        //so we fetched image data here
        $pre_q = "SELECT * FROM `facilities` WHERE `id`=?";
        $res = select($pre_q, $values, 'i');
        $img = mysqli_fetch_assoc($res);

        if(deleteImage($img['icon'],FACILITES_FOLDER)){
            $q = "DELETE FROM `facilities` WHERE `id`=? ";
            $res = delete($q,$values,'i');
            echo $res;
        }
        else{
            echo 0;
        }
    }
?>

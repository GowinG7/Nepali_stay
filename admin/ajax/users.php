<?php

    require('../db_config.php');
    require('../essentials.php');
    adminlogin();

    if (isset($_POST['get_users'])) {
        $res = selectAll('user_creden');
        $i = 1;
    
        $data = ""; // Initial value null
    
        while ($row = mysqli_fetch_assoc($res)) {
            // Delete button for unverified users only
            $del_btn = "<button type='button' onclick='remove_user($row[id])' class='btn btn-danger shadow-none btn-sm'> 
                <i class='bi bi-trash'></i> Delete
                </button>";
    
            // Verification toggle button
            $verified = "<button onclick='toggle_verify($row[id],1)' class='btn btn-warning btn-sm shadow-none'>
                <i class='bi bi-x-lg'></i> Unverified
                </button>";
    
            if ($row['is_verified']) {
                $verified = "<button onclick='toggle_verify($row[id],0)' class='btn btn-success btn-sm shadow-none'>
                    <i class='bi bi-check-lg'></i> Verified
                    </button>";
                $del_btn = ""; // Hide delete button for verified users
            }
    
            // Status toggle button
            $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>
                active
                </button>";
    
            if (!$row['status']) { // If status is not active
                $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-danger btn-sm shadow-none'>
                    inactive
                    </button>";
            }
    
            $date = date("d-m-Y", strtotime($row['datentime']));
    
            // Add the row to the data string
            $data .= " 
              <tr>
                <td>$i</td>
                <td>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[username]</td>
                <td>$row[phone]</td>
                <td>$verified</td>
                <td>$status</td>
                <td>$date</td>
                <td>$del_btn</td>
              </tr>
            ";
            $i++;
        }
        echo $data;
    }
    
  //request yeha aauxa toggle status ko users.js file bata 
    if(isset($_POST['toggle_status']))
    {
    $frm_data = filteration($_POST);

    $q = "UPDATE `user_creden` SET `status`=? WHERE `id`=? ";
    $v = [$frm_data['value'], $frm_data['toggle_status']];

    if(update($q,$v,'ii')){
        echo 1;
    }
    else{
        echo 0;
    }
    }

    //request yeha aauxa toggle status ko users.js file bata 
    if(isset($_POST['toggle_verify']))
    {
    $frm_data = filteration($_POST);

    $q = "UPDATE `user_creden` SET `is_verified`=? WHERE `id`=? ";
    $v = [$frm_data['value'], $frm_data['toggle_verify']];

    if(update($q,$v,'ii')){
        echo 1;
    }
    else{
        echo 0;
    }
    }

    //users.js bata yeha request aauxa
    if(isset($_POST['remove_user']))
    {
    $frm_data = filteration($_POST); //sirf 1 , 2 matra lekherw aaye ni filter grya xau
    
    $res = delete("DELETE FROM  `user_creden`  WHERE `id`=? AND `is_verified`=?", [$frm_data['user_id'],0], 'ii');

    if($res){
        echo 1;
    }
    else{
        echo 0;
    }

    }

    if (isset($_POST['search_user'])) {

        $frm_data = filteration($_POST);
         // LIKE operator is used to search data basis on given pattern value 
        $query = "SELECT * FROM `user_creden` WHERE `name` LIKE ? ";

        $res = select($query,["%$frm_data[name]%"],'s');
        $i = 1;
    
        $data = ""; //initial value null
    
        while ($row = mysqli_fetch_assoc($res)) {
            //jun unverified xa teha delete options
            $del_btn = "<button type='button' onclick='remove_user($row[id])' class='btn btn-danger shadow-none btn-sm'> 
                <i class='bi bi-trash'></i> Delete
                </button>";
    
            $verified = "<span class='badge bg-warning'> <i class='bi bi-x-lg'></i> </span>"; 
    
            if($row['is_verified']){
              $verified = "<span class='badge bg-success'> <i class='bi bi-check-lg'></i> </span>";
              $del_btn = ""; //delete button nadekhinet matlab blank
            }
            $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>
                active
                </button>";
    
            if(!$row['status']){  //is status not equal to 1
                $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-danger btn-sm shadow-none'>
                 inactive
                 </button>"; 
            }
    
            $date = date("d-m-Y", strtotime($row['datentime']));
    
            //users.php ma bayeko tbody ko bitra data leuna xa so tesma dheraie row haru banai fetch grna
            $data .= " 
              <tr>
                <td>$i</td>
                <td>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[username]</td>
                <td>$row[phone]</td>
                <td>$verified</td>
                <td>$status</td>
                <td>$date</td>
                <td>$del_btn</td>
              <tr>
            ";
                $i++;
            }
            echo $data;
        }
?>

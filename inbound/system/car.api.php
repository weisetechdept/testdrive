<?php
    session_start();
    require_once '../../db-conn.php';
    if($_SESSION['testdrive_admin'] !== true){
        header('Location: /404');
    }

    date_default_timezone_set("Asia/Bangkok");

    if($_GET['b'] == 'ho'){
        
        $db->where('car_branch','ho');

    } else if($_GET['b'] == 'tm'){

        $db->where('car_branch','tm');

    }

    if($_GET['s'] == '1'){

        $db->where('car_status',1);

    } else if($_GET['s'] == '10') {

        $db->where('car_status',10);

    }

    $quota = $db->get('car');

    foreach($quota as $q) {

        //$db->join('car_update u','c.car_id = u.up_id','LEFT');
        $db->join('booking b','b.bk_id = c.up_parent','LEFT');
        $mileage = $db->where('bk_car',$q['car_id'])->orderBy('up_id','DESC')->getOne('car_update c');
        

        if($q['car_branch'] == 'ho'){
            $branch = 'สำนักงานใหญ่';
        } elseif($q['car_branch'] == 'tm'){
            $branch = 'ตลาดไท';
        }
        
        $api['data'][] = array(
            $q['car_id'],
            $q['car_model'],
            $q['car_img'],
            $q['car_branch'],
            $q['car_status'],
            date('Y-m-d', strtotime($q['car_datetime'])),
            number_format($mileage['up_mileage']),
            $q['car_vin']
        );
    }



   echo json_encode($api);

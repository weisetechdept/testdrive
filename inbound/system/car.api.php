<?php
    session_start();
    require_once '../../db-conn.php';
    if($_SESSION['testdrive_admin'] !== true){
        header('Location: /404');
    }
    date_default_timezone_set("Asia/Bangkok");

    $quota = $db->get('car');

    foreach($quota as $q) {

        $mileage = $db->where('up_parent',$q['car_id'])->orderBy('up_id','DESC')->getOne('car_update');

        if($q['car_branch'] == 'ho'){
            $branch = 'สำนักงานใหญ่';
        } elseif($q['car_branch'] == 'tm'){
            $branch = 'ตลาดไท';
        }
        
        $api['data'][] = array(
            $q['car_id'],
            $q['car_model'],
            $q['car_img'],
            $branch,
            $q['car_status'],
            date('Y-m-d', strtotime($q['car_datetime'])),
            $mileage['up_mileage']
        );
    }

    echo json_encode($api);
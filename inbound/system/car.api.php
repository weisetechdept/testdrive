<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    

    $quota = $db->get('car');

    foreach($quota as $q) {

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
            date('Y-m-d', strtotime($q['car_datetime']))
        );
    }

    echo json_encode($api);
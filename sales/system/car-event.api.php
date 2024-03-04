<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $car = $db->where('car_status',1)->get('car');

    foreach($car as $c){
        
        $api['car'][] = array(
            'id' => $c['car_id'],
            'model' => $c['car_model'],
            'branch' => strtoupper($c['car_branch'])
        );
    }

    echo json_encode($api);
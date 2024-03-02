<?php
    session_start();
    require_once '../../db-conn.php';
    if($_SESSION['testdrive_admin'] !== true){
        header('Location: /404');
    }
    date_default_timezone_set("Asia/Bangkok");
    
    $db->join("booking b", "b.bk_car = c.car_id", "RIGHT");
    $data = $db->get('car c');

    $ho = 0;
    $tm = 0;
    $success = 0;
    $cancel = 0;

    foreach($data as $count){

        if($count['car_branch'] == 'ho'){
            $ho += 1;
        } elseif($count['car_branch'] == 'tm'){
            $tm += 1;
        }

        if($count['bk_status'] == '2'){
            $success += 1;
        }

        if($count['bk_status'] == '10'){
            $cancel += 1;
        }
        
    }

    $api = array('all' => $ho+$tm,'ho' => $ho, 'tm' => $tm,'success' => $success,'cancel' => $cancel);

    $car = $db->where('car_status',1)->get('car');
    foreach($car as $c){
        $api['car'][] = array(
            'id' => $c['car_id'],
            'name' => '('.strtoupper($c['car_branch']).') '.$c['car_model'],
        );
    }

    echo json_encode($api);
    
<?php
    session_start();
    require_once '../../db-conn.php';

    if($_SESSION['testdrive_admin'] !== true){
        header('Location: /404');
    }

    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents("php://input"));
    $id = $request->id;
    $mileage = $request->mileage;
    $up_id = $request->up_id;
    $car_id = $request->car_id;

    $chk = $db->where('bk_id',$id)->getOne('booking');

    if($chk['bk_status'] == '1') {
/*
        $db->join('booking b','b.bk_id = u.up_parent','INNER');
        $mile_chk = $db->where('bk_car',$car_id)->orderBy('up_id','desc')->getOne('car_update u');

        if($mile_chk['up_mileage'] > $mileage){

            $api = array('status' => '501');

        } else {
*/
            $data = Array (
                'bk_status' => '2'
            );
            $db->where ('bk_id', $id);
            if ($db->update ('booking', $data)){

                    $upMile = Array (
                        'up_mileage' => $mileage
                    );
                    $db->where ('up_id', $up_id);
                    if ($db->update ('car_update', $upMile)){
                        $api = array('status' => '200');
                    } else {
                        $api = array('status' => '500');
                    }
                
            } else {
                $api = array('status' => '500');
            }
/*
        }
*/  
    } else {
        $api = array('status' => '500');
    }

    echo json_encode($api);

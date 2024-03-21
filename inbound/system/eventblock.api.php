<?php

    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if($_SESSION['testdrive_admin'] !== true){
        header('Location: /404');
    }

    if($_GET['get'] == 'list'){

        $evbl = $db->get("event");

        foreach ($evbl as $value) {
            $car = $db->where('car_id',$value['even_car'])->getOne('car');
            $api['data'][] = array(
                $value['even_id'],
                $value['even_firstname'].' '.$value['even_lastname'],
                $value['even_detail'],
                $car['car_model'],
                $value['even_fromdate'],
                $value['even_todate'],
                $value['even_status'],
                $value['even_datetime']
            );
        }

    }

    if($_GET['get'] == 'update'){

        $id = $_GET['id'];

        $chk = $db->where('even_id',$id)->getOne('event');
        if($chk['even_status'] == '1'){
            $change = '10';
        } else {
            $change = '1';
        }

        $data = array(
            'even_status' => $change
        );
        $id = $db->where('even_id',$id)->update('event',$data);
        if($id){
            $api['status'] = 'success';
            $api['message'] = 'แก้ไขสถานะสำเร็จ';
        } else {
            $api['status'] = 'error';
            $api['message'] = 'แก้ไขสถานะไม่สำเร็จ';
        }
            

    }

    

    echo json_encode($api);

    

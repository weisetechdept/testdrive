<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents("php://input"));
    $id = $request->id;

    $chk = $db->where('bk_id',$id)->getOne('booking');

    $dt = new DateTime($chk['bk_date']);
    $dt->modify('-2 days');

    if($chk['bk_status'] == '0' && date('Y-m-d') < $dt->format('Y-m-d')) {

        $data = Array (
            'bk_status' => '10'
        );
        $db->where ('bk_id', $id);
        if ($db->update ('booking', $data)){
            $api = array('status' => '200');
        } else {
            $api = array('status' => '500');
        }
        
    } else {
        $api = array('status' => '500');
        echo json_encode($api);
        exit();
    }

    echo json_encode($api);

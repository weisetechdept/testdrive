<?php
    session_start();
    require_once '../../db-conn.php';
    if($_SESSION['testdrive_admin'] !== true){
        header('Location: /404');
    }
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents("php://input"));
    $id = $request->id;

    $chk = $db->where('bk_id',$id)->getOne('booking');

    /*
    $docs = $db->where('up_parent', $id)->where('up_status',1)->getValue('car_update','count(*)');
    if($chk['bk_status'] == '1' && $docs > 0) { */

    if($chk['bk_status'] == '1') {

        $data = Array (
            'bk_status' => '2'
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

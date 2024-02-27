<?php
     session_start();
     require_once '../../db-conn.php';
     date_default_timezone_set("Asia/Bangkok");
    
    $request = json_decode(file_get_contents('php://input'));
    $id = $request->id;

    $chk = $db->where('img_parent', $id)->get('document');
    foreach($chk as $chk){
        if($chk['img_type'] == '1'){
            $docs1 += 1;
        } elseif($chk['img_type'] == '2'){
            $docs2 += 1;
        } elseif($chk['img_type'] == '3'){
            $docs3 += 1;
        } 
    }

    if($docs1 == 0 || $docs2 == 0 || $docs3 == 0){
        $api = array('status' => '400');
    } else {
        $data = Array (
            'bk_status' => '1'
        );
        $db->where ('bk_id', $id);
        if ($db->update ('booking', $data)){
            $api = array('status' => '200');
        } else {
            $api = array('status' => '500');
        }
    }

    echo json_encode($api);
    
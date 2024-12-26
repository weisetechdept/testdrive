<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents('php://input'));
    $id = $request->id;

    if(empty($id)){
        echo json_encode(['status' => 'error', 'message' => 'ID is required']);
        exit;
    } else {
        $data = array(
            'bk_status' => 0
        );
        $reset = $db->where('bk_id', $id)->update('booking', $data);
        if($reset){
            echo json_encode(['status' => 200, 'message' => 'Status reset successfully']);
        } else {
            echo json_encode(['status' => 500, 'message' => $db->getLastError()]);
        }
    }

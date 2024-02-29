<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $requset = json_decode(file_get_contents("php://input"));

    $data = $requset->memb_id;

 
    foreach($data as $d) {
        $chk = $db->where('qt_user_id',$d)->getValue('man_quota','count(*)');
        if($chk == 0) {
            $send = array(
                'qt_user_id' => $d,
                'qt_status' => 1,
                'qt_datetime' => date('Y-m-d H:i:s')
            );
            $db->insert('man_quota',$send);
            if($db->count > 0) {
                $count = 1;
            } 
        }
    }

    if($count == 1) {
        $api = array('status' => 'success', 'message' => 'เพิ่มโควต้าสำเร็จ');
    } else {
        $api = array('status' => 'error', 'message' => 'อาจมีบางรายการ เกิดข้อผิดพลาดบางอย่าง โปรดตรวจสอบอีกครั้ง');
    }

    echo json_encode($api);
    
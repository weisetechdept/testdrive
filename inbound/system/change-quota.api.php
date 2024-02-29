<?php 
        session_start();
        require_once '../../db-conn.php';
        if($_SESSION['testdrive_admin'] !== true){
                header('Location: /404');
            }
        date_default_timezone_set("Asia/Bangkok");

        $request = $request = json_decode(file_get_contents("php://input"));
        $id = $request->id;

        $chk = $db->where('qt_id',$id)->getOne('man_quota');

        if($chk['qt_status'] == 1) {
                $status = 10;
        } elseif(($chk['qt_status'] == 10)) {
                $status = 1;
        }
        if(!empty($id)) {
                $data = array(
                        'qt_status' => $status
                );
                $db->where('qt_id', $id);
                $id = $db->update('man_quota', $data);

                if($id) {
                $api = array(
                        'status' => 'success',
                        'message' => 'Change status success'
                );
                } else {
                $api = array(
                        'status' => 'error',
                        'message' => 'Change status error'
                );
                }
        }
        echo json_encode($api);
        
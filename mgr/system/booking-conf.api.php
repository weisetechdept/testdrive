<?php
    session_start();
    require_once '../../db-conn.php';

    $requset = json_decode(file_get_contents("php://input"));
    $id = $requset->id;

    // Check if stat_parent is unique
    $query = $db->where('stat_parent', $id)->getOne('status_log');
    if ($query) {
        $api = array(
            'status' => 400,
            'message' => 'stat_parent already exists'
        );
    } else {
        $data = array(
            'stat_key' => 'TEST_IS_BK',
            'stat_value' => 'BK',
            'stat_parent' => $id,
            'stat_status' => '1',
            'stat_datetime' => date('Y-m-d H:i:s')
        );

        $conf_bk = $db->insert('status_log', $data);
        $api = array(
            'status' => 500,
            'message' => 'Booking Configuration Failed'
        );
        if ($conf_bk) {
            $api = array(
                'status' => 200,
                'message' => 'Booking Configuration Created Successfully'
            );
        }
    }

    echo json_encode($api);
    
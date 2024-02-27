<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $quota = $db->get('man_quota');

    foreach($quota as $q) {
        $api['data'][] = array(
            $q['qt_id'],
            $q['qt_user_id'],
            $q['qt_status'],
            $q['qt_datetime']
        );
    }

    echo json_encode($api);
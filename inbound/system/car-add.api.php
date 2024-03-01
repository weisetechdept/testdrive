<?php
    session_start();
    require_once '../../db-conn.php';
    if($_SESSION['testdrive_admin'] !== true){
        header('Location: /404');
    }
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents("php://input"));

    if(empty($request->model) || $request->branch == '0') {
        $api = array('status' => '500');
        exit;
    }

    $data = array(
        'car_model' => $request->model,
        'car_img' => '',
        'car_branch' => $request->branch,
        'car_status' => '10',
        'car_sort' => '99',
        'car_datetime' => date('Y-m-d H:i:s'),
    );

    $id = $db->insert('car', $data);
    if($id) {
        $api = array('status' => '200');
    } else {
        $api = array('status' => '500');
    }

    echo json_encode($api);
<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents("php://input"));
    
    $id = $request->id;
    $branch = $request->branch;
    $model = $request->model;

    $data = Array (
        'car_model' => $model,
        'car_branch' => $branch
    );

    $db->where ('car_id', $id);
    if ($db->update ('car', $data)){
        $api = array('status' => '200');
    } else {
        $api = array('status' => '500');
    }
        
  

    echo json_encode($api);

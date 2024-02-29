<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $data = json_decode(file_get_contents("php://input"));

    if(isset($data->aimg_link)){

        $img_link = $data->aimg_link;
        $agrnt_id = $data->aimg_parent;

        $data = Array (
            "car_img" => $img_link
        );
        $db->where ('car_id', $agrnt_id);
        if ($db->update ('car', $data)){
            $api = array('status' => '200');
        } else {
            $api = array('status' => '400');
        }
        
    }
 
    echo json_encode($api);


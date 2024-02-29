<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if($_SESSION['pp_login'] !== true && $_SESSION['pp_permission'] !== 'user'){
        header('Location: /404');
    }

    $data = json_decode(file_get_contents("php://input"));


    $agrnt_id = $data->aimg_parent;
    $mileage = $data->aimg_mileage;
    $chk = $db->where('up_parent',$agrnt_id)->where('up_status',1)->get('car_update');

    if(isset($data->aimg_img_id) && count($chk) == 0){

        $img_id = $data->aimg_img_id;
        $img_link = $data->aimg_link;

        $data = Array (
            "up_img_code" => $img_id,
            "up_img_path" => $img_link,
            "up_mileage" => $mileage,
            "up_parent" => $agrnt_id,
            "up_status" => "1",
            "up_datetime" => date("Y-m-d H:i:s")
        );
        
        $id = $db->insert ('car_update', $data);
        if ($id){
           $api = array('status' => '200');
        } else {
            $api = array('status' => '500');
        }
        
    } else {
        $api = array('status' => '500');
    }

    echo json_encode($api);
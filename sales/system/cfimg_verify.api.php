<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if($_SESSION['pp_login'] !== true && $_SESSION['pp_permission'] !== 'user'){
        header('Location: /404');
    }

    $data = json_decode(file_get_contents("php://input"));

    if(isset($data->aimg_img_id)){

        $img_type = $data->aimg_type;
        $img_id = $data->aimg_img_id;
        $img_link = $data->aimg_link;
        $agrnt_id = $data->aimg_parent;

        $data = Array (
            "img_type" => $img_type,
            "img_cf_code" => $img_id,
            "img_cf_path" => $img_link,
            "img_parent" => $agrnt_id,
            "img_status" => "1",
            "img_datetime" => date("Y-m-d H:i:s")
        );
        
        $id = $db->insert ('document', $data);
        if ($id){
           $api = array('status' => '200');
        } else {

            $api = array('status' => '500');
        }
        
    }

    echo json_encode($api);
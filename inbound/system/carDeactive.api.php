<?php 
    session_start();
    require_once '../../db-conn.php';
    if($_SESSION['testdrive_admin'] !== true){
        header('Location: /404');
    }
    date_default_timezone_set("Asia/Bangkok");

    if($_GET['st'] == 'deactive'){

        $data = array(
            'car_status' => 10
        );
    
        $id = $db->where('car_id',$_GET['id'])->update('car',$data);
        if($id){
            $api = array(
                'status' => 200,
                'message' => 'success'
            );
        } else {
            $api = array(
                'status' => 500,
                'message' => 'error'
            );
        }

    }

    if($_GET['st'] == 'active'){

        $chk = $db->where('car_id',$_GET['id'])->getOne('car');
        if(!empty($chk['car_img'])){

            $data = array(
                'car_status' => 1
            );
            $id = $db->where('car_id',$_GET['id'])->update('car',$data);
            if($id){
                $api = array(
                    'status' => 200,
                    'message' => 'success'
                );
            } else {
                $api = array(
                    'status' => 500,
                    'message' => 'error'
                );
            }
            
        } else {
            $api = array(
                'status' => 400,
                'message' => 'error'
            );
        }

        

    }

    echo json_encode($api);
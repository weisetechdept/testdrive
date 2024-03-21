<?php
    session_start();
    require_once '../../db-conn.php';
    
    if($_SESSION['testdrive_admin'] !== true){
        header('Location: /404');
    }
    date_default_timezone_set("Asia/Bangkok");
    

    $requset = json_decode(file_get_contents("php://input"));

    $car = $requset->car;
    $fname = $requset->fname;
    $lname = $requset->lname;
    $detail = $requset->detail;
    $fromdate = $requset->fromdate;
    $todate = $requset->todate;

    $data = array(
        'even_firstname' => $fname,
        'even_lastname' => $lname,
        'even_detail' => $detail,
        'even_car' => $car,
        'even_fromdate' => $fromdate,
        'even_todate' => $todate,
        'even_status' => 1,
        'even_datetime' => date('Y-m-d H:i:s')
    );
   
    $id = $db->insert('event',$data);
    if($db->count > 0) {
        $api = array('status' => 'success', 'message' => 'เพิ่มข้อมูลสำเร็จ');
    } else {
        $api = array('status' => 'error', 'message' => 'เพิ่มข้อมูลไม่สำเร็จ');
    }

    echo json_encode($api);
    
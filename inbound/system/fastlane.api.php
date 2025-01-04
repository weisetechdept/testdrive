<?php

    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents('php://input'));


    $branch = isset($request->branch) ? $request->branch : '';
    $car = isset($request->car) ? $request->car : '';
    $date = isset($request->date) ? $request->date : '';
    $time = isset($request->time) ? $request->time : '';
    $fname = isset($request->fname) ? $request->fname : '';
    $lname = isset($request->lname) ? $request->lname : '';
    $note = isset($request->note) ? $request->note : '';
    $sales = isset($request->sales) ? $request->sales : '';
    $tel = isset($request->tel) ? $request->tel : '';
    $type = isset($request->type) ? $request->type : '';

    if($type == 'quick'){
        $where = '3';
    } else {
        $where = '4';
    }

    $data = array(
        'bk_fname' => $fname,
        'bk_lname' => $lname,
        'bk_tel' => $tel,
        'bk_email' => '',
        'bk_car' => $car,
        'bk_date' => $date,
        'bk_time' => $time,
        'bk_parent' => $sales,
        'bk_where' => $where,
        'bk_note' => $note,
        'bk_status' => '0',
        'bk_datetime' => date('Y-m-d H:i:s')
    );

    $insert = $db->insert('booking', $data);
    if($insert){
        $response = array(
            'status' => 'success',
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'id' => $insert
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'บันทึกข้อมูลไม่สำเร็จ'
        );
    }

    echo json_encode($response);

    
<?php

    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    //$id = '271';
    $request = json_decode(file_get_contents('php://input'));

    $fname = $request->fname;
    $lname = $request->lname;
    $car = $request->car;
    $date = $request->date;
    $time = $request->time;
    $tel = $request->tel;
    $condition = $request->condition;
    $email = $request->email;

    if(!empty($email)) {
        $email = $request->email;
    }

        if( empty($car) || empty($date) || $time == '0' || empty($fname) || empty($lname) || empty($tel) || $condition == false) {
            $api['status'] = 'failed';
            $api['message'] = 'โปรดกรอกข้อมูลให้ครบถ้วน';
            exit();
        } else {

            $rand = $db->where('qt_status',1)->get('man_quota');
            foreach($rand as $rs) {
                $man_rand[] = $rs['qt_user_id'];
            }
            $rand_rs = array_rand($man_rand,1);

            $data = array(
                'bk_fname' => $fname,
                'bk_lname' => $lname,
                'bk_tel' => $tel,
                'bk_email' => $email,
                'bk_car' => $car,
                'bk_date' => $date,
                'bk_time' => $time,
                'bk_parent' => $man_rand[$rand_rs],
                'bk_where' => '1',
                'bk_status' => 0,
                'bk_datetime' => date('Y-m-d H:i:s')
            );
            $id = $db->insert('booking',$data);
            if($id){
                $api['status'] = 'success';
                $api['id'] = $id;
            } else {
                $api['status'] = 'failed';
                $api['message'] = 'ไม่สามารถจองได้ในขณะนี้ กรุณาลองใหม่อีกครั้ง';
            }
        }

    echo json_encode($api);

    

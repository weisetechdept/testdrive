<?php

    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents('php://input'));

    $fname = $request->fname;
    $lname = $request->lname;
    $car = $request->car;
    $date = $request->date;
    $time = $request->time;
    $tel = $request->tel;
    $condition = $request->condition;
    $email = $request->email;
    $note = $request->note;

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

            $parent = $man_rand[$rand_rs];

            $time_ar = json_encode(array($time));

            $data = array(
                'bk_fname' => $fname,
                'bk_lname' => $lname,
                'bk_nlsID' => '',
                'bk_tel' => $tel,
                'bk_email' => $email,
                'bk_car' => $car,
                'bk_date' => $date,
                'bk_time' => $time_ar,
                'bk_parent' => $parent,
                'bk_where' => '1',
                'bk_note' => $note,
                'bk_status' => 0,
                'bk_datetime' => date('Y-m-d H:i:s')
            );
            $id = $db->insert('booking',$data);
            if($id){
                $api['status'] = 'success';
                $api['id'] = $id;

                $uid = $db_nms->where('id',$parent)->getOne('db_member');
                $access_token = 'GtacKYhQw2Y7U9Wzc8GeNUW32big3VZs4oeUU7U8wEtlPUDq1kLKQYBpD1HbwP/nFetgiLI0GA8pxPG7fAxvOYO001rJ6WXN4uNp7d+pxM43hKKZ1klmScK6z8jr3XJZno1X1AGGwwQWUP9lBjUuEAdB04t89/1O/w1cDnyilFU=';
                $userId = $uid['line_usrid'];

                $messages = array(
                    'type' => 'text',
                    'text' => '[Online] คุณได้ลูกค้าทดลองขับรถใหม่ "คุณ'.$fname.' '.$lname.'" โปรดติดต่อยืนยันการนัดหมายโดยเร็วที่สุด'
                );
                $post = json_encode(array(
                    'to' => array($userId),
                    'messages' => array($messages),
                ));


                $url = 'https://api.line.me/v2/bot/message/multicast';
                $headers = array('Content-Type: application/json', 'Authorization: Bearer '.$access_token);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://api.line.me/v2/bot/message/multicast");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_FAILONERROR, true);

                $result = curl_exec($ch);

            } else {
                $api['status'] = 'failed';
                $api['message'] = 'ไม่สามารถจองได้ในขณะนี้ กรุณาลองใหม่อีกครั้ง';
                $api['error'] = $db->getLastError();
            }
        }

    echo json_encode($api);

    

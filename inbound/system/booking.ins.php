<?php

    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents('php://input'));
    $type = $request->type;
    $walk = $request->sales;
    $note = $request->note;

    if($type == 'walkin'){
        $id_sales = $walk;
        $where = '4';
    } else {
        $id_sales = 'TBR';
        $where = '3';
    }

    $quota = $db->where("bk_parent",$id_sales)->where('bk_where',2)->where("bk_status",array(0,1),'BETWEEN')->getValue("booking","count(*)");

        $chk_uniq = $db->where('bk_date',$request->date)->where('bk_time',$request->time)->where('bk_car',$request->car)->where('bk_status',array('0','1','2'),'IN')->getValue('booking','count(*)');
        if($chk_uniq){
            $api['status'] = 'failed';
            $api['message'] = 'ไม่สามารถจองรถในเวลาดังกล่าวได้ เนื่องจากมีการจองรถไว้แล้วในเวลาดังกล่าว';
            echo json_encode($api);
            exit();
    
        } elseif(empty($request->car) || empty($request->date) || empty($request->time) || empty($request->fname) || empty($request->lname) || empty($request->tel)) {
            $api['status'] = 'failed';
            $api['message'] = 'โปรดกรอกข้อมูลให้ครบถ้วน';
            echo json_encode($api);
            exit();
        } else {
            $data = array(
                'bk_fname' => $request->fname,
                'bk_lname' => $request->lname,
                'bk_tel' => $request->tel,
                'bk_email' => '',
                'bk_car' => $request->car,
                'bk_date' => $request->date,
                'bk_time' => $request->time,
                'bk_parent' => $id_sales,
                'bk_where' => $where,
                'bk_note' => $note,
                'bk_status' => 0,
                'bk_datetime' => date('Y-m-d H:i:s')
            );
            
            $id = $db->insert('booking',$data);
            if($id){
                $api['status'] = 'success';
                $api['id'] = $id_sales;

                if($where == '4'){
                    $uid = $db_nms->where('id',$id_sales)->getOne('db_member');
                    $access_token = 'GtacKYhQw2Y7U9Wzc8GeNUW32big3VZs4oeUU7U8wEtlPUDq1kLKQYBpD1HbwP/nFetgiLI0GA8pxPG7fAxvOYO001rJ6WXN4uNp7d+pxM43hKKZ1klmScK6z8jr3XJZno1X1AGGwwQWUP9lBjUuEAdB04t89/1O/w1cDnyilFU=';
                    $userId = $uid['line_usrid'];

                    $messages = array(
                        'type' => 'text',
                        'text' => '[Walk-in] คุณได้ลูกค้าทดลองขับรถใหม่ "คุณ'.$fname.' '.$lname.'" โปรดติดต่อยืนยันการนัดหมายโดยเร็วที่สุด'
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
                } 
            } else {
                $api['status'] = 'failed';
                $api['message'] = 'ไม่สามารถจองได้ในขณะนี้ กรุณาลองใหม่อีกครั้ง';
            }
        }

    echo json_encode($api);

    

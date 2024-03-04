<?php

    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $id = 'TBR';

    $request = json_decode(file_get_contents('php://input'));

    $quota = $db->where("bk_parent",$id)->where('bk_where',2)->where("bk_status",array(0,1),'BETWEEN')->getValue("booking","count(*)");

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
                'bk_parent' => $id,
                'bk_where' => '3',
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

    

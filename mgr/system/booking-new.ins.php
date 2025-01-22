<?php

    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if($_SESSION['pp_login'] !== true && $_SESSION['pp_permission'] !== 'leader'){
        header('Location: /404'); 
    }

    $id = $_SESSION['sales_user'];
    function areConsecutive($arr, $n) 
    { 
        if ( $n < 1 ) 
            return false; 
        $min = getMin($arr, $n); 
        $max = getMax($arr, $n);  
        if ($max - $min + 1 == $n) 
        { 
            $visited = array(); 
            for ($i = 0; $i < $n; $i++) 
            { 
                $visited[$i] = false; 
            } 
            for ($i = 0; $i < $n; $i++) 
            { 
                if ( $visited[$arr[$i] - $min] != false ) 
                return false; 
                $visited[$arr[$i] - $min] = true; 
            } 
            return true; 
        } 
        
        return false;
    } 
    
    function getMin($arr, $n) 
    { 
        $min = $arr[0]; 
        for ($i = 1; $i < $n; $i++) 
            if ($arr[$i] < $min) 
                $min = $arr[$i]; 
        return $min; 
    } 
    
    function getMax($arr, $n) 
    { 
        $max = $arr[0]; 
        for ($i = 1; $i < $n; $i++) 
            if ($arr[$i] > $max) 
                $max = $arr[$i]; 
        return $max; 
    } 

    $request = json_decode(file_get_contents('php://input'));
    $time = $request->time;
    $n = count($time);

    if($n < 1){
        $api = array('status' => 'failed','message' => 'กรุณาเลือกเวลาที่ต้องการจอง');
    } else {

        if(areConsecutive($time, $n) == true) {

            $quota = $db->where("bk_parent",$id)->where('bk_where',2)->where("bk_status",array(0,1),'BETWEEN')->getValue("booking","count(*)");
            if($quota < 3){

                $chk_uniq = $db->where('bk_car',$request->car)->where('bk_date',$request->date)->where('bk_status',array('0','1','2'),'IN')->get('booking');

                $chk = json_decode($chk_uniq['bk_time']);
                foreach ($chk as $value) {
                    array_search($value, $time) !== false ? $api['chk_time'] = 'failed' : '';
                }

                if($api['chk_time'] == 'failed'){
                    $api['status'] = 'failed';
                    $api['message'] = 'เวลาที่เลือกมีการจองแล้ว กรุณาเลือกเวลาใหม่อีกครั้ง';
                    exit();
                } else {

                    if (empty($request->car) || empty($request->date) || empty($request->fname) || empty($request->time) || empty($request->lname) || empty($request->tel)) {
                    
                        $api['status'] = 'failed';
                        $api['message'] = 'โปรดกรอกข้อมูลให้ครบถ้วน';
    
                    } else {

                        $rep1 = str_replace(' ','',$request->tel);
                        $tel_fn = str_replace('-','',$rep1);

                        sort($time);
                        
                        $data = array(
                            'bk_fname' => $request->fname,
                            'bk_lname' => $request->lname,
                            'bk_nlsID' => null,
                            'bk_tel' => $tel_fn,
                            'bk_email' => '',
                            'bk_car' => $request->car,
                            'bk_date' => $request->date,
                            'bk_time' => json_encode($time),
                            'bk_parent' => $id,
                            'bk_where' => '2',
                            'bk_note' => '',
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

                }
                

            } else {

                $api['status'] = 'failed';
                $api['message'] = 'สิทธิ์การจองคงเหลือไม่เพียงพอ';

            }

        } else {

            $api = array('status' => 'failed','message' => 'เวลาที่เลือกไม่ต่อเนื่องกัน กรุณาเลือกเวลาใหม่อีกครั้ง');

        }

    }

    echo json_encode($api);



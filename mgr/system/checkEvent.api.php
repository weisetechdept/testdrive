<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $date = $_GET['date'];
    $car = $_GET['car'];

    function customTime($time){
        if($time == '1'){
            return '08:00 - 08:45';
        }elseif($time == '2'){
            return '09:00 - 09:45';
        }elseif($time == '3'){
            return '10:00 - 10:45';
        }elseif($time == '4'){
            return '11:00 - 11:45';
        }elseif($time == '5'){
            return '12:00 - 12:45';
        }elseif($time == '6'){
            return '13:00 - 13:45';
        }elseif($time == '7'){
            return '14:00 - 14:45';
        }elseif($time == '8'){
            return '15:00 - 15:45';
        }elseif($time == '9'){
            return '16:00 - 16:45';
        }
    }

    $chk = $db->where('bk_car',$car)->where('bk_date', $date)->get('booking');

    $bked = array();
    foreach ($chk as $value) {
        $bked[] = $value['bk_time'];
    }

    for($i=1;$i<=9;$i++){

        if(in_array($i,$bked)){
            $api['data'][] = array(
                'date' => $date,
                'time' => customTime($i),
                'status' => 'ไม่ว่าง'
            );
        }else{
            $api['data'][] = array(
                'date' => $date,
                'time' => customTime($i),
                'status' => 'ว่าง'
            );
        }
    }

    echo json_encode($api);

    
            
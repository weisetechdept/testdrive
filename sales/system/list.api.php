<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if($_SESSION['pp_login'] !== true && $_SESSION['pp_permission'] !== 'user'){
        header('Location: /404');
    }

    $id = $_SESSION['sales_user'];

    $db->join('car c','c.car_id = b.bk_car','RIGHT');
    $bk = $db->where('bk_parent',$id)->get('booking b');

    
        
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
    

    foreach ($bk as $value) {

        $api['data'][] = array(
            $value['bk_id'],
            $value['bk_fname'],
            $value['car_model'],
            $value['bk_date'],
            customTime($value['bk_time']),
            $value['bk_status'],
            $value['bk_where'],
        );
    }

    echo json_encode($api);
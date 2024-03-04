<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
/*
    if($_SESSION['pp_login'] !== true){
        header('Location: /404');
    }
*/

    $form_date = $_GET['formdate'];
    $to_date = $_GET['todate'];

    if($form_date == '' || $to_date == ''){

        $api['data'] = null;

    } else {
         
        $db->join('car c','c.car_id = b.bk_car','LEFT');
        $bk = $db->where('bk_date',$form_date,'>=')->where('bk_date',$to_date,'<=')->get('booking b');
            
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

            $sales = $db_nms->where('id',$value['bk_parent'])->getOne('db_member');

            $api['data'][] = array(
                $value['bk_id'],
                $value['bk_fname'].' '.$value['bk_lname'],
                $value['bk_tel'],
                $value['car_model'],
                $value['bk_date'],
                customTime($value['bk_time']),
                $sales['first_name'].' ('.$sales['nickname'].')',
                $value['bk_status'],
                $value['bk_datetime'],
                $value['bk_where']
            );
        }
    }

    echo json_encode($api);
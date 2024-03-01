<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if($_SESSION['pp_login'] !== true && $_SESSION['pp_permission'] !== 'user'){
        header('Location: /404');
    }

    $id = $_GET['id'];

    $db->join('car c','c.car_id = b.bk_car','LEFT');
    $bk = $db->where('bk_id',$id)->get('booking b');
        
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

    $chk1 = $db->where('img_parent',$id)->where('img_type',1)->getValue('document','count(*)');
    $chk2 = $db->where('img_parent',$id)->where('img_type',2)->getValue('document','count(*)');
    $chk3 = $db->where('img_parent',$id)->where('img_type',3)->getValue('document','count(*)');

    $api['docs'] = array(
        'docs1' => $chk1,
        'docs2' => $chk2,
        'docs3' => $chk3
    );


    foreach ($bk as $value) {

        $api['detail'] = array(
            'id' => $value['bk_id'],
            'name' => $value['bk_fname'].' '.$value['bk_lname'],
            'tel' => $value['bk_tel'],
            'car' => $value['car_model'],
            'bk_date' => $value['bk_date'],
            'bk_time' => customTime($value['bk_time']),
            'docs_status' => $status,
            'where' => $value['bk_where'],
            'status' => $value['bk_status'],
            'create' => $value['bk_datetime']
        );
    }

    echo json_encode($api);
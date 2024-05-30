<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
/*
    if($_SESSION['pp_login'] !== true){
        header('Location: /404');
    }
*/
    $id = $_GET['id'];

    $db->join('car c','c.car_id = b.bk_car','LEFT');
    $bk = $db->where('bk_id',$id)->getOne('booking b');
        
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

    function customTime2($time){

        $alltime = json_decode($time);

        $first = reset($alltime);
        $last = end($alltime);
        
        if($first == '1'){
            $first = '08:00';
        } elseif($first == '2'){
            $first = '09:00';
        } elseif($first == '3'){
            $first = '10:00';
        } elseif($first == '4'){
            $first = '11:00';
        } elseif($first == '5'){
            $first = '12:00';
        } elseif($first == '6'){
            $first = '13:00';
        } elseif($first == '7'){
            $first = '14:00';
        } elseif($first == '8'){
            $first = '15:00';
        } elseif($first == '9'){
            $first = '16:00';
        }

        if($last == '1'){
            $last = '08:45';
        } elseif($last == '2'){
            $last = '09:45';
        } elseif($last == '3'){
            $last = '10:45';
        } elseif($last == '4'){
            $last = '11:45';
        } elseif($last == '5'){
            $last = '12:45';
        } elseif($last == '6'){
            $last = '13:45';
        } elseif($last == '7'){
            $last = '14:45';
        } elseif($last == '8'){
            $last = '15:45';
        } elseif($last == '9'){
            $last = '16:45';
        }

        return $first.' - '.$last;

    } 

    $chk1 = $db->where('img_parent',$id)->where('img_type',1)->getValue('document','count(*)');
    $chk2 = $db->where('img_parent',$id)->where('img_type',2)->getValue('document','count(*)');
    $chk3 = $db->where('img_parent',$id)->where('img_type',3)->getValue('document','count(*)');

    $api['docs'] = array(
        'docs1' => $chk1,
        'docs2' => $chk2,
        'docs3' => $chk3
    );

    $db->join('booking b','b.bk_id = u.up_parent','INNER');
    $mile_chk = $db->where('bk_car',$bk['bk_car'])->orderBy('up_id','desc')->getOne('car_update u');


    

        $api['detail'] = array(
            'id' => $bk['bk_id'],
            'name' => $bk['bk_fname'].' '.$bk['bk_lname'],
            'tel' => $bk['bk_tel'],
            'car' => $bk['car_model'],
            'bk_date' => $bk['bk_date'],
            'bk_time' => customTime2($bk['bk_time']),
            'docs_status' => $status,
            'where' => $bk['bk_where'],
            'status' => $bk['bk_status'],
            'create' => $bk['bk_datetime'],
            'bk_note' => $bk['bk_note'],
            'mile_chk' => $mile_chk['up_mileage']
        );
    

    echo json_encode($api);
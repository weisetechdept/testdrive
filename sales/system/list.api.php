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

    foreach ($bk as $value) {

        $api['data'][] = array(
            $value['bk_id'],
            $value['bk_fname'],
            substr($value['car_model'],0,10),
            $value['bk_date'],
            customTime2($value['bk_time']),
            $value['bk_status'],
            $value['bk_where'],
        );
    }

    echo json_encode($api);
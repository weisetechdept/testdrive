<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if($_SESSION['pp_login'] !== true){
        header('Location: /404');
    }

    $id = $_GET['id'];

    $db->join('car c','c.car_id = b.bk_car','LEFT');
    $bk = $db->where('bk_id',$id)->getOne('booking b');
    if (!$bk) {
        echo json_encode(['error' => 'Booking not found']);
        exit;
    }
        
    function customTime($time){
        if($time == '1'){
            return '08:00 - 08:30';
        }elseif($time == '2'){
            return '08:31 - 09:00';
        }elseif($time == '3'){
            return '09:01 - 09:30';
        }elseif($time == '4'){
            return '09:31 - 10:00';
        }elseif($time == '5'){
            return '10:01 - 10:30';
        }elseif($time == '6'){
            return '10:31 - 11:00';
        }elseif($time == '7'){
            return '11:01 - 11:30';
        }elseif($time == '8'){
            return '11:31 - 12:00';
        }elseif($time == '9'){
            return '12:01 - 12:30';
        }elseif($time == '10'){
            return '12:31 - 13:00';
        }elseif($time == '11'){
            return '13:01 - 13:30';
        }elseif($time == '12'){
            return '13:31 - 14:00';
        }elseif($time == '13'){
            return '14:01 - 14:30';
        }elseif($time == '14'){
            return '14:31 - 15:00';
        }elseif($time == '15'){
            return '15:01 - 15:30';
        }elseif($time == '16'){
            return '15:31 - 16:00';
        }elseif($time == '17'){
            return '16:01 - 16:30';
        }elseif($time == '18'){
            return '16:31 - 17:00';
        }elseif($time == '19'){
            return '17:01 - 17:30';
        }elseif($time == '20'){
            return '17:31 - 18:00';
        }

    }

    function customTime2($time){

        $alltime = json_decode($time);

        $first = reset($alltime);
        $last = end($alltime);
        
        if($first == '1'){
            $first = '08:00';
        } elseif($first == '2'){
            $first = '08:31';
        } elseif($first == '3'){
            $first = '09:01';
        } elseif($first == '4'){
            $first = '09:31';
        } elseif($first == '5'){
            $first = '10:01';
        } elseif($first == '6'){
            $first = '10:31';
        } elseif($first == '7'){
            $first = '11:01';
        } elseif($first == '8'){
            $first = '11:31';
        } elseif($first == '9'){
            $first = '12:01';
        } elseif($first == '10'){
            $first = '12:31';
        } elseif($first == '11'){
            $first = '13:01';
        } elseif($first == '12'){
            $first = '13:31';
        } elseif($first == '13'){
            $first = '14:01';
        } elseif($first == '14'){
            $first = '14:31';
        } elseif($first == '15'){
            $first = '15:01';
        } elseif($first == '16'){
            $first = '15:31';
        } elseif($first == '17'){
            $first = '16:01';
        } elseif($first == '18'){
            $first = '16:31';
        } elseif($first == '19'){
            $first = '17:01';
        } elseif($first == '20'){
            $first = '17:31';
        }

        if($last == '1'){
            $last = '08:30';
        } elseif($last == '2'){
            $last = '09:00';
        } elseif($last == '3'){
            $last = '09:30';
        } elseif($last == '4'){
            $last = '10:00';
        } elseif($last == '5'){
            $last = '10:30';
        } elseif($last == '6'){
            $last = '11:00';
        } elseif($last == '7'){
            $last = '11:30';
        } elseif($last == '8'){
            $last = '12:00';
        } elseif($last == '9'){
            $last = '12:30';
        } elseif($last == '10'){
            $last = '13:00';
        } elseif($last == '11'){
            $last = '13:30';
        } elseif($last == '12'){
            $last = '14:00';
        } elseif($last == '13'){
            $last = '14:30';
        } elseif($last == '14'){
            $last = '15:00';
        } elseif($last == '15'){
            $last = '15:30';
        } elseif($last == '16'){
            $last = '16:00';
        } elseif($last == '17'){
            $last = '16:30';
        } elseif($last == '18'){
            $last = '17:00';
        } elseif($last == '19'){
            $last = '17:30';
        } elseif($last == '20'){
            $last = '18:00';
        }

        return $first.' - '.$last;

    }

    $chk1 = $db->where('img_parent',$id)->where('img_type',1)->getValue('document','count(*)');
    $chk2 = $db->where('img_parent',$id)->where('img_type',2)->getValue('document','count(*)');
    $chk3 = $db->where('img_parent',$id)->where('img_type',3)->getValue('document','count(*)');

    $status = ($chk1 > 0 || $chk2 > 0 || $chk3 > 0) ? 'complete' : 'incomplete';

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
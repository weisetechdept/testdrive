<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    function getTeam($uid){
        global $db_nms;
        $team = $db_nms->get('db_user_group');
        foreach($team as $t){
            $tm = array_merge(json_decode($t['detail']),json_decode($t['leader']));
            //$team_data = json_decode($t['detail']);
            if(in_array($uid,$tm)){
                return $t['name'];
            }
        }
    }

    function getSales($uid){
        global $db_nms;
        $member = $db_nms->where('id',$uid)->getOne('db_member');
        return $member['first_name'].' '.$member['last_name'];
    }

    function getCar($uid){
        global $db;
        $car = $db->where('car_id',$uid)->getOne('car');
        return $car['car_model'];
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
            $first = '14:01';
        } elseif($first == '18'){
            $first = '14:31';
        } elseif($first == '19'){
            $first = '15:01';
        } elseif($first == '20'){
            $first = '15:31';
        } elseif($first == '21'){
            $first = '16:01';
        } elseif($first == '22'){
            $first = '16:31';
        } elseif($first == '23'){
            $first = '17:01';
        } elseif($first == '24'){
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
        }  elseif($last == '10'){
            $last = '13:00';
        } elseif($last == '11'){
            $last = '13:30';
        } elseif($last == '12'){
            $last = '14:00';
        } elseif($last == '13'){
            $last = '14:30';
        } elseif($last == '14'){
            $last = '15:30';
        }  elseif($last == '15'){
            $last = '15:00';
        } elseif($last == '16'){
            $last = '16:30';
        }  elseif($last == '17'){
            $last = '16:00';
        } elseif($last == '18'){
            $last = '17:30';
        } elseif($last == '19'){
            $last = '17:00';
        } elseif($last == '20'){
            $last = '18:30';
        } elseif($last == '21'){
            $last = '18:00';
        } elseif($last == '22'){
            $last = '19:30';
        } elseif($last == '23'){
            $last = '19:00';
        } elseif($last == '24'){
            $last = '20:30';
        } 

        return $first.' - '.$last;

    } 

    function getStatus($id){
        global $db;
        $status = $db->where('stat_parent',$id)->getOne('status_log');

        if($status){
            return 'จอง';
        } else {
            return 'ไม่จอง';
        }
    }

    $request = json_decode(file_get_contents('php://input'));
    $date = $request->date;
    $group = $request->group;
    $rtype = $request->report_type;
    $dtype = $request->data_type;

    $form_date = date('Y-m-01', strtotime($date));
    $to_date = date('Y-m-t', strtotime($date));

    if($dtype == 'in'){
        $where = array('2');
    } elseif($dtype == 'inBK'){
        $where = array('2');
    } elseif($dtype == 'out'){
        $where = array('7');
    } elseif($dtype == 'boot') {
        $where = array('6');
    } elseif($dtype == 'total') {
        $where = array('2','7');
    }

    $team = $db_nms->where('name',$group)->getOne('db_user_group');
    $member = json_decode($team['detail']);

    $db->join('status_log s','s.stat_parent = b.bk_parent','LEFT');
    $booking = $db->where("bk_datetime", $form_date,">=")->where("bk_datetime", $to_date,"<=")
                ->where('bk_where',$where,"IN") 
                ->where('bk_parent',$member,"IN")
                ->get('booking b');

    $rs = array();
    $rs = $booking;
    
    // foreach($rs as $key => $value){

    //     $booking[$key]['bk_datetime'] = date('d/m/Y H:i:s', strtotime($value['bk_datetime']));
    //     $booking[$key]['bk_status'] =  getStatus($value['bk_id']);
    //     $booking[$key]['bk_team'] = getTeam($value['bk_parent']);
    //     $booking[$key]['bk_sales'] = getSales($value['bk_parent']);
    //     $booking[$key]['bk_time'] = customTime2($value['bk_time']);
    //     $booking[$key]['bk_car'] = getCar($value['bk_car']);

    // }

    $book = array();

    foreach($rs as $key => $value){

        if($dtype == 'inBK' || $dtype == 'outBK' || $dtype == 'totalBK'){

            if(getStatus($value['bk_id']) == 'จอง'){
                $book[$key]['bk_datetime'] = date('d/m/Y H:i:s', strtotime($value['bk_datetime']));
                $book[$key]['bk_status'] =  getStatus($value['bk_id']);
                $book[$key]['bk_team'] = getTeam($value['bk_parent']);
                $book[$key]['bk_sales'] = getSales($value['bk_parent']);
                $book[$key]['bk_time'] = customTime2($value['bk_time']);
                $book[$key]['bk_car'] = getCar($value['bk_car']);
                $book[$key]['bk_fname'] = $value['bk_fname'];
                $book[$key]['bk_lname'] = $value['bk_lname'];
                $book[$key]['bk_id'] = $value['bk_id'];
                $book[$key]['bk_date'] = date('d/m/Y', strtotime($value['bk_date']));
            }

        } else {

            $book[$key]['bk_datetime'] = date('d/m/Y H:i:s', strtotime($value['bk_datetime']));
            $book[$key]['bk_status'] =  getStatus($value['bk_id']);
            $book[$key]['bk_team'] = getTeam($value['bk_parent']);
            $book[$key]['bk_sales'] = getSales($value['bk_parent']);
            $book[$key]['bk_time'] = customTime2($value['bk_time']);
            $book[$key]['bk_car'] = getCar($value['bk_car']);
            $book[$key]['bk_fname'] = $value['bk_fname'];
            $book[$key]['bk_lname'] = $value['bk_lname'];
            $book[$key]['bk_id'] = $value['bk_id'];
            $book[$key]['bk_date'] = date('d/m/Y', strtotime($value['bk_date']));

        }

        
    }

    $book['countData'] = count($book);

    echo json_encode($book);
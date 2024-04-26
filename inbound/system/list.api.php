<?php 
    session_start();
    require_once '../../db-conn.php';
    if($_SESSION['testdrive_admin'] !== true){
        header('Location: /404');
    }
    date_default_timezone_set("Asia/Bangkok");

    if($_GET['b'] == 'ho'){
        $branch = 'ho';
    } elseif($_GET['b'] == 'tm') {
        $branch = 'tm';
    }

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

    $db->join('car c','c.car_id = b.bk_car','LEFT');
    $bk = $db->where('car_branch',$branch)->get('booking b');

    
        
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

        if($value['bk_parent'] == 'TBR'){
            $owner = 'TBR Fastlane';
        } else {
            $parent = $db_nms->where('id',$value['bk_parent'])->getOne('db_member');
            $nickn = ' ('.$parent['nickname'].')';
            $owner = $parent['first_name'].''.$nickn.' - '.getTeam($parent['id']);
        }

        $api['data'][] = array(
            $value['bk_id'],
            $value['bk_fname'].' '.$value['bk_lname'],
            $value['bk_tel'],
            $value['car_model'],
            $value['bk_date'],
            customTime($value['bk_time']),
            $owner,
            $value['bk_status'],
            $value['bk_datetime'],
            $value['bk_where']
        );
    }

    echo json_encode($api);
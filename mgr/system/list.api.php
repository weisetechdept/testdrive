<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if($_SESSION['pp_login'] !== true && $_SESSION['pp_permission'] !== 'leader'){
        header('Location: /404');
    }

    $id = $_SESSION['sales_user'];

   //$id = 271;

    function mgr($data){
        global $db_nms;
        $group = $db_nms->get('db_user_group');
        foreach($group as $value){
            $chk = in_array($data, json_decode($value['leader']));
            if($chk){
                foreach(json_decode($value['detail']) as $emp){
                    $team[] = $emp;
                }
            }
        }
        return array_unique($team);
    }

    if($_GET['get'] == 'list'){

        $db->join('car c','c.car_id = b.bk_car','LEFT');
        $bk = $db->where('bk_parent', mgr($id),'IN')->get('booking b');

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
                $value['bk_fname'],
                $value['car_model'],
                $value['bk_date'],
                customTime($value['bk_time']),
                $value['bk_status'],
                $value['bk_where'],
                $sales['first_name'].' '.$sales['last_name']
            );
        }


    }

    if($_GET['get'] == 'count'){

        $countAll = $db->where('bk_parent', mgr($id),'IN')->getValue("booking","count(*)");
        $api['count'] = array(
            'all' => $countAll
        );

    }

    echo json_encode($api);

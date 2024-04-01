<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
/*
    if($_SESSION['pp_login'] !== true){
        header('Location: /404');
    }
*/
    function getTeam($uid){
        global $db_nms;
        $team = $db_nms->get('db_user_group');
        foreach($team as $t){
            $team_data = json_decode($t['detail']);
            if(in_array($uid,$team_data)){
                return $t['name'];
            } 
        }
    } 
    

    if($_GET['ac'] == 'search'){

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

        $form_date = $_GET['formdate'];
        $to_date = $_GET['todate'];
        $model = $_GET['model'];
        $status = $_GET['status'];
        $where = $_GET['where'];

        if($form_date == '' || $to_date == ''){
    
               $api['data'] = []; // Set an empty array if there is no data

        } else {

            $car_data = array();
            $car = $db->get('car');
            foreach ($car as $value) {
                array_push($car_data, $value['car_id']);
            }

            if($model !== 'all'){
                $where_model = array($model);
            } else {
                $where_model = $car_data;
            }

            if($status !== 'all'){
                $where_status = array($status);
            } else {
                $where_status = array(0,1,2,3,4);
            }

            if($where !== 'all'){
                $where_where = array($where);
            } else {
                $where_where = array('1','2','3','4');
            }

            $db->join('car c','c.car_id = b.bk_car','LEFT');
            $bk = $db->where('bk_date',$form_date,'>=')->where('bk_date',$to_date,'<=')->where('bk_status',$where_status,'IN')->where('bk_car',$where_model,'IN')->where('bk_where',$where_where,'IN')->get('booking b');

            if($bk == null){
                $api['data'] = []; // Set an empty array if there is no data
            } else {

                foreach ($bk as $value) {

                    $sales = $db_nms->where('id',$value['bk_parent'])->getOne('db_member');

                    if($value['bk_parent'] == 'TBR'){
                        $parent = 'TBR Fastlane';
                    } else {
                        $parent = $sales['first_name'].' ('.$sales['nickname'].')';
                    }

                    $api['data'][] = array(
                        $value['bk_id'],
                        $value['bk_fname'].' '.$value['bk_lname'],
                        $value['bk_tel'],
                        $value['car_model'],
                        $value['bk_date'],
                        customTime($value['bk_time']),
                        $parent,
                        getTeam($value['bk_parent']),
                        $value['bk_where'],
                        $value['bk_status']
                    );
                }
            }
        }

    }

    if($_GET['ac'] == 'car'){

        $car = $db->get('car');
        foreach ($car as $value) {
            $api['car'][] = array(
                'id' => $value['car_id'],
                'model' => ' ('.strtoupper($value['car_branch']).') '.$value['car_model']
            );
        }

    }

    echo json_encode($api);
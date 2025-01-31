<?php 
    session_start();
    $api = array();
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
        $team = array();
        foreach($group as $value){
            $leaders = json_decode($value['leader'], true);
            $chk = is_array($leaders) && in_array($data, $leaders);
            if($chk){
                foreach(json_decode($value['detail']) as $emp){
                    $team[] = $emp;
                }
            }
        }
        return array_unique($team);
    }

    if($_GET['get'] == 'list'){ 

        $date_form = date('Y-m-01', strtotime($_GET['date']));
        $date_to = date('Y-m-t', strtotime($_GET['date']));

        $sale = mgr($id);

        $db->join('car c','c.car_id = b.bk_car','LEFT');
        $bk = $db->where('bk_parent', $sale, "IN")->where('bk_status',2)->where('bk_date',$date_form,">=")->where('bk_date',$date_to,"<=")->get('booking b');

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

        if(!$bk){
            $api['data'] = array();
        } else {
            foreach ($bk as $value) {

                $sales = $db_nms->where('id',$value['bk_parent'])->getOne('db_member');

                
    
                $api['data'][] = array(
                    $value['bk_id'],
                    $value['bk_fname'],
                    $value['car_model'],
                    $value['bk_date'],
                    customTime2($value['bk_time']),
                    $value['bk_status'],
                    $value['bk_where'],
                    $sales['first_name'].' '.$sales['last_name']
                );
            }
        }

        


    }


    if($_GET['get'] == 'count'){

        $date_form = date('Y-m-01', strtotime($_GET['date']));
        $date_to = date('Y-m-t', strtotime($_GET['date']));

        $nameMonth = date('F Y', strtotime($_GET['date']));

        $thaimonth = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

        $countAll = $db->where('bk_parent', mgr($id),'IN')->where('bk_status',2)->where('bk_date',$date_form,">=")->where('bk_date',$date_to,"<=")->getValue("booking","count(*)");
        $api['count'] = array(
            'all' => $countAll,
            'monthName' => $thaimonth[date('n', strtotime($_GET['date'])) - 1].' '.(date('Y', strtotime($_GET['date'])) + 543)
        );

    }

    echo json_encode($api);

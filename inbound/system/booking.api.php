<?php

    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");


    if($_GET['get'] == "car"){

        $request = json_decode(file_get_contents('php://input'));
        $branch = $request->branch;
       
        $car = $db->where('car_branch',$branch)->where("car_status",1)->orderBy('car_sort','ASC')->get("car");
        if(!$car){
            $api['status'] = 'failed';
            $api['message'] = 'No car available';
            echo json_encode($api);
            exit();
        }else{
            foreach($car as $c){
                $api['car'][] = array(
                    'id' => $c['car_id'],
                    'model' => $c['car_model'],
                    'img' => $c['car_img']
                );
            }
        }
       
        
    }

    if($_GET['get'] == "time"){
        $i = 1;
        $request = json_decode(file_get_contents('php://input'));
        $date = $request->date;
        $car = $request->car;

        $t[0] = array('id' => 1,'time' => '08:00 - 08:45');
        $t[1] = array('id' => 2,'time' => '09:00 - 09:45');
        $t[2] = array('id' => 3,'time' => '10:00 - 10:45');
        $t[3] = array('id' => 4,'time' => '11:00 - 11:45');
        $t[4] = array('id' => 5,'time' => '12:00 - 12:45');
        $t[5] = array('id' => 6,'time' => '13:00 - 13:45');
        $t[6] = array('id' => 7,'time' => '14:00 - 14:45');
        $t[7] = array('id' => 8,'time' => '15:00 - 15:45');
        $t[8] = array('id' => 9,'time' => '16:00 - 16:45');

        foreach($t as $time){
            $bked = $db->where("bk_date",$date)->where('bk_car',$car)->where('bk_status',array(0,1),'IN')->get("booking");
            $isBooked = false;

            foreach($bked as $b){
                if($b['bk_time'] == $time['id']){
                    $isBooked = true;
                    break;
                }
            }

            $api['time'][] = array(
                'id' => $time['id'],
                'time' => $time['time'],
                'status' => $isBooked ? 0 : 1 
            );
        }

        //$api = array($date,$car);
    }

    if($_GET['get'] == "carInfo"){

        $request = json_decode(file_get_contents('php://input'));
        $car = $request->car;
        
        $car = $db->where("car_id",$car)->getOne("car");
        $api['car'] = array(
            'id' => $car['car_id'],
            'model' => $car['car_model']
        );
        
    }

    if($_GET['get'] == "sales"){

        function getTeam($uid){
            global $db_nms;
            $team = $db_nms->get('db_user_group');
            foreach($team as $t){
                $team_data = json_decode($t['detail']);
                if(in_array($uid,$team_data)){
                    if($t['name'] == 'S'){
                        return 'E2';
                    } else {
                        return $t['name'];
                    }
                } 
            }
    
        }

        $sales = $db_nms->where('verify',1)->where('status','user')->orderBy('id','ASC')->get('db_member');
        foreach($sales as $s){
            $api[] = array(
                'id' => $s['id'],
                'text' => $s['first_name'].' '.$s['last_name'].($s['nickname'] ? ' ('.$s['nickname'].')' : ' - ทีม ' .getTeam($s['id']))
            );
        }
    }

    echo json_encode($api);

    

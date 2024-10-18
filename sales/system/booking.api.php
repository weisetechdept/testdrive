<?php

    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $id = $_SESSION['sales_user'];

    if($_GET['get'] == "sales"){ 
        
        $quota = $db->where("bk_parent",$id)->where('bk_where',2)->where("bk_status",array(0,1),'BETWEEN')->getValue("booking","count(*)");
        if($quota){
            $quota = 3-$quota;
        } else {
            $quota = 3;
        }

        $api['sales'] = array(
            'id' => $id,
            'quota' => $quota
        );
    } 

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

    // if($_GET['get'] == "time"){

    //     $i = 1;
    //     $request = json_decode(file_get_contents('php://input'));
    //     $date = $request->date;
    //     $car = $request->car;

    //     $t[0] = array('id' => 1,'time' => '08:00 - 08:45');
    //     $t[1] = array('id' => 2,'time' => '09:00 - 09:45');
    //     $t[2] = array('id' => 3,'time' => '10:00 - 10:45');
    //     $t[3] = array('id' => 4,'time' => '11:00 - 11:45');
    //     $t[4] = array('id' => 5,'time' => '12:00 - 12:45');
    //     $t[5] = array('id' => 6,'time' => '13:00 - 13:45');
    //     $t[6] = array('id' => 7,'time' => '14:00 - 14:45');
    //     $t[7] = array('id' => 8,'time' => '15:00 - 15:45');
    //     $t[8] = array('id' => 9,'time' => '16:00 - 16:45');
    //     $t[9] = array('id' => 9,'time' => '17:00 - 17:45');

        
        
    //     foreach($t as $time){ 
    //         $bked = $db->where("bk_date",$date)->where('bk_car',$car)->where('bk_status',array(0,1),'IN')->get("booking");
    //         $isBooked = false;

    //         foreach($bked as $b){
    //             if($b['bk_time'] == $time['id']){
    //                 $isBooked = true;
    //             } else{
    //                 $isBooked = true;
    //             }
    //         }

    //         $api['time'][] = array(
    //             'id' => $time['id'],
    //             'time' => $time['time'],
    //             'status' => $isBooked ? 0 : 1 
    //         );
    //     }

    //     //$api = array($date,$car);
    // }

    if($_GET['get'] == "time-new"){
        $i = 1;
        $request = json_decode(file_get_contents('php://input'));
        $date = $request->date;
        $car = $request->car;

        function timeSort($item){
            $nowTime = date('H:i:s');
            switch ($item) {
                case '1':
                    $rawTime = '08:00:00';
                    break;
                case '2':
                    $rawTime = '09:00:00';
                    break;
                case '3':
                    $rawTime = '10:00:00';
                    break;
                case '4':
                    $rawTime = '11:00:00';
                    break;
                case '5':
                    $rawTime = '12:00:00';
                    break;
                case '6':
                    $rawTime = '13:00:00';
                    break;
                case '7':
                    $rawTime = '14:00:00';
                    break;
                case '8':
                    $rawTime = '15:00:00';
                    break;
                case '9':
                    $rawTime = '16:00:00';
                    break;
                case '10':
                    $rawTime = '17:00:00';
                    break;
                default:
                    $rawTime = '00:00:00'; // Default value to avoid undefined variable
                    break;
            }
            if($nowTime > $rawTime){
                return 1;
            } else {
                return 0;
            }
        }

        $t[0] = array('id' => 1,'time' => '08:00 - 08:45');
        $t[1] = array('id' => 2,'time' => '09:00 - 09:45');
        $t[2] = array('id' => 3,'time' => '10:00 - 10:45');
        $t[3] = array('id' => 4,'time' => '11:00 - 11:45');
        $t[4] = array('id' => 5,'time' => '12:00 - 12:45');
        $t[5] = array('id' => 6,'time' => '13:00 - 13:45');
        $t[6] = array('id' => 7,'time' => '14:00 - 14:45');
        $t[7] = array('id' => 8,'time' => '15:00 - 15:45');
        $t[8] = array('id' => 9,'time' => '16:00 - 16:45');
        $t[9] = array('id' => 10,'time' => '17:00 - 17:45');

        foreach($t as $time){
            $bked = $db->where("bk_date",$date)->where('bk_car',$car)->where('bk_status',array(0,1),'IN')->get("booking");

            $isBooked = false;
            foreach($bked as $b){

                $booked = json_decode($b['bk_time']);
                foreach ($booked as $value) {
                    if($value == $time['id']){
                        $isBooked = true;
                        break;
                    } 
                }
            }

                if(timeSort($time['id']) == '1' && $date == date('Y-m-d')){
                    $isBooked = true;
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

    echo json_encode($api);

    

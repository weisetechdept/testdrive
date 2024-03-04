<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $id = $_GET['id'];

    if($_GET['get'] == "data"){

        $db->join('car c','c.car_id = b.bk_car','LEFT');
        $move = $db->where('bk_id',$id)->get('booking b');

        foreach($move as $m){

            $api = array(
                'id' => $m['bk_id'],
                'name' => $m['bk_fname'].' '.$m['bk_lname'],
                'branch' => $m['car_branch'],
                'model' => $m['car_model'],
                'model_id' => $m['car_id'],
                'date' => $m['bk_date'],
                'time' => $m['bk_time']
            );
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

    if($_GET['get'] == "edit"){

        $request = json_decode(file_get_contents('php://input'));
        $id = $request->id;
        $date = $request->date;
        $time = $request->time;

        $data = array(
            'bk_date' => $date,
            'bk_time' => $time
        );
        $move = $db->where('bk_id',$id)->update('booking',$data);
        if($move){
            $api = array(
                'status' => 'success',
                'message' => 'Booking has been moved'
            );
        }else{
            $api = array(
                'status' => 'failed',
                'message' => 'Booking cannot be moved'
            );
        }

    }

    echo json_encode($api);

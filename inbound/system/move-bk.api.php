<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");



    if($_GET['get'] == "data"){

        $id = $_GET['id'];

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

        function timeSort($item){
            $nowTime = date('H:i:s');
            switch ($item) {
                case '1':
                    $rawTime = '08:00:00';
                    break;
                case '2':
                    $rawTime = '08:31:00';
                    break;
                case '3':
                    $rawTime = '09:01:00';
                    break;
                case '4':
                    $rawTime = '09:31:00';
                    break;
                case '5':
                    $rawTime = '10:01:00';
                    break;
                case '6':
                    $rawTime = '10:31:00';
                    break;
                case '7':
                    $rawTime = '11:01:00';
                    break;
                case '8':
                    $rawTime = '11:31:00';
                    break;
                case '9':
                    $rawTime = '12:01:00';
                    break;
                case '10':
                    $rawTime = '12:31:00';
                    break;
                case '11':
                    $rawTime = '13:01:00';
                    break;
                case '12':
                    $rawTime = '13:31:00';
                    break;
                case '13':
                    $rawTime = '14:01:00';
                    break;
                case '14':
                    $rawTime = '14:31:00';
                    break;
                case '15':
                    $rawTime = '15:01:00';
                    break;
                case '16':
                    $rawTime = '15:31:00';
                    break;
                case '17':
                    $rawTime = '16:01:00';
                    break;
                case '18':
                    $rawTime = '16:31:00';
                    break;
                case '19':
                    $rawTime = '17:01:00';
                    break;
                case '20':
                    $rawTime = '17:31:00';
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

        $request = json_decode(file_get_contents('php://input'));
        if(!isset($request)){
            $api = array(
                'status' => 'failed',
                'message' => 'Please select date and car'
            );
        } else {

            $date = $request->date;
            $car = $request->car;

            /* sample data */
            $ts = array();

            $ts[0] = array('id' => 1,'time' => '08:00 - 08:30');
            $ts[1] = array('id' => 2,'time' => '08:31 - 09:00');
            $ts[2] = array('id' => 3,'time' => '09:01 - 09:30');
            $ts[3] = array('id' => 4,'time' => '09:31 - 10:00');
            $ts[4] = array('id' => 5,'time' => '10:01 - 10:30');
            $ts[5] = array('id' => 6,'time' => '10:31 - 11:00');
            $ts[6] = array('id' => 7,'time' => '11:01 - 11:30');
            $ts[7] = array('id' => 8,'time' => '11:30 - 12:00');
            $ts[8] = array('id' => 9,'time' => '12:01 - 12:30');
            $ts[9] = array('id' => 10,'time' => '12:31 - 13:00');
            $ts[10] = array('id' => 11,'time' => '13:01 - 13:30');
            $ts[11] = array('id' => 12,'time' => '13:31 - 14:00');
            $ts[12] = array('id' => 13,'time' => '14:01 - 14:30');
            $ts[13] = array('id' => 14,'time' => '15:31 - 15:00');
            $ts[14] = array('id' => 15,'time' => '15:01 - 15:30');
            $ts[15] = array('id' => 16,'time' => '15:31 - 16:00');
            $ts[16] = array('id' => 17,'time' => '16:01 - 16:30');
            $ts[17] = array('id' => 18,'time' => '16:31 - 17:00');
            $ts[18] = array('id' => 19,'time' => '17:01 - 17:30');
            $ts[19] = array('id' => 20,'time' => '17:31 - 18:00');

            $nowTime = date('H') - 8;
            $today = date('d-m-Y');

            $status = 0;

            foreach($ts as $key => $time){

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

                if($isBooked == false){
                    if(date('d-m-Y', strtotime($date)) == $today){
                        if($nowTime > $key / 2){
                            $status = 0;
                        } else {
                            $status = 1;
                        }
                    } else {
                        $status = 1;
                    }
                } else {
                    $status = 0;
                }

                
                
                $api['time'][] = array(
                    'id' => $time['id'],
                    'time' => $time['time'],
                    'status' => $status
                );

                
            }


            // $t[0] = array('id' => 1,'time' => '08:00 - 08:45');
            // $t[1] = array('id' => 2,'time' => '09:00 - 09:45');
            // $t[2] = array('id' => 3,'time' => '10:00 - 10:45');
            // $t[3] = array('id' => 4,'time' => '11:00 - 11:45');
            // $t[4] = array('id' => 5,'time' => '12:00 - 12:45');
            // $t[5] = array('id' => 6,'time' => '13:00 - 13:45');
            // $t[6] = array('id' => 7,'time' => '14:00 - 14:45');
            // $t[7] = array('id' => 8,'time' => '15:00 - 15:45');
            // $t[8] = array('id' => 9,'time' => '16:00 - 16:45');
            // $t[9] = array('id' => 10,'time' => '17:00 - 17:45');

            // foreach($t as $time){
            //     $bked = $db->where("bk_date",$date)->where('bk_car',$car)->where('bk_status',array(0,1),'IN')->get("booking");
            //     $isBooked = false;

            //     foreach($bked as $b){
            //         if($b['bk_time'] == $time['id']){
            //             $isBooked = true;
            //             break;
            //         }
            //     }

            //     $api['time'][] = array(
            //         'id' => $time['id'],
            //         'time' => $time['time'],
            //         'status' => $isBooked ? 0 : 1 
            //     );
            // }

        }

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

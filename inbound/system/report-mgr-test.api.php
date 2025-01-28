<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $api = array();

    if(isset($_GET['date'])){
        $months = array();
        $month_names = array();

        for ($i = 0; $i < 12; $i++) {
            $api['searchDate'][] = array(
                'name' => date('F Y', strtotime("-$i months")),
                'value' => date('Y-m-01', strtotime("-$i months"))
            );
        }
    }

    if(isset($_GET['report'])){

        $date = isset($_GET['date']) ? $_GET['date'] : null;

        $form_date = date('Y-m-01', strtotime($date));
        $to_date = date('Y-m-t', strtotime($date));

        function bhRs($id){
            if($id == '1'){
                return 'HO';
            } elseif($id == '2'){
                return 'TM';
            } else {
                return 'N/A';
            }
        }   


        $bh = array('1','2');
        foreach($bh as $b){
            $api['byTeam'][bhRs($b)]['ALL']['inDataALL'] = 0;
            $api['byTeam'][bhRs($b)]['ALL']['inDataBKALL'] = 0;
            $api['byTeam'][bhRs($b)]['ALL']['outDataALL'] = 0;
            $api['byTeam'][bhRs($b)]['ALL']['outDataBKALL'] = 0;
            $api['byTeam'][bhRs($b)]['ALL']['countBootTotal'] = 0;
        }
        $inDataALL = 0;
        $inDataBKALL = 0;

        $outDataALL = 0;
        $outDataBKALL = 0;

        $bootDataALL = 0;

        foreach($bh as $b){

            $group = $db_nms->where('branch',$b)->get('db_user_group');
            foreach($group as $g){
        
                $sales = json_decode($g['detail']);
                if (!empty($sales)) {

                    $cars = array();
                    $db->join("status_log s","s.stat_parent = b.bk_id","LEFT");
                    $db->groupBy("b.bk_id");
                    $book_cars = $db->where("bk_datetime", $form_date,">=")->where("bk_datetime", $to_date,"<=")->where('bk_parent', $sales, "IN")->get("booking b");


                        foreach($book_cars as $value){
                            if($value['bk_where'] == '2'){
                                $team['byTeam'][bhRs($b)][$g['name']]['inData'][] = array(

                                    'id' => $value['bk_id'],
                                    'customer' => $value['bk_fname'].' '.$value['bk_lname'],
                                    'owner' => $value['bk_parent']

                                );
                            } elseif($value['bk_where'] == '7'){
                                $team['byTeam'][bhRs($b)][$g['name']]['outData'][] = array(
                                    'id' => $value['bk_id'],
                                    'customer' => $value['bk_fname'].' '.$value['bk_lname'],
                                    'owner' => $value['bk_parent']
                                );
                            } elseif($value['bk_where'] == '6'){
                                $team['byTeam'][bhRs($b)][$g['name']]['bootData'][] = array(
                                    'id' => $value['bk_id'],
                                    'customer' => $value['bk_fname'].' '.$value['bk_lname'],
                                    'owner' => $value['bk_parent']
                                );
                            }

                            if($value['stat_key'] == 'TEST_IS_BK' && $value['stat_value'] == 'BK' && $value['stat_status'] == '1'){

                                if($value['bk_where'] == '2'){
                                    $team['byTeam'][bhRs($b)][$g['name']]['inDataBK'][] = array(
                                        'id' => $value['bk_id'],
                                        'customer' => $value['bk_fname'].' '.$value['bk_lname'],
                                        'owner' => $value['bk_parent']
                                    );
                                } elseif($value['bk_where'] == '7'){
                                    $team['byTeam'][bhRs($b)][$g['name']]['outDataBK'][] = array(
                                        'id' => $value['bk_id'],
                                        'customer' => $value['bk_fname'].' '.$value['bk_lname'],
                                        'owner' => $value['bk_parent']
                                    );
                                } elseif($value['bk_where'] == '6'){
                                    $team['byTeam'][bhRs($b)][$g['name']]['bootDataBK'][] = array(
                                        'id' => $value['bk_id'],
                                        'customer' => $value['bk_fname'].' '.$value['bk_lname'],
                                        'owner' => $value['bk_parent']
                                    );
                                }
                    
                            }

                        }

                    
                }
        
            }

        }

        $bh = array('1','2');
        foreach($bh as $b){
            $group = $db_nms->where('branch',$b)->get('db_user_group');
            foreach($group as $g){

                $api['byTeam'][bhRs($b)][$g['name']]['total'] = (isset($team['byTeam'][bhRs($b)][$g['name']]['inData']) ? count($team['byTeam'][bhRs($b)][$g['name']]['inData']) : 0) + (isset($team['byTeam'][bhRs($b)][$g['name']]['outData']) ? count($team['byTeam'][bhRs($b)][$g['name']]['outData']) : 0);
                $api['byTeam'][bhRs($b)][$g['name']]['totalBK'] = (isset($team['byTeam'][bhRs($b)][$g['name']]['inDataBK']) ? count($team['byTeam'][bhRs($b)][$g['name']]['inDataBK']) : 0) + (isset($team['byTeam'][bhRs($b)][$g['name']]['outDataBK']) ? count($team['byTeam'][bhRs($b)][$g['name']]['outDataBK']) : 0);
                $api['byTeam'][bhRs($b)][$g['name']]['totalPer'] = isset($team['byTeam'][bhRs($b)][$g['name']]['inData']) && count($team['byTeam'][bhRs($b)][$g['name']]['inData']) > 0 ? (isset($team['byTeam'][bhRs($b)][$g['name']]['inDataBK']) ? round(count($team['byTeam'][bhRs($b)][$g['name']]['inDataBK']) * 100 / count($team['byTeam'][bhRs($b)][$g['name']]['inData'])) : 0) : 0;
                
                $api['byTeam'][bhRs($b)][$g['name']]['countIn'] = isset($team['byTeam'][bhRs($b)][$g['name']]['inData']) ? count($team['byTeam'][bhRs($b)][$g['name']]['inData']) : 0;
                $api['byTeam'][bhRs($b)][$g['name']]['countInBK'] = isset($team['byTeam'][bhRs($b)][$g['name']]['inDataBK']) ? count($team['byTeam'][bhRs($b)][$g['name']]['inDataBK']) : 0;
                $api['byTeam'][bhRs($b)][$g['name']]['countInPer'] = isset($team['byTeam'][bhRs($b)][$g['name']]['inData']) && count($team['byTeam'][bhRs($b)][$g['name']]['inData']) > 0 ? (isset($team['byTeam'][bhRs($b)][$g['name']]['inDataBK']) ? round(count($team['byTeam'][bhRs($b)][$g['name']]['inDataBK']) * 100 / count($team['byTeam'][bhRs($b)][$g['name']]['inData'])) : 0) : 0;
                $api['byTeam'][bhRs($b)][$g['name']]['countOut'] = isset($team['byTeam'][bhRs($b)][$g['name']]['outData']) ? count($team['byTeam'][bhRs($b)][$g['name']]['outData']) : 0;
                $api['byTeam'][bhRs($b)][$g['name']]['countOutBK'] = isset($team['byTeam'][bhRs($b)][$g['name']]['outDataBK']) ? count($team['byTeam'][bhRs($b)][$g['name']]['outDataBK']) : 0;
                $api['byTeam'][bhRs($b)][$g['name']]['countOutPer'] = isset($team['byTeam'][bhRs($b)][$g['name']]['outData']) && count($team['byTeam'][bhRs($b)][$g['name']]['outData']) > 0 ? (isset($team['byTeam'][bhRs($b)][$g['name']]['outDataBK']) ? round(count($team['byTeam'][bhRs($b)][$g['name']]['outDataBK']) * 100 / count($team['byTeam'][bhRs($b)][$g['name']]['outData'])) : 0) : 0;
                
                $api['byTeam'][bhRs($b)][$g['name']]['countBootTotal'] = isset($team['byTeam'][bhRs($b)][$g['name']]['bootData']) ? count($team['byTeam'][bhRs($b)][$g['name']]['bootData']) : 0;
                $api['byTeam'][bhRs($b)][$g['name']]['countBootBK'] = '-';
                $api['byTeam'][bhRs($b)][$g['name']]['countBootPer'] = '-';

                /* count all */

                $api['byTeam'][bhRs($b)]['ALL']['inDataALL'] = $api['byTeam'][bhRs($b)]['ALL']['inDataALL'] + (isset($team['byTeam'][bhRs($b)][$g['name']]['inData']) ? count($team['byTeam'][bhRs($b)][$g['name']]['inData']) : 0);
                $api['byTeam'][bhRs($b)]['ALL']['inDataBKALL'] =  $api['byTeam'][bhRs($b)]['ALL']['inDataBKALL'] + (isset($team['byTeam'][bhRs($b)][$g['name']]['inDataBK']) ? count($team['byTeam'][bhRs($b)][$g['name']]['inDataBK']) : 0);
                $api['byTeam'][bhRs($b)]['ALL']['inDataPerALL'] =  $api['byTeam'][bhRs($b)]['ALL']['inDataALL'] > 0 ? round($api['byTeam'][bhRs($b)]['ALL']['inDataBKALL'] * 100 / $api['byTeam'][bhRs($b)]['ALL']['inDataALL']) : 0;
                
                $api['byTeam'][bhRs($b)]['ALL']['outDataALL'] = $api['byTeam'][bhRs($b)]['ALL']['outDataALL'] + (isset($team['byTeam'][bhRs($b)][$g['name']]['outData']) ? count($team['byTeam'][bhRs($b)][$g['name']]['outData']) : 0);
                $api['byTeam'][bhRs($b)]['ALL']['outDataBKALL'] = $api['byTeam'][bhRs($b)]['ALL']['outDataBKALL'] + (isset($team['byTeam'][bhRs($b)][$g['name']]['outDataBK']) ? count($team['byTeam'][bhRs($b)][$g['name']]['outDataBK']) : 0);
                $api['byTeam'][bhRs($b)]['ALL']['outDataPerALL'] = $api['byTeam'][bhRs($b)]['ALL']['outDataALL'] > 0 ? round($api['byTeam'][bhRs($b)]['ALL']['outDataBKALL'] * 100 / $api['byTeam'][bhRs($b)]['ALL']['outDataALL']) : 0;

                $api['byTeam'][bhRs($b)]['ALL']['countTotal'] = $api['byTeam'][bhRs($b)]['ALL']['inDataALL'] + $api['byTeam'][bhRs($b)]['ALL']['outDataALL'];
                $api['byTeam'][bhRs($b)]['ALL']['countTotalBK'] = $api['byTeam'][bhRs($b)]['ALL']['inDataBKALL'] + $api['byTeam'][bhRs($b)]['ALL']['outDataBKALL'];
                $api['byTeam'][bhRs($b)]['ALL']['countTotalPer'] = $api['byTeam'][bhRs($b)]['ALL']['countTotal'] > 0 ? round($api['byTeam'][bhRs($b)]['ALL']['countTotalBK'] * 100 / $api['byTeam'][bhRs($b)]['ALL']['countTotal']) : 0;

                $api['byTeam'][bhRs($b)]['ALL']['countBootTotal'] = $bootDataALL + (isset($team['byTeam'][bhRs($b)][$g['name']]['bootData']) ? count($team['byTeam'][bhRs($b)][$g['name']]['bootData']) : 0);
            

            }
        }

    /* finish base on car */ 
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

        function getBranch($uid){
            global $db_nms;
            $member = $db_nms->where('id',$uid)->getOne('db_member');
            if($member['branch'] ==  '1'){
                return 'HO';
            } elseif($member['branch'] == '2'){ 
                return 'TM';
            } else {
                return 'N/A';
            }
        }

        /* report by cars */
        $cars = array();
        $db->join("status_log s","s.stat_parent = b.bk_id","LEFT");
        $db->groupBy("b.bk_id");
        $book_cars = $db->where("bk_datetime", $form_date,">=")->where("bk_datetime", $to_date,"<=")->get("booking b");

        foreach($book_cars as $value){

            if($value['bk_where'] == '2'){
                $api['car_report'][$value['bk_car']]['inData'][] = array(
                    'id' => $value['bk_id'],
                    'customer' => $value['bk_fname'].' '.$value['bk_lname']
                );
            } elseif($value['bk_where'] == '7'){
                $api['car_report'][$value['bk_car']]['outData'][] = array(
                    'id' => $value['bk_id'],
                    'customer' => $value['bk_fname'].' '.$value['bk_lname']
                );
            } elseif($value['bk_where'] == '6'){
                $api['car_report'][$value['bk_car']]['bootData'][] = array(
                    'id' => $value['bk_id'],
                    'customer' => $value['bk_fname'].' '.$value['bk_lname']
                );
            }



            if($value['stat_key'] == 'TEST_IS_BK' && $value['stat_value'] == 'BK' && $value['stat_status'] == '1'){

                if($value['bk_where'] == '2'){
                    $api['car_report'][$value['bk_car']]['inDataBK'][] = array(
                        'id' => $value['bk_id'],
                        'customer' => $value['bk_fname'].' '.$value['bk_lname']
                    );
                } elseif($value['bk_where'] == '7'){
                    $api['car_report'][$value['bk_car']]['outDataBK'][] = array(
                        'id' => $value['bk_id'],
                        'customer' => $value['bk_fname'].' '.$value['bk_lname']
                    );
                } elseif($value['bk_where'] == '6'){
                    $api['car_report'][$value['bk_car']]['bootDataBK'][] = array(
                        'id' => $value['bk_id'],
                        'customer' => $value['bk_fname'].' '.$value['bk_lname']
                    );
                }

            }

        }

        // $api['car_report'] = array(); // This line is removed to prevent resetting the array

        function getCar($id){
            global $db;
            $car = $db->where('car_id',$id)->getOne('car');
            return $car['car_model'];
        }

        foreach($api['car_report'] as $key => $value){

            $serie = $db->where('car_id',$key)->getOne('car');

            $api['car_report'][$key]['id'] = $serie['car_id'];
            $api['car_report'][$key]['model'] = $serie['car_model'];
            $api['car_report'][$key]['vin'] = $serie['car_vin'];
            $api['car_report'][$key]['total'] = (isset($api['car_report'][$key]['inData']) ? count($api['car_report'][$key]['inData']) : 0) + (isset($api['car_report'][$key]['outData']) ? count($api['car_report'][$key]['outData']) : 0);
            
            $api['car_report'][$key]['countIn'] = isset($api['car_report'][$key]['inData']) ? count($api['car_report'][$key]['inData']) : 0;
            $api['car_report'][$key]['countInBK'] = isset($api['car_report'][$key]['inDataBK']) ? count($api['car_report'][$key]['inDataBK']) : 0;
            $api['car_report'][$key]['countInPer'] = isset($api['car_report'][$key]['inData']) && count($api['car_report'][$key]['inData']) > 0 ? (isset($api['car_report'][$key]['inDataBK']) ? round(count($api['car_report'][$key]['inDataBK']) * 100 / count($api['car_report'][$key]['inData'])).'%' : 0) : 0;

            $api['car_report'][$key]['countOut'] = isset($api['car_report'][$key]['outData']) ? count($api['car_report'][$key]['outData']) : 0;
            $api['car_report'][$key]['countOutBK'] = isset($api['car_report'][$key]['outDataBK']) ? count($api['car_report'][$key]['outDataBK']) : 0;
            $api['car_report'][$key]['countOutPer'] = isset($api['car_report'][$key]['outData']) && count($api['car_report'][$key]['outData']) > 0 ? (isset($api['car_report'][$key]['outDataBK']) ? round(count($api['car_report'][$key]['outDataBK']) * 100 / count($api['car_report'][$key]['outData'])).'%' : 0) : 0;

            $api['car_report'][$key]['countBootTotal'] = isset($api['car_report'][$key]['bootData']) ? count($api['car_report'][$key]['bootData']) : 0;
            $api['car_report'][$key]['countBootBK'] = '-';
            $api['car_report'][$key]['countBootPer'] = '-';

        }

    }

    echo json_encode($api);
<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $form_date = '2025-01-01';
    $to_date = '2025-01-31';

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

    /* in + walk showroom */
    $countInAll = $db->where("bk_where",'2')->where("bk_datetime", $form_date,">=")->where("bk_datetime", $to_date,"<=")->get("booking");

    $countInHO = '0';
    $countInTM = '0';

    foreach($countInAll as $value){

        if($value['bk_parent'] !== 'TBR'){
            if(getBranch($value['bk_parent']) == 'HO'){
                $countInHO++;
            } elseif(getBranch($value['bk_parent']) == 'TM'){
                $countInTM++;
            }
        }

    }

    $api['TestDIn'] = array(
        "All" => count($countInAll),
        "HO" => $countInHO,
        "TM" => $countInTM
    );

    /* out showroom */
    $countOutAll = $db->where("bk_where",'7')->where("bk_datetime", $form_date,">=")->where("bk_datetime", $to_date,"<=")->get("booking");

    $countOutHO = '0';
    $countOutTM = '0';

    foreach($countOutAll as $value){

        if($value['bk_parent'] !== 'TBR'){
            if(getBranch($value['bk_parent']) == 'HO'){
                $countOutHO++;
            } elseif(getBranch($value['bk_parent']) == 'TM'){
                $countOutTM++;
            }
        }

    }

    $api['TestDOut'] = array(
        "All" => count($countOutAll),
        "HO" => $countOutHO,
        "TM" => $countOutTM
    );

     /* booth showroom */
     $countBoothAll = $db->where("bk_where",'6')->where("bk_datetime", $form_date,">=")->where("bk_datetime", $to_date,"<=")->get("booking");

     $countBoothHO = '0';
     $countBoothTM = '0';
 
     foreach($countBoothAll as $value){
 
         if($value['bk_parent'] !== 'TBR'){
             if(getBranch($value['bk_parent']) == 'HO'){
                 $countBoothHO++;
             } elseif(getBranch($value['bk_parent']) == 'TM'){
                 $countBoothTM++;
             }
         }
 
     }

    $api['TestDBooth'] = array(
        "All" => count($countBoothAll),
        "HO" => $countBoothHO,
        "TM" => $countBoothTM
    );
    
    $api['TestDInBk'] = array(
        "All" => '0',
        "HO" => '0',
        "TM" => '0'
    );

    $api['TestDOutBk'] = array(
        "All" => '0',
        "HO" => '0',
        "TM" => '0'
    );

    $api['TestDAllBk'] = array(
        "All" => '0',
        "HO" => '0',
        "TM" => '0'
    );

    $api['TestDOutPer'] = array(
        "All" => '0',
        "HO" => '0',
        "TM" => '0'
    );

    $api['TestDInPer'] = array(
        "All" => '0',
        "HO" => '0',
        "TM" => '0'
    );

    $api['TestDAllPer'] = array(
        "All" => '0',
        "HO" => '0',
        "TM" => '0'
    );

    /* report by cars */
    //$db->join("car c","c.car_id = b.bk_car","LEFT");
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

    function getCar($id){
        global $db;
        $car = $db->where('car_id',$id)->getOne('car');
        return $car['car_model'];
    }

    foreach($api['car_report'] as $key => $value){
        $serie = $db->where('car_id',$key)->getOne('car');

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

    // $car = $db->get('car');
    // $api['cars'] = array();

    // foreach($car as $value){
    //     $api['cars'][] = array(
    //         "car_id" => $value['car_id'],
    //         "car_model" => $value['car_model'],
    //         "car_vin" => $value['car_vin']
    //     );
    // }

    /* All */
    $api['TestDAll'] = array(
        "All" => count($countOutAll) + count($countInAll),
        "HO" => $countOutHO + $countInHO,
        "TM" => $countOutTM + $countInTM
    );

    echo json_encode($api);
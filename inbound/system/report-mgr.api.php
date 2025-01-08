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

    /* All */
    $api['TestDAll'] = array(
        "All" => count($countOutAll) + count($countInAll),
        "HO" => $countOutHO + $countInHO,
        "TM" => $countOutTM + $countInTM
    );

    echo json_encode($api);
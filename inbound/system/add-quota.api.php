<?php
    session_start();
    require_once '../../db-conn.php';

    if($_SESSION['testdrive_admin'] !== true){
        header('Location: /404');
    }
    
    date_default_timezone_set("Asia/Bangkok");

    function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}

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

    $man = $db_nms->where('verify',1)->get('db_member');

    foreach ($man as $value) {
        $api['data'][] = array(
            $value['id'],
            $value['first_name'].' '.$value['last_name'],
            $value['nickname'],
            getTeam($value['id'])
        );
    }

    echo json_encode($api);
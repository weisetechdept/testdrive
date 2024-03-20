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

    $quota = $db->get('man_quota');

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

    foreach($quota as $q) {



        $user_data = $db_nms->where('id',$q['qt_user_id'])->getOne('db_member');
        $assigned = $db->where('bk_parent',$q['qt_user_id'])->where('bk_where',1)->getValue('booking','count(*)');

        $api['data'][] = array(
            $q['qt_id'],
            $user_data['first_name'].' ('.$user_data['nickname'].')',
            $q['qt_status'],
            DateThai($q['qt_datetime']),
            $assigned,
            getTeam($q['qt_user_id'])
        );
    }



    echo json_encode($api);
    

    //$user_data = $db_nms->where('id','271')->getOne('db_member');

    //echo json_encode($user_data);

  
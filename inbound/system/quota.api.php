<?php
    session_start();
    require_once '../../db-conn.php';
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

    foreach($quota as $q) {

        $user_data = $db_nms->where('id',$q['qt_user_id'])->getOne('db_member');
        $assigned = $db->where('bk_parent',$q['qt_user_id'])->where('bk_where',1)->getValue('booking','count(*)');

        $api['data'][] = array(
            $q['qt_id'],
            $user_data['first_name'].' ('.$user_data['nickname'].')',
            $q['qt_status'],
            DateThai($q['qt_datetime']),
            $assigned
        );
    }

    echo json_encode($api);
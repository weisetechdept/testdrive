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

    $man = $db_nms->where('verify',1)->get('db_member');

    foreach ($man as $value) {
        $api['data'][] = array(
            $value['id'],
            $value['first_name'].' '.$value['last_name'],
            $value['nickname']
        );
    }

    echo json_encode($api);
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

    $id = $_GET['id'];

    $car = $db->where('car_id',$id)->getOne('car');

    $api['detail'] = array(
        'id' => $car['car_id'],
        'model' => $car['car_model'],
        'img' => $car['car_img'],
        'branch' => $car['car_branch'],
        'status' => $car['car_status'],
        'datetime' => DateThai(date('Y-m-d', strtotime($car['car_datetime'])))
    );
    
    echo json_encode($api);
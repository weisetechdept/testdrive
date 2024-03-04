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

    $history = $db->where('up_parent',$id)->get('car_update');

    foreach($history as $h){
        $api['history'][] = array(
            'date' => DateThai(date('Y-m-d', strtotime($h['up_datetime']))),
            'mileage' => $h['up_mileage']
        );
    }
    
    echo json_encode($api);
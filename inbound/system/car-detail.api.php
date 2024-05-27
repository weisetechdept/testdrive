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
        'datetime' => DateThai(date('Y-m-d', strtotime($car['car_datetime']))),
        'vin' => $car['car_vin'],
    );

    $db->join('booking b','b.bk_id = c.up_parent','LEFT');
    $mileage = $db->where('bk_car',$car['car_id'])->orderBy('up_id','DESC')->get('car_update c');

    foreach ($mileage as $value) {
        $api['mileage'][] = array(
            'mileage' => number_format($value['up_mileage']).' กม.',
            'datetime' => DateThai(date('Y-m-d', strtotime($value['up_datetime']))),
            'customer' => $value['bk_fname'],
            'id' => $value['bk_id'],
        );
    }


    echo json_encode($api);
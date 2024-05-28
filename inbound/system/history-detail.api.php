<?php
     session_start();
     require_once '../../db-conn.php';

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

     $car = $_GET['id'];

     $db->join('booking b','b.bk_id = c.up_parent','LEFT');
     $mileage = $db->where('bk_car',$car)->orderBy('up_id','DESC')->get('car_update c');
 
     foreach ($mileage as $value) {

         $api['history'][] = array(
            'mileage' => number_format($value['up_mileage']).' กม.',
            'datetime' => DateThai(date('Y-m-d', strtotime($value['up_datetime']))),
            'customer' => $value['bk_fname'],
            'id' => $value['bk_id']
         );

     }

     echo json_encode($api);
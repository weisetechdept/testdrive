<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
/*
    if($_SESSION['pp_login'] !== true){
        header('Location: /404');
    }
*/
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
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
	}

    function docsType($type) {
        if ($type == '1') {
            return 'บัตร ปชช.';
        } else if ($type == '2') {
            return 'ใบขับขี่ผู้ทดลองขับ';
        } else if ($type == '3') {
            return 'เอกสารยินยอมข้อตกลงทดลองขับ';
        }
    }

    $db->join("document d", "d.img_parent=b.bk_id", "RIGHT");
    $db->where('bk_id', $_GET['u'])->where('img_status', '1');
    $img = $db->get("booking b");

    
        foreach ($img as $value) {

            $api['img'][] = array('link' => $value['img_cf_path'],
                'type' => docsType($value['img_type']),
                'datetime' => DateThai($value['img_datetime'])
            );

            if($value['img_type'] == '2'){
                $api['verifyDLS'] = array('img' => $value['img_cf_path'],
                    'datetime' => DateThai($value['img_datetime']),
                    'id' => $value['img_id']
                );
            }

        }



    $update = $db->where('up_parent',$_GET['u'])->where('up_status',1)->getOne('car_update'); 
    if ($update) {
        $api['up_img'] = array('link' => $update['up_img_path'],
            'datetime' => DateThai($update['up_datetime']),
            'mileage' => $update['up_mileage'],
            'up_id' => $update['up_id']
        );
    } else {
        $api['up_img'] = '';
    }

    

    print_r(json_encode($api));
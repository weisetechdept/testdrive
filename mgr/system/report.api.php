<?php

    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

  

    if(isset($_GET['get']) && $_GET['get'] == "sales"){
        
        

        $thaimonth = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

        $api = array();

        $mgr_id = $_SESSION['sales_user'];

        $sale = $db_nms->get('db_user_group');
        $team = array();
        foreach($sale as $value){
            $leaders = json_decode($value['leader']);
            if (is_array($leaders) && in_array($mgr_id, $leaders)) {
                foreach(json_decode($value['detail']) as $emp){
                    $team[] = $emp;
                }
            }
        }

        $team = array_unique($team);

        // function getBooking($id){
        //     global $db;
        //     $bk = $db->where('bk_parent', $id)->where('bk_status',2)->get('booking');
        //     return count($bk);
        // }

        $getDate = isset($_GET['date']) ? $_GET['date'] : null;
        if($getDate){

            $date_form = date('Y-m-01', strtotime($getDate));
            $date_to = date('Y-m-t', strtotime($getDate));

        }else{

            $date_form = date('Y-m-01');
            $date_to = date('Y-m-t');

        }

        // $d_form = date('Y-01-01');
        // $d_to = date('Y-01-t');

        $testd = $db->where('bk_parent',$team,"IN")->where('bk_date',$date_form,">=")->where('bk_date',$date_to,"<=")->where('bk_where',2)->where('bk_status',2)->getValue('booking',"count(*)");
        $booth = $db->where('bk_parent',$team,"IN")->where('bk_date',$date_form,">=")->where('bk_date',$date_to,"<=")->where('bk_where',2)->where('bk_status',5)->getValue('booking',"count(*)");

        $db->join('status_log s', 'b.bk_id = s.stat_parent', 'INNER');
        $td_bk = $db->where('bk_parent',$team,"IN")->where('bk_date',$date_form,">=")->where('bk_date',$date_to,"<=")->where('bk_where',2)->where('bk_status',2)->getValue('booking b',"count(*)");

        $api['reportAll'] = array(
            'testdrive' => $testd ?: 0,
            'booth' => $booth ?: 0,
            'booking' => $td_bk ?: 0,
            'percentage' => $td_bk > 0 ? round(($td_bk / $testd) * 100, 2) : 0
        );
        
    
        foreach($team as $t){
            $sale = $db_nms->where('id',$t)->getOne('db_member');

            if ($sale) {
                $testd = $db->where('bk_parent', $sale['id'])->where('bk_date',$date_form,">=")->where('bk_date',$date_to,"<=")->where('bk_status',2)->getValue('booking',"count(*)");

                $db->join('status_log s', 'b.bk_id = s.stat_parent', 'INNER');
                $bktd = $db->where('bk_parent', $sale['id'])->where('bk_date',$date_form,">=")->where('bk_date',$date_to,"<=")->where('bk_status',2)->getValue('booking b',"count(*)");

                

                $api['teamData'][] = array(
                    'id' => $sale['id'],
                    'name' => $sale['first_name'].' '.$sale['last_name'].($sale['nickname'] ? ' ('.$sale['nickname'].')' : ''),
                    'testdrive' => $testd,
                    'booking' => $bktd,
                    'percentage' => $bktd > 0 ? round(($bktd / $testd) * 100, 2) : 0,
                    'booth' => '-'
                );
            }
        }

        $api['selectDate'] = array();
        for($l=0;$l<9;$l++){
            $api['selectDate'][] = array(
            'value' => date('Y-m-01', strtotime("-$l month")),
            'name' => $thaimonth[date('n', strtotime("-$l month")) - 1] . ' ' . (date('Y', strtotime("-$l month")) + 543)
            );
        }

        echo json_encode($api);
        
    }

   

    


    

<?php

    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if(isset($_GET['get']) && $_GET['get'] == "sales"){ 

        $mgr_id = '271';

        $sale = $db_nms->get('db_user_group');
        foreach($sale as $value){
            $chk = in_array($mgr_id, json_decode($value['leader']));
            if($chk){
                foreach(json_decode($value['detail']) as $emp){
                    $team[] = $emp;
                }
            }
        }

        $team = array_unique($team);

        function getBooking($id){
            global $db;
            $bk = $db->where('bk_parent', $id)->where('bk_status',2)->get('booking');
            return count($bk);
        }
    
        foreach($team as $t){
            $sale = $db_nms->where('id',$t)->getOne('db_member');
            if ($sale) {
                $teamRs['teamData'][] = array(
                    'id' => $sale['id'],
                    'name' => $sale['first_name'].' '.$sale['last_name'].($sale['nickname'] ? ' ('.$sale['nickname'].')' : ''),
                    'bkTotal' => getBooking($sale['id']),
                );
            }
        }

        echo json_encode($teamRs);
        
    }

   

    


    

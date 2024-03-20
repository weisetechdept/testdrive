<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if($_SESSION['pp_login'] !== true && $_SESSION['pp_permission'] !== 'leader'){
        header('Location: /404');
    }

    $id = $_SESSION['sales_user'];

    //$id = 271;

    function mgr($data){
        global $db_nms;
        $group = $db_nms->get('db_user_group');
        foreach($group as $value){
            $chk = in_array($data, json_decode($value['leader']));
            if($chk){
                foreach(json_decode($value['detail']) as $emp){
                    $team[] = $emp;
                }
            }
        }
        return array_unique($team);
    }

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

    $team = $db_nms->where('id',mgr($id),'IN')->get('db_member');

    foreach($team as $team){
        $api['user'][] = array(
            'id' => $team['id'],
            'name' => $team['first_name'].' '.$team['last_name'].' - ('.$team['nickname'].') ทีม '.getTeam($team['id'])
        );
    }

    echo json_encode($api);
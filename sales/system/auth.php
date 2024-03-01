<?php
    //session_start();
    //require_once '../../db-conn.php';


        require_once '../../vendor/autoload.php';
        $db_nms = new MysqliDb (Array (
                'host' => 'db-mysql-sgp1-23943-do-user-9295225-0.b.db.ondigitalocean.com',
                'username' => 'doadmin',
                'password' => 'AVNS_FhTeCG8UMlV_1ntithp',
                'db'=> 'nms',
                'port' => 25060,
                'charset' => 'utf8'
        ));

        /*
        $db_nms->where('line_usrid','U6f5da61c00cd349634881dafa7a6e624')->getOne('db_member');
        echo $db_nms->getLastQuery();
        */
        $a = $db_nms->get('db_branch');
        foreach($a as $ab){
                echo $ab['id'];
        }


    //$request = json_decode(file_get_contents('php://input'));
    //$userId = $request->userId;

        //$profile = $db_nms->where('line_usrid','U6f5da61c00cd349634881dafa7a6e624')->getOne('db_member');
        //echo json_encode(array('status' => '200'));
        //echo json_encode($profile);
        /*
        if($profile['verify'] == '1') {
            $_SESSION['sales_user'] = $profile['id'];
            $_SESSION['pp_permission'] = $profile['status'];
            echo json_encode(array('status' => '200', 'permission' => $profile['status']));
        } else {
            echo json_encode(array('status' => '400'));
            unset($_SESSION['pp_login']);
            unset($_SESSION['sales_user']);
            unset($_SESSION['pp_permission']);
        }
        */

    //$db->join("tpf_point_trans p", "c.camp_id=p.poit_campaign", "LEFT");
	//$db->where("p.poit_parent", $profile['memb_id']);
	//$products = $db->get("tpf_campaign c", null, "c.camp_topic, c.camp_point ,p.poit_datetime");
?>
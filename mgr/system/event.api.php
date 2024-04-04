<?php
    session_start();
    require_once '../../db-conn.php';

    if($_SESSION['pp_login'] !== true && $_SESSION['pp_permission'] !== 'leader'){
        header('Location: /404');
    }

    $car = $_GET['c'];

    if($car !== 0){

        for ($i = 0; $i < 9; $i++) {
            $date = date('Y-m-d', strtotime($dateToday . ' + ' . $i . ' days'));

            $chk = $db->where('bk_car',$car)->where('bk_date', $date)->getValue('booking', 'COUNT(*)');
            $empty = 9-$chk;
    
            if($empty == 0){
                $api['events'][] = array(
                    'date' => $date,
                    'title' => 'เต็ม',
                    'color' => '#dc3545',
                );
    
            } else {
                $api['events'][] = array(
                    'date' => $date,
                    'title' => 'ว่าง '.$empty,
                    'color' => '#28a745',
                    'description' => 'ว่าง '.$empty,
                    'url' => '/mgr/check?car='.$car.'&date='.$date
                );
            }
    

    
        }

    }

    echo json_encode($api);
    

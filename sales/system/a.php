<?php 
    require_once '../../db-conn.php';
    $a = $db_nms->get('db_branch');
    foreach($a as $ab){
        echo $ab['id'];
    }
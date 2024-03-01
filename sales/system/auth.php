<?php
    session_start();
    require_once '../../db-conn.php';

    $db_nms->where('line_usrid','U6f5da61c00cd349634881dafa7a6e624')->getOne('db_member');
    echo $db_nms->getLastQuery();
      
?>
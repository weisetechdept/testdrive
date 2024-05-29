<?php
    session_start();
    require_once '../../db-conn.php';
    if($_SESSION['testdrive_admin'] !== true){
        header('Location: /404');

    } 

    $request = json_decode(file_get_contents('php://input'));

    $id = $request->id;
    $branch = $request->branch;

        if($branch == 'ho'){
            $branch = 'tm';
        } else {
            $branch = 'ho';
        }

        $data = array(
            'car_branch' => $branch,
        );

        $db->where ('car_id', $id);
        if ($db->update ('car', $data)){
            $api = array('status' => 'success');
        } else {
            $api = array('status' => 'error');   
        }

        echo json_encode($api);

    

    




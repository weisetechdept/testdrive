<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $requset = json_decode(file_get_contents('php://input'));
    $sales = $requset->sales;
    $bk_id = $requset->id;

    $data = array(
        'bk_parent' => $sales
    );
    
    $id = $db->where('bk_id', $bk_id)->update('booking', $data);
    if($id){

        $luid = $db_nms->where('id', $sales)->getOne('db_member');

        $access_token = 'GtacKYhQw2Y7U9Wzc8GeNUW32big3VZs4oeUU7U8wEtlPUDq1kLKQYBpD1HbwP/nFetgiLI0GA8pxPG7fAxvOYO001rJ6WXN4uNp7d+pxM43hKKZ1klmScK6z8jr3XJZno1X1AGGwwQWUP9lBjUuEAdB04t89/1O/w1cDnyilFU=';
        $userId = $luid['line_usrid'];
      
        $messages = array(
            'type' => 'text',
            'text' => 'คุณได้ลูกค้าทดลองขับรถใหม่ จากช่องทางออนไลน์ โปรดติดต่อยืนยันกับลูกค้าโดยเร็วที่สุด'
        );
        $post = json_encode(array(
            'to' => array($userId),
            'messages' => array($messages),
        ));

        $url = 'https://api.line.me/v2/bot/message/multicast';
        $headers = array('Content-Type: application/json', 'Authorization: Bearer '.$access_token);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.line.me/v2/bot/message/multicast");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);

        $result = curl_exec($ch);

        $api = array(
            'status' => 'success',
            'message' => 'ส่งรายการเรียบร้อย'
        );

    } else {
        $api = array(
            'status' => 'error',
            'message' => 'ไม่สามารถส่งรายการได้'
        );
    }
       
    echo json_encode($api);
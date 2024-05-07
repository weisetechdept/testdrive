<?php
    session_start();
    require_once '../../db-conn.php';

    $request = json_decode(file_get_contents('php://input'));

    $id = $request->id;

    if($msg == ''){
        $msg == '';
    } else {
        $msg = ' , '.$request->msg;
    }

    $parent = $db->where('bk_id',$id)->getOne('booking');
    $line = $db_nms->where('id',$parent['bk_parent'])->getOne('db_member');

    echo $id.' - '.$msg.' - '.$line['line_usrid'];

        $access_token = 'GtacKYhQw2Y7U9Wzc8GeNUW32big3VZs4oeUU7U8wEtlPUDq1kLKQYBpD1HbwP/nFetgiLI0GA8pxPG7fAxvOYO001rJ6WXN4uNp7d+pxM43hKKZ1klmScK6z8jr3XJZno1X1AGGwwQWUP9lBjUuEAdB04t89/1O/w1cDnyilFU=';
        
        $userId = $line['line_usrid'];
      
        $messages = array(
            'type' => 'text',
            'text' => '[Test Drive] ID : '.$id.' คุณ'.$parent['bk_fname'].' ยังขาดเอกสาร โปรดอัพโหลด '.$msg
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
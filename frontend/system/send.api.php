<?php

    $access_token = 'GtacKYhQw2Y7U9Wzc8GeNUW32big3VZs4oeUU7U8wEtlPUDq1kLKQYBpD1HbwP/nFetgiLI0GA8pxPG7fAxvOYO001rJ6WXN4uNp7d+pxM43hKKZ1klmScK6z8jr3XJZno1X1AGGwwQWUP9lBjUuEAdB04t89/1O/w1cDnyilFU=';
    //$userId = $member['line_usrid'];
    $userId = 'U6f5da61c00cd349634881dafa7a6e624';
    //$userId = $member['line_usrid'];
    $messages = array(
        'type' => 'text',
        'text' => 'คุณได้ลูกค้าทดลองขับรถใหม่ คุณ โปรดติดต่อยืนยันกับลูกค้าโดยเร็วที่สุด'
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
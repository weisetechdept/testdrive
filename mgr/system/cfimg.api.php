<?php 
        session_start();
        require_once '../../db-conn.php';
        date_default_timezone_set("Asia/Bangkok");

        if($_SESSION['pp_login'] !== true && $_SESSION['pp_permission'] !== 'leader'){
            header('Location: /404');
        }

        $image = $_FILES['file_upload']['tmp_name'];
        $type = mime_content_type($image);
        $name = basename($image);
        
        $url = 'https://api.cloudflare.com/client/v4/accounts/1adf66719c0e0ef72e53038acebcc018/images/v1';
        $cfile = curl_file_create($image, $type, $name);
        $data = array("file" => $cfile);
        
        $headers = [ 
            'Authorization: Bearer x2skj57v2poPW8UxIQGqBACBxkJ4Glg42lVhbDPe',
            'Content-Type: multipart/form-data'
        ];
        
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
     
        print_r($response);

    /*
    { "result": { "id": "8e5ddf43-8c72-4966-5f09-5fa0d271ee00", "filename": "weise-logo.jpg", "uploaded": "2023-10-01T16:39:02.543Z", "requireSignedURLs": false, "variants": [ "https://imagedelivery.net/FG9yH3i4rybjZWgNeKKJvA/8e5ddf43-8c72-4966-5f09-5fa0d271ee00/resize500", "https://imagedelivery.net/FG9yH3i4rybjZWgNeKKJvA/8e5ddf43-8c72-4966-5f09-5fa0d271ee00/public" ] }, "success": true, "errors": [], "messages": [] }
    */

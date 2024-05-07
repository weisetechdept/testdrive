<?php 
        session_start();
        require_once '../../db-conn.php';

        if($_GET['get'] == 'daily'){

            $today = date('Y-m-d');
            $list = $db->where('bk_date',$today,'<')->where('bk_status',0)->get('booking');

            foreach ($list as $value) {

                $data = array(
                    'bk_status' => '10'
                );
                $update = $db->where('bk_id',$value['bk_id'])->update('booking',$data);
            }

        }

        




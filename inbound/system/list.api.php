<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

        if($_SESSION['testdrive_admin'] !== true){
            header('Location: /404');
        } 

    function customTime2($time){

        $alltime = json_decode($time);

        $first = reset($alltime);
        $last = end($alltime);
        
        if($first == '1'){
            $first = '08:00';
        } elseif($first == '2'){
            $first = '08:31';
        } elseif($first == '3'){
            $first = '09:01';
        } elseif($first == '4'){
            $first = '09:31';
        } elseif($first == '5'){
            $first = '10:01';
        } elseif($first == '6'){
            $first = '10:31';
        } elseif($first == '7'){
            $first = '11:01';
        } elseif($first == '8'){
            $first = '11:31';
        } elseif($first == '9'){
            $first = '12:01';
        } elseif($first == '10'){
            $first = '12:31';
        } elseif($first == '11'){
            $first = '13:01';
        } elseif($first == '12'){
            $first = '13:31';
        } elseif($first == '13'){
            $first = '14:01';
        } elseif($first == '14'){
            $first = '14:31';
        } elseif($first == '15'){
            $first = '15:01';
        } elseif($first == '16'){
            $first = '15:31';
        } elseif($first == '17'){
            $first = '16:01';
        } elseif($first == '18'){
            $first = '16:31';
        } elseif($first == '19'){
            $first = '17:01';
        } elseif($first == '20'){
            $first = '17:31';
        }

        if($last == '1'){
            $last = '08:30';
        } elseif($last == '2'){
            $last = '09:00';
        } elseif($last == '3'){
            $last = '09:30';
        } elseif($last == '4'){
            $last = '10:00';
        } elseif($last == '5'){
            $last = '10:30';
        } elseif($last == '6'){
            $last = '11:00';
        } elseif($last == '7'){
            $last = '11:30';
        } elseif($last == '8'){
            $last = '12:00';
        } elseif($last == '9'){
            $last = '12:30';
        } elseif($last == '10'){
            $last = '13:00';
        } elseif($last == '11'){
            $last = '13:30';
        } elseif($last == '12'){
            $last = '14:00';
        } elseif($last == '13'){
            $last = '14:30';
        } elseif($last == '14'){
            $last = '15:00';
        } elseif($last == '15'){
            $last = '15:30';
        } elseif($last == '16'){
            $last = '16:00';
        } elseif($last == '17'){
            $last = '16:30';
        } elseif($last == '18'){
            $last = '17:00';
        } elseif($last == '19'){
            $last = '17:30';
        } elseif($last == '20'){
            $last = '18:00';
        }

        return $first.' - '.$last;

    }

    

    $api = [];
    $branch = '';

    if(isset($_GET['b']) && $_GET['b'] == 'ho'){
        $branch = 'ho';
    } elseif(isset($_GET['b']) && $_GET['b'] == 'tm') {
        $branch = 'tm';
    } else {
        $branch = '';
    }

    function DateThai($strDate)
    {
        $strYear = date("y",strtotime($strDate));
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("j",strtotime($strDate));
    
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    } 

    function getTeam($uid){
        global $db_nms;
        $team = $db_nms->get('db_user_group');
        foreach($team as $t){
            $tm = array_merge(json_decode($t['detail']),json_decode($t['leader']));
            //$team_data = json_decode($t['detail']);
            if(in_array($uid,$tm)){
                return $t['name'];
            }

        }
    }

    function getOwner($id){
        global $db_nms;
        if($id == 'TBR'){
            $owner = 'TBR Fastlane';
        } else {
            $parent = $db_nms->where('id',$id)->getOne('db_member');
            
            if($parent['nickname'] !== ''){
                $nickn = ' ('.$parent['nickname'].')';
            } else {
                $nickn = '';
            }
            $owner = $parent['first_name'].''.$nickn.' - '.getTeam($parent['id']);
        }

        return $owner;
    }

    $sql_details_1 = ['user'=> $usern,'pass'=> $passn,'db'=> $dbn,'host'=> $hostn,'charset'=>'utf8'];
    
    require 'ssp.class.php';

    $table = 'booking';

    $primaryKey = 'bk_id';
    $columns = [
        ['db' => 'bk_id', 'dt' => 0, 'field' => 'bk_id'],
        ['db' => 'bk_fname', 'dt' => 1, 'field' => 'bk_fname'],
        ['db' => 'bk_tel', 'dt' => 2, 'field' => 'bk_tel',
            'formatter' => function($d, $row){
                return '******'.substr($d,6,4);
            }
        ],
        ['db' => 'car_model', 'dt' => 3, 'field' => 'car_model'],
        ['db' => 'bk_date', 'dt' => 4, 'field' => 'bk_date',
            'formatter' => function($d, $row){
                return DateThai($d);
            }
        ],
        ['db' => 'bk_time', 'dt' => 5, 'field' => 'bk_time',
            'formatter' => function($d, $row){
                return customTime2($d);
            }
        ],
        ['db' => 'bk_parent', 'dt' => 6, 'field' => 'bk_parent',
            'formatter' => function($d, $row){
                return getOwner($d);
            }
        ],
        ['db' => 'bk_where', 'dt' => 7, 'field' => 'bk_where',
            'formatter' => function($d, $row){
                if($d == '1'){
                    return '<span class="badge badge-success">ออนไลน์</span>';
                } elseif($d == '2'){
                    return '<span class="badge badge-primary">เซลล์</span>';
                } elseif($d == '3'){
                    return '<span class="badge badge-info">TBR</span>';
                } elseif($d == '4'){
                    return '<span class="badge badge-secondary">Walk-in</span>';
                } elseif($d == '5'){
                    return '<span class="badge badge-secondary">ทำคอนเท้นต์</span>';
                } elseif($d == '6'){
                    return '<span class="badge badge-secondary">ออกบูธ</span>';
                }
            }
        ],
        ['db' => 'bk_status', 'dt' => 8, 'field' => 'bk_status',
            'formatter' => function($d, $row){
                if($d == '0'){
                    return '<span class="badge badge-warning">ยังไม่ทดลองขับ</span>';
                }elseif($d == '1'){
                    return '<span class="badge badge-primary">รับกุญแจ</span>';
                }elseif($d == '2'){
                    return '<span class="badge badge-success">สำเร็จ</span>';
                }elseif($d == '10'){
                    return '<span class="badge badge-danger">ยกเลิก</span>';
                }
            }
        ],
        ['db' => 'bk_id', 'dt' => 9, 'field' => 'bk_id',
            'formatter' => function($d, $row){
                return "<a class=\"btn btn-outline-info btn-sm\" href=\"/admin/de/$d\">ดูข้อมูล</a>";
            }
        ],
    ]; 

    $joinQuery = "FROM car c LEFT JOIN booking b ON c.car_id = b.bk_car";
    
    $where = " c.car_branch IN ('".$branch."')";

    if(isset($_GET['search']['value'])){
        $searchValue = $_GET['search']['value'];
        $joinQuery .= " AND (c.car_model LIKE '%$searchValue%' OR b.bk_id LIKE '%$searchValue%' OR b.bk_fname LIKE '%$searchValue%')";
    }
    
    if (!isset($_GET['columns'])) {
        $_GET['columns'] = [];
    }
    if (!isset($_GET['draw'])) {
        $_GET['draw'] = 1;
    }

    echo json_encode(
        SSP::simple($_GET, $sql_details_1, $table, $primaryKey, $columns, $joinQuery, $where)
    );
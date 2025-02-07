<?php
    session_start();
    require_once 'db-conn.php';

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

    function getSales($uid){
        global $db_nms;
        $member = $db_nms->where('id',$uid)->getOne('db_member');
        return $member['first_name'].' '.$member['last_name'];
    }

    $p = isset($_GET['p']) ? $_GET['p'] : '';
    $date_form = isset($_GET['date_form']) ? $_GET['date_form'] : '';
    $date_to = isset($_GET['date_to']) ? $_GET['date_to'] : '';
?>

<form action="check.php" method="get">
    <input type="text" name="p" placeholder="Threshold" value="90">
    <input type="date" name="date_form" placeholder="Date Form" value="<?php echo $date_form; ?>">
    <input type="date" name="date_to" placeholder="Date To" value="<?php echo $date_to; ?>">
    <button type="submit">ค้นหา</button>
</form>

<?php

if(isset($_GET['p']) && isset($_GET['date_form']) && isset($_GET['date_to'])){

    $api= array();
  
        $check_lname = $db->where('bk_date',$date_form,'>=')->where('bk_date',$date_to,'<=')->where('bk_where',array(2,7),"IN")->where('bk_status',2)->get('booking');
        foreach($check_lname as $cl){

            $api[] = array(
                'id' => $cl['bk_id'],
                'customer_name' => $cl['bk_fname'].' '.$cl['bk_lname'],
                'date' => $cl['bk_date'],
                'saleid' => $cl['bk_parent'],
                'saleman' => getSales($cl['bk_parent']),
                'team' => getTeam($cl['bk_parent'])
            );
            
        }
    
    //$data = json_decode(file_get_contents('data.json'), true); // โหลดข้อมูลจากไฟล์ JSON
    $data = $api;

    $threshold = $p; // กำหนดเปอร์เซ็นต์ความคล้ายกันที่ถือว่าใกล้เคียง
    $groups = [];
    $visited = [];

    // ฟังก์ชันตรวจสอบความคล้ายกันของชื่อ
    function isSimilar($name1, $name2, $threshold) {
        similar_text($name1, $name2, $percent1); // วิธีที่ 1: similar_text()
        $levenshtein = levenshtein($name1, $name2); // วิธีที่ 2: Levenshtein distance
        
        // คำนวณเปอร์เซ็นต์จาก Levenshtein
        $maxLength = max(strlen($name1), strlen($name2));
        $percent2 = (1 - ($levenshtein / $maxLength)) * 100;

        // คำนวณค่าเฉลี่ยของทั้งสองวิธี
        $avgPercent = ($percent1 + $percent2) / 2;

        return $avgPercent >= $threshold;
    }

    // สร้างกราฟของความคล้ายกัน
    $graph = [];
    foreach ($data as $customer) {
        $id = $customer['id'];
        $graph[$id] = [];
    }

    for ($i = 0; $i < count($data); $i++) {
        for ($j = $i + 1; $j < count($data); $j++) {
            $id1 = $data[$i]['id'];
            $id2 = $data[$j]['id'];
            $name1 = $data[$i]['customer_name'];
            $name2 = $data[$j]['customer_name'];

            if (isSimilar($name1, $name2, $threshold)) {
                $graph[$id1][] = $id2;
                $graph[$id2][] = $id1;
            }
        }
    }

    // ฟังก์ชัน DFS เพื่อรวมกลุ่มที่เชื่อมโยงกัน
    function dfs($id, &$group, &$visited, &$graph, &$data) {
        if (isset($visited[$id])) return;
        $visited[$id] = true;

        // ค้นหาข้อมูลลูกค้าจาก ID
        foreach ($data as $customer) {
            if ($customer['id'] == $id) {
                $group[] = [
                    'id' => $customer['id'],
                    'customer_name' => $customer['customer_name'],
                    'date' => $customer['date'],
                    'saleid' => $customer['saleid'],
                    'saleman' => $customer['saleman'],
                    'team' => $customer['team']
                ];
                break;
            }
        }

        foreach ($graph[$id] as $neighbor) {
            dfs($neighbor, $group, $visited, $graph, $data);
        }
    }

    // ค้นหากลุ่มที่เชื่อมโยงกัน
    foreach ($graph as $id => $connections) {
        if (!isset($visited[$id])) {
            $group = [];
            dfs($id, $group, $visited, $graph, $data);
            if (count($group) > 1) {
                $groups[] = $group;
            }
        }
    }

    // แสดงผล
    //echo json_encode($groups, JSON_PRETTY_PRINT);

}

    // $threshold = 90; // กำหนดเปอร์เซ็นต์ความคล้ายกันที่ถือว่าใกล้เคียง
    // $similar_names = [];

    // for ($i = 0; $i < count($data); $i++) {
    //     for ($j = $i + 1; $j < count($data); $j++) {
    //         $id1 = $data[$i]['id'];
    //         $id2 = $data[$j]['id'];
    //         $name1 = $data[$i]['customer_name'];
    //         $name2 = $data[$j]['customer_name'];

    //         // คำนวณความคล้ายกันโดยใช้ similar_text()
    //         similar_text($name1, $name2, $percent);

    //         if ($percent >= $threshold) {
    //             $similar_names[] = [
    //                 'id1' => $id1,
    //                 'id2' => $id2,
    //                 'name1' => $name1,
    //                 'name2' => $name2,
    //                 'similarity' => $percent
    //             ];
    //         }
    //     }
    // }

    // // แสดงผลข้อมูลที่มีความคล้ายกัน
    // echo "รายชื่อที่คล้ายกัน:<br>";
    // foreach ($similar_names as $pair) {
    //     echo "ID: {$pair['id1']} - {$pair['name1']} <-> ID: {$pair['id2']} - {$pair['name2']} ({$pair['similarity']}%)<br>";
    // }

    
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Customer Name</th>
                    <th>Date</th>
                    <th>SaleId</th>
                    <th>Saleman</th>
                    <th>Team</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($groups as $group): ?>
                    <tr class="table-primary">
                        <td colspan="6">Group: <?php echo $group[0]['customer_name']; ?></td>
                    </tr>
                    <?php foreach($group as $customer): ?>
                        <tr>
                            <td><?php echo $customer['id']; ?></td>
                            <td><?php echo $customer['customer_name']; ?></td>
                            <td><?php echo $customer['date']; ?></td>
                            <td><?php echo $customer['saleid']; ?></td>
                            <td><?php echo $customer['saleman']; ?></td>
                            <td><?php echo $customer['team']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>


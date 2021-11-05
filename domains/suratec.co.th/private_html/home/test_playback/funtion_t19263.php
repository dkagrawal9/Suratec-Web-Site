<?php
require_once '../admin/library/connect.php';
// require_once '../admin/library/functions.php';
header('Content-Type: application/json');
date_default_timezone_set("Asia/Bangkok");
$sql = 'SELECT `id`,`action`,`duration`,`left_sensor1`,`left_sensor2`,`left_sensor3`,`left_sensor4`,`left_sensor5`,`right_sensor1`,`right_sensor2`,`right_sensor3`,`right_sensor4`,`right_sensor5`,`id_customer` FROM `surasole` WHERE `id_customer` = "d49738a251a7ecb4a294bnb77946f204b1h" AND DATE(`action`) = "2020-02-19" ORDER BY `id` ASC';

$query = mysqli_query($objConnect, $sql);
$num = mysqli_num_rows($query);

    $count = 0;
    $action = 0;
    $duration = 0;
    $left_sensor = [];
    $right_sensor = [];
    $retData = [];
    $i = 1;
while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    //$result = mysqli_fetch_array($query);
//    var_dump($i);
//    var_dump($result);
    $i++;
    
    $result = mysqli_fetch_array($query);
    $left_1 = $result['left_sensor1'];
    $left_2 = $result['left_sensor2'];
    $left_3 = $result['left_sensor3'];
    $left_4 = $result['left_sensor4'];
    $left_5 = $result['left_sensor5'];
    //$datasum_left = ($left_1.",".$left_2.",".$left_3.",".$left_4.",".$left_5);
    $datasum_left = [$left_1,$left_2,$left_3,$left_4,$left_5];
    $right_1 = $result['right_sensor1'];
    $right_2 = $result['right_sensor2'];
    $right_3 = $result['right_sensor3'];
    $right_4 = $result['right_sensor4'];
    $right_5 = $result['right_sensor5'];
    //$datasum_right = ($right_1.",".$right_2.",".$right_3.",".$right_4.",".$right_5);
    $datasum_right = [$right_1,$right_2,$right_3,$right_4,$right_5];
    array_push($left_sensor, $datasum_left);
    array_push($right_sensor, $datasum_right);
    $duration = $result['duration'];
}

/*if ($count > 0 || $count == 0) {
    $retData[$count]['action'] = $result['action'];
    $retData[$count]['duration'] = $result['duration'];
    $retData[$count]['left'] = $left_sensor;
    $retData[$count]['right'] = $right_sensor;
    $duration = $result['duration'];

}*/
    
                    //print_r($left_sensor);
                    //print_r($right_sensor);
                    //$results = [$duration,$datasum_left,$datasum_right];
                    $results = array('duration' => $duration,'left_sensor'=> $left_sensor,'right_sensor'=> $right_sensor);
                    echo json_encode($results);
?>


<?php
require_once '../admin/library/connect.php';
require_once '../admin/library/functions.php';



//$rrr = getRecordData();
//var_dump($rrr);
// print_r($rrr);

    //  function getRecordData()
    // {
// $id_customer = 'df59f3e3cfdbb73ec3356f1aa38a0boc13e';

if (isset($_POST["id_customer"])) {
    $id_customer = $_POST["id_customer"];
    $playback_type = $_POST["playback_type"];
    $datetimepicker = $_POST["datetimepicker"];
}else{
   $id_customer = 'df59f3e3cfdbb73ec3356f1aa38a0boc13e'; 
   $playback_type = '2';
   $datetimepicker = '2020-02-19';
}

global $objConnect;
global $date;
        $sql_customer = "SELECT * FROM `mod_customer` WHERE `id_customer`= '$id_customer' ";
$query_customer = mysqli_query($objConnect, $sql_customer);
$result_customer = mysqli_fetch_array($query_customer);
        if ($query_customer && $query_customer->num_rows > 0) {

 $sql_surasole = "SELECT * FROM `surasole` WHERE `id_customer`='$id_customer' AND  `type`='$playback_type'  AND date(action) BETWEEN '$datetimepicker' AND '$datetimepicker' ";
$query_surasole = mysqli_query($objConnect, $sql_surasole);
 if ($query_surasole && $query_surasole->num_rows > 0) {
    $data=[];
    while ($result_surasole = mysqli_fetch_array($query_surasole)) {
        $data[] = $result_surasole;
    };
     
          //  $data = Surasole::where('id_customer', $request->customer)->whereDate('action', date("Y-m-d"))->get();
            $count = 0;
            $action = 0;
            $left_sensor = [];
            $right_sensor = [];
            $retData = [];
            $retData1 = [];
            for ($i = 0; $i < count($data); $i++) {
                if ($i != 0) {
                   // echo $data[$i]['duration'] - $data[$i - 1]['duration'];
                    if ($data[$i]['duration'] - $data[$i - 1]['duration'] >= 0) {
                        $lsensor = [$data[$i]['left_sensor1'], $data[$i]['left_sensor2'], $data[$i]['left_sensor3'], $data[$i]['left_sensor4'], $data[$i]['left_sensor5']];
                        $rsensor = [$data[$i]['right_sensor1'], $data[$i]['right_sensor2'], $data[$i]['right_sensor3'], $data[$i]['right_sensor4'], $data[$i]['right_sensor5']];
                        array_push($left_sensor, $lsensor);
                        array_push($right_sensor, $rsensor);
                    } else {
                        $retData[$count]['action'] = $data[$action]['action'];
                        $retData[$count]['duration'] = $data[$i - 1]['duration'];
                        $retData[$count]['left'] = $left_sensor;
                        $retData[$count]['right'] = $right_sensor;
                        $left_sensor = [];
                        $right_sensor = [];
                        $action = $i + 1;
                        $count++;
                       // $retData1[] = $retData;
                        
                    }
                } else {
                    $lsensor = [$data[$i]['left_sensor1'], $data[$i]['left_sensor2'], $data[$i]['left_sensor3'], $data[$i]['left_sensor4'], $data[$i]['left_sensor5']];
                    $rsensor = [$data[$i]['right_sensor1'], $data[$i]['right_sensor2'], $data[$i]['right_sensor3'], $data[$i]['right_sensor4'], $data[$i]['right_sensor5']];
                    array_push($left_sensor, $lsensor);
                    array_push($right_sensor, $rsensor);
                }
       

            }
            // echo "<br>";
            // echo $action;
            if ($count > 0 ) {
                $retData[$count]['action'] = $data[$action-1]['action'];
                $retData[$count]['duration'] = $data[count($data) - 1]['duration'];
                $retData[$count]['left'] = $left_sensor;
                $retData[$count]['right'] = $right_sensor;
            }else{
                $retData[$count]['action'] = $data[$action]['action'];
                $retData[$count]['duration'] = $data[count($data)]['duration'];
                $retData[$count]['left'] = $left_sensor;
                $retData[$count]['right'] = $right_sensor;
            }
           // return $retData;
         // var_dump($retData);
            //print_r($retData1[0]);
            // echo "<br>";
            // print_r($retData);

 }

        } else {
            var_dump($objConnect->error);
        }
   // }


//         print_r($retData);
// echo "<br>";echo "<br>";
// print_r($retData[0]['left']);
  $retData_left  ='';
// echo "<br>";
//   echo count($retData[0]['left']);
    for ($i=0; $i <count($retData[0]['left']) ; $i++) { 
        // print_r($retData[0]['left'][$i]);
        // echo "<br>";
        $retData_left1  ='';
        for ($x=0; $x <count($retData[0]['left'][$i]) ; $x++) { 
        //     print_r($retData[0]['left'][$i][$x]);
        // echo "<br>";
        $retData_left1 .= '"'.$retData[0]['left'][$i][$x].'",';
        }
        $v = substr($retData_left1, 0, -1); 
        $retData_left .= '['.$v.'],';

            // $retData_left .= $retData[0]['left'][$i];
        }    


       
        $retData_left_text = substr($retData_left, 0, -1); 

    ?>



<!-- <select> -->
    <option value="0">เวลา Playback</option>
<?php
     for ($z=0; $z < count($retData); $z++) { 


        ///////////  left  /////
          $retData_left  ='';
 for ($i=0; $i <count($retData[$z]['left']) ; $i++) { 
$retData_left1  ='';
        for ($x=0; $x <count($retData[$z]['left'][$i]) ; $x++) { 
$retData_left1 .= $retData[$z]['left'][$i][$x].',';
        }
        $v = substr($retData_left1, 0, -1); 
        $retData_left .=  $v.'***';
}   
 $retData_left_text = substr($retData_left, 0, -3); 

///////////  left  /////


        ///////////  right  /////
          $retData_right  ='';
 for ($i=0; $i <count($retData[$z]['right']) ; $i++) { 
$retData_right1  ='';
        for ($x=0; $x <count($retData[$z]['right'][$i]) ; $x++) { 
$retData_right1 .= $retData[$z]['right'][$i][$x].',';
        }
        $v = substr($retData_right1, 0, -1); 
        $retData_right .=  $v.'***';
}   
$retData_right_text = substr($retData_right, 0, -3); 

///////////  right  /////

         ?>
          <option value='<?php echo $retData_left_text.'/'.$retData_right_text  ?>'><?php echo $retData[$z]['action'] ?></option> 
         <?php
     }
?>
    
 <!-- </select> 
 -->
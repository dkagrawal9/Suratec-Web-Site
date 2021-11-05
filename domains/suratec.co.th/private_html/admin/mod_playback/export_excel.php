<?php
session_start();
ini_set('display_errors', false);
ini_set('display_startup_errors', false);

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

require_once '../plugins/PHPExcel-1.8/Classes/PHPExcel.php';
require_once '../library/connect.php';


//echo date('H:i:s') , " Create new PHPExcel object" , EOL;
$objPHPExcel = new PHPExcel();



if (isset($_POST["id_customer"])) {
    $id_customer = $_POST["id_customer"];
    $playback_type = $_POST["playback_type"];
    $datetimepicker = $_POST["datetimepicker"];
}else{
   $id_customer = ''; 
   $playback_type = '';
   $datetimepicker = '';
}

	  

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'action')
            ->setCellValue('B1', 'duration')
            ->setCellValue('C1', 'left_sensor1')
            ->setCellValue('D1', 'left_sensor2')
            ->setCellValue('E1', 'left_sensor3')
            ->setCellValue('F1', 'left_sensor4')
            ->setCellValue('G1', 'left_sensor5')
            ->setCellValue('H1', 'left_stride_F')
            ->setCellValue('I1', 'left_stride_M')
            ->setCellValue('J1', 'left_stride_H')
            ->setCellValue('K1', 'left_balance_x')
            ->setCellValue('L1', 'left_balance_y')
            ->setCellValue('M1', 'right_sensor1')
            ->setCellValue('N1', 'right_sensor2')
            ->setCellValue('O1', 'right_sensor3')
            ->setCellValue('P1', 'right_sensor4')
            ->setCellValue('Q1', 'right_sensor5')
            ->setCellValue('R1', 'right_stride_F')
            ->setCellValue('S1', 'right_stride_M')
            ->setCellValue('T1', 'right_stride_H')
            ->setCellValue('U1', 'right_balance_x')
            ->setCellValue('V1', 'right_balance_y')
            ->setCellValue('W1', 'body_COP_x')
            ->setCellValue('X1', 'body_COP_y');
            



$sec =explode(".",$playback_time)[2]; 
$startTime = explode(".",$playback_time)[0];
$addedtime = date("H:i:s", strtotime(explode(".",$playback_time)[0]) + (($sec + 1)));

$strSQL = "SELECT
    surasole.*,
    mod_customer.fname,
    mod_customer.lname
FROM
    `surasole`
LEFT JOIN mod_customer ON mod_customer.id_customer = surasole.id_customer
WHERE surasole.`left_sensor1` < 1024 AND surasole.`left_sensor2` < 1024 AND surasole.`left_sensor3` < 1024 AND surasole.`left_sensor4` < 1024 AND surasole.`left_sensor5` < 1024 AND surasole.`right_sensor1` < 1024 AND surasole.`right_sensor2` < 1024 AND surasole.`right_sensor3` < 1024 AND surasole.`right_sensor4` < 1024 AND surasole.`right_sensor5` < 1024 AND surasole.`id_customer`='$id_customer' AND  surasole.`type`='$playback_type'  AND date(surasole.action) BETWEEN '$datetimepicker $startTime' AND '$datetimepicker $addedtime'";
$result = mysqli_query($objConnect, $strSQL);

$i = 2;



while($objResult = mysqli_fetch_array($result)){
 

  $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $objResult["action"]);

  $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $objResult["duration"]);

  $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $objResult["left_sensor1"]);

  $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $objResult["left_sensor2"]);

  $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $objResult["left_sensor3"]);

  $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $objResult["left_sensor4"]);

  $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $objResult["left_sensor5"]);

  $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, "=(C".$i."+D".$i."+E".$i.")/3"); //$objResult["left_stride_F"]

  $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, "=F".$i); //$objResult["left_stride_M"]

  $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, "=G".$i); //$objResult["left_stride_H"]

  $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, "=E".$i."-D".$i.""); //$objResult["left_balance_x"]

  $objPHPExcel->getActiveSheet()->setCellValue('L' . $i, "=H".$i."-J".$i.""); //$objResult["left_balance_y"]
  

  $objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $objResult["right_sensor1"]);

  $objPHPExcel->getActiveSheet()->setCellValue('N' . $i, $objResult["right_sensor2"]);

  $objPHPExcel->getActiveSheet()->setCellValue('O' . $i, $objResult["right_sensor3"]);

  $objPHPExcel->getActiveSheet()->setCellValue('P' . $i, $objResult["right_sensor4"]);

  $objPHPExcel->getActiveSheet()->setCellValue('Q' . $i, $objResult["right_sensor5"]);

  $objPHPExcel->getActiveSheet()->setCellValue('R' . $i, "=(M".$i."+N".$i."+O".$i.")/3"); //$objResult["right_stride_F"]

  $objPHPExcel->getActiveSheet()->setCellValue('S' . $i, "=P".$i); //$objResult["right_stride_M"]
  
  $objPHPExcel->getActiveSheet()->setCellValue('T' . $i, "=Q".$i); //$objResult["right_stride_H"]

  $objPHPExcel->getActiveSheet()->setCellValue('U' . $i, "=O".$i."-N".$i.""); //$objResult["right_balance_x"]
  
  $objPHPExcel->getActiveSheet()->setCellValue('V' . $i, "=R".$i."-T".$i.""); //$objResult["right_balance_y"]
  
  $objPHPExcel->getActiveSheet()->setCellValue('W' . $i, "=SUM(R".$i.":T".$i.")-SUM(H".$i.":J".$i.")"); //$objResult["body_COP_x"]
  
  $objPHPExcel->getActiveSheet()->setCellValue('X' . $i, "=(H".$i."+R".$i.")-(J".$i."+T".$i.")"); //$objResult["body_COP_y"]

$i++;
}


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 95 file
//echo date('H:i:s') , " Write to Excel5 format" , EOL;
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
// $objWriter->save('populate.xls');

//ตั้งชื่อไฟล์
$time = date("H:i:s");
$date = date("Y-m-d");
list($h,$i,$s) = explode(":",$time);
//$file_name = "".$date."_".$h."_".$i."_".$s."";
$file_name = ".$date.";
 header('Content-type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$file_name.'.xls"');
$objWriter->save('php://output');
?>
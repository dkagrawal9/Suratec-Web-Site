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
            ->setCellValue('C1', 'stamp')
            ->setCellValue('D1', 'left_sensor1')
            ->setCellValue('E1', 'left_sensor2')
            ->setCellValue('F1', 'left_sensor3')
            ->setCellValue('G1', 'left_sensor4')
            ->setCellValue('H1', 'left_sensor5')
            ->setCellValue('I1', 'left_stride_F')
            ->setCellValue('J1', 'left_stride_M')
            ->setCellValue('K1', 'left_stride_H')
            ->setCellValue('L1', 'left_balance_x')
            ->setCellValue('M1', 'left_balance_y')
            ->setCellValue('N1', 'WeChat')
            ->setCellValue('O1', 'left_peak_pressure_position')
            ->setCellValue('P1', 'left_peak_pressure_value')
            ->setCellValue('Q1', 'left_swing_phase')
            ->setCellValue('R1', 'left_stance_phase')
            ->setCellValue('S1', 'right_sensor1')
            ->setCellValue('T1', 'right_sensor2')
            ->setCellValue('U1', 'right_sensor3')
            ->setCellValue('V1', 'right_sensor4')
            ->setCellValue('W1', 'right_sensor5')
            ->setCellValue('X1', 'right_stride_F')
            ->setCellValue('Y1', 'right_stride_M')
            ->setCellValue('Z1', 'right_stride_H')
            ->setCellValue('AA1', 'right_balance_x')
            ->setCellValue('AB1', 'right_balance_y')
            ->setCellValue('AC1', 'right_peak_pressure_position')
            ->setCellValue('AD1', 'right_peak_pressure_value')
            ->setCellValue('AE1', 'right_swing_phase')
            ->setCellValue('AF1', 'right_stance_phase')
            ->setCellValue('AG1', 'body_COP_x')
            ->setCellValue('AH1', 'body_COP_y')
            ->setCellValue('AI1', 'id_customer')
            ->setCellValue('AJ1', 'id_device')
            ->setCellValue('AK1', 'type');





$strSQL = "SELECT
    surasole.*,
    mod_customer.fname,
    mod_customer.lname
FROM
    `surasole`
LEFT JOIN mod_customer ON mod_customer.id_customer = surasole.id_customer
WHERE surasole.`id_customer`='$id_customer' AND  surasole.`type`='$playback_type'  AND date(surasole.action) BETWEEN '$datetimepicker' AND '$datetimepicker'";
$result = mysqli_query($objConnect, $strSQL);
$i = 2;

while($objResult = mysqli_fetch_array($result)){

  $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, "555".$objResult["action"]);

  $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $objResult["duration"]);

  $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $objResult["stamp"]);

  $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $objResult["left_sensor1"]);

  $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $objResult["left_sensor2"]);

  $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $objResult["left_sensor3"]);

  $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $objResult["left_sensor4"]);

  $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $objResult["left_sensor5"]);

  $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, ""); //$objResult["left_stride_F"]

  $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $objResult["left_stride_M"]);

  $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $objResult["left_stride_H"]);

  $objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $objResult["left_balance_x"]);

  $objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $objResult["left_balance_y"]);

  $objPHPExcel->getActiveSheet()->setCellValue('N' . $i, $objResult["WeChat"]);

  $objPHPExcel->getActiveSheet()->setCellValue('O' . $i, $objResult["left_peak_pressure_position"]);

  $objPHPExcel->getActiveSheet()->setCellValue('P' . $i, $objResult["left_peak_pressure_value"]);

  $objPHPExcel->getActiveSheet()->setCellValue('Q' . $i, $objResult["left_swing_phase"]);

  $objPHPExcel->getActiveSheet()->setCellValue('R' . $i, $objResult["left_stance_phase"]);

  $objPHPExcel->getActiveSheet()->setCellValue('S' . $i, $objResult["right_sensor1"]);

  $objPHPExcel->getActiveSheet()->setCellValue('T' . $i, $objResult["right_sensor2"]);

  $objPHPExcel->getActiveSheet()->setCellValue('U' . $i, $objResult["right_sensor3"]);

  $objPHPExcel->getActiveSheet()->setCellValue('V' . $i, $objResult["right_sensor4"]);

  $objPHPExcel->getActiveSheet()->setCellValue('W' . $i, $objResult["right_sensor5"]);

  $objPHPExcel->getActiveSheet()->setCellValue('X' . $i, $objResult["right_stride_F"]);

  $objPHPExcel->getActiveSheet()->setCellValue('Y' . $i, $objResult["right_stride_M"]);
  
  $objPHPExcel->getActiveSheet()->setCellValue('Z' . $i, $objResult["right_stride_H"]);

  $objPHPExcel->getActiveSheet()->setCellValue('AA' . $i, $objResult["right_balance_x"]);
  $objPHPExcel->getActiveSheet()->setCellValue('AB' . $i, $objResult["right_balance_y"]);
  $objPHPExcel->getActiveSheet()->setCellValue('AC' . $i, $objResult["right_peak_pressure_position"]);
  $objPHPExcel->getActiveSheet()->setCellValue('AD' . $i, $objResult["right_peak_pressure_value"]);
  $objPHPExcel->getActiveSheet()->setCellValue('AE' . $i, $objResult["right_swing_phase"]);
  $objPHPExcel->getActiveSheet()->setCellValue('AF' . $i, $objResult["right_stance_phase"]);
  $objPHPExcel->getActiveSheet()->setCellValue('AG' . $i, $objResult["body_COP_x"]);
  $objPHPExcel->getActiveSheet()->setCellValue('AH' . $i, $objResult["body_COP_y"]);
  $objPHPExcel->getActiveSheet()->setCellValue('AI' . $i, $objResult["fname"].' '.$objResult["lname"]);
  $objPHPExcel->getActiveSheet()->setCellValue('AJ' . $i, $objResult["id_device"]);
  $objPHPExcel->getActiveSheet()->setCellValue('AK' . $i, $objResult["type"]);
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
$file_name = "".$date."_".$h."_".$i."_".$s."";
 header('Content-type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$file_name.'.xls"');
$objWriter->save('php://output');
?>
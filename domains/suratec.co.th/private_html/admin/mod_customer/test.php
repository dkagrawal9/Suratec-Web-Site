<?php
require_once '../library/connect.php';
$id_customer = 'df59f3e3cfdbb73ec3356f1aa38a0boc13e';

global $objConnect;
global $date;


$sql_surasole = "SELECT *  FROM `surasole` WHERE `id_customer`='$id_customer' AND  (`action` BETWEEN '2020-02-14 00:00:00' AND '2020-02-14 23:23:23')";
$query_surasole = mysqli_query($objConnect, $sql_surasole);
while ($data = mysqli_fetch_array($query_surasole)) {
	# code...
}





public function getRecordData(Request $request)
    {
        if (Customer::where('id_customer', $request->customer)->exists()) {
            $data = Surasole::where('id_customer', $request->customer)->whereDate('action', date("Y-m-d"))->get();
            $count = 0;
            $action = 0;
            $left_sensor = [];
            $right_sensor = [];
            $retData = [];
            for ($i = 0; $i < count($data); $i++) {
                if ($i != 0) {
                    if ($data[$i]->duration - $data[$i - 1]->duration >= 0) {
                        $lsensor = [$data[$i]->left_sensor1, $data[$i]->left_sensor2, $data[$i]->left_sensor3, $data[$i]->left_sensor4, $data[$i]->left_sensor5];
                        $rsensor = [$data[$i]->right_sensor1, $data[$i]->right_sensor2, $data[$i]->right_sensor3, $data[$i]->right_sensor4, $data[$i]->right_sensor5];
                        array_push($left_sensor, $lsensor);
                        array_push($right_sensor, $rsensor);
                    } else {
                        $retData[$count]['action'] = $data[$action]->action;
                        $retData[$count]['duration'] = $data[$i - 1]->duration;
                        $retData[$count]['left'] = $left_sensor;
                        $retData[$count]['right'] = $right_sensor;
                        $left_sensor = [];
                        $right_sensor = [];
                        $action = $i + 1;
                        $count++;
                    }
                } else {
                    $lsensor = [$data[$i]->left_sensor1, $data[$i]->left_sensor2, $data[$i]->left_sensor3, $data[$i]->left_sensor4, $data[$i]->left_sensor5];
                    $rsensor = [$data[$i]->right_sensor1, $data[$i]->right_sensor2, $data[$i]->right_sensor3, $data[$i]->right_sensor4, $data[$i]->right_sensor5];
                    array_push($left_sensor, $lsensor);
                    array_push($right_sensor, $rsensor);
                }
            }
            if ($count > 0 || $count == 0) {
                $retData[$count]['action'] = $data[$action]->action;
                $retData[$count]['duration'] = $data[count($data) - 1]->duration;
                $retData[$count]['left'] = $left_sensor;
                $retData[$count]['right'] = $right_sensor;
            }
            return $retData;
        } else {
            return $this->responseRequestError();
        }
    }

    ?>
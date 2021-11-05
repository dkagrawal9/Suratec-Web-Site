<?php
	require_once '../admin/library/connect.php';
	header('Content-Type: application/json');

	if(!isset($_SESSION)) {
		session_start();
	}

	$resultArray = array();
	$appSql = "SELECT a.id AS appointment_id,a.cancelable AS cancelable, emp.id_employee, emp.surname AS doctor_name, a.status, a.call_status, a.appointment_date, TIME_FORMAT(a.appointment_time,'%h:%i %p') AS appointment_time, a.created_at as created_at FROM appointments AS a INNER JOIN mod_employee AS emp ON emp.id_employee=a.id_employee WHERE a.id_customer = '".$_SESSION['id_customer']."'";

	$result = $objConnect->query($appSql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_object()){
			$appRow = (array) $row;
			
			$appRow['joinCall'] = false;
			$appointmentDT = date("Y-m-d H:i:s",strtotime($row->appointment_date . ' ' . $row->appointment_time));

			$currentTime = date("Y-m-d H:i:00");
			$endTime = date("Y-m-d H:i:00",strtotime($appointmentDT . " +30 minutes"));

			if ($currentTime >= $appointmentDT AND $currentTime <= $endTime AND $row->status == 5 AND $row->call_status == 1) {
				$appRow['joinCall'] = true;
			}

			if ($currentTime > $endTime AND $row->status == 1) {
				$appRow['status'] = 4;
			}

			array_push($resultArray, $appRow);
		}
	}   

	echo json_encode(['data'=> $resultArray]);
	exit;
?>

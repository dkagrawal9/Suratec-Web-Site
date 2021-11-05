<?php
	require_once '../library/connect.php';
	header('Content-Type: application/json');

	if(!isset($_SESSION)) {
		session_start();
  }
  
  $sqlMember = "SELECT id_data_role FROM tbl_member WHERE id_member = '".$_SESSION['user_member']."'";
  $member = $objConnect->query($sqlMember)->fetch_object();

	$resultArray = array();
	$appSql = "SELECT a.id AS channel_id, c.id_customer, c.fname, c.age, a.status, a.appointment_date, TIME_FORMAT(a.appointment_time,'%h:%i %p') AS appointment_time, a.created_at as created_at FROM appointments AS a INNER JOIN mod_customer AS c ON c.id_customer=a.id_customer WHERE a.id_employee = '$member->id_data_role'";

	$result = $objConnect->query($appSql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_object()){
			$appRow = (array) $row;
			$appRow['startCall'] = false;

			$appointmentDT = date("Y-m-d H:i:s",strtotime($row->appointment_date . ' ' . $row->appointment_time));

			$currentTime = date("Y-m-d H:i:00");
			$endTime = date("Y-m-d H:i:00",strtotime($appointmentDT . " +30 minutes"));
			if ($currentTime >= $appointmentDT AND $currentTime <= $endTime AND $row->status == 5) {
				$appRow['startCall'] = true;
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

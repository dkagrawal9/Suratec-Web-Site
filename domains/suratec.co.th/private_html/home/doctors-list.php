<?php
	require_once '../admin/library/connect.php';
	header('Content-Type: application/json');

	if(!isset($_SESSION)) {
		session_start();
	}

	$resultArray = array();
	$sqlDr = "SELECT id_employee, surname, email FROM mod_employee WHERE role_id='u6c21d97c94895ab1f58e1db5dde1c9080g'";
	
	$result = $objConnect->query($sqlDr);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_object()){
			$appRow = (array) $row;			
			$appRow['surname'] = "<a href='/home/doctor-profile.php?profile=".$appRow['id_employee']."' target='_blank'>".$appRow['surname']."</a>";
			$appRow['id_customer'] = $_SESSION["id_customer"];
			array_push($resultArray, $appRow);
		}
	}   

	echo json_encode(['data'=> $resultArray]);
	exit;
?>

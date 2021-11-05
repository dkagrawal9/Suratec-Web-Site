<?php
	require_once '../admin/library/connect.php';
	header('Content-Type: application/json');

	if(!isset($_SESSION)) {
		session_start();
	}

	$id_customer = $_SESSION['id_customer'];
	$resultArray = array();
	$notifSql = "SELECT id AS notification_id, details, `status`, created_at FROM notifications WHERE id_user='$id_customer' ORDER BY created_at DESC";

	$result = $objConnect->query($notifSql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_object()){
			$appRow = (array) $row;
			array_push($resultArray, $appRow);
		}
	}   

	echo json_encode(['data'=> $resultArray]);
	exit;
?>

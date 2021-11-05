<?php
	require_once '../library/connect.php';
	header('Content-Type: application/json');

	if(!isset($_SESSION)) {
		session_start();
  }
  
  $sqlMember = "SELECT id_data_role FROM tbl_member WHERE id_member = '".$_SESSION['user_member']."'";
  $member = $objConnect->query($sqlMember)->fetch_object();
  
	$resultArray = array();
	$notifSql = "SELECT id AS notification_id, details, `status`, created_at FROM notifications WHERE id_user='$member->id_data_role' ORDER BY created_at DESC";

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

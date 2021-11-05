<?php
	require_once '../library/connect.php';

	header('Content-Type: application/json');

	if(!isset($_SESSION)) {
		session_start();
	}
	$errors = [];

	try {
		// Validate request
		if (!empty($_POST)) {
			$id = !empty($_POST['id']) ? $_POST['id'] : '';

			$sqlMember = "SELECT id_data_role FROM tbl_member WHERE id_member = '".$_SESSION['user_member']."'";
  		$member = $objConnect->query($sqlMember)->fetch_object();

			$delQuery = "UPDATE notifications SET `status`=2 WHERE id='$id' AND id_user='$member->id_data_role'";

			if ($objConnect->query($delQuery) === TRUE) {
				echo json_encode(['status'=> 200,'message'=> 'Notification marked read']);exit;
			} else {
				echo json_encode(['status'=> 401,'message'=>$objConnect->error]);exit;
			}
			
		}else{
			echo json_encode(['status'=> 401,'message' => 'Invalid request']);exit;
		}
	} catch (\Throwable $th) {
		echo json_encode(['status'=> 401,'message'=>$th->getErrorMessage()]);exit;
	}

?>

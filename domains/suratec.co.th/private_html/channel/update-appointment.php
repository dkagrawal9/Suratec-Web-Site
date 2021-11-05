<?php
	require_once '../admin/library/connect.php';

	header('Content-Type: application/json');

	if(!isset($_SESSION)) {
		session_start();
	}
	$errors = [];

	try {
		// Validate request
		if (!empty($_POST)) {
			$id = !empty($_POST['channelId']) ? $_POST['channelId'] : '';

			$delQuery = "UPDATE appointments SET `call_status`=1 WHERE id='$id'";

			if ($objConnect->query($delQuery) === TRUE) {
				echo json_encode(['status'=> 200,'message'=> 'Appointment call status updated successfully']);exit;
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

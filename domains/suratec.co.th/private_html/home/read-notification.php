<?php
	require_once '../admin/library/connect.php';
	require_once '../admin/library/functions.php';

	header('Content-Type: application/json');

	if(!isset($_SESSION)) {
		session_start();
	}
	$errors = [];

	try {
		// Validate request
		if (!empty($_POST)) {
			$id = !empty($_POST['id']) ? $_POST['id'] : '';
			$id_customer = $_SESSION['id_customer'];

			$delQuery = "UPDATE notifications SET `status`=2 WHERE id='$id' AND id_user='$id_customer'";

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

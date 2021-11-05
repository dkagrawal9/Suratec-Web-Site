<?php
	require_once '../library/connect.php';
	header('Content-Type: application/json');

	if(!isset($_SESSION)) {
		session_start();
	}

	$sqlMember = "SELECT id_data_role FROM tbl_member WHERE id_member = '".$_SESSION['user_member']."'";
	$member = $objConnect->query($sqlMember)->fetch_object();

	$result = ['status'=> 401,'message' => 'Invalid request'];
	try {
		// Validate request
		if (!empty($_POST)) {
			$id = !empty($_POST['id']) ? $_POST['id'] : '';
			$status = !empty($_POST['status']) ? $_POST['status'] : '';

			if ($status == 5) {
				$statusText = "Appointment accepted successfully";
			}else{
				$statusText = "Appointment rejected successfully";
			}

			$delQuery = "UPDATE appointments SET `status`='$status' WHERE id='$id' AND id_employee='$member->id_data_role'";

			if ($objConnect->query($delQuery) === TRUE) {
				$result = (['status'=> 200,'message'=> $statusText]);
			} else {
				$result = (['status'=> 401,'message'=>$objConnect->error]);
			}

		}else{
			$result = (['status'=> 401,'message' => 'Invalid request']);
		}
	} catch (\Throwable $th) {
		$result = (['status'=> 401,'message'=>$th->getErrorMessage()]);
	}


	echo json_encode($result);
	exit;

?>

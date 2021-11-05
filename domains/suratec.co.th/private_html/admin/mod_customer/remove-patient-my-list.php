<?php
	require_once '../library/connect.php';
	header('Content-Type: application/json');

	if(!isset($_SESSION)) {
		session_start();
	}

	$sqlMember = "SELECT id_data_role FROM tbl_member WHERE id_member = '".$_SESSION['user_member']."'";
	$member = $objConnect->query($sqlMember)->fetch_object();

	$response = ['status'=> 401,'message' => 'Invalid request'];

	try {
		// Validate request
		if (!empty($_POST)) {
			$id_customer = !empty($_POST['id_customer']) ? $_POST['id_customer'] : '';

			$delQuery = "UPDATE mod_customer SET `assigned_dr`=null WHERE id_customer='$id_customer'";

			if ($objConnect->query($delQuery) === TRUE) {
				$response = ['status'=> 200,'message'=> 'Patient remove from your list successfully'];
			} else {
				$response = ['status'=> 401,'message'=>$objConnect->error];
			}
			
		}else{
			$response = ['status'=> 401,'message' => 'Invalid request'];
		}
	} catch (\Throwable $th) {
		$response = ['status'=> 401,'message'=>$th->getErrorMessage()];
	}




	echo json_encode($response);
	exit;
?>

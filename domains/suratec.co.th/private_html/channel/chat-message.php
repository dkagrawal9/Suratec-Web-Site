<?php
	require_once '../admin/library/connect.php';

	header('Content-Type: application/json');

	if(!isset($_SESSION)) {
		session_start();
	}

	try {
		// Validate request
		if (!empty($_POST)) {
			$channel = !empty($_POST['channel']) ? $_POST['channel'] : '';
			$message = !empty($_POST['message']) ? $_POST['message'] : '';
			$user_id = !empty($_POST['user_id']) ? $_POST['user_id'] : '';
			$unread = !empty($_POST['unread']) ? 1 : 0;

			$delQuery = "INSERT INTO chats (channel,user_id,message,unread) VALUES('$channel','$user_id','$message',$unread)";

			if ($objConnect->query($delQuery) === TRUE) {
				echo json_encode(['status'=> 200,'message'=> 'Message added successfully']);exit;
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

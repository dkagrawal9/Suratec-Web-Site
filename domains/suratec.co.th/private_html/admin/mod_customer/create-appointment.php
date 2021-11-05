<?php
	require_once '../library/connect.php';
	require_once '../library/functions.php';

	header('Content-Type: application/json');

	if(!isset($_SESSION)) {
		session_start();
	}

	$response = ['status'=> 401,'errors'=> ['create_error'=>'Invalid data request']];
	//echo json_encode($response);exit;
	$errors = [];

	try {
		// Validate request
		if (!empty($_POST)) {
			$id_customer = !empty($_POST['id_customer']) ? $_POST['id_customer'] : '';
			$appointment_date = !empty($_POST['appointment_date']) ? $_POST['appointment_date'] : '';
			$appointment_time = !empty($_POST['appointment_time']) ? $_POST['appointment_time'] : '';
			
			$validAppointmentDate = strtotime(date("Y-m-d",strtotime($appointment_date)));
			$validAppointmentTime = strtotime(date("Y-m-d H:i:s",strtotime($appointment_date . " " . $appointment_time)));
			$todayDate = strtotime(date("Y-m-d"));
			$nowInt = strtotime(date("Y-m-d H:i:s"));

			// Validate request data
			if (validatePatient($id_customer) == false) {
				$errors['id_customer'] = 'Invalid Patient, please select valid';
			}
			if ($validAppointmentDate < $todayDate) {
				$errors['appointment_date'] = 'Appointment date cannot be in past';
			}
			if ($validAppointmentTime < $nowInt) {
				$errors['appointment_time'] = 'Invalid Appointment time, select valid';
			}
			if (validateBookingSlot($appointment_time) == false) {
				$errors['appointment_time'] = 'Invalid time slot, select valid';
			}

			// Get doctor id
			$sqlMember = "SELECT id_data_role FROM tbl_member WHERE id_member = '".$_SESSION['user_member']."'";
  			$member = $objConnect->query($sqlMember)->fetch_object();
  			$id_employee = $member->id_data_role;

			// Check for duplicate Appointment
			$appointmentData = [
				'id_employee' => $id_employee,
				'id_customer' => $id_customer,
				'appointment_date' => $appointment_date,
				'appointment_time' => $appointment_time,
			];
			if (validateDuplicateAppointment($appointmentData)==true) {
				$errors['appointment_exists'] = 'Appointment already exists with patient and appointment date time, please select different';
			}
			if (appointmentBookedForDay($appointmentData)==true) {
				$errors['appointment_exists'] = 'You have already booked an appointment for date ' . $appointment_date;
			}

			$employee_uid = rand(1523523,2523523);
			$customer_uid = rand(3523523,4523523);

			// Create an Appointment
			$id = setMD5();
			$insQuery = "
				INSERT INTO appointments (id, id_employee, id_customer, employee_uid, customer_uid, cancelable, status, appointment_date, appointment_time) 
				VALUES('".$id."','".$appointmentData['id_employee']."','".$id_customer."','".$employee_uid."','".$customer_uid."',1,1,'".$appointmentData['appointment_date']."','".$appointmentData['appointment_time']."');
			";

			// Check if any error
			if (count($errors) == 0) {
				if ($objConnect->query($insQuery) === TRUE) {
					
					// Send email and web notification
					$appointmentData['id_customer'] = $id_customer;
					sendAppointmentEmailWebNotif($appointmentData);

					$response = ['status'=> 200,'message'=> 'Appointment created successfully'];
				} else {
					$response = ['status'=> 401,'errors'=> ['create_error'=>$objConnect->error]];
				}
			}else{
				$response = ['status'=> 401,'errors'=> $errors];
			}
			
		}else{
			 $response = ['status'=> 401,'errors'=> ['create_error'=>'Invalid request']];
		}
	} catch (\Throwable $th) {
		$response = ['status'=> 401,'errors'=> ['create_error'=>$th->getErrorMessage()]];
	}
	echo json_encode($response);exit;

?>

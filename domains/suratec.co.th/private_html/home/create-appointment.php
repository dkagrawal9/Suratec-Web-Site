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
			$id_employee = !empty($_POST['id_employee']) ? $_POST['id_employee'] : '';
			$appointment_date = !empty($_POST['appointment_date']) ? $_POST['appointment_date'] : '';
			$appointment_time = !empty($_POST['appointment_time']) ? $_POST['appointment_time'] : '';
			$id_customer = $_SESSION['id_customer'];
			
			$validAppointmentDate = strtotime(date("Y-m-d",strtotime($appointment_date)));
			$validAppointmentTime = strtotime(date("Y-m-d H:i:s",strtotime($appointment_date . " " . $appointment_time)));
			$todayDate = strtotime(date("Y-m-d"));
			$nowInt = strtotime(date("Y-m-d H:i:s"));

			// Validate request data
			if (validateDoctor($id_employee) == false) {
				$errors['id_employee'] = 'Invalid Doctor, please select valid';
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

			// Check for duplicate Appointment
			$appointmentData = [
				'id_employee' => $id_employee,
				'id_customer' => $id_customer,
				'appointment_date' => $appointment_date,
				'appointment_time' => $appointment_time,
			];
			if (validateDuplicateAppointment($appointmentData)==true) {
				$errors['appointment_exists'] = 'Appointment already exists with doctor and appointment date time, please select different';
			}
			if (appointmentBookedForDay($appointmentData)==true) {
				$errors['appointment_exists'] = 'You have already booked an appointment for date ' . $appointment_date;
			}

			$employee_uid = rand(1523523,2523523);
			$customer_uid = rand(3523523,4523523);

			// Create an Appointment
			$id = setMD5();
			$insQuery = "
				INSERT INTO appointments (id, id_employee, id_customer, employee_uid, customer_uid, status, appointment_date, appointment_time) 
				VALUES('".$id."','".$appointmentData['id_employee']."','".$id_customer."','".$employee_uid."','".$customer_uid."',1,'".$appointmentData['appointment_date']."','".$appointmentData['appointment_time']."');
			";

			// Check if any error
			if (count($errors) == 0) {
				if ($objConnect->query($insQuery) === TRUE) {
					
					// Send email and web notification
					$appointmentData['id_customer'] = $id_customer;
					sendAppointmentEmailWebNotif($appointmentData);

					echo json_encode(['status'=> 200,'message'=> 'Appointment booked successfully']);exit;
				} else {
					echo json_encode(['status'=> 401,'errors'=> ['create_error'=>$objConnect->error]]);exit;
				}
			}else{
				echo json_encode(['status'=> 401,'errors'=> $errors]);exit;
			}
			
		}else{
			echo json_encode(['status'=> 401,'message' => 'Invalid request']);exit;
		}
	} catch (\Throwable $th) {
		echo json_encode(['status'=> 401,'errors'=> ['create_error'=>$th->getErrorMessage()]]);exit;
	}

?>

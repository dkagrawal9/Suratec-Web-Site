<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Appointment;
use App\Employee;
use App\Customer;
use App\Notification;
use App\Member;
use App\Device;

class AppointmentController extends Controller
{

    /**
    * Get all customers/patient list
    *
    * @param  String $id_customer
    * @return HTTP Response
    */
    public function patientsAppointments(Request $request,$id_customer)
    {
        $appointments = Appointment::where('id_customer',$id_customer);
        if(isset($request->status) && $request->status){
            $appointments = $appointments->where('status',$request->status);
        }        
        $appointments = $appointments->get()->map(function($appointment){
            $appointment['startCall'] = false;
            $appointment['joinCall'] = false;
            $appointmentDT = date("Y-m-d H:i:s",strtotime($appointment->appointment_date . ' ' . $appointment->appointment_time));
            $currentDT = date("Y-m-d H:i:s");
            if ($currentDT > $appointmentDT AND $appointment->status == 5 AND $appointment->call_status == 1) {
				$appointment['joinCall'] = true;
			}
            return $appointment;
        });
        return response()->json(['data' => $appointments], 200);
    }

    /**
    * Get all doctors/employee list
    *
    * @param  String $id_employee
    * @return HTTP Response
    */
    public function doctorsAppointments(Request $request,$id_employee)
    {
        $appointments = Appointment::where('id_employee',$id_employee);
        if(isset($request->status) && $request->status){
            $appointments = $appointments->where('status',$request->status);
        }        
        $appointments = $appointments->get()->map(function($appointment){
            $appointment['joinCall'] = false;
            $appointment['startCall'] = false;
            $appointmentDT = date("Y-m-d H:i:s",strtotime($appointment->appointment_date . ' ' . $appointment->appointment_time));
            $currentDT = date("Y-m-d H:i:s");
            if ($currentDT > $appointmentDT AND $appointment->status == 5) {
				$appointment['startCall'] = true;
            }
            return $appointment;
        });
        return response()->json(['data' => $appointments], 200);
    }

    /**
    * Create an Appointment
    *
    * @param  Request $request
    * @return HTTP Response
    */
    public function create(Request $request)
    {

        // Request validation
        $validator = \Validator::make($request->all(), [
            'id_employee' => 'required',
            'id_customer' => 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'data_role' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'validation_errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Data validation
        $validAppointmentDate = strtotime(date("Y-m-d",strtotime($request->appointment_date)));
        $validAppointmentTime = strtotime(date("Y-m-d H:i:s",strtotime($request->appointment_date . " " . $request->appointment_time)));
        $todayDate = strtotime(date("Y-m-d"));
        $nowInt = strtotime(date("Y-m-d H:i:s"));

        $errors = [];
        $validDoctor = $this->validateDoctor($request->id_employee);
        $validPatient = $this->validatePatient($request->id_customer);
        $bookingSlot = collect($this->getBookingTime())->get($request->appointment_time);


        if ($validDoctor == false) {
            $errors[] = 'Invalid Doctor id';
        }
        if ($validPatient == false) {
            // $errors['id_customer'] = 'Invalid Customer/Patient id';
            $errors[] = 'Invalid Customer/Patient id';
        }
        if ($validAppointmentDate < $todayDate) {
            // $errors['appointment_date'] = 'Appointment date cannot be in past';
            $errors[] = 'Appointment date cannot be in past';
        }
        if ($validAppointmentTime < $nowInt) {
            // $errors['appointment_time'] = 'Invalid Appointment time';
            $errors[] = 'Invalid Appointment time';
        }
        if ($bookingSlot == null) {
            // $errors['appointment_time'] = 'Invalid time slot';
            $errors[] = 'Invalid time slot';
        }
        if ($this->validateDuplicateAppointment($request)==true) {
            // $errors['appointment_exists'] = 'Appointment already booked with doctor and appointment date time';
            $errors[] = 'Appointment already booked with doctor and appointment date time';
        }
        if ($this->appointmentBookedForDay($request)==true) {
            // $errors['appointment_exists'] = 'You have already booked an appointment for date ' . $request->appointment_date;
            $errors[] = 'You have already booked an appointment for date ' . $request->appointment_date;
        }


        if (!empty($errors)) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'validation_errors',
                'errors' => $errors
            ], 422);
        }

        // Create an appointment
        $appointment = new Appointment();
        $appointment->id = $this->setMD5();
        $appointment->id_employee = $request->id_employee;
        $appointment->id_customer = $request->id_customer;
        $appointment->employee_uid = rand(1523523,2523523);
        $appointment->customer_uid = rand(3523523,4523523);
        $appointment->status  = 1;
        $appointment->appointment_date = $request->appointment_date;
        $appointment->appointment_time = $request->appointment_time;
        if ($appointment->save()) {
            if($request->data_role == "mod_employee"){
                $getEmployeeName = Employee::where('id_employee',$request->id_employee)->first();
                $empname = $getEmployeeName->username ." ". $getEmployeeName->surname;
                $getCustomerName = Customer::where('id_customer',$request->id_customer)->first();
                $name = $getCustomerName->fname ." ". $getCustomerName->lname;
                $getCustomer = Device::where('user_id',$request->id_customer)->first();
                if($getCustomer){
                   $this->sendNotification($getCustomer->device_type,$title="Appointment",$msg="Appointment created by $empname",$getCustomer->device_id,$appointment);
                    
                }
            }else{
                $getCustomerName = Customer::where('id_customer',$request->id_customer)->first();
                $custname = $getCustomerName->fname ." ". $getCustomerName->lname;
                $getEmployeeName = Employee::where('id_employee',$request->id_employee)->first();
                $name = $getEmployeeName->username ." ". $getEmployeeName->surname;
                $getCustomer = Device::where('user_id',$request->id_employee)->first();
                if($getCustomer){
                    $this->sendNotification($getCustomer->device_type,$title="Appointment",$msg="Appointment created by $custname",$getCustomer->device_id,$appointment);
                    
                }
            }
            // Send web and email notification
            $this->sendAppointmentEmailWebNotif($request);
            return response()->json(['status' => 'OK','message' => 'Appointment create successfully'], 201);
        }else{
            return response()->json(['status' => 'ERROR','message' => 'Unable to create an Appointment'], 401);
        }

        // return response()->json(['status' => 'OK','message' => 'Appointment created successfully'], 201);

        // $problem->product_id = $request->product_id;

    }

    public function sendNotification($type,$title,$msg,$deviceID,$payload,$mytype = '')
    {
        if ($type != 0) {
            $fields['notification'] = array(
                'title' => $title,
                'body' => $msg,
                'sound' => 'mySound',
                /*  'type' => $type, */
            );
        } 
        
        $message_data['data']['title'] =  $title;
        $message_data['data']['message'] =  $msg;
        $message_data['data']['type'] =  ($mytype == '')?'appointment':$mytype;
        $message_data['data']['date'] =  date("Y-m-d H:i:s");
        $message_data['data']['payload'] =  $payload;
                
        if (!empty($message_data['data'])) {

            $fields['data'] = $message_data['data'];
        }
        //dd($fields['data']);
        $fields['to'] = $deviceID;
        
        $headers = array(
            'Authorization: key=' . env("FIREBASE_API_ACCESS_KEY"),
            'Content-Type: application/json'
        );
        //dd($headers);
        #Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        
        curl_close($ch);
        
        return $result;
    }

    /**
    * Validate if booking is booked for the day or not
    * Only one booking can be done in single day
    *
    * @param  Array id_customer, appointment date, appointment time
    * @return Boolean TRUE if valid, otherwise FALSE
    */
    private function appointmentBookedForDay($data)
    {
        $appointment = Appointment::where('id_customer',$data->id_customer)
        ->where('status',1)
        ->where('appointment_date',$data->appointment_date)
        ->count();

        if (!empty($appointment)) {
            return true;
        }else{
            return false;
        }
    }

    /**
    * Validate if booking is already exists or not
    *
    * @param  Array id_employee, appointment date, appointment time
    * @return Boolean TRUE if valid, otherwise FALSE
    */
    private function validateDuplicateAppointment($data)
    {
        $appointment = Appointment::where('id_employee',$data->id_employee)
        ->where('status',1)
        ->where('appointment_date',$data->appointment_date)
        ->where('appointment_time',$data->appointment_time)
        ->count();

        if (!empty($appointment)) {
            return true;
        }else{
            return false;
        }
    }


    /**
    * Validate Patient/Customer
    *
    * @param  String $id_customer
    * @return Boolean TRUE is valid, otherwise FALSE
    */
    private function validatePatient($id_customer = '')
    {
        $patient = Customer::where('id_customer',$id_customer)->count();

        if (!empty($patient)) {
            return true;
        }else{
            return false;
        }
    }

    /**
    * Validate Doctor
    *
    * @param  String $id_employee
    * @return Boolean TRUE is valid, otherwise FALSE
    */
    private function validateDoctor($id_employee = '')
    {
        $doctor = Employee::where('id_employee',$id_employee)->where('role_id','u6c21d97c94895ab1f58e1db5dde1c9080g')->count();

        if (!empty($doctor)) {
            return true;
        }else{
            return false;
        }
    }

    /**
    * Get Booking time frame
    *
    * @return Array booking time list
    */
    public function getBookingTime(){
        return [
            '08:00:00' => '08:00 AM', '08:30:00' => '08:30 AM', '09:00:00' => '09:00 AM', '09:30:00' => '09:30 AM', '10:00:00' => '10:00 AM',
            '10:30:00' => '10:30 AM', '11:00:00' => '11:00 AM', '11:30:00' => '11:30 AM', '13:00:00' => '01:00 PM', '13:30:00' => '01:30 PM', '14:00:00' => '02:00 PM',
            '14:30:00' => '02:30 PM', '15:00:00' => '03:00 PM', '15:30:00' => '03:30 PM', '16:00:00' => '04:00 PM', '16:30:00' => '04:30 PM',
            '17:00:00' => '05:00 PM'
        ];
    }

    private function setMD5(){

        $passuniq = uniqid();
        $passmd5 = md5($passuniq);
        $sumlenght = strlen($passmd5);#num passmd5
        $letter_pre = chr(rand(97,122));#set char for prefix
        $letter_post = chr(rand(97,122));#set char for postfix
        $letter_mid = chr(rand(97,122));#set char for middle string
        $num_rand = rand(0,$sumlenght);#random for cut passmd5
        $cut_pre = substr($passmd5,0,$num_rand);#cutmd5 start 0 stop $numrand
        $setmid = $cut_pre.$letter_mid;#set pre string + char middle
        $cut_post = substr($passmd5,$num_rand, $sumlenght+1);
        $set_modify_md5 = $letter_pre.$setmid.$cut_post.$letter_post;
        return $set_modify_md5;

    }

    /**
    * Send Web and Email notification for Appointment
    *
    * @param  Array Appointment details
    * @return void
    */
    function sendAppointmentEmailWebNotif($request)
    {
        try {

            $doctor = Employee::find($request->id_employee);
            $patient = Customer::find($request->id_customer);
            $patientFullName = $patient->fname . ' ' . $patient->lname;

            // Get patient username
            $member = Member::where('id_data_role',$patient->id_customer)->first();

            $appointmentDate = $request->appointment_date;
            $appointmentTime = date("h:i a",strtotime($request->appointment_date . " " . $request->appointment_time));


            // Send web notification to Doctor
            $details = 'New Appointment is booked with Patient name: '.$patientFullName.', Age: '.$patient->age.' and Appointment Date and time: ' . $appointmentDate . ' ' . $appointmentTime;
            $doctorNotif = new Notification;
            $doctorNotif->id = $this->setMD5();;
            $doctorNotif->id_user = $doctor->id_employee;
            $doctorNotif->details = $details;
            $doctorNotif->status = 1;
            $doctorNotif->save();

            // Send web notification to patient
            $details = 'Appointment booked successfully with Date and time: ' . $appointmentDate . ' ' . $appointmentTime;
            $patientNotif = new Notification;
            $patientNotif->id = $this->setMD5();;
            $patientNotif->id_user = $patient->id_customer;
            $patientNotif->details = $details;
            $patientNotif->status = 1;
            $patientNotif->save();


            // Send email to Doctor
            $DR = DIRECTORY_SEPARATOR;
            $template_path = base_path("public".$DR."templates".$DR."appointment_doctor.html");
            if (file_exists($template_path)) {
                
                $htmlReplace = [
                    '{{PATIENT_USERNAME}}' => $member->user_member,
                    '{{PATIENT_NAME}}' => $patientFullName,
                    '{{PATIENT_AGE}}' => $patient->age,
                    '{{PATIENT_EMAIL}}' => $patient->email,
                    '{{APPOINTMENT_DATE}}' => $appointmentDate,
                    '{{APPOINTMENT_TIME}}' => $appointmentTime,
                    '{{APPOINTMENT_LINK}}' => 'https://www.suratec.co.th/admin/mod_customer/appointments.php'
                ];
                $htmlDoctor = file_get_contents($template_path);
                $htmlDoctor = str_replace(array_keys($htmlReplace),$htmlReplace,$htmlDoctor);

                $data = [
                    'email' => $doctor->email,
                    'name' => $doctor->surname,
                    'body' => $htmlDoctor
                ];
                Mail::send([], [], function($message) use ($data) {
                    $message
                    ->to($data['email'], $data['name'])
                    ->subject('New Appointment')
                    ->setBody($data['body'], 'text/html');

                    $message->from('support@suratec.co.th','Suratec');
                });
            }

            // Send email to Patient
            $template_path = base_path("public".$DR."templates".$DR."appointment_patient.html");
            if (file_exists($template_path)) {
                
                $htmlReplace = [
                    '{{APPOINTMENT_DATE}}' => $appointmentDate,
                    '{{APPOINTMENT_TIME}}' => $appointmentTime,
                    '{{APPOINTMENT_LINK}}' => 'https://www.suratec.co.th/home/appointments.php?profile=st'
                ];
                $htmlPatient = file_get_contents($template_path);
                $htmlPatient = str_replace(array_keys($htmlReplace),$htmlReplace,$htmlPatient);
                
                $data = [
                    'email' => $patient->email,
                    'name' => $patientFullName,
                    'body' => $htmlPatient
                ];
                Mail::send([], [], function($message) use ($data) {
                    $message
                    ->to($data['email'], $data['name'])
                    ->subject('Appointment Booked!!!')
                    ->setBody($data['body'], 'text/html');
                    $message->from('support@suratec.co.th','Suratec');
                });
            }          

        } catch (\Throwable $th) {
            // throw $th;
        }

    }


    /**
    * Cancel an Appointment
    *
    * @param  String $id_customer
    * @param  String $id_appointment
    * @return HTTP Response
    */
    public function cancelAppointment($id_appointment = '', $id_customer ='',$status ='')
    {
        $validCustomer = $this->validatePatient($id_customer);
        if ($validCustomer == false) {
            return response()->json(['status' => 'ERROR', 'message' => 'Patient not found'], 404);
        }

        $appointment = Appointment::where('id',$id_appointment)->where('id_customer',$id_customer)->first();

        if ($appointment == null) {
            return response()->json(['status' => 'ERROR', 'message' => 'Appointment not found'], 404);
        }

        $appointment->status = $status; //6 dr//pt 2
        if ($appointment->save()) {
            $appointments = Appointment::where('id',$id_appointment)->where('id_customer',$id_customer)->first();
            if($status == "6"){
                $getEmployeeName = Employee::where('id_employee',$appointments->id_employee->id_employee)->first();
                $empname = $getEmployeeName->username ." ". $getEmployeeName->surname;
                $getCustomerName = Customer::where('id_customer',$appointments->id_customer->id_customer)->first();
                $name = $getCustomerName->fname ." ". $getCustomerName->lname;
                $getCustomer = Device::where('user_id',$appointments->id_customer->id_customer)->first();
                
                if($getCustomer){
                   $this->sendNotification($getCustomer->device_type,$title="Appointment",$msg="Appointment Rejected  by $empname",$getCustomer->device_id,$appointment);
                    
                }
            }elseif($status == "5"){
                $getEmployeeName = Employee::where('id_employee',$appointments->id_employee->id_employee)->first();
                $empname = $getEmployeeName->username ." ". $getEmployeeName->surname;
                $getCustomerName = Customer::where('id_customer',$appointments->id_customer->id_customer)->first();
                $name = $getCustomerName->fname ." ". $getCustomerName->lname;
                $getCustomer = Device::where('user_id',$appointments->id_customer->id_customer)->first();
                
                if($getCustomer){
                   $this->sendNotification($getCustomer->device_type,$title="Appointment",$msg="Appointment Approved by $empname",$getCustomer->device_id,$appointment);
                    
                }
            }else{
                $getCustomerName = Customer::where('id_customer',$appointments->id_customer->id_customer)->first();
                $custname = $getCustomerName->fname ." ". $getCustomerName->lname;
                $getEmployeeName = Employee::where('id_employee',$appointments->id_employee->id_employee)->first();
                $name = $getEmployeeName->username ." ". $getEmployeeName->surname;
                $getCustomer = Device::where('user_id',$appointments->id_employee->id_employee)->first();
                
                if($getCustomer){
                    $this->sendNotification($getCustomer->device_type,$title="Appointment",$msg="Appointment cancelled by $custname",$getCustomer->device_id,$appointment);
                    
                }
            }
            if($status == "6"){
            return response()->json(['status' => 'OK', 'message' => 'Appointment Rejected successfully'], 200);
            }
            if($status == "5"){
            return response()->json(['status' => 'OK', 'message' => 'Appointment Approved successfully'], 200);
            }
            if($status == "2"){
            return response()->json(['status' => 'OK', 'message' => 'Appointment cancelled successfully'], 200);
            }
        }else{
            return response()->json(['status' => 'ERROR', 'message' => 'Unable to cancel an Appointment'], 422);
        }

    }

    /**
    * Update an Appointment call status to 1, so that patient can join the call
    *
    * @param  String $id_appointment
    * @param  String $id_employee
    * @return HTTP Response
    */
    public function updateCallStatus($id_appointment = '', $id_employee ='')
    {
        $validEmployee = $this->validateDoctor($id_employee);
        if ($validEmployee == false) {
            return response()->json(['status' => 'ERROR', 'message' => 'Doctor not found'], 404);
        }

        $appointment = Appointment::where('id',$id_appointment)->where('id_employee',$id_employee)->first();

        if ($appointment == null) {
            return response()->json(['status' => 'ERROR', 'message' => 'Appointment not found'], 404);
        }

        $appointment->call_status = 1;
        if ($appointment->save()) {
            // return $appointment->id_customer->id_customer;
            $getEmployeeName = Employee::where('id_employee',$appointment->id_employee->id_employee)->first();
            $name = $getEmployeeName->username ." ". $getEmployeeName->surname;
            $getCustomer = Device::where('user_id',$appointment->id_customer->id_customer)->first();                
            if($getCustomer){
               $this->sendNotification($getCustomer->device_type,$title="Call Started",$msg="Call Started by  Dr. $name",$getCustomer->device_id,$appointment,'call');                
            }
            return response()->json(['status' => 'OK', 'message' => 'Appointment call status updated successfully'], 200);
        }else{
            return response()->json(['status' => 'ERROR', 'message' => 'Unable to update an Appointment'], 422);
        }

    }

    /**
    * Update an Appointment call status to 1, so that patient can join the call
    *
    * @param  String $id_appointment
    * @param  String $id_employee
    * @return HTTP Response
    */
    public function endAppointmentCall($id_appointment = '', $id_employee ='')
    {
        $validEmployee = $this->validateDoctor($id_employee);
        if ($validEmployee == false) {
            return response()->json(['status' => 'ERROR', 'message' => 'Doctor not found'], 404);
        }

        $appointment = Appointment::where('id',$id_appointment)->where('id_employee',$id_employee)->first();

        if ($appointment == null) {
            return response()->json(['status' => 'ERROR', 'message' => 'Appointment not found'], 404);
        }

        $appointment->status = 3;
        $appointment->call_status = 2;
        if ($appointment->save()) {
            return response()->json(['status' => 'OK', 'message' => 'Appointment call status updated successfully'], 200);
        }else{
            return response()->json(['status' => 'ERROR', 'message' => 'Unable to update an Appointment'], 422);
        }

    }


}
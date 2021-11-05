<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();
require 'connect.php';

// Load Composer's autoloader
require_once $_SERVER['DOCUMENT_ROOT'] . '/home/vendor/autoload.php';

// ถ้าผู้ใช้ต้องการ login
if (isset($_POST['username'])) {
    doLogin($objConnect);
} elseif (isset($_POST['username_admin'])){
    doCreatetbl($objConnect);
}

function checkAdminUser($objConnect)
{
    // ถ้าไม่มีการกำหนดค่า session id ก็จะ Redirect ไปยังหน้า Login อีกครั้ง
    if (!isset($_SESSION["user_id"])) {
        header('Location: ../login.php');
        exit;
    } else {
        $str = "SELECT * FROM tbl_member WHERE id_member = '".$_SESSION['user_member']."' AND data_role != 'mod_customer'";
        $query = mysqli_query($objConnect, $str);
        $result = mysqli_fetch_array($query);

        if($_SESSION["user_id"]!=$result['member_session_update']){
            header('Location: ../login.php');
            exit();
        }

    }
    // ถ้าผู้ใช้ต้องการ logout
    if (isset($_GET['logout'])) {
        doLogout($objConnect);
    }

}

function checkMemUser($objConnect)
{
    // ถ้าไม่มีการกำหนดค่า session id ก็จะ Redirect ไปยังหน้า Login อีกครั้ง
    if (!isset($_SESSION["id_customer"])) {
        header('Location: Signin_Signup.php?Signin_Signup=st');
        exit;
    } else {

    }
}

function doCreatetbl($objConnect){  
    header('Content-Type: application/json');
    
        $cmd = "CREATE TABLE IF NOT EXISTS `tbl_member`(
                `id_member` varchar(35) NOT NULL,
                `user_member` varchar(100) NOT NULL,
                `pass_member` varchar(100) NOT NULL,
                `member_regdate` datetime NOT NULL,
                `member_last_login` datetime NOT NULL,
                `member_last_logout` datetime NOT NULL,
                `member_session_update` varchar(130) NOT NULL,
                `data_role` varchar(30) NOT NULL,
                `permission` varchar(30) NOT NULL,
                `del_time` datetime DEFAULT NULL,
                `id_data_role` varchar(35) NOT NULL,
                PRIMARY KEY (`id_member`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $query_testt = mysqli_query($objConnect,$cmd);

        $cmd = "CREATE TABLE IF NOT EXISTS froala_uploads(
                 `id_uploads` int(11) NOT NULL AUTO_INCREMENT,
                  `name_uploads` varchar(100) NOT NULL,
                  `link_uploads` varchar(100) NOT NULL,
                  `img_path` varchar(100) NOT NULL,
                  PRIMARY KEY (`id_uploads`)  
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $query_testt = mysqli_query($objConnect,$cmd);

         $cmd = "CREATE TABLE IF NOT EXISTS link_local(
                `id_link` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(50) NOT NULL,
                `table` varchar(100) NOT NULL,
                `link` varchar(50) NOT NULL,
                PRIMARY KEY (`id_link`)  
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
       $query_testt = mysqli_query($objConnect,$cmd);

        $cmd = "CREATE TABLE IF NOT EXISTS system(
                 `id_system` int(11) NOT NULL AUTO_INCREMENT,
                  `name_system` varchar(100) NOT NULL,
                  `name_system_en` varchar(100) NOT NULL,
                  `link_system` varchar(100) NOT NULL,
                  `type` int(11) NOT NULL,
                  `groups` int(11) NOT NULL,
                  `sort` int(11) NOT NULL,
                  `level` varchar(100) NOT NULL,
                  `icon` varchar(100) NOT NULL,
                  `date_add` date NOT NULL,
                  `date_update` date NOT NULL,
                  PRIMARY KEY (`id_system`)  
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $query_testt = mysqli_query($objConnect,$cmd);

        $id_member = setMD5();
        $username = $_POST['username_admin'];
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $cmd = "INSERT INTO `tbl_member` (
        `id_member`, 
        `user_member`, 
        `pass_member`, 
        `member_regdate`, 
        `member_last_login`, 
        `member_last_logout`, 
        `member_session_update`, 
        `data_role`, 
        `permission`, 
        `del_time`, 
        `id_data_role`) VALUES
        ('$id_member', '$username', 
            '$password', 
            NOW(), 
            '0000-00-00 00:00:00', 
            '0000-00-00 00:00:00', 
            '', 
            'Super_admin', 
            'Super_admin', 
            NULL, 
            '');";
        $query_test =mysqli_query($objConnect,$cmd);
        doLogin($objConnect);
}


function doLogin($objConnect)
{
    header('Content-Type: application/json');
    if(isset($_POST['username_admin'])){
        $username = $_POST['username_admin'];
    }else{
        $username = $_POST["username"];
    }
    $password = $_POST["password"];
    // require 'config.php';
    $str = "SELECT * FROM tbl_member WHERE user_member = '".$username."'";
    $query = mysqli_query($objConnect, $str);
    $result = mysqli_fetch_array($query);
    $row = mysqli_num_rows($query);
    if(!$result) {
        echo json_encode(array('status' => '0','message'=> 'Error login data!'));
    }
    else
    {
        $_SESSION["parent_id"] = $result['parent_id'];
        $hash = $result['pass_member'];
        if(password_verify($password,$hash)){
            if(isset($_POST['username_admin'])){
                $_SESSION["user_id"] = session_id();
                $_SESSION["user_member"] = $result['id_member'];
                $_SESSION['permission'] = 'Super_admin';
                $_SESSION['task_view'] = '';
                $_SESSION['task_authen'] = '';
                
            }else{
                $str_employee = 'SELECT * FROM mod_employee WHERE id_employee = "'.$result['id_data_role'].'"';
                $query_employee = mysqli_query($objConnect,$str_employee);
                $_SESSION["user_id"] = session_id();
                $_SESSION["user_member"] = $result['id_member'];
                $_SESSION["id_employee"] = $result['id_data_role'];

                if($query_employee){
                    if($result['permission']=='Super_admin'){
                        $_SESSION['permission'] = 'Super_admin';
                        $_SESSION['task_view'] = '';
                        $_SESSION['task_authen'] = '';
                    }else{
                        $fetch_employee = mysqli_fetch_array($query_employee);

                        $_SESSION['permission'] = 'user';
                        $_SESSION["task_view"] = $fetch_employee ["task_view"];
                        $_SESSION["task_authen"] = $fetch_employee ["task_authen"];
                        $_SESSION["role_id"] = $fetch_employee['role_id'];
                      
                    }
                }else{
                    $_SESSION['permission'] = 'Super_admin';
                    $_SESSION['task_view'] = '';
                    $_SESSION['task_authen'] = '';
                }
            }

            $sql = "UPDATE tbl_member
                    SET member_last_login = NOW()
                        ,member_session_update = '".$_SESSION['user_id']."'
                    WHERE id_member = '{$result['id_member']}'";
            mysqli_query($objConnect, $sql);

            

            echo json_encode(array('status' => '1','message'=> $_SESSION['permission']));
        }else{
            echo json_encode(array('status' => '0','message'=> $password));
        }
    }
    mysqli_close($objConnect);
}

/*
    Logout a user admin
*/
function doLogout($objConnect)
{
    if (isset($_SESSION['user_id'])) {
        //*** Update Status
        $sql = "UPDATE tbl_member SET status = '0', member_session_update = '0000-00-00 00:00:00' WHERE id_member = '".$_SESSION["user_id"]."' ";
        $query = mysqli_query($objConnect,$sql);
          //ล้างค่าออกจากตัวแปร $_SESSION
    }

    //กลับไปยังหน้าล็อกอินอีกครั้ง  
    if($_GET['logout']=='main'){
        unset($_SESSION['user_id'],$_SESSION['permission'],$_SESSION['user_member'],$_SESSION["role_id"]);
        header('Location: ../../home/Signin_Signup.php?Signin_Signup=st');
        exit;
    } 
}

function checkmember($objConnect)
{
    // ถ้าไม่มีการกำหนดค่า session id ก็จะ Redirect ไปยังหน้า Login อีกครั้ง
    if (!isset($_SESSION["id_customer"])) {
        header('Location: Signin_Signup.php');
        exit;
    } else {
        
        }
 }


function setMD5(){

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
* Get Doctors
*
* @return Array doctor list
*/
function getDoctorList()
{
    global $objConnect;

    // Doctor List
    $doctorsList = [];
    $sqlDr = "SELECT id_employee, surname FROM mod_employee WHERE role_id='u6c21d97c94895ab1f58e1db5dde1c9080g'";
    $result = $objConnect->query($sqlDr);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_row()){
            array_push($doctorsList, [
                'id_employee' => $row[0],
                'surname' => $row[1]
            ]);
        }   
    }else{
        return $doctorsList;
    }   
    return $doctorsList;
}

/**
* Validate is the doctor ID is valid or not
*
* @param  String $id_employee
* @return Boolean TRUE is valid, otherwise FALSE
*/
function validateDoctor($id_employee = ''){
    global $objConnect;

    $doctorsList = getDoctorList($objConnect);
    foreach ($doctorsList as $key => $doctor) {
        if ($id_employee == $doctor['id_employee']) {
            return true;
            break;
        }
    }
    return false;
}

/**
* Validate is the patient ID is valid or not
*
* @param  String $id_patient
* @return Boolean TRUE is valid, otherwise FALSE
*/
function validatePatient($id_customer = ''){
    global $objConnect;

    $sql = "SELECT id_customer FROM mod_customer WHERE id_customer='".$id_customer."'";
    $result = $objConnect->query($sql);

    if ($result->num_rows > 0) {
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
function getBookingTime(){
    return [
        '08:00:00' => '08:00 AM', '08:30:00' => '08:30 AM', '09:00:00' => '09:00 AM', '09:30:00' => '09:30 AM', '10:00:00' => '10:00 AM',
        '10:30:00' => '10:30 AM', '11:00:00' => '11:00 AM', '11:30:00' => '11:30 AM', '13:00:00' => '01:00 PM', '13:30:00' => '01:30 PM',
        '14:00:00' => '02:00 PM', '14:30:00' => '02:30 PM', '15:00:00' => '03:00 PM', '15:30:00' => '03:30 PM', '16:00:00' => '04:00 PM',
        '16:30:00' => '04:30 PM', '17:00:00' => '05:00 PM'
    ];
}

/**
* Validate if booking slot is valid
*
* @param  String $timeSlot
* @return Boolean TRUE if valid, otherwise FALSE
*/
function validateBookingSlot($timeSlot = ''){
    $timeSlots = getBookingTime();

    foreach ($timeSlots as $tsKey => $value) {
        if ($timeSlot == $tsKey) {
            return true;
            break;
        }
    }

    return false;
}

/**
* Validate if booking is booked for the day or not
* Only one booking can be done in single day
*
* @param  Array id_customer, appointment date, appointment time
* @return Boolean TRUE if valid, otherwise FALSE
*/
function appointmentBookedForDay($data = []){
    
    global $objConnect;

    // Check duplicate appointment
    $sqlAp = "SELECT id FROM appointments WHERE `id_customer`='". $data['id_customer'] ."' AND `status`=1 AND `appointment_date`='".$data['appointment_date']."'";
    $result = $objConnect->query($sqlAp);
    return $result->num_rows > 0 ? true : false;

}

/**
* Validate if booking is already exists or not
*
* @param  Array id_employee, appointment date, appointment time
* @return Boolean TRUE if valid, otherwise FALSE
*/
function validateDuplicateAppointment($data = []){
    
    global $objConnect;

    // Check duplicate appointment
    $sqlAp = "SELECT id FROM appointments WHERE `id_employee`='". $data['id_employee'] ."' AND `status`=1 AND `appointment_date`='".$data['appointment_date']."' AND `appointment_time`='".$data['appointment_time']."'";
    $result = $objConnect->query($sqlAp);
    return $result->num_rows > 0 ? true : false;

}

/**
* Send Web and Email notification for Appointment
*
* @param  Array Appointment details
* @return void
*/
function sendAppointmentEmailWebNotif(array $appointmentData)
{
    try {

        global $objConnect;
        
        // Get doctor details
        $sqlDr = "SELECT surname, email FROM mod_employee WHERE `id_employee`='". $appointmentData['id_employee'] ."'";
        $doctorDetails = $objConnect->query($sqlDr)->fetch_object();

        // Get patient details
        $sqlPatient = "SELECT fname, lname, age, email FROM mod_customer WHERE `id_customer`='". $appointmentData['id_customer'] ."'";
        $patientDetails = $objConnect->query($sqlPatient)->fetch_object();
        $patientFullName = $patientDetails->fname . ' ' . $patientDetails->lname;

        // Get member details
        $sqlMem = "SELECT user_member FROM tbl_member WHERE `id_data_role`='". $appointmentData['id_customer'] ."'";
        $memberDetails = $objConnect->query($sqlMem)->fetch_object();


        $appointmentDate = $appointmentData['appointment_date'];
        $appointmentTime = date("h:i a",strtotime($appointmentData['appointment_date'] . " " . $appointmentData['appointment_time']));
        
        $htmlReplace = [
            '{{PATIENT_USERNAME}}' => $memberDetails->user_member,
            '{{PATIENT_NAME}}' => $patientFullName,
            '{{PATIENT_AGE}}' => $patientDetails->age,
            '{{PATIENT_EMAIL}}' => $patientDetails->email,
            '{{APPOINTMENT_DATE}}' => $appointmentDate,
            '{{APPOINTMENT_TIME}}' => $appointmentTime,
            '{{APPOINTMENT_LINK}}' => 'https://www.suratec.co.th/admin/mod_customer/appointments.php'
        ];
        $htmlDoctor = file_get_contents(__DIR__ ."/appointment_doctor.html");
        $htmlDoctor = str_replace(array_keys($htmlReplace),$htmlReplace,$htmlDoctor);

        $htmlReplace = [
            '{{APPOINTMENT_DATE}}' => $appointmentDate,
            '{{APPOINTMENT_TIME}}' => $appointmentTime,
            '{{APPOINTMENT_LINK}}' => 'https://www.suratec.co.th/home/appointments.php?profile=st'
        ];
        $htmlPatient = file_get_contents(__DIR__ ."/appointment_patient.html");
        $htmlPatient = str_replace(array_keys($htmlReplace),$htmlReplace,$htmlPatient);
        
        // Send email to Doctor
        sendEmail([
            'email' => $doctorDetails->email,
            'name' => $doctorDetails->surname,
        ],'New Appointment',$htmlDoctor);

        // Send email to Doctor
        sendEmail([
            'email' => $patientDetails->email,
            'name' => $patientFullName,
        ],'Appointment Booked!!!',$htmlPatient);

        // Send web notification to Doctor
        $id = setMD5();
        $details = 'New Appointment is booked with Patient name: '.$patientFullName.', Age: '.$patientDetails->age.' and Appointment Date and time: ' . $appointmentDate . ' ' . $appointmentTime;
        $insQuery = "
            INSERT INTO notifications (id, id_user, details, status) 
            VALUES('".$id."','".$appointmentData['id_employee']."','".$details."',1);
        ";
        $objConnect->query($insQuery);

        // Send web notification to patient
        $id = setMD5();
        $details = 'Appointment booked successfully with Date and time: ' . $appointmentDate . ' ' . $appointmentTime;
        $insQuery = "
            INSERT INTO notifications (id, id_user, details, status) 
            VALUES('".$id."','".$appointmentData['id_customer']."','".$details."',1);
        ";
        $objConnect->query($insQuery);

    } catch (\Throwable $th) {
        //throw $th;
    }

}

/**
* Send email
*
* @param  Array to, subject and email body
* @return Boolean TRUE if valid, otherwise FALSE
*/
function sendEmail($to = [], $subject = 'Notification', $body='Hello'){
    
    $mail = new PHPMailer(true);
	try {
		//Server settings
		$mail->isSMTP();
		$mail->Host       = 'mail.suratec.co.th';
		$mail->SMTPAuth   = true;
		$mail->Username   = 'support@suratec.co.th';
		$mail->Password   = 'vA!8o49X1@vT';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Port       = 587;

		//Recipients
		$mail->setFrom('support@suratec.co.th', 'Suratec');
		$mail->addAddress($to['email'], $to['name']);
		// $mail->addAddress('keval.savani@gmail.com', $to['name']);

		// Content
		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body    = $body;

		$mail->send();
		return true;
	} catch (Exception $e) {
		// echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
	}
}

?>
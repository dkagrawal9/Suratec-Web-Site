<?php 
require_once '../admin/library/connect.php';

if(!isset($_SESSION)) {
  session_start();
}

// validate channel
$channel = !empty($_GET['channel']) ? $_GET['channel'] : 'INVALID_CHANNEL';
$user_id = !empty($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
$invalid = ['status' => '','message' => ''];

$user='';
$userUID = '';
$userName = '';
if (!empty($user_id)) {
  $user = 'doctor';
  if (!empty($_SESSION['id_customer'])) {
    $user = 'patient';
  }
  
  $appointmentArray = array();
  $appSql = "SELECT a.id AS appointment_id, emp.surname AS doctor_name, c.fname AS patient_name, a.status, a.call_status, a.employee_uid, a.customer_uid, a.appointment_date, TIME_FORMAT(a.appointment_time,'%h:%i %p') AS appointment_time, a.created_at as created_at FROM appointments AS a INNER JOIN mod_employee AS emp ON emp.id_employee=a.id_employee INNER JOIN mod_customer AS c ON c.id_customer=a.id_customer WHERE id='$channel' AND status=5";
  $appointment = $objConnect->query($appSql)->fetch_object();
  
  // Check if appointment is valid
  if (empty($appointment)) {
    $invalid = [
      'status' => 'channel_not_found',
      'message' => 'The provided channel not found',
    ];
  }
  
  if (!empty($appointment)) {
  
    // Check if appointment time is valid
    $appointmentDateTime = $appointment->appointment_date . ' ' . $appointment->appointment_time;
    $appointmentDT = date("Y-m-d H:i:s",strtotime($appointment->appointment_date . ' ' . $appointment->appointment_time));
    $currentDT = date("Y-m-d H:i:s");
    
    if ($currentDT < $appointmentDT) {
      $invalid = [
        'status' => 'appointment_time',
        'message' => 'Call cannot be initialize before the appointment time, please check with date and time of the appointment',
      ];
    }

    if ($user=='doctor') {
      $userUID = $appointment->employee_uid;
      $userName = $appointment->patient_name;
    }else{
      $userUID = $appointment->customer_uid;
      $userName = $appointment->doctor_name;      
    }
    
    if ($user=='patient' AND $appointment->call_status == 0) {
      $invalid = ['status' => 'unauthorized','message' => 'Your doctor has not started to call yet, please contact your doctor'];
    }
    
  
  }
}else{
  $invalid = ['status' => 'unauthorized','message' => 'You are not authorized to for appointment call'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Suratec Appointment</title>
  <link rel="stylesheet" href="./assets/common.css" />
  <style>
    .agora-theme .video-view, .agora-theme .video-placeholder, .agora-theme #local_stream, .agora-theme #local_video_info
    {
      width: 654px;
      height: 540px;
    }
    #local_stream::before{
      content: "Doctor";
      margin-left: 297px;
      font-weight: bold;
      font-size: 20px;
      border-bottom: 1px solid black;
    }
    #local_stream::before{
      content: "<?php echo ($user=='doctor') ? $appointment->doctor_name : $appointment->patient_name ?>";
      margin-left: 297px;
      font-weight: bold;
      font-size: 20px;
      border-bottom: 1px solid black;
    }
    .second-user::before{
      content: "<?php echo ($user=='doctor') ? $appointment->patient_name : $appointment->doctor_name ?>";
      margin-left: 297px;
      font-weight: bold;
      font-size: 20px;
      border-bottom: 1px solid black;
    }
    .appointment-table{
      border: 7px solid #ccc;
    }
    .appointment-table tr{
      border: 3px solid #ccc;
    }
    .text-center{
      text-align: center;
    }
  </style>
</head>
<body class="agora-theme">
  <div class="navbar-fixed">
    <nav class="agora-navbar">
      <div class="nav-wrapper agora-primary-bg valign-wrapper">
        <h5 class="left-align">Appointment - Voice Call</h5>
        <?php
          if (!empty($appointment)) {
        ?>
          <div class="float-right">
            <span><strong>Appointment</strong> : <?= $appointmentDateTime ?></span>
            &nbsp;&nbsp;&nbsp;
            <?php
              if ($user=='doctor') {
            ?>
                <span><strong>Your Patient</strong> : <?= $appointment->patient_name ?></span>
            <?php
              }else{
            ?>
              <span><strong>Your Doctor</strong> : <?= $appointment->doctor_name ?></span>
            <?php
              }
            ?>
            &nbsp;&nbsp;&nbsp;
            <button class="btn btn-raised btn-primary waves-effect waves-light" id="leave"><?php echo $user=='doctor' ? 'END CALL' : 'LEAVE' ?></button>
          </div>
        <?php
          }
        ?>
      </div>
    </nav>
  </div>
  <div class="row col l12 s12">
    <?php
      if (!empty($invalid['status'])) {
        echo "error #".$invalid['status'];
        echo "<br>";
        echo "message: ".$invalid['message'];
      }else{
    ?>
      <div class="col m12">
        <div class="col m3">
        <table class="appointment-table striped highlight">
          <thead>
            <tr>
              <th colspan="2" class="text-center">Appointment Details</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><strong>Appointment Date</strong></td>
              <td><?= $appointment->appointment_date ?></td>
            </tr>
            <tr>
              <td><strong>Appointment Time</strong></td>
              <td><?= $appointment->appointment_time; ?></td>
            </tr>
            <tr>
              <td><strong>Status</strong></td>
              <td>On Going</td>
            </tr>
            <tr>
              <td><strong><?php echo $user=='doctor' ? 'Your Patient' : 'Your Doctor'; ?></strong></td>
              <td><?php echo $user=='doctor' ? $appointment->patient_name : $appointment->doctor_name; ?></td>
            </tr>
          </tbody>
        </table>
        </div>

        <div class="video-grid" id="video" style="opacity:0" >
          <div class="video-view">
            <div id="local_stream" class="video-placeholder"></div>
            <div id="local_video_info" class="video-profile hide"></div>
            <div id="video_autoplay_local" class="autoplay-fallback hide"></div>
          </div>
        </div>
      </div>
    <?php
      } #endif
    ?>

  </div>
  <script>
    const userType = '<?= $user?>';
    const userUID = '<?= $userUID?>';
    const channelId = '<?= $channel?>';
    const userName = '<?= $userName?>';
  </script>
  <script src="vendor/jquery.min.js"></script>
  <script src="vendor/materialize.min.js"></script>
  <?php 

    if (empty($invalid['status'])) {
  ?>
    <script src="https://cdn.agora.io/sdk/release/AgoraRTCSDK-3.1.2.js"></script>
    <script src="vendor/voice-script.js"></script>
  <?php
    }
  
  ?>
  
</html>

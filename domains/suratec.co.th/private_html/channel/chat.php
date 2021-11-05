<?php 
// Chat DEMO
// https://webdemo.agora.io/agora-web-showcase/examples/Agora-RTM-Tutorial-Web/
require_once '../admin/library/connect.php';

if(!isset($_SESSION)) {
  session_start();
}

// validate channel
$channel = !empty($_GET['channel']) ? $_GET['channel'] : 'INVALID_CHANNEL';
$user_id = !empty($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
$session_user_id = !empty($_SESSION['id_customer']) ? $_SESSION['id_customer'] : '';
$invalid = ['status' => '','message' => ''];

// id_customer is empty, user is doctor
if (empty($session_user_id)) {
  $drSql = "SELECT id_data_role FROM tbl_member WHERE id_member='".$_SESSION["user_member"]."'";
  $tmpResult = $objConnect->query($drSql)->fetch_object();
  $session_user_id = $tmpResult->id_data_role;
}

$userType='';
$displayUser='';
$userUID = '';
$receiverUID = '';
$userName = '';
$senderName = 'Sender';
$receiverName = 'Receiver';

if (!empty($session_user_id)) {
  $userType = 'doctor';
  $displayUser = 'patient';
  if (!empty($_SESSION['id_customer'])) {
    $userType = 'patient';
    $displayUser = 'doctor';
  }
  
  $appointmentArray = array();
  $appSql = "SELECT * FROM chats WHERE channel='$channel'";
  $chatData = $objConnect->query($appSql);

  $channelID = explode("-",$channel);
  $employeeID = $channelID[0];
  $customerID = $channelID[1];

  $userSql = "SELECT * FROM mod_employee WHERE id_employee='$employeeID'";
  $doctorDetails = $objConnect->query($userSql)->fetch_object();

  $userSql = "SELECT * FROM mod_customer WHERE id_customer='$customerID'";
  $patientDetails = $objConnect->query($userSql)->fetch_object();


  // Me
  if ($session_user_id==$employeeID) {
    $userUID = $employeeID;
    $receiverUID = $customerID;
    $senderName = $doctorDetails->surname;
    $receiverName = $patientDetails->fname;
  }else{
    $userUID = $customerID;
    $receiverUID = $employeeID;
    $receiverName = $doctorDetails->surname;
    $senderName = $patientDetails->fname;
  }



}else{
  $invalid = ['status' => 'unauthorized','message' => 'You are not authorized to for chat'];
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
  <link rel="stylesheet" href="./assets/chat.css" />
</head>
<body class="agora-theme">
  <div class="navbar-fixed">
    <nav class="agora-navbar">
      <div class="nav-wrapper agora-primary-bg valign-wrapper">
        <h5 class="left-align">Suratec Chat</h5>
      </div>
    </nav>
  </div>
  
  <div class="row col l12 s12">
    <div class="row container col l12 s12 main-container">
      
      <div class="col" style="min-width: 433px; max-width: 443px">
        <div class="card" style="margin-top: 0px; margin-bottom: 0px;">
          <div class="row card-content" style="margin-bottom: 0px;">
              <div class="input-field">
                <h5 style="margin-left: 0px;">Chat Information</h5>
                <br>
              </div>
              <div class="input-field">
                <label class="active"><?php echo ucfirst($displayUser) ?> name</label>
                <span><?php echo $receiverName ?></span>
              </div>
          </div>
        </div>
      </div>

      <div class="col m7 log-container">
        <div class="card" style="margin-top: 0px; margin-bottom: 0px;">
          <div class="row card-content" style="margin-bottom: 0px;padding-bottom: 0px;min-height: 433px;min-height: 433px">
            <ul id="chatLog" class="chat">
              <?php
                while ($row = $chatData->fetch_object()) {
                  if ($session_user_id != $row->user_id) {
                ?>
                    <li class="left clearfix">
                      <span class="chat-img pull-left">
                        <span class="img-circle"><?php echo ucfirst($receiverName[0]) ?></span>
                      </span>
                      <div class="chat-body clearfix">
                        <div class="header">
                          <strong class="primary-font"><?php echo $receiverName ?></strong>
                          <small class="text-muted">
                            &nbsp;<?php echo date("Y-m-d H:i",strtotime($row->created_at)) ?>
                          </small>
                        </div>
                        <p><?php echo $row->message ?></p>
                      </div>
                    </li>
                <?php
                  }else{
                ?>
                    <li class="right clearfix">
                      <div class="chat-body clearfix">
                        <div class="header">
                          <small class="text-muted">
                            <?php echo date("Y-m-d H:i",strtotime($row->created_at)) ?>&nbsp;
                          </small>
                          <strong class="pull-right primary-font">Me</strong>
                        </div>
                        <p class="text-right"><?php echo $row->message ?></p>
                      </div>
                      <span class="chat-img pull-right">
                        <span class="img-circle"><?php echo ucfirst($senderName[0]) ?></span>
                      </span>
                    </li>
                <?php
                  }
                ?>
                <li class="clearfix chat-divider"></li>
              <?php
                }
              ?>
            </ul>
          </div>
          <div class="row card-content" style="margin-bottom: 0px;padding-bottom: 0px;padding-top: 0px;">
            <div class="input-field channel-padding" style="display:flex;">
              <input type="text" placeholder="write message..." id="messageText">
              <button class="btn btn-raised btn-primary waves-effect waves-light custom-btn-pin" id="sendMessage" style="margin-top: 10px;margin-left: 10px;">Send</button>
            </div>
          </div>
        </div>
      </div>      
    </div>
  </div>

  <script>
    const userType = '<?= $userType?>';
    const userUID = '<?= $userUID?>';
    const receiverUID = '<?= $receiverUID?>';
    const channelMD5 = '<?= md5($channel)?>';
    const channel = '<?= $channel?>';
    const userName = '<?= $userName?>';
    const receiverName = '<?= $receiverName?>';
    const appId = '427de33581664f158e837109a11077db';

    const senderTemplate = `
      <li class="right clearfix">
        <div class="chat-body clearfix">
          <div class="header">
            <small class="text-muted">
              {{DATE_TIME}}&nbsp;
            </small>
            <strong class="pull-right primary-font">Me</strong>
          </div>
          <p class="text-right">{{MESSAGE}}</p>
        </div>
        <span class="chat-img pull-right">
          <span class="img-circle"><?php echo ucfirst($senderName[0]) ?></span>
        </span>
      </li>
      <li class="clearfix chat-divider"></li>
    `;
    const receiverTemplate = `
      <li class="left clearfix">
        <span class="chat-img pull-left">
          <span class="img-circle"><?php echo ucfirst($receiverName[0]) ?></span>
        </span>
        <div class="chat-body clearfix">
          <div class="header">
            <strong class="primary-font"><?php echo $receiverName ?></strong>
            <small class="text-muted">
              &nbsp;{{DATE_TIME}}
            </small>
          </div>
          <p>{{MESSAGE}}</p>
        </div>
      </li>
    `;

  </script>
  <script src="vendor/jquery.min.js"></script>
  <script src="vendor/materialize.min.js"></script>
  <?php 

    if (empty($invalid['status'])) {
  ?>
    <script src="vendor/agora-rtm-sdk-1.2.2.js"></script>
    <script src="vendor/rtm-client.js"></script>
    <script src="vendor/chat.js"></script>
  <?php
    }
  ?>

  <script>
    $('#chatLog').scrollTop($('#chatLog')[0].scrollHeight);
  </script>






  
</html>

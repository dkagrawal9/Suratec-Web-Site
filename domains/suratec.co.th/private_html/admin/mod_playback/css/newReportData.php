<?php
   if(!isset($_SESSION)) 
       { 
           session_start(); 
       } 
   require_once '../library/connect.php';
   require_once '../library/functions.php';
   checkAdminUser($objConnect);
   
   $title = 'Report Data';
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
      
       <!-- start Date -->
      <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
      <link rel="stylesheet" media="all" type="text/css" href="jquerydatepicker/jquery-ui.css" />
      <link rel="stylesheet" media="all" type="text/css" href="jquerydatepicker/jquery-ui-timepicker-addon.css" />
      <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
       <!-- End  Date -->
       

     
      <title>Report | Suratec</title>
      <!-- Bootstrap -->
      <link href="css/style.css" rel="stylesheet">     
   </head>
   <style>
      .insideWrapper {
      width:100%;
      height:100%;
      position:relative;
      }
      .coveredImage {
    
      position:absolute;
      top:0px;
      left:0px;
      }
      .coveringCanvas {
      width:100%;
      height:100%;
      position:absolute;
      top:0px;
      left:0px;
      }
      .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
      background: #00efb8 !important;
      }
      .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
      background: #ffffff !important;
      border: solid 1px #00efb8 !important;
      }
   </style>
   <?php
      $id_user = $_SESSION["id_employee"];
      $playback_type = '';
      $sql_type = "SELECT role.role_name FROM `mod_employee`
      LEFT JOIN role ON role.role_id=mod_employee.role_id WHERE mod_employee.id_employee ='".$id_user."' ";
      $query_type = mysqli_query($objConnect,$sql_type);
      $result_type = mysqli_fetch_array($query_type,MYSQLI_ASSOC);
      
      $disable_type = "";
      if ($result_type["role_name"]=='Doctor' ) {
        $disable_type = "disabled";
        $playback_type = '1';
      }else if ($result_type["role_name"]=='Coach') {
        $disable_type = "disabled";
        $playback_type = '2';
      }
      if (isset($_GET['id_customer'])) {
            $id_customer = $_GET['id_customer'];
          }else{
            $id_customer = '';
          }
           $userData = "SELECT * FROM `mod_customer` WHERE `id_customer` = '".$id_customer."' AND (`delete_datetime` IS NULL OR delete_datetime IS NULL)";
           $query_type = mysqli_query($objConnect,$userData);
          while ($userDataRec = mysqli_fetch_array($query_type)) {
            // echo "<pre>";
            // print_r($userDataRec);
            $fname =  $userDataRec['fname'];
              $email =  $userDataRec['email'];
              $age =  $userDataRec['age'];
              $weight =  $userDataRec['weight'];
              $height =  $userDataRec['height'];
              $create_datetime =  $userDataRec['create_datetime'];
              $img_path =  $userDataRec['img_path'];
              $sex =  ($userDataRec['sex']==0)?'Male':'FeMale';
              
        }
          if (isset($_POST['playback_type'])) {
            $playback_type = $_POST['playback_type'];
          }else{
            $playback_type = $playback_type;
          }
      
          if (isset($_POST['datetimepicker'])) {
            $datetimepicker = $_POST['datetimepicker'];
          }else{
            $datetimepicker = '';
          }
          if (isset($_POST['playback_time'])) {
            $playback_time = $_POST['playback_time'];             
          }else{
            $playback_time = '';
          }
          if (isset($_POST['status_play'])) {
            $status_play = $_POST['status_play'];
          }else{
            $status_play = '';
          }
          $str_photo = "";
        if(isset($_FILES['upload_csv'])) { $str_photo = trim($_FILES['upload_csv']['name']); }
      ?>
   <body>
      <div id="s-wrapper" class="s-wrapper">
         <main class="s-main-page s-bg-primary">
            <div class="s-rightbar">
               <div class="s-dashboard">
                  <image id="Suranapa_Image" data-name="Suranapa Image" width="10%"  src="https://www.suratec.co.th/admin/mod_playback/images/reportLogo.jpeg">
                 
                  <div class="s-inner-dashboard">
                     <div class="s-report s-br-16 s-bg-primary s-p20">
                        <div class="s-fill-report">
                           <h4 class="s-main-title text-white">
                              <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                              Fill in the report
                              </font></font>
                           </h4>
                           <div class="s-form-row s-d-flex">
                              <div class="s-form-control">
                                 <label>User type</label>
                                 <select class="s-select s-common-btn" <?php echo $disable_type ?> name="playback_type" id='playback_type' onchange="playback_time_func()">
                                    <option value="0">Select Playback</option>
                                    <option <?php
                                          if ($playback_type == '1') {
                                                echo "selected";
                                             }
                                             ?> value="1">การแพทย์</option>
                                                <option  <?php
                                                      if ($playback_type == '2') {
                                                        echo "selected";
                                                      }
                                                      ?>
                                                   value="2">การกีฬา
                                             </option>
                                 </select>
                              </div>
                              <div class="s-form-control">
                                 <label>Date</label>
                                   <input type='text' class="s-calendar s-common-btn" name="datetimepicker" id='datetimepicker' autocomplete="off" onchange="playback_time_func()" value="<?php echo $datetimepicker ?>"/>                                 
                              </div>
                              <div class="s-form-control">
                                 <label>Time</label>
                                 <!-- <input type="text" class="s-timer s-common-btn" placeholder="Hour : Minute : Second"> -->
                                 <SELECT class="s-select s-common-btn" name="playback_time" id='playback_time'>
                                    <option value="0">เวลา Playback</option>
                                 </SELECT>                                 
                              </div>
                              <div class="s-form-control">
                                 <label>SuraPodo Data</label>
                                 <div class="s-upload-btn-wrapper">
                                    <button class="s-btn">
                                       <input type="file" id="" name="filename" value="select file">
                                    </button>
                                 
                                 </div>
                              </div>
                              <div class="s-form-control">
                                 <label>GAIT Distance (meter)</label>
                                 <input type="number" id="gait_distance" class="s-common-btn" min="0" max="99" placeholder="GAIT Distance">                                 
                              </div>
                              <div class="s-form-control">
                                    <input type="button" onclick="window.print()" class="s-download s-common-btn" value="Download report ">
                                    <input type="button" onclick="function_play()"  class="s-report s-common-btn search_date" value="Display report">                               
                              </div>
                           </div>
                        </div>
                        <p class="s-note text-color"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">*All fields should be filled in before clicking the Show Report button.</font></font></p>
                     </div>
                     <div class="s-report s-br-16" style="margin-top:3px">
                        <div class="bg-dark-color">
                           <img src="images/bg-gray-dark.jpg" alt="bg-color" />
                        </div>
                        <div class="s-report-wrap s-d-flex">
                           <div class="s-report-list">
                              <h2 class="s-title text-white">รายงานข้อมูลของ</h2>
                              <div class="s-report-user">
                              <?php 
                                 if($img_path == null || $img_path == ''){
                                    ?>
                                    <img src="images/noimage.png"  alt="profile"/>
                                 <?php 
                                 }else{
                                    ?>
                                    <img src="https://api1.suratec.co.th/pic/<?=$img_path?>" alt="profile"/>
                                 <?php 
                                 }
                              ?>
                                 
                              </div>
                           </div>
                           <div class="s-report-name">
                              <h3 class="s-title text-white">
                              <?=$fname?>
                              </h3>
                              <ul>
                                 <li>
                                    <p>Height <span><?=$height?> ซม.</span></p>
                                 </li>
                                 <li>
                                    <p>Age <span><?=$age?> ปี</span></p>
                                 </li>
                                 <li>
                                    <p>Weight <span><?=$weight?> กก.</span></p>
                                 </li>                                 
                                 <li>
                                    <p>Gender <span><?=$sex?></span></p>
                                 </li>                                 
                              </ul>
                           </div>
                           <div class="s-report-date">
                              <ul>
                                 <li>
                                    <p>Used since <span><?=date('d-m-Y',strtotime($create_datetime))?></span></p>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="s-box-shadow s-br-16 bg-secondary s-p20 s-statistic-box">
                     <h5 class="s-title-big">
                        Static Data Analysis
                     </h5>
                     <img src="images/pd.png" alt="bg-green" class="d-block mx-auto myclass-mt-0"/>
                     <div class="s-box-wrapper">
                        <div class="s-box-item">
                           <div class="btn-wrap">
                              <a href="#" class="s-btn s-green">
                              <img src="images/left foot.png" alt="bg-green" />
                              </a>
                           </div>
                           <div class="s-chart s-cricle s-circle-border-green">
                           <img id="ft1" src="https://www.suratec.co.th/admin/mod_playback/images/N1.png" alt="Left-foot">
                           </div>
                           <div class="s-content text-center">
                              <h6><span id = "tft1">NORMAL</span></h6>
                              <p class="text-green">Arch Index<span id="ai1">0.00</span></p>
                              <p class="text-green">Foot Length<span id="lfl">0.00 cm</span></p>
                              <p class="text-green">Foot Width<span id="lfw">0.00 cm</span></p>
                           </div>
                        </div>
                        <div class="s-box-item" style="margin: -20px;">
                           <div class="s-graph">
                           <div class="chappalNodata" style="border: 1px solid;padding: 70px;">
                                <h3 style="text-align: center;">No Data Found</h3>
                            </div>
                            <div id="contour_div"></div>
                            <canvas id="chappal_chart" style="margin-bottom: -135px;"></canvas>
                            <img src="img/foottype.jpeg"  style="height: 150px; width: auto;margin: 0 auto;display: block;"/>
            
                            <div class="chappalYesData length-width">
                            </div>
                             
                           </div>
                        </div>
                        <div class="s-box-item">
                           <div class="btn-wrap">
                              <a href="#" class="s-btn s-blue">
                              <img src="images/right foot.png" alt="bg-blue" />
                              </a>
                           </div>
                           <div class="s-chart s-cricle s-circle-border-blue">
                           <img id="ft2" src="https://www.suratec.co.th/admin/mod_playback/images/N2.png" alt="Right-foot">
                           </div>
                           <div class="s-content text-center">
                              <h6><span id = "tft2">NORMAL</span></h6>
                              <p>Arch Index<span id="ai2">0.00</span></p>
                              <p>Foot Length<span id="rfl">0.00 cm</span></p>
                              <p>Foot Width<span id="rfw">0.00 cm</span></p>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <div class="s-box-shadow s-br-16 bg-secondary s-p20 s-peak-box">
                     <h5 class="s-title-big">
                        Dynamic Data Analysis at Different Foot Zones
                     </h5>
                     <!-- <div class="s-peak-bar">
                        <img src="images/bg-peak.png" alt="peak" />
                     </div> -->
                     <div class="s-peak-div">
                        <div class="s-peak-img">
                           <!-- <img src="images/peak.png" alt="peak" /> -->
                           <img src="images/lag.png" alt="peak" />
                        </div>
                        <div class="s-peak-wrap">
                           <div class="s-peak-top">
                              <p class="s-peak-left"><span id="pl1">0.00</span></p>
                              <ul class="s-peak-middle">
                                 <li><span id="pl2">0.00</span></li>
                                 <li><span id="pl3">0.00</span></li>
                              </ul>
                              <p class="s-peak-base"><span id="pl4">0.00</span></p>
                              <p class="s-peak-bottom"><span id="pl5">0.00</span></p>
                           </div>
                           <div class="s-peak-top">
                              <p class="s-peak-left"><span id="pr1">0.00</span></p>
                              <ul class="s-peak-middle">
                                 <li><span id="pr2">0.00</span></li>
                                 <li><span id="pr3">0.00</span></li>
                              </ul>
                              <p class="s-peak-base"><span id="pr4">0.00</span></p>
                              <p class="s-peak-bottom"><span id="pr5">0.00</span></p>
                           </div>
                        </div>
                       <!--  <p class="text-center"><b>Foot Zone</b></p> -->
                     </div>
                  </div>
                  <div class="s-box-shadow s-br-16 bg-secondary s-p20 s-dynamic-box" >
                     <h5 class="s-title-big">
                        Dynamic Data Analysis
                     </h5>
                     <div class="s-content-list">
                        <img src="images/border-img.png" class="img-tag" />
                        <ul>
                                 <li>
                                    <p><span  id="ws">0</span><span>Walking Speed <br/> (steps/min)</span></p>
                                </li>
                                <li>
                                <p><span id="sc">0</span><span>Step count <br/> (steps)</span></p>
                                </li>
                                <li>
                                <p><span id="gs">NA</span><span>GAIT speed<br/> (m/s)</span></p>
                                </li>
                        
                        </ul>
                     </div>
                     <div class="s-box-wrapper">
                        <div class="s-box-item">
                           <a href="#" class="common-btn">
                           <img src="images/left balance.png" />
                           </a>
                           <canvas id="balance_left" width="300px"  height="300px" style="margin: 0 auto;"></canvas>
                           <div class="s-content text-center">
                              <p>Stance Time<span id="lst">0 Sec</span></p>
                              <p>Swing Time<span id="lsw">0 Sec</span></p>
                              
                           </div>
                        </div>
                        <div class="s-box-item">
                           <a href="#" class="common-btn">
                           <img src="images/cop.png" />
                           </a>
                           <canvas id="cop" width="300px" height="300px" style="margin: 0 auto;"></canvas>
                           <div class="s-content text-center">
                              <p>Cycle Time<span id="gst">0 Sec</span></p>
                           </div>
                        </div>
                        <div class="s-box-item">
                           <a href="#" class="common-btn">
                           <img src="images/right balance.png" />
                           </a>
                           <canvas id="balance_right" width="300px"  height="300px" style="margin: 0 auto;"></canvas>
                           <div class="s-content text-center">
                              <p>Stance Time<span id="rst">0 Sec</span></p>
                              <p>Swing Time<span id="rsw">0 Sec</span></p>
                              
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="s-box-shadow s-br-16 bg-secondary s-p20 s-phase-box">
                     <h5 class="s-title-big">
                        Gait Cycle Analysis
                     </h5>
                     <div class="s-phase-two-box">
                        <div class="s-phase-item">
                           <p class="s-phase-title">Left Side</p>
                           <!-- <ul class="s-phase-left s-phase-common">
                              <li><p>Stance phase</p> <span>Swing phase</span></li>
                              </ul> -->
                           <img src="images/left phase.png" alt="left-side" class="img-tag" />
                          
                           <ul class="s-phase-name s-ul">
                              <li><span id="l1t">0s</span></li>
                              <li><span id="l2t">0s</span></li>
                              <li><span id="l3t">0s</span></li>
                              <li><span id="l4t">0s</span></li>
                              <li><span id="l5t">0s</span></li>
                              <li><span id="l6t">0s</span></li>
                           </ul>
                           <ul class="s-phase-name s-ul">
                              <li><span id="l1p">0%</span></li>
                              <li><span id="l2p">0%</span></li>
                              <li><span id="l3p">0%</span></li>
                              <li><span id="l4p">0%</span></li>
                              <li><span id="l5p">0%</span></li>
                              <li><span id="l6p">0%</span></li>
                           </ul>
                        </div>
                        <div class="s-phase-item">
                           <p class="s-phase-title">Right Side</p>
                           <!-- <ul class="s-phase-right s-phase-common">
                              <li><p>Stance phase</p> <span>Swing phase</span></li>
                              </ul> -->
                           <img src="images/right phase.png" alt="right-side" class="img-tag" />
                           
                           <ul class="s-phase-name s-ul">
                              <li><span id="r1t">0s</span></li>
                              <li><span id="r2t">0s</span></li>
                              <li><span id="r3t">0s</span></li>
                              <li><span id="r4t">0s</span></li>
                              <li><span id="r5t">0s</span></li>
                              <li><span id="r6t">0s</span></li>
                           </ul>
                           <ul class="s-phase-name s-ul">
                              <li><span id="r1p">0%</span></li>
                              <li><span id="r2p">0%</span></li>
                              <li><span id="r3p">0%</span></li>
                              <li><span id="r4p">0%</span></li>
                              <li><span id="r5p">0%</span></li>
                              <li><span id="r6p">0%</span></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="page-brack"></div>
                  <div class="s-box-shadow s-br-16 bg-secondary s-p20 s-gait-box" style="">
                     <h5 class="s-title-big">
                        Gait Pattern
                     </h5>
                     <div class="tab-contents ">
                         <img src="images/pti_left.png" alt="right-side" class="img-tag d-block mx-auto myimg-onbox" />
                        <div class="wrap-circle mybox" >
                           <div class="circle-wrap">
                              <div class="circle">
                                 <div class="mask full">
                                    <div class="fill"></div>
                                 </div>
                                 <div class="mask half">
                                    <div class="fill"></div>
                                 </div>
                                 <div class="inside-circle">
                                    <span id="FL">0%</span>
                                    <img src="img/fore_foot.png">
                                 </div>
                              </div>
                           </div>
                           <div class="circle-wrap">
                              <div class="circle">
                                 <div class="mask full">
                                    <div class="fill"></div>
                                 </div>
                                 <div class="mask half">
                                    <div class="fill"></div>
                                 </div>
                                 <div class="inside-circle">
                                     <span id="ML">0%</span>
                                    <img src="img/mid_foot.png">
                                 </div>
                              </div>
                           </div>
                           <div class="circle-wrap">
                              <div class="circle">
                                 <div class="mask full">
                                    <div class="fill"></div>
                                 </div>
                                 <div class="mask half">
                                    <div class="fill"></div>
                                 </div>
                                 <div class="inside-circle">
                                    <span id="HL">0%</span>
                                    <img src="img/heel.png">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="chart-container" style="position: relative; height:400px;">
                           <canvas id="gait_left"></canvas>
                        </div>

                        <img src="images/pti_right.png" alt="right-side" class="img-tag d-block mx-auto myimg-onbox" />
                        <div class="wrap-circle mybox" style="margin-top: 15px;">

                           <div class="circle-wrap">
                              <div class="circle">
                                 <div class="mask full">
                                    <div class="fill"></div>
                                 </div>
                                 <div class="mask half">
                                    <div class="fill"></div>
                                 </div>
                                 <div class="inside-circle">
                                    <span id="FR">0%</span>
                                    <img src="img/fore_foot.png">
                                 </div>
                              </div>
                           </div>
                           <div class="circle-wrap">
                              <div class="circle">
                                 <div class="mask full">
                                    <div class="fill"></div>
                                 </div>
                                 <div class="mask half">
                                    <div class="fill"></div>
                                 </div>
                                 <div class="inside-circle">
                                    <span id="MR">0%</span>
                                    <img src="img/mid_foot.png">
                                 </div>
                              </div>
                           </div>
                           <div class="circle-wrap">
                              <div class="circle">
                                 <div class="mask full">
                                    <div class="fill"></div>
                                 </div>
                                 <div class="mask half">
                                    <div class="fill"></div>
                                 </div>
                                 <div class="inside-circle">
                                    <span id="HR">0%</span>
                                    <img src="img/heel.png">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="chart-container" style="position: relative; height:400px;">
                           <canvas id="gait_right"></canvas>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </main>
      </div>
      <input type="hidden" name="per_button_edit" id="per_button_edit" value="<?php echo $button_edit ?>">
      <input type="hidden" name="per_button_del" id="per_button_del" value="<?php echo $button_del ?>">
      <input type="hidden" name="per_button_open" id="per_button_open" value="<?php echo $button_open ?>">
      <input type="hidden" name="per_input_read" id="per_input_read" value="<?php echo $input_read ?>">
      <input type="hidden" name="id_customer" id="id_customer" value="<?php echo $id_customer ?>">
      <input type="hidden" name="get_time" id="get_time" value="<?php echo $playback_time ?>">
      <input type="hidden" name="status_play" id="status_play" value="<?php echo $status_play?>">
      <form id="form-del">
      <input type="hidden" name="_method" value="DELETE">
      <input type="hidden" name="id_customer" value id="form-del-cus">
      </form>
      <!-- ./wrapper -->
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="report_js/jquery.min.js"></script>
      <script type="text/javascript" src="jquerydatepicker/jquery-ui.min.js"></script>
      
      
      <script src ="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
      <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
      
      <script type="text/javascript" src="js/jquery.redirect.js"></script>
      
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="report_js/custom.js"></script>   
      <script>      
      <?php
         $sql_date = "SELECT DATE_FORMAT(`action`, '%Y-%m-%d') AS date_action FROM `surasole` WHERE `id_customer` = '".$id_customer."' GROUP BY DATE_FORMAT(`action`, '%Y-%m-%d') ";
         $invalid_date = array();
         $query_date = mysqli_query($objConnect, $sql_date);
         while ($result_date = mysqli_fetch_array($query_date)) {
           // เอาเฉพาะส่วนวันที่ เช่น 2013-04-22
           $date_part = substr($result_date['date_action'], 0, 10);
           // แยกส่วนวันที่ด้วยเครื่องหมาย -
           // โดยให้เดือน และวัน ไปอยู่ในตัวแปร $month และ $day
           list($year, $month, $day) = explode('-', $date_part);
           // เพิ่มวันที่เข้าไป โดยแปลงเลขที่มี 0 นำหน้า ให้กลับเป็นเลขปกติด้วย (int)
           // เช่น '04' จะกลายเป็น 4
           $invalid_date[] = $year . '-' .$month . '-' . $day;
         }
         ?>
      /* ******************File Upload End************************ */
      var invalidDate = <?php echo json_encode($invalid_date); ?>;
         function beforeShowDay(date) {
            var date = new Date(date),
             mnth = ("0" + (date.getMonth() + 1)).slice(-2),
             day = ("0" + date.getDate()).slice(-2);
           var searchDate = date.getFullYear() + '-' +mnth + '-' + day;
           // indexOf() จะให้ค่า -1 หากไม่มีค่าที่ตรวจสอบอยู่ใน Array
           if (invalidDate.indexOf(searchDate) === -1) {
             // บอก Datepicker ว่า วันที่นี้สามารถเลือกได้
             
             return [false, "", ""];
           }
           // นอกนั้นเลือกไม่ได้ เพราะเป็นวันที่ที่มีอยู่ใน Array invalidDate
           
           return [true, "", ""];
         }

         function myStopFunction() {
         
         if(typeof(setleft) != "undefined" && setleft !== null) {
         clearInterval(setleft);
         clearInterval(setright);
         }
       
       }
         $(function () {
          $('#datetimepicker').datepicker({
              todayBtn: "linked",
              language: "it",
              autoclose: true,
              todayHighlight: true,
              format: 'yyyy-mm-dd'
              
          });
               });
       
       function playback_time_func(){
         id_customer =  $("#id_customer").val();  
         playback_type =  $("#playback_type").val();  
         datetimepicker =  $("#datetimepicker").val();
         get_time =  $("#get_time").val();
       
       if (id_customer != '' && playback_type != '0' && datetimepicker!= '') {
          $.ajax({   
                   url:'report_test_time.php?id_customer='+id_customer, 
                   method:'POST',  
                   data:{id_customer:id_customer, playback_type:playback_type, datetimepicker:datetimepicker,get_time:get_time},  
                       success:function(data){ 
                      
                       $("#playback_time").html(data); 
                       status_play =  $("#status_play").val();  
                       if (status_play=='1') {
                      //    search_date();
                       }
       
                       }, 
       
                          
                  });
            }        
       } 
            /* ******************File Upload saart************************ */
    
      $("#chappal_csv").change(function() {
        readURL(this);
        });
        function readURL(input) {
            if(Validate(input)){
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                    chappalGraph(e.target.result)
                    if(e.target.result != localStorage.getItem('chappal_key') && localStorage.getItem('chappal_key') !=''){
                            location.reload();
                        }
                    // $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
        }
        var sFileName  = '';
        var _validFileExtensions = [".csv"];    
                function Validate(oForm) {                  
                    var arrInputs = oForm;
                    // for (var i = 0; i < arrInputs.length; i++) {
                        var oInput = arrInputs;
                        if (oInput.type == "file") {
                            var sFileName = oInput.value;
                            if (sFileName.length > 0) {
                                var blnValid = false;
                                for (var j = 0; j < _validFileExtensions.length; j++) {
                                    var sCurExtension = _validFileExtensions[j];
                                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                                        blnValid = true;
                                        $('#chappal_chart').show();
                                        $('.chappalNodata').hide();
                                        $('.chappalYesData').show();

                                        return true;
                                        break;
                                    }
                                }
                                
                                if (!blnValid) {
                                    localStorage.setItem('chappal_key',''); 
                                    $('#chappal_chart').hide();
                                    $('.chappalNodata').show();
                                    $('.chappalYesData').hide();
                                    alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                                    return false;
                                }
                            }
                        }
                    // }
                
                    return true;
                }
       function function_play() {
         id_customer =  $("#id_customer").val();  
         gait_distance =  $("#gait_distance").val();  
         localStorage.setItem('gait_distance',gait_distance); 
         playback_type =  $("#playback_type").val();  
         datetimepicker =  $("#datetimepicker").val();  
         playback_time =  $("#playback_time").val();  
     
         var files = $('#chappal_csv')[0].files;
         $.redirect("newReportData.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time, status_play: '1',upload_csv:files[0]}, "POST", ""); 
       } 
       
         playback_time_func();
         $("#datetimepicker").datepicker({
           beforeShowDay: beforeShowDay,
           dateFormat: 'yy-mm-dd',
         changeMonth: true,
         changeYear: true
         });

         // Declare All Arrays    
      /* **********Start*********** */
const xlabels = [];
const xlabels_int = [];
const new_xlabels = [];
const foreL = [];
const midL = [];
const heelL = [];
const foreR = [];
const midR = [];
const heelR = [];
const totalL = [];
const totalR =[];
const box_new_x =[];
const box_new_y =[];
const box_length =[];


const storage_left_balance = [];
const storage_right_balance = [];
const storage_left_balance_kpa = [];
const storage_right_balance_kpa = [];
const storage_cop = [];
const storage_cop_kpa = [];
const step_count_pdf = [];
const new_sec_pdf = [];
const fl_pdf = [];
const ml_pdf = [];
const hl_pdf = [];
const fr_pdf = [];
const mr_pdf = [];
const hr_pdf = [];
const new_x_mean_pdf = [];
const new_y_mean_pdf = [];
const new_x_sd_square_pdf = [];
const new_y_sd_square_pdf = [];
var new_ticks = 0;
var max_rs1_static = 0
var max_rs2_static = 0
var max_rs3_static = 0
var max_rs4_static = 0
var max_rs5_static = 0
			
var max_ls1_static = 0
var max_ls2_static  = 0
var max_ls3_static  = 0
var max_ls4_static  = 0
var max_ls5_static  = 0
/* ********End************* */
      
         
         // Declare All Arrays
         
         call();// Function Call to plot All Canvas
         
         if(localStorage.getItem('chappal_key') && localStorage.getItem('chappal_key') !=''){
            chappalGraph(localStorage.getItem('chappal_key'))
            $('.chappalNodata').hide();
            $('#chappal_chart').show();
            $('.chappalYesData').show();
      }else{
        $('.chappalNodata').show();
            $('#chappal_chart').hide();
            $('.chappalYesData').hide();
      }
         function replaceAll(string, search, replace) {
         return string.split(search).join(replace);
         }
         
         // Function for get all columns	
         
         
         
         
         
         async function call(){
             await getData(); // Get Data from CSV File
             chartIt_left_balance();
             chartIt_cop();
             chartIt_right_balance();
             chartIt_left_gait();
             chartIt_right_gait();
         }
        // async function newchart(){
        //     const chappalData = [];
        //     const avgChappalData = [];
        //     const response = await fetch('k11.csv'); // Upload CSV 
        //     const fileData = await response.text();			
        //     const table = fileData.split('\n').slice(1);
            
        //     table.forEach(function (row, i) {
        //     const columns = row.split(',');
        //     var length = fileData.split("\n").length; 
        //     chappalData[i] = columns;              
        //     });
        //     chappalData.forEach(function(row,indexData){
        //     chappalData[indexData] = chappalData[indexData].toString().replace('{""l"":[{""p"":[',"")
        //     chappalData[indexData] = chappalData[indexData].split(",");	
        //     var rowWiseData = replaceAll(chappalData[indexData].toString(), '"{""p"":[', '');
        //     rowWiseData = replaceAll(rowWiseData.toString(), ']}', '');
        //     chappalData[indexData] = rowWiseData.split(",");					
        //     });
        //     /* Start column wise sum and after than avg */
        //     result = chappalData.reduce(function (r, a) {
        //     a.forEach(function (b, i) {
        //     r[i] = (r[i] || 0) + parseInt(b.replace('"',""));
        //     });
        //     return r;
        //     }, []);
        //     // document.write('<pre>' + JSON.stringify(result, 0, 4) + '</pre>');
        //     result.forEach(function(avgrow1,avgindex){
        //     result[avgindex] = parseInt(avgrow1/chappalData.length);
        //     });
        //     // var resizeData = resize(result,[50][50],0);
        //     const newResizeArr = [];
        //     const finalArr = [];
        //     while(result.length) newResizeArr.push(result.splice(0,50));
            
        //     var x, x_length = 50, y, y_length = 50, map = [], map2 = [];
            
        //     // Don't be lazy
        //     for (x = 0; x < x_length; x++) {
        //     map[x] = []
        //     for (y = 0; y < y_length; y++) {
        //     map[x][y] = newResizeArr[y][49-x];
            
        //     }
        //     }
        //     console.log(map, "******Map");
            
        //     for (x = 0; x < x_length; x++) {
        //     map2[x] = []
        //     for (y= 0; y < y_length; y++){
        //     if(map[x][y] >= 30){
        //     map2[x][y] = (3.68177 * Math.pow(1.00163,( map[x][y]))).toFixed(2);
        //     }
        //     else map2[x][y] = 0
            
            
        //     }
        //     }
        //     var d3 = Plotly.d3
        //     var canvas = document.getElementById('contourmap');
        //     var graph_image = new Image();
        //     var data = [];
        //         var data = [{
        //             z: map2,
        //     x:[0,0.7,1.4,2.1,2.8,3.5,4.2,4.9,5.6,6.3,7,7.7,8.4,9.1,9.8,10.5,11.2,11.9,12.6,13.3,14,14.7,15.4,16.1,16.8,17.5,18.2,18.9,19.6,20.3,21,21.7,22.4,23.1,23.8,24.5,25.2,25.9,26.6,27.3,28,28.7,29.4,30.1,30.8,31.5,32.2,32.9,33.6,34.3],
        //     y:[0,0.7,1.4,2.1,2.8,3.5,4.2,4.9,5.6,6.3,7,7.7,8.4,9.1,9.8,10.5,11.2,11.9,12.6,13.3,14,14.7,15.4,16.1,16.8,17.5,18.2,18.9,19.6,20.3,21,21.7,22.4,23.1,23.8,24.5,25.2,25.9,26.6,27.3,28,28.7,29.4,30.1,30.8,31.5,32.2,32.9,33.6,34.3],
            
        //             type: 'contour',
        //             colorscale: [[0, 'rgb(255,255,255)'], [0.25, 'rgb(31,120,180)'], [0.45, 'rgb(178,223,138)'], [0.65, 'rgb(51,160,44)'], [0.85, 'rgb(251,154,153)'], [1, 'rgb(227,26,28)']],
        //             autocontour: true,
        //             contours: {
        //     coloring: 'heatmap',
        //             start: 50,
        //             end: 1500,
        //             size: 100
        //         },
        //     colorbar:{
        //     title: 'Pressure (kPA)',
        //     titleside: 'right',
        //     titlefont: {
        //     size: 16,
        //     family: 'Arial, sans-serif'
        //     }
        //     }
        //         }
        //         ];
            
        //         var layout = {
        //         title: 'Surapodo Pressure Analysis',
        //     xaxis: {
        //     title: {
        //     text: 'Width in CM',
        //     font: {
        //     family: 'Courier New, monospace',
        //     size: 18,
        //     color: '#7f7f7f'
        //     }
        //     },
        //     },
        //     yaxis: {
        //     title: {
        //     text: 'Height in CM',
        //     font: {
        //     family: 'Courier New, monospace',
        //     size: 18,
        //     color: '#7f7f7f'
        //     }
        //     },
        //     },
        //     autosize: true,
        //     width: 300,
        //     height: 350
        //         }
            
        //         Plotly.plot(
        //             'contour_div',
        //             data,
        //             layout)
        //         .then(
        //             function(gd) {
        //             Plotly.toImage(gd, {
                        
        //                 })
        //                 .then(
        //                 function(url) {
        //                     graph_image.src = url;
        //                     return Plotly.toImage(gd, {
        //                     format: 'svg',
        //                     });
        //                 })
        //     //location.reload();
        //             });
         
        //  } 
   function chartIt_left_balance() {
    
    const ctx = document.getElementById('balance_left').getContext('2d');
    const balance_left = new Chart(ctx, {
        type: 'scatter',
        options: {
            responsive: false,
            hover: true,
            legend: {
                display: false
            },
            layout: {
                padding: {
                    left: 20,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            },

            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'LX'
                    },
                    ticks: {
                        min: -1000,
                        max: 1000,
                        stepSize: 250
                    },
                    gridLines: {
                        color: '#888',
                        drawOnChartArea: true
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: -1000,
                        max: 1000,
                        stepSize: 250
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'LY'
                    },
                    gridLines: {
                        color: '#888',
                        drawOnChartArea: true
                    }
                }]
            }
        },
        data: {
            datasets: [{
                    data: storage_left_balance,
                    showLine: true,
                    backgroundColor: "rgba(75,75,192,0.4)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: 'rgba(75,75,192,1)',
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(75,72,192,1)",
                    PointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    fill: false,
                    pointRadius: 0,
                    borderColor: [
                        'rgba(75, 75, 192, 1)'

                    ],
                    borderWidth: 2
                },
                {
                    type: 'scatter',
                    showLine: true,
                    borderColor: "rgba(255,0,0,0.6)",
                    pointRadius: 0,
                    borderWidth: 2.3,
                    data: [{
                            x: -1000,
                            y: 0
                        },
                        {
                            x: 1000,
                            y: 0
                        },
                    ]
                },
                {
                    type: 'scatter',
                    showLine: true,
                    borderColor: "rgba(255,0,0,0.6)",
                    pointRadius: 0,
                    borderWidth: 2.3,
                    data: [{
                            x: 0,
                            y: 1000
                        },
                        {
                            x: 0,
                            y: -1000
                        }
                    ]
                }
            ],
        }

    });
}
         
         // Function for Canvas 2 Plot (COP_balance) 
         function chartIt_cop() {
         //await getData();
         const ctx = document.getElementById('cop').getContext('2d');
         const cop = new Chart(ctx, {
         type: 'scatter',
         options: {
             responsive: false,
             hover: true,
             legend: {
                 display: false
             },
             layout: {
                 padding: {
                     left: 20,
                     right: 0,
                     top: 0,
                     bottom: 0
                 }
             },
         
             scales: {
                 xAxes: [{
                     scaleLabel: {
                         display: true,
                         labelString: 'COP-X'
                     },
                     ticks: {
                         min: -2000,
                         max: 2000,
                         stepSize: 500
                     },
                     gridLines: {
                         color: '#888',
                         drawOnChartArea: true
                     }
                 }],
                 yAxes: [{
                     scaleLabel: {
                         display: true,
                         labelString: 'COP-Y'
                     },
           ticks: {
                         min: -2000,
                         max: 2000,
                         stepSize: 500
                     },
                     gridLines: {
                         color: '#888',
                         drawOnChartArea: true
                     }
                 }]
             }
         },
         data: {
             datasets: [{
                     data: storage_cop,
                     showLine: true,
                     backgroundColor: "rgba(75,75,192,0.4)",
                     borderCapStyle: 'butt',
                     borderDash: [],
                     borderDashOffset: 0.0,
                     borderJoinStyle: 'miter',
                     pointBorderColor: 'rgba(75,75,192,1)',
                     pointBackgroundColor: "#fff",
                     pointBorderWidth: 1,
                     pointHoverRadius: 5,
                     pointHoverBackgroundColor: "rgba(75,72,192,1)",
                     PointHoverBorderColor: "rgba(220,220,220,1)",
                     pointHoverBorderWidth: 2,
                     pointRadius: 1,
                     pointHitRadius: 10,
                     fill: false,
                     pointRadius: 0,
                     borderColor: [
                         'rgba(75, 75, 192, 1)'
         
                     ],
                     borderWidth: 2
                 },
          {
                     type: 'scatter',
                     showLine: true,
                     borderColor: "rgba(255,0,0,0.6)",
                     pointRadius: 0,
                     borderWidth: 2.3,
                     data: [{
                             x: -2000,
                             y: 0
                         },
                         {
                             x: 2000,
                             y: 0
                         },
                     ]
                 },
                 {
                     type: 'scatter',
                     showLine: true,
                     borderColor: "rgba(255,0,0,0.6)",
                     pointRadius: 0,
                     borderWidth: 2.3,
                     data: [{
                             x: 0,
                             y: 2000
                         },
                         {
                             x: 0,
                             y: -2000
                         }
                     ]
                 },
                 
             ],
         }
         
         });
         }
         
         
         // Function for Canvas 3 Plot (right_balance)   
         function chartIt_right_balance() {
         //await getData();
         const ctx = document.getElementById('balance_right').getContext('2d');
         const balance_right = new Chart(ctx, {
         type: 'scatter',
         options: {
             responsive: false,
             hover: true,
             legend: {
                 display: false
             },
             layout: {
                 padding: {
                     left: 20,
                     right: 0,
                     top: 0,
                     bottom: 0
                 }
             },
         
             scales: {
                 xAxes: [{
                     scaleLabel: {
                         display: true,
                         labelString: 'RX'
                     },
                     ticks: {
                         min: -1000,
                         max: 1000,
                         stepSize: 250
                     },
                     gridLines: {
                         color: '#888',
                         drawOnChartArea: true
                     }
                 }],
                 yAxes: [{
                     ticks: {
                         min: -1000,
                         max: 1000,
                         stepSize: 250
                     },
                     scaleLabel: {
                         display: true,
                         labelString: 'RY'
                     },
                     gridLines: {
                         color: '#888',
                         drawOnChartArea: true
                     }
                 }]
             }
         },
         data: {
             datasets: [{
                     data: storage_right_balance,
                     showLine: true,
                     backgroundColor: "rgba(75,75,192,0.4)",
                     borderCapStyle: 'butt',
                     borderDash: [],
                     borderDashOffset: 0.0,
                     borderJoinStyle: 'miter',
                     pointBorderColor: 'rgba(75,75,192,1)',
                     pointBackgroundColor: "#fff",
                     pointBorderWidth: 1,
                     pointHoverRadius: 5,
                     pointHoverBackgroundColor: "rgba(75,72,192,1)",
                     PointHoverBorderColor: "rgba(220,220,220,1)",
                     pointHoverBorderWidth: 2,
                     pointRadius: 1,
                     pointHitRadius: 10,
                     fill: false,
                     pointRadius: 0,
                     borderColor: [
                         'rgba(75, 75, 192, 1)'
         
                     ],
                     borderWidth: 2
                 },
                 {
                     type: 'scatter',
                     showLine: true,
                     borderColor: "rgba(255,0,0,0.6)",
                     pointRadius: 0,
                     borderWidth: 2.3,
                     data: [{
                             x: -1000,
                             y: 0
                         },
                         {
                             x: 1000,
                             y: 0
                         },
                     ]
                 },
                 {
                     type: 'scatter',
                     showLine: true,
                     borderColor: "rgba(255,0,0,0.6)",
                     pointRadius: 0,
                     borderWidth: 2.3,
                     data: [{
                             x: 0,
                             y: 1000
                         },
                         {
                             x: 0,
                             y: -1000
                         }
                     ]
                 }
                 
             ],
         }
         
         });
         }
         
         
         //// Function for Canvas 4 Plot (left_gait) 
         function chartIt_left_gait() {
         //await getData();
         const ctx = document.getElementById('gait_left').getContext('2d');
         
         const gait_left = new Chart(ctx, {
         type: 'line',
         options: {
             responsive: true,
             maintainAspectRatio: false,
             legend: {
                 position: 'bottom',
                 display: true,            
             },
             hover: true,
             scales: {
                 xAxes: [{
                     scaleLabel: {
                         display: true,
                         labelString: 'Time (Second)',
                     },
           ticks: {
                     display: true,
                     maxTicksLimit: 18,
           },
                     gridLines: {
                         color: "rgba(0, 0, 0, 0)",
                     },
                     
                 }],
                 yAxes: [{
                     scaleLabel: {
                         display: true,
                         labelString: 'Sensor signal'
                     },
         ticks: {
         max: 700,
         min: 0,
         stepSize: 100
             },
                     gridLines: {
                         color: "rgba(0, 0, 0, 0)",
                     }
                 }]
             },
             
             layout: {
                 padding: {
                     left: 20,
                     right: 0,
                     top: 0,
                     bottom: 0
                 }
             },
             title: {
                 display: true,
                 text: 'Left Foot',
         fontSize: 14
             }
         },
         data: {
             labels: xlabels,
             datasets: [{
         label: 'Fore Foot',
                     data: foreL,
                     backgroundColor: "rgba(75,75,192,0.4)",
                     borderCapStyle: 'butt',
                     borderDash: [],
                     borderDashOffset: 0.0,
                     borderJoinStyle: 'miter',
                     pointBorderColor: 'rgba(75,75,192,1)',
                     pointBackgroundColor: "#fff",
                     pointBorderWidth: 1,
                     pointHoverRadius: 5,
                     pointHoverBackgroundColor: "rgba(75,72,192,1)",
                     PointHoverBorderColor: "rgba(220,220,220,1)",
                     pointHoverBorderWidth: 2,
                     pointRadius: 1,
                     pointHitRadius: 10,
                     fill: true,
                     pointRadius: 0,
                     borderColor: [
                         'rgba(75, 75, 192, 1)'
         
                     ],
                     borderWidth: 1
         
                 },
                 {
                     label: 'Mid Foot',
                     data: midL,
                     backgroundColor: "rgba(192,65,60,0.4)",
                     borderCapStyle: 'butt',
                     borderDash: [],
                     borderDashOffset: 0.0,
                     borderJoinStyle: 'miter',
                     pointBorderColor: 'rgba(192,65,60,1)',
                     pointBackgroundColor: "#fff",
                     pointBorderWidth: 1,
                     pointHoverRadius: 5,
                     pointHoverBackgroundColor: "rgba(192,62,60,1)",
                     PointHoverBorderColor: "rgba(220,220,220,1)",
                     pointHoverBorderWidth: 2,
                     pointRadius: 1,
                     pointHitRadius: 10,
                     fill: true,
                     pointRadius: 0,
                     borderColor: [
                         'rgba(192, 65, 60, 1)'
                     ],
                     borderWidth: 1
                 },
                 {
                     label: 'Heel',
                     data: heelL,
                     backgroundColor: "rgba(75,200,60,0.4)",
                     borderCapStyle: 'butt',
                     borderDash: [],
                     borderDashOffset: 0.0,
                     borderJoinStyle: 'miter',
                     pointBorderColor: 'rgba(75,200,60,1)',
                     pointBackgroundColor: "#fff",
                     pointBorderWidth: 1,
                     pointHoverRadius: 5,
                     pointHoverBackgroundColor: "rgba(72,200,60,1)",
                     PointHoverBorderColor: "rgba(220,220,220,1)",
                     pointHoverBorderWidth: 2,
                     pointRadius: 1,
                     pointHitRadius: 10,
                     fill: true,
                     pointRadius: 0,
                     borderColor: [
                         'rgba(75, 200, 60, 1)'
         
                     ],
                     borderWidth: 1
                 }
              
             ]
         },
         
         });
         
         }
         
         
         // Function for Canvas 5 Plot (right_gait)  
         function chartIt_right_gait() {
         //await getData();
         const ctx = document.getElementById('gait_right').getContext('2d');
         const myChart2 = new Chart(ctx, {
         type: 'line',
         options: {
             responsive: true,
             maintainAspectRatio: false,
             legend: {
                 position: 'bottom',
                 display: true,            
             },
             hover: true,
         
             scales: {
                 xAxes: [{
         
                     scaleLabel: {
                         display: true,
                         labelString: 'Time (Second)'
                     },
           ticks: {
                     display: true,
                     maxTicksLimit: 18
           },
                     gridLines: {
                         color: "rgba(0, 0, 0, 0)",
                     }
                 }],
                 yAxes: [{
         
                     scaleLabel: {
                         display: true,
                         labelString: 'Sensor signal'
                     },
         ticks: {
         max: 700,
         min: 0,
         stepSize: 100
             },
                     gridLines: {
                         color: "rgba(0, 0, 0, 0)",
                     }
                 }]
             },
             layout: {
                 padding: {
                     left: 20,
                     right: 0,
                     top: 0,
                     bottom: 0
                 }
             },
             title: {
                 display: true,
                 text: 'Right Foot',
         fontSize: 14
             }
         },
         data: {
             labels: xlabels,
             datasets: [{
                     label: 'Fore Foot',
                     data: foreR,
                     backgroundColor: "rgba(75,75,192,0.4)",
                     borderCapStyle: 'butt',
                     borderDash: [],
                     borderDashOffset: 0.0,
                     borderJoinStyle: 'miter',
                     pointBorderColor: 'rgba(75,75,192,1)',
                     pointBackgroundColor: "#fff",
                     pointBorderWidth: 1,
                     pointHoverRadius: 5,
                     pointHoverBackgroundColor: "rgba(75,72,192,1)",
                     PointHoverBorderColor: "rgba(220,220,220,1)",
                     pointHoverBorderWidth: 2,
                     pointRadius: 1,
                     pointHitRadius: 10,
                     fill: true,
                     pointRadius: 0,
                     borderColor: [
                         'rgba(75, 75, 192, 1)'
         
                     ],
                     borderWidth: 1
         
                 },
                 {
                     label: 'Mid Foot',
                     data: midR,
                     backgroundColor: "rgba(192,65,60,0.4)",
                     borderCapStyle: 'butt',
                     borderDash: [],
                     borderDashOffset: 0.0,
                     borderJoinStyle: 'miter',
                     pointBorderColor: 'rgba(192,65,60,1)',
                     pointBackgroundColor: "#fff",
                     pointBorderWidth: 1,
                     pointHoverRadius: 5,
                     pointHoverBackgroundColor: "rgba(192,62,60,1)",
                     PointHoverBorderColor: "rgba(220,220,220,1)",
                     pointHoverBorderWidth: 2,
                     pointRadius: 1,
                     pointHitRadius: 10,
                     fill: true,
                     pointRadius: 0,
                     borderColor: [
                         'rgba(192, 65, 60, 1)'
         
         
                     ],
                     borderWidth: 1
                 },
                 {
                     label: 'Heel',
                     data: heelR,
                     backgroundColor: "rgba(75,200,60,0.4)",
                     borderCapStyle: 'butt',
                     borderDash: [],
                     borderDashOffset: 0.0,
                     borderJoinStyle: 'miter',
                     pointBorderColor: 'rgba(75,200,60,1)',
                     pointBackgroundColor: "#fff",
                     pointBorderWidth: 1,
                     pointHoverRadius: 5,
                     pointHoverBackgroundColor: "rgba(72,200,60,1)",
                     PointHoverBorderColor: "rgba(220,220,220,1)",
                     pointHoverBorderWidth: 2,
                     pointRadius: 1,
                     pointHitRadius: 10,
                     fill: true,
                     pointRadius: 0,
                     borderColor: [
                         'rgba(75, 200, 60, 1)'
         
                     ],
                     borderWidth: 1
                 }
              
             ]
         },
         
         });
         
         }
         
       // Function for get all columns 
async function chappalGraph(sFileName){
        const chappalresponse = await fetch(sFileName); // Upload CSV 
        // const data = await response.text();
    
        localStorage.setItem('chappal_key',sFileName); 
        if(sFileName && localStorage.getItem('chappal_key') !=''){
            
            const chappalData = [];
            const avgChappalData = [];
                // const response = await fetch('k19.csv'); // Upload CSV 
                const fileData = await chappalresponse.text();          
                const table = fileData.split('\n').slice(1);
        
                table.forEach(function (row, i) {
                    const columns = row.split(',');
                    var length = fileData.split("\n").length; 
                    chappalData[i] = columns;              
                });
                chappalData.forEach(function(row,indexData){
                chappalData[indexData] = chappalData[indexData].toString().replace('{""l"":[{""p"":[',"")
                chappalData[indexData] = chappalData[indexData].split(","); 
                var rowWiseData = replaceAll(chappalData[indexData].toString(), '"{""p"":[', '');
                rowWiseData = replaceAll(rowWiseData.toString(), ']}', '');
                chappalData[indexData] = rowWiseData.split(",");                    
            });
             /* Start column wise sum and after than avg */
            result = chappalData.reduce(function (r, a) {
                    a.forEach(function (b, i) {
                        r[i] = (r[i] || 0) + parseInt(b.replace('"',""));
                    });
                    return r;
                }, []);
            // document.write('<pre>' + JSON.stringify(result, 0, 4) + '</pre>');
            result.forEach(function(avgrow1,avgindex){
                result[avgindex] = parseInt(avgrow1/chappalData.length);
            });
            // var resizeData = resize(result,[50][50],0);
            const newResizeArr = [];
            const finalArr = [];
            while(result.length) newResizeArr.push(result.splice(0,50));
            var x, x_length = 50, y, y_length = 50, map = [], map1 = [], map2 =[];

                // Don't be lazy
                for (x = 0; x < x_length; x++) {
                map[x] = []
                    for (y = 0; y < y_length; y++) {
                        map[x][y] = newResizeArr[y][49-x];
                    }
                }
        for (x = 0; x < x_length; x++) {
        map2[x] = []
        for (y= 0; y < y_length; y++){
			if(map[x][y] >=30){
          map2[x][y] = (3.68177 * Math.pow(1.00163,( map[x][y]))).toFixed(2);
			}
			else map2[x][y] = 0;
        }
      }
            var d3 = Plotly.d3
            var canvas = document.getElementById('chappal_chart');
            var ctx = canvas.getContext('2d');
            var graph_image = new Image();

            // Plotly.d3.csv('4_180.csv', function(err,columns) {

            //console.log(rows);
            var data = [];
            var data = [{
                z: map2,
        x:[0,0.7,1.4,2.1,2.8,3.5,4.2,4.9,5.6,6.3,7,7.7,8.4,9.1,9.8,10.5,11.2,11.9,12.6,13.3,14,14.7,15.4,16.1,16.8,17.5,18.2,18.9,19.6,20.3,21,21.7,22.4,23.1,23.8,24.5,25.2,25.9,26.6,27.3,28,28.7,29.4,30.1,30.8,31.5,32.2,32.9,33.6,34.3],
        y:[0,0.7,1.4,2.1,2.8,3.5,4.2,4.9,5.6,6.3,7,7.7,8.4,9.1,9.8,10.5,11.2,11.9,12.6,13.3,14,14.7,15.4,16.1,16.8,17.5,18.2,18.9,19.6,20.3,21,21.7,22.4,23.1,23.8,24.5,25.2,25.9,26.6,27.3,28,28.7,29.4,30.1,30.8,31.5,32.2,32.9,33.6,34.3],
        
                type: 'contour',
                colorscale: [[0, 'rgb(255,255,255)'], [0.25, 'rgb(31,120,180)'], [0.45, 'rgb(178,223,138)'], [0.65, 'rgb(51,160,44)'], [0.85, 'rgb(251,154,153)'], [1, 'rgb(227,26,28)']],
                autocontour: true,
                contours: {
          coloring: 'heatmap',
                start: 50,
                end: 1500,
                size: 100
            },
			colorbar:{
					title: 'Pressure (kPA)',
					titleside: 'right',
					titlefont: {
							size: 16,
							family: 'Arial, sans-serif'
							   }
					}
            }
            ];

            var layout = {

      xaxis: {
        title: {
        text: 'Width in CM',
        font: {
        family: 'Courier New, monospace',
        size: 18,
        color: '#7f7f7f'
          }
        },
      },
      yaxis: {
        title: {
        text: 'Height in CM',
        font: {
        family: 'Courier New, monospace',
        size: 18,
        color: '#7f7f7f'
          }
        },
      },
      autosize: true,
      width: 400,
        height: 390
            }

            Plotly.plot(
                'contour_div',
                data,
                layout)
            .then(
                function(gd) {
                Plotly.toImage(gd, {
                    
                    })
                    .then(
                    function(url) {
                        graph_image.src = url;
                        return Plotly.toImage(gd, {
                        format: 'svg',
                        });
                    })
        //location.reload();
                });
            // });
        
        /*start calculation  part  */
            // result = map.reduce(function (rowindex, rowdata) {
                map.forEach(function (rowdata, rowindex) {
                    map1[rowindex] = [];                    
                    rowdata.forEach(function (columandata, indexData1) {
                        if (columandata >= 30 &&  columandata !='NaN'){
                            map1[rowindex][indexData1] = 1;
                        }else{
                            map1[rowindex][indexData1] = 0;
                        }
                    });         
            }, []);
                for (let indexCali = 1; indexCali <= 48; indexCali++) {
                    for (let indexCalJ = 1; indexCalJ <= 48; indexCalJ++) {
                        if (map1[indexCali][indexCalJ] == 1){
                            list = [map1[indexCali-1][indexCalJ-1], map1[indexCali-1][indexCalJ], map1[indexCali-1][indexCalJ+1], map1[indexCali+1][indexCalJ-1], map1[indexCali+1][indexCalJ], map1[indexCali-1][indexCalJ+1], map1[indexCali][indexCalJ-1], map1[indexCali][indexCalJ+1]]                         
                            var sum = list.reduce(function(a, b){
                                return a + b;
                            }, 0);
                            if (sum ==  0){
                                map1[indexCali][indexCalJ]  = 0;
                            }
                        }
                    
                    }
                }               
                            
                
                var arr_left_height = []
                var arr_right_height = []
        var arr_left_width = []
                var arr_right_width = []

                                
                /* # Left  */
                for (let leftindexCali = 0; leftindexCali <= 49; leftindexCali++) {
                    for (let leftindexCalJ = 0; leftindexCalJ < 25; leftindexCalJ++) {
                        if (map1[leftindexCali][leftindexCalJ] == 1){
                            arr_left_height.push(leftindexCali)
              arr_left_width.push(leftindexCalJ)
            }
                    }
                }
                for (let rightindexCali = 0; rightindexCali <= 49; rightindexCali++) {
                    for (let rightindexCalJ = 25; rightindexCalJ < 50; rightindexCalJ++) {
                        if (map1[rightindexCali][rightindexCalJ] == 1){
                            arr_right_height.push(rightindexCali)
              arr_right_width.push(rightindexCalJ)
            }
                    }
                }
                
                var left_sort = arr_left_height.sort((a,b)=>a-b);
                var right_sort = arr_right_height.sort((a,b)=>a-b);
        var left_sort_width = arr_left_width.sort((a,b)=>a-b);
                var right_sort_width = arr_right_width.sort((a,b)=>a-b);
        //console.log(left_sort,"***************Left Sort");
        //console.log(right_sort,"***************Right Sort");
                var foot_length_left = (left_sort[left_sort.length - 1] - left_sort[0] + 1) * 0.7
                var foot_length_right = (right_sort[right_sort.length - 1] - right_sort[0] + 1) * 0.7
        
        var foot_width_left = ((left_sort_width[left_sort_width.length - 1] - left_sort_width[0] + 1) * 0.7).toFixed(1)
        var foot_width_right = ((right_sort_width[right_sort_width.length - 1] - right_sort_width[0] + 1) * 0.7).toFixed(1)
        $('#lfl').text((foot_length_left.toFixed(1) +' cm'));
        $('#rfl').text((foot_length_right.toFixed(1) +' cm'));
        $('#lfw').text((foot_width_left) +' cm');
        $('#rfw').text((foot_width_right)+' cm');
                
/*              # Count number of pressure points in a row */
                var count_left = [];
                var count_right = [];

                /* # Left */
                for (let leftpressurei = 0; leftpressurei <= 49; leftpressurei++) {
                    var temp_left = 0
                    for (let lefpressureJ = 0; lefpressureJ < 25; lefpressureJ++) {
                        if (map1[leftpressurei][lefpressureJ] == 1){
                            temp_left = temp_left + 1
                        }
                        count_left[leftpressurei] = temp_left
                    }
                }

                /* # Right */
                for (let rightpressurei = 0; rightpressurei <= 49; rightpressurei++) {
                    var temp_right = 0
                    for (let rightpressureJ = 25; rightpressureJ < 50; rightpressureJ++) {
                        if (map1[rightpressurei][rightpressureJ] == 1){
                            temp_right = temp_right + 1
                        }
                        count_right[rightpressurei] = temp_right
                    }
                }        
          
                /* # Left */
                var start_row_left = left_sort[left_sort.length - 1] - 5;
                var end_row_left = left_sort[0];
                var reminder_left = (start_row_left - end_row_left + 1) % 3;

                if (reminder_left == 1 ){
                    start_row_left = start_row_left + 2;
                }else if(reminder_left == 2){
                    start_row_left = start_row_left + 1
                }   
                var per_foot_left = parseInt((start_row_left + 1 - end_row_left) / 3)  

                /* # Right */
                var start_row_right = right_sort[right_sort.length - 1] - 5;
                var end_row_right = right_sort[0];
                var reminder_right = (start_row_right - end_row_right + 1) % 3;

                if (reminder_right == 1 ){
                    start_row_right = start_row_right + 2;
                }else if(reminder_right == 2){
                    start_row_right = start_row_right + 1;
                }
                var per_foot_right = parseInt((start_row_right + 1 - end_row_right) / 3);
                            
                /* # Left */
                var Heel_foot_left = sum_array(end_row_left,end_row_left + per_foot_left,count_left);
                var mid_foot_left = sum_array(end_row_left + per_foot_left,end_row_left + 2*(per_foot_left),count_left);
                var fore_foot_left = sum_array(end_row_left + 2*(per_foot_left), start_row_left + 1,count_left);
                

                /* # Right */
                var Heel_foot_right = sum_array(end_row_right,end_row_right + per_foot_right,count_right);
                var mid_foot_right = sum_array(end_row_right + per_foot_right,end_row_right + 2*(per_foot_right),count_right);
                var fore_foot_right = sum_array(end_row_right + 2*(per_foot_right),start_row_right + 1,count_right);
                
                function sum_array(start, end,arr){
                    var sum = 0;
                    for (var i=start; i<end; i++){
                    sum = sum + arr[i]; 
                    }
                    return sum;
            }
                var left_arch_index =(mid_foot_left / (fore_foot_left + mid_foot_left + Heel_foot_left)).toFixed(2);
                var right_arch_index = (mid_foot_right / (fore_foot_right + mid_foot_right + Heel_foot_right)).toFixed(2);
               
                $('#ai1').text(left_arch_index);
                $('#ai2').text(right_arch_index);

                 if (left_arch_index < 0.21){
                    $('#tft1').text('HIGH');
                    $('#ft1').attr("src", "images/H1.png");
                 }else if(left_arch_index > 0.28){
                    $('#tft1').text('FLAT');
                    $('#ft1').attr("src", "images/F1.png");
                 }else{
                    $('#tft1').text('NORMAL');
                    $('#ft1').attr("src", "images/N1.png");
                 }
                 if (right_arch_index < 0.21){
                    $('#tft2').text('HIGH');
                    $('#ft2').attr("src", "images/H2.png");
                 }else if(right_arch_index > 0.28){
                    $('#tft2').text('FLAT');
                    $('#ft2').attr("src", "images/F2.png");
                 }else{
                    $('#tft2').text('NORMAL');
                    $('#ft2').attr("src", "images/N2.png");
                 }
            
        }
}  
         async function getData() { 
  <?php
      $sec =explode(".",$playback_time)[2]; 
      $cutTime =    round($sec*0.20);
    //   $startTime = explode(".",$playback_time)[0];
      $startTime = date("H:i:s", strtotime(explode(".",$playback_time)[0]) + $cutTime);
      $addedtime = date("H:i:s", strtotime(explode(".",$playback_time)[0]) + (($sec + 1)- $cutTime));
      
   $strSQL = "SELECT distinct TIME_TO_SEC(ROUND(
    TIMEDIFF(surasole.action,(SELECT `action` FROM `surasole` 
    LEFT JOIN mod_customer ON mod_customer.id_customer = surasole.id_customer
    WHERE surasole.`id_customer`='$id_customer' AND  surasole.`type`='$playback_type' 
    AND surasole.action BETWEEN '$datetimepicker $startTime' AND '$datetimepicker $addedtime'
    ORDER BY `duration` ASC limit 1))
,1)) AS duration
    ,surasole.left_sensor1,surasole.left_sensor2,surasole.left_sensor3,
    surasole.left_sensor4,surasole.left_sensor5,surasole.right_sensor1,surasole.right_sensor2,
    surasole.right_sensor3,surasole.right_sensor4,surasole.right_sensor5,(surasole.left_sensor2+surasole.left_sensor3)/2 as left_stride_F,
    (surasole.left_sensor3-surasole.left_sensor2) as left_balance_x,(((surasole.left_sensor2+surasole.left_sensor3)/2)-surasole.left_sensor5) as left_balance_y,(surasole.right_sensor2+surasole.right_sensor3)/2 as right_stride_F,(surasole.right_sensor3-surasole.right_sensor2) as right_balance_x,
    (((surasole.right_sensor2+surasole.right_sensor3)/2)-surasole.right_sensor5) as right_balance_y,(((surasole.right_sensor2+surasole.right_sensor3)/2)+(surasole.right_sensor4+surasole.right_sensor5))-(((surasole.left_sensor2+surasole.left_sensor3)/2)+(surasole.left_sensor4+surasole.left_sensor5)) as body_COP_x,(((surasole.left_sensor2+surasole.left_sensor3)/2)+((surasole.right_sensor2+surasole.right_sensor3)/2))-(surasole.right_sensor5+surasole.left_sensor5) as body_COP_y
    
FROM
    `surasole`
LEFT JOIN mod_customer ON mod_customer.id_customer = surasole.id_customer
WHERE surasole.`id_customer`='$id_customer' AND  surasole.`type`='$playback_type'  AND surasole.action BETWEEN '$datetimepicker $startTime' AND '$datetimepicker $addedtime' ORDER BY surasole.action";
$result = mysqli_query($objConnect, $strSQL);
$i = 2;
?>
var columns1 = [];
var column29 = [];
var column30 = [];
var column31 = [];
var column32 = [];
var column33 = [];
var column34 = [];
var left_sen1 = [];
var left_sen2 = [];
var left_sen3 = [];
var right_sen1 = [];
var right_sen2 = [];
var right_sen3 = [];
var wssum = [];
var columnsData1 = [];
var columnsData12 = [];

<?php
$mainData = [];
  while($columnsData = mysqli_fetch_assoc($result)){   
        $columnsDataStr =  implode(",",$columnsData);  
        array_push($mainData,$columnsDataStr);        
      }
?>
selectsec = '<?php echo $sec; ?>';
//var new_sec = 1 + (selectsec - Math.round(selectsec*0.40));

//new_ticks = new_sec -1;
//new_sec_pdf[0] = new_sec;
columnsData12 = '<?php echo json_encode($mainData); ?>';
const columnsDataFinal = columnsData12.split('","').slice(1);
    columnsDataFinal.forEach(function (row, i) {
        const columns = row.split(',');
        const time = columns[0];
        xlabels.push(time);
        xlabels_int.push(parseInt(time)); //Integer in sec to plot LEFT and RIGHT GAIT
		// Left Fore-foot ((S2+S3)/2)
        const fore_left = columns[11];
        //const fore_left_kpa = ((1.7501 * fore_left)-90.201).toFixed(2); 
        foreL.push(fore_left);
		
		// Left Mid-foot
        const mid_left = parseInt(columns[4]);
        midL.push(mid_left);
		const heel_left = parseInt(columns[5]);
		heelL.push(heel_left);
		
		//Left Balance
        const lx = columns[12]
        const ly = columns[13]
        var json_left = {
            x: lx,
            y: ly
        };
        storage_left_balance.push(json_left);
		
		// COP Balance
        const cop_x = columns[17]
        const cop_y = columns[18]
        var json_cop = {
            x: cop_x,
            y: cop_y
        };
        storage_cop.push(json_cop);
		
		//Right Balance
        const rx = columns[15]
        const ry = columns[16]
        var json_right = {
            x: rx,
            y: ry
        };
        storage_right_balance.push(json_right);

		// Right Fore-foot ((S2+S3)/2)
        const fore_right = columns[14];
		//const fore_right_kpa = (1.15037 * Math.pow(1.00774,fore_right)).toFixed(2);;
        foreR.push(fore_right);
		
		//Right Mid-foot
        const mid_right = parseInt(columns[9]);
        midR.push(mid_right);
		
		//Right Heel
        const heel_right = parseInt(columns[10]);
		
		
        heelR.push(heel_right);
    
    
    /* COP KPA Conversion */
    //const cop_x_kpa = (parseFloat(fore_right_kpa) + parseFloat(mid_right_kpa) + parseFloat(heel_right_kpa)) -(parseFloat(fore_left_kpa) + parseFloat(mid_left_kpa) + parseFloat(heel_left_kpa))
    //const cop_y_kpa = (parseFloat(fore_right_kpa) + parseFloat(fore_left_kpa)) - (parseFloat(heel_right_kpa) + parseFloat(heel_left_kpa))
	
	
    const left_s1 = parseInt(columns[1]);
    const left_s2 = parseInt(columns[2]);
    const left_s3 = parseInt(columns[3]);
	const right_s1 = parseInt(columns[6]);
    const right_s2 = parseInt(columns[7]);
    const right_s3 = parseInt(columns[8]);
    left_sen1.push(left_s1);
	left_sen2.push(left_s2);
	left_sen3.push(left_s3);
	right_sen1.push(right_s1);
	right_sen2.push(right_s2);
	right_sen3.push(right_s3);
    
 
        columns[29] = (parseInt(columns[1])+parseInt(columns[2])+parseInt(columns[3])+parseInt(columns[4])+parseInt(columns[5]));// Sum LEFT
        columns[30] = (parseInt(columns[6])+parseInt(columns[7])+parseInt(columns[8])+parseInt(columns[9])+parseInt(columns[10]));//Sum RIGHT
        columns[31] = (parseInt(columns[29]) - parseInt(columns[30]));  // LEFT - RIGHT    
        columns[32] = (parseInt(columns[30]) - parseInt(columns[29]));  // RIGHT - LEFT
		columns[33] = parseInt((parseInt(columns[1])+parseInt(columns[2])+parseInt(columns[3])) /3); //Left Fore Foot (Avg. of 3 sensors)
		columns[34] = parseInt((parseInt(columns[6])+parseInt(columns[7])+parseInt(columns[8])) /3); //Right Fore Foot (Avg. of 3 sensors)
    
        column29.push(columns[29]); // Sum LEFT
        column30.push(columns[30]); // Sum RIGHT
        column31.push(columns[31]); // Left - RIGHT
        column32.push(columns[32]); // RIGHT - LEFT
		column33.push(columns[33]); //Left Fore Foot
        column34.push(columns[34]); //Right Fore Foot 
        
        
    });
   
   
/********************** Step Count and Walking Speed**********Start********** */
var subject_count = [];
var new_x = [];
var new_y = [];
var step_count = 0;
var gait_dis = localStorage.getItem('gait_distance');
$('#gait_distance').val(gait_dis);
var gait_speed = 0;
    column31.forEach(function (row1, ival) {
        if((column31[ival] < 0 && column31[ival+1] >= 0) || (column31[ival] > 0 && column31[ival+1] <= 0)){
            step_count = step_count + 1
        }
        if(column31[ival] < 0 && column31[ival+1] >= 0){
            subject_count.push(ival)        
        }
    });
        step_count_pdf[0] = step_count;
		new_sec = xlabels[xlabels.length-1];
		new_ticks = new_sec;
		new_sec_pdf[0] = new_sec;
        console.log(gait_dis, "*************Distance***************");
        console.log(new_sec,"*******Time********");
        if (gait_dis > 0){
            gait_speed = (gait_dis / new_sec).toFixed(2);
        }
        $('#sc').text(step_count);  
        $('#ws').text(Math.round((step_count/new_sec)*60))
        $('#gs').text((gait_speed));
        
    
	
/********************** Step Count and Walking Speed**********End********** */	



   
/********************** Cross-Section Points for Subject**********Start********** */	

length = subject_count.length;
subject_count.forEach(function (sub, sub_i) {
    new_x.push(storage_cop[subject_count[sub_i]].x);
    new_y.push(storage_cop[subject_count[sub_i]].y);    

});
box_new_x.push(new_x);
box_new_y.push(new_y);
box_length.push(length);

var new_x_sum = 0;
var new_x_mean = 0;
var new_x_sd = 0;
var new_x_sd_tot = 0;
var new_x_sd_square = 0;
var new_y_sum = 0;
var new_y_mean = 0;
var new_y_sd = 0;
var new_y_sd_tot = 0;
var sd_x =0;
var sd_y =0;

    new_x.forEach(function (new_x_val, new_x_i) {
        new_x_sum = new_x_sum+parseFloat(new_x_val);        
    });

   new_x_mean = Math.round(new_x_sum/new_x.length,2);
    new_x_mean_pdf[0] = new_x_mean;
    //$('#sub1').text(new_x_mean);

   new_x.forEach(function (new_x_sd_val, new_x_sd_i) {
    sd_x = Math.pow((new_x_sd_val-new_x_mean),2);
    new_x_sd_tot = new_x_sd_tot + parseFloat(sd_x);
   });
   new_x_sd = new_x_sd_tot / new_x.length;
   new_x_sd_square = Math.round(Math.sqrt(new_x_sd),2);
   new_x_sd_square_pdf[0] = new_x_sd_square;    
   //$('#sub2').text(new_x_sd_square);
      new_y.forEach(function (new_y_val, new_y_i) {
    new_y_sum = new_y_sum+parseFloat(new_y_val);    
   });
   new_y_mean = Math.round(new_y_sum/new_y.length,2);
   new_y_mean_pdf[0] = new_y_mean;
   //$('#sub3').text(new_y_mean);

   new_y.forEach(function (new_y_sd_val, new_y_sd_i) {
    sd_y = Math.pow((new_y_sd_val-new_y_mean),2);
      new_y_sd_tot = new_y_sd_tot + parseFloat(sd_y);
   });
   new_y_sd = new_y_sd_tot / new_y.length;
   new_y_sd_square = Math.round(Math.sqrt(new_y_sd),2);
   new_y_sd_square_pdf[0] = new_y_sd_square;
   //$('#sub4').text(new_y_sd_square);
   
/********************** Cross-Section Points for Subject**********End********** */	


/********************** Peak Pressure Calculation**********Start********** */	



var index_left = [];
var index_right = [];


for (var i = 2; i < column31.length - 4; i++) {
	
	if ((column31[i] > 1000) && (column29[i] > 1200) && (column29[i] > column29[i-1]) && (column29[i] > column29[i+1])){
		index_left.push(i);
	}
	if((column29[i] == column29[i-1]) && (column29[i] == column29[i+1])){
		
		if((column29[i+1] > column29[i+2]) && (column31[i+1] > 1000) && (column29[i+1] > 1200)){
            index_left.push(i+1)
		 }
		 
        else if((column29[i+2] > column29[i+3]) && (column31[i+2] > 1000) && (column29[i+2] > 1200)){
            index_left.push(i+2)
	    }
            
        else if((column29[i+3] > column29[i+4]) && (column31[i+3] > 1000) && (column29[i+3] > 1200)){
			index_left.push(i+3)
		}
    }
	
	if((column29[i] > column29[i-1]) && (column29[i] == column29[i+1])){  
        
        if((column29[i+1] > column29[i+2]) && (column31[i+1] > 1000) && (column29[i+1] > 1200)){
            index_left.push(i+1)
		}
            
        else if((column29[i+2] > column29[i+3]) && (column31[i+2] > 1000) && (column29[i+2] > 1200)){
            index_left.push(i+2)
		}
            
        else if((column29[i+3] > column29[i+4]) && (column31[i+3] > 1000) && (column29[i+3] > 1200)){
            index_left.push(i+3)
		}
	}
		
	
}	

for (var i = 2; i < column31.length - 4; i++) {
	
	if ((column32[i] > 1000) && (column30[i] > 1200) && (column30[i] > column30[i-1]) && (column30[i] > column30[i+1])){
		index_right.push(i);
	}
	if((column30[i] == column30[i-1]) && (column30[i] == column30[i+1])){
		
		if((column30[i+1] > column30[i+2]) && (column32[i+1] > 1000) && (column30[i+1] > 1200)){
            index_right.push(i+1)
		 }
		 
        else if((column30[i+2] > column30[i+3]) && (column32[i+2] > 1000) && (column30[i+2] > 1200)){
            index_right.push(i+2)
	    }
            
        else if((column30[i+3] > column30[i+4]) && (column32[i+3] > 1000) && (column30[i+3] > 1200)){
			index_right.push(i+3)
		}
    }
	
	if((column30[i] > column30[i-1]) && (column30[i] == column30[i+1])){  
        
        if((column30[i+1] > column30[i+2]) && (column32[i+1] > 1000) && (column30[i+1] > 1200)){
            index_right.push(i+1)
		}
            
        else if((column30[i+2] > column30[i+3]) && (column32[i+2] > 1000) && (column30[i+2] > 1200)){
            index_right.push(i+2)
		}
            
        else if((column30[i+3] > column30[i+4]) && (column32[i+3] > 1000) && (column30[i+3] > 1200)){
            index_right.push(i+3)
		}
	}	
	
}	    
 
var new_left = []
var new_right = []

for (var i = 0; i < index_left.length-1; i++) {
    if ((index_left[i+1] - index_left[i]) >5){
        new_left.push(index_left[i])
	}
}
		
for (var i = 0; i < index_right.length-1; i++) {
    if ((index_right[i+1] - index_right[i]) >5){
        new_right.push(index_right[i])  
	}
}	
		

      
start_peak = Math.min(new_left[0],new_right[0]);
end_peak  = Math.max(new_left[new_left.length-1], new_right[new_right.length-1]); 
//arr_peak = np.concatenate((new_left, new_right))
new_left.push.apply(new_left,new_right);
arr_peak = new_left;
//x_peak = np.sort(arr_peak)
x_peak = arr_peak.sort((a, b) => a - b);
length_peak = x_peak.length;

var max_l1 = []
var max_l2 = []
var max_l3 = []
var max_l4 = []
var max_l5 = []
var max_r1 = []
var max_r2 = []
var max_r3 = []
var max_r4 = []
var max_r5 = []

if(start_peak == new_left[0]){
    for (var j = 0; j < length_peak-1; j++){ 
        if (j %2 == 0){
            var max_rs1 = 0
            var max_rs2 = 0
            var max_rs3 = 0
            var max_rs4 = 0
            var max_rs5 = 0
		for (var i = x_peak[j]; i < x_peak[j+1]+6 ; i++){
  
                if(right_sen1[i] > max_rs1){
                    max_rs1 = right_sen1[i]
				}
                    
                if(right_sen2[i] > max_rs2){
                    max_rs2 = right_sen2[i]
				}
                    
                if(right_sen3[i] > max_rs3){
                    max_rs3 = right_sen3[i]
				}
                    
                if(midR[i] > max_rs4){
                    max_rs4 = midR[i]
				}
                    
                if(heelR[i] > max_rs5){
                    max_rs5 = heelR[i]
				}					
			}    
            max_r1.push(max_rs1)    
            max_r2.push(max_rs2)
            max_r3.push(max_rs3)
            max_r4.push(max_rs4)
            max_r5.push(max_rs5)
		}
        else {
            var max_ls1 = 0
            var max_ls2 = 0
            var max_ls3 = 0
            var max_ls4 = 0
            var max_ls5 = 0
			for (var k = x_peak[j]; k < x_peak[j+1]+6 ; k++){
    
                if(left_sen1[k] > max_ls1){
                    max_ls1 = left_sen1[k]
				}
                    
                if(left_sen2[k] > max_ls2){
                    max_ls2 = left_sen2[k]
				}
                    
                if(left_sen3[k] > max_ls3){
                    max_ls3 = left_sen3[k]
				}
                    
                if(midL[k] > max_ls4){
                    max_ls4 = midL[k]
				}
                    
                if(heelL[k] > max_ls5){
                    max_ls5 = heelL[k]  
				}
			}
				
                    
            max_l1.push(max_ls1)    
            max_l2.push(max_ls2)
            max_l3.push(max_ls3)
            max_l4.push(max_ls4)
            max_l5.push(max_ls5)
		}
	}
}

if(start_peak == new_right[0]){
    for (var j=0; j< length_peak-1; j++){ 
        if (j %2 != 0){
            var max_rs1 = 0
            var max_rs2 = 0
            var max_rs3 = 0
            var max_rs4 = 0
            var max_rs5 = 0
			
            for (var i = x_peak[j]; i< x_peak[j+1]+6; i++){ 
			
                if(right_sen1[i] > max_rs1){
                    max_rs1 = right_sen1[i]
				}
				
                if(right_sen2[i] > max_rs2){
                    max_rs2 = right_sen2[i]
				}
                    
                if(right_sen3[i] > max_rs3){
                    max_rs3 = right_sen3[i]
				}
                    
                if(midR[i] > max_rs4){
                    max_rs4 = midR[i]
				}
                    
                if(heelR[i] > max_rs5){
                    max_rs5 = heelR[i]  
				}
			}				
                    
            max_r1.push(max_rs1)    
            max_r2.push(max_rs2)
            max_r3.push(max_rs3)
            max_r4.push(max_rs4)
            max_r5.push(max_rs5)
		}
        else {
            var max_ls1 = 0
            var max_ls2 = 0
            var max_ls3 = 0
            var max_ls4 = 0
            var max_ls5 = 0
            for (var k = x_peak[j]; k < x_peak[j+1]+6; k++){
				
                if(left_sen1[k] > max_ls1){
                    max_ls1 =left_sen1[k]
				}
                    
                if(left_sen2[k] > max_ls2){
                    max_ls2 =left_sen2[k]
				}
				
                if(left_sen3[k] > max_ls3){
                    max_ls3 = left_sen3[k]
				}
                    
                if(midL[k] > max_ls4){
                    max_ls4 = midL[k]
				}
                    
                if(heelL[k] > max_ls5){
                    max_ls5 = heelL[k] 
				}					
			} 
            max_l1.push(max_ls1)    
            max_l2.push(max_ls2)
            max_l3.push(max_ls3)
            max_l4.push(max_ls4)
            max_l5.push(max_ls5)
		}
	}
}
var sum_peak_l1 = 0;
var sum_peak_l2 = 0;
var sum_peak_l3 = 0;
var sum_peak_l4 = 0;
var sum_peak_l5 = 0;
var sum_peak_r1 = 0;
var sum_peak_r2 = 0;
var sum_peak_r3 = 0;
var sum_peak_r4 = 0;
var sum_peak_r5 = 0;

for (var i=0; i < max_l1.length; i++){
	sum_peak_l1 = sum_peak_l1 + max_l1[i];
}
for (var i=0; i < max_l2.length; i++){
	sum_peak_l2 = sum_peak_l2 + max_l2[i];
}
for (var i=0; i < max_l3.length; i++){
	sum_peak_l3 = sum_peak_l3 + max_l3[i];
}
for (var i=0; i < max_l4.length; i++){
	sum_peak_l4 = sum_peak_l4 + max_l4[i];
}
for (var i=0; i < max_l5.length; i++){
	sum_peak_l5 = sum_peak_l5 + max_l5[i];
}
for (var i=0; i < max_r1.length; i++){
	sum_peak_r1 = sum_peak_r1 + max_r1[i];
}
for (var i=0; i < max_r2.length; i++){
	sum_peak_r2 = sum_peak_r2 + max_r2[i];
}
for (var i=0; i < max_r3.length; i++){
	sum_peak_r3 = sum_peak_r3 + max_r3[i];
}
for (var i=0; i < max_r4.length; i++){
	sum_peak_r4 = sum_peak_r4 + max_r4[i];
}
for (var i=0; i < max_r5.length; i++){
	sum_peak_r5 = sum_peak_r5 + max_r5[i];
}
/********************** Peak Pressure Calculation**********End********** */	

        
			
            for (var i = 0; i< column29.length; i++){ 
			
                if(right_sen1[i] > max_rs1_static){
                    max_rs1_static = right_sen1[i]
				}
				
                if(right_sen2[i] > max_rs2_static){
                    max_rs2_static = right_sen2[i]
				}
                    
                if(right_sen3[i] > max_rs3_static){
                    max_rs3_static = right_sen3[i]
				}
                    
                if(midR[i] > max_rs4_static){
                    max_rs4_static = midR[i]
				}
                    
                if(heelR[i] > max_rs5_static){
                    max_rs5_static = heelR[i]  
				}
				 if(left_sen1[i] > max_ls1_static){
                    max_ls1_static =left_sen1[i]
				}
                    
                if(left_sen2[i] > max_ls2_static){
                    max_ls2_static =left_sen2[i]
				}
				
                if(left_sen3[i] > max_ls3_static){
                    max_ls3_static = left_sen3[i]
				}
                    
                if(midL[i] > max_ls4_static){
                    max_ls4_static = midL[i]
				}
                    
                if(heelL[i] > max_ls5_static){
                    max_ls5_static = heelL[i] 
				}	
			}			
//Left 1			 			
if (max_l1.length == 0){
    avg_peak_l1 = max_ls1_static;
}            
else{
    avg_peak_l1 = Math.round(sum_peak_l1 /max_l1.length);
}
//Left 2
if (max_l2.length == 0){
    avg_peak_l2 = max_ls2_static;
}            
else{
    avg_peak_l2 = Math.round(sum_peak_l2 /max_l2.length);
}
//Left 3
if (max_l3.length == 0){
    avg_peak_l3 = max_ls3_static;
}            
else{
    avg_peak_l3 = Math.round(sum_peak_l3 /max_l3.length);
}
//Left 4
if (max_l4.length == 0){
    avg_peak_l4 = max_ls4_static;
}            
else{
    avg_peak_l4 = Math.round(sum_peak_l4 /max_l4.length);
}
//Left 5
if (max_l5.length == 0){
    avg_peak_l5 = max_ls5_static;
}            
else{
    avg_peak_l5 = Math.round(sum_peak_l5 /max_l5.length);
}
//Right 1			 			
if (max_r1.length == 0){
    avg_peak_r1 = max_rs1_static;
}            
else{
    avg_peak_r1 = Math.round(sum_peak_r1 /max_r1.length);
}
// Right 2
if (max_r2.length == 0){
    avg_peak_r2 = max_rs2_static;
}            
else{
    avg_peak_r2 = Math.round(sum_peak_r2 /max_r2.length);
}
//Right 3
if (max_r3.length == 0){
    avg_peak_r3 = max_rs3_static;
}            
else{
    avg_peak_r3 = Math.round(sum_peak_r3 /max_r3.length);
}
//Right 4
if (max_r4.length == 0){
    avg_peak_r4 = max_rs4_static;
}            
else{
    avg_peak_r4 = Math.round(sum_peak_r4 /max_r4.length);
}
//Right 5
if (max_r5.length == 0){
    avg_peak_r5 = max_rs5_static;
}            
else{
    avg_peak_r5 = Math.round(sum_peak_r5 /max_r5.length);
}



avg_peak_l1_kpa = (0.497 * Math.exp(0.0088* avg_peak_l1)).toFixed(2);
avg_peak_l2_kpa = (0.497 * Math.exp(0.0088* avg_peak_l2)).toFixed(2);
avg_peak_l3_kpa = (0.497 * Math.exp(0.0088* avg_peak_l3)).toFixed(2);
avg_peak_l4_kpa = (0.497 * Math.exp(0.0088* avg_peak_l4)).toFixed(2);
avg_peak_l5_kpa = (0.497 * Math.exp(0.0088* avg_peak_l5)).toFixed(2);
avg_peak_r1_kpa = (0.497 * Math.exp(0.0088* avg_peak_r1)).toFixed(2); 
avg_peak_r2_kpa = (0.497 * Math.exp(0.0088* avg_peak_r2)).toFixed(2); 
avg_peak_r3_kpa = (0.497 * Math.exp(0.0088* avg_peak_r3)).toFixed(2); 
avg_peak_r4_kpa = (0.497 * Math.exp(0.0088* avg_peak_r4)).toFixed(2); 
avg_peak_r5_kpa = (0.497 * Math.exp(0.0088* avg_peak_r5)).toFixed(2); 
$('#pl1').text(avg_peak_l1_kpa);  
$('#pl2').text(avg_peak_l2_kpa);  
$('#pl3').text(avg_peak_l3_kpa);  
$('#pl4').text(avg_peak_l4_kpa);  
$('#pl5').text(avg_peak_l5_kpa);  

$('#pr1').text(avg_peak_r1_kpa);  
$('#pr2').text(avg_peak_r2_kpa);  
$('#pr3').text(avg_peak_r3_kpa);  
$('#pr4').text(avg_peak_r4_kpa);  
$('#pr5').text(avg_peak_r5_kpa);  





		
          
   
//-------------------------------------------------------------OLD GAIT CYCLE PHASES -------------------------------------
var count = [];
var count_left1 = [];
var count_left2 = [];
var count_left3 = [];
var count_left4 = [];
var arr1 =[];
var arr = [];
var total_length = column31.length
//console.log(total_length,"*******Length");

  for (var i = 1; i < total_length; i++) {
    if(heelL[i-1] ==0 && heelL[i] > 0){
      count_left1.push(i);
    }
    
    if(heelL[i] >100 && midL[i] > 100 && column33[i] > 60){
        count_left2.push(i);
    }
    
    if(heelL[i] <100 && midL[i] < 100 && column33[i] > 80 && column30[i] > 200){
      count_left3.push(i);
      }
    if(column29[i] < 200 && column30[i] > 200){
      count_left4.push(i);
    }  
    
  }
   
   count_left1.push.apply(count_left1, count_left2);
   count_left1.push.apply(count_left1, count_left3);
   count_left1.push.apply(count_left1, count_left4);
  
   arr1 = count_left1
   //console.log(arr1,"************ARRAY WITHOUT*******");                
   arr = arr1.sort((a, b) => a - b)
   //console.log(arr,"************ARRAY WITH*******");                  
   count.push(count_left1[0])
   
for (var i = 1; i < arr.length -1 ; i++){
  if((arr[i] > count[count.length-1]) && (count_left1.includes(count[count.length-1])))
    for (var l2 = 0; l2 < count_left2.length -1; l2++)
      if(arr[i] == count_left2[l2])
        count.push(arr[i])
            
    else if((arr[i] > count[count.length-1]) && (count_left2.includes(count[count.length-1])))
        for (var l3 = 0; l3 < count_left3.length -1; l3++)
      if(arr[i] == count_left3[l3])
        count.push(arr[i])
               
    else if((arr[i] > count[count.length-1]) && (count_left3.includes(count[count.length-1])))
        for (var l4 = 0; l4 < count_left4.length -1; l4++)
      if(arr[i] == count_left4[l4])
        count.push(arr[i])
               
    else if ((arr[i] > count[count.length-1]) && (count_left4.includes(count[count.length-1])))
        for (var l1 = 0; l1 < count_left1.length -1; l1++)
      if(arr[i] == count_left1[l1])
        count.push(arr[i])
}     
                                      
//console.log(count, "***********COUNT");
var reminder_left = (count.length - 1) % 4
var left_length = count.length - reminder_left
var left_phase_count = parseInt(count.length / 4) 

var l1_total_time = 0
var l2_total_time = 0
var l3_total_time = 0
var l4_total_time = 0

for (var j = 0; j< (left_length-2); j++){
    var i;
    if (j %4 == 0){        
        for (i = count[j]; i <= count[j+1];i++){              
            l1_total_time = (parseFloat(l1_total_time) + parseFloat(xlabels[i+1] - xlabels[i])).toFixed(2);
  }}
    else if (j % 4 == 1){
        for (i = count[j]; i <= count[j+1];i++){              
            l2_total_time = (parseFloat(l2_total_time) + parseFloat(xlabels[i+1] - xlabels[i])).toFixed(2);
  }}
    else if (j % 4 == 2){
        for (i = count[j]; i <= count[j+1];i++){            
            l3_total_time = (parseFloat(l3_total_time) + parseFloat(xlabels[i+1] - xlabels[i])).toFixed(2);   
  }}      
    else{
        for (i = count[j]; i <= count[j+1];i++){   
            l4_total_time = (parseFloat(l4_total_time) +parseFloat( xlabels[i+1] - xlabels[i])).toFixed(2);   
  }}
}
      
//console.log(l1_total_time,l2_total_time,l3_total_time,l4_total_time,"**********Deepak");              

var l1_time = parseFloat(l1_total_time / left_phase_count);
var l2_time = parseFloat(l2_total_time / left_phase_count);
var l3_time = parseFloat(l3_total_time / left_phase_count);
var l4_time = parseFloat(l4_total_time / left_phase_count);

var left_total_time = parseFloat(l1_time + l2_time + l3_time + l4_time);
var l1_per = Math.round(parseFloat((l1_time / left_total_time)*100));
var l2_per = Math.round(parseFloat((l2_time / left_total_time)*100));
var l3_per = Math.round(parseFloat((l3_time / left_total_time)*100));
var l4_per = Math.round(parseFloat((l4_time / left_total_time)*100));
//console.log(l1_time, l2_time, l3_time,l4_time);
var left_stance_time = parseFloat(left_total_time - l4_time);
var left_sway_time = l4_time;
//console.log(left_total_time,left_stance_time, "*****Left Stance");
//console.log(left_sway_time, "*****Left Sway");


//Right

var countR = [];
var count_right1 = [];
var count_right2 = [];
var count_right3 = [];
var count_right4 = [];
var arr2 =[];
var arr3 = [];
var total_length_right = column31.length
//console.log(total_length_right,"*******Length");

  for (var i = 1; i < total_length_right; i++) {
    if(heelR[i-1] ==0 && heelR[i] > 0){
      count_right1.push(i);
    }
    
    if(heelR[i] >100 && midR[i] > 100 && column34[i] > 60){
        count_right2.push(i);
    }
    
    if(heelR[i] <100 && midR[i] < 100 && column34[i] > 80 && column29[i] > 200){
      count_right3.push(i);
      }
    if(column30[i] < 200 && column29[i] > 200){
      count_right4.push(i);
    }  
    
  }
   count_right1.push.apply(count_right1, count_right2);
   count_right1.push.apply(count_right1, count_right3);
   count_right1.push.apply(count_right1, count_right4);
   arr2 = count_right1
   //console.log(arr2,"************ARRAY WITHOUT*******");                
   arr3 = arr2.sort((a, b) => a - b)
   //console.log(arr3,"************ARRAY WITH*******");                 
   countR.push(count_right1[0])
   
for (var i = 1; i < arr3.length -1 ; i++){
  if((arr3[i] > countR[countR.length-1]) && (count_right1.includes(countR[countR.length-1])))
    for (var r2 = 0; r2 < count_right2.length -1; r2++)
      if(arr3[i] == count_right2[r2])
        countR.push(arr3[i])
            
    else if((arr3[i] > countR[countR.length-1]) && (count_right2.includes(countR[countR.length-1])))
        for (var r3 = 0; r3 < count_right3.length -1; r3++)
      if(arr3[i] == count_right3[r3])
        countR.push(arr3[i])
               
    else if((arr3[i] > countR[countR.length-1]) && (count_right3.includes(countR[countR.length-1])))
        for (var r4 = 0; r4 < count_right4.length -1; r4++)
      if(arr3[i] == count_right4[r4])
        countR.push(arr3[i])
               
    else if ((arr3[i] > countR[countR.length-1]) && (count_right4.includes(countR[countR.length-1])))
        for (var r1 = 0; r1 < count_right1.length -1; r1++)
      if(arr3[i] == count_right1[l1])
        countR.push(arr3[i])
}     
                                      
//console.log(countR, "***********COUNT");
var reminder_right = (countR.length - 1) % 4
var right_length = countR.length - reminder_right
var right_phase_count = parseInt(countR.length / 4) 

var r1_total_time = 0
var r2_total_time = 0
var r3_total_time = 0
var r4_total_time = 0

for (var j = 0; j< (right_length-2); j++){
    var i;
    if (j %4 == 0){        
        for (i = countR[j]; i <= countR[j+1];i++){              
            r1_total_time = (parseFloat(r1_total_time) + parseFloat(xlabels[i+1] - xlabels[i])).toFixed(2);
  }}
    else if (j % 4 == 1){
        for (i = countR[j]; i <= countR[j+1];i++){              
            r2_total_time = (parseFloat(r2_total_time) + parseFloat(xlabels[i+1] - xlabels[i])).toFixed(2);
  }}
    else if (j % 4 == 2){
        for (i = countR[j]; i <= countR[j+1];i++){            
            r3_total_time = (parseFloat(r3_total_time) + parseFloat(xlabels[i+1] - xlabels[i])).toFixed(2);   
  }}      
    else{
        for (i = countR[j]; i <= countR[j+1];i++){   
            r4_total_time = (parseFloat(r4_total_time) +parseFloat( xlabels[i+1] - xlabels[i])).toFixed(2);   
  }}
}
      
//console.log(r1_total_time,r2_total_time,r3_total_time,r4_total_time,"**********Deepak");              


var r1_time = parseFloat(r1_total_time / right_phase_count);
var r2_time = parseFloat(r2_total_time / right_phase_count);
var r3_time = parseFloat(r3_total_time / right_phase_count);
var r4_time = parseFloat(r4_total_time / right_phase_count);

var right_total_time = parseFloat(r1_time + r2_time + r3_time + r4_time);
var r1_per = Math.round(parseFloat((r1_time / right_total_time)*100));
var r2_per = Math.round(parseFloat((r2_time / right_total_time)*100));
var r3_per = Math.round(parseFloat((r3_time / right_total_time)*100));
var r4_per = Math.round(parseFloat((r4_time / right_total_time)*100));
var right_stance_time = (parseFloat(right_total_time - r4_time));
var right_sway_time = r4_time;
//console.log(left_total_time,left_stance_time, "*****Left Stance");
//console.log(left_sway_time, "*****Left Sway");

 $('#l1t').text(l1_time.toFixed(2) + 's');
 $('#l3t').text(l2_time.toFixed(2)+ 's');
 $('#l5t').text(l3_time.toFixed(2)+ 's');
 $('#l6t').text(l4_time.toFixed(2)+ 's');
 $('#r1t').text(r1_time.toFixed(2)+ 's');
 $('#r3t').text(r2_time.toFixed(2)+ 's');
 $('#r5t').text(r3_time.toFixed(2)+ 's');
 $('#r6t').text(r4_time.toFixed(2)+ 's');
 
 $('#l1p').text(l1_per + '%');
 $('#l3p').text(l2_per+ '%');
 $('#l5p').text(l3_per+'%');
 $('#l6p').text(l4_per+ '%');
 
 $('#r1p').text(r1_per+ '%');
 $('#r3p').text(r2_per+ '%');
 $('#r5p').text(r3_per+ '%');
 $('#r6p').text(r4_per+ '%');






 $('#lsw').text(left_sway_time.toFixed(2) + ' sec');
 $('#lst').text(left_stance_time.toFixed(2) + ' sec');
 $('#gst').text(left_total_time.toFixed(2) + ' sec');
 $('#rsw').text(right_sway_time.toFixed(2) + ' sec');
 $('#rst').text(right_stance_time.toFixed(2) + ' sec');

//---------------------------------------------------------------------OLD GAIT CYCLE End--------------------------------------------------
  

//-------------------------------------------------------------Foot-Zone Perentages in Stance Phase --------------Start-----------------
      // # Array Declaration
      const FL = [];
      const ML = [];
      const HL = [];
      const FR = [];
      const MR = [];
      const HR = [];

      foreL.forEach(function (foreL_val, foreL_i) { 
    
      if(column31[foreL_i] > 300){
              FL.push(parseFloat(foreL_val) / (parseFloat(foreL_val) + parseInt(midL[foreL_i]) + parseInt(heelL[foreL_i])))
              ML.push(parseInt(midL[foreL_i]) / (parseFloat(foreL_val) + parseInt(midL[foreL_i]) + parseInt(heelL[foreL_i])))
              HL.push(parseInt(heelL[foreL_i]) / (parseFloat(foreL_val) + parseInt(midL[foreL_i]) + parseInt(heelL[foreL_i])))
           }
              
         if(column32[foreL_i] > 300){
              FR.push(parseFloat(foreR[foreL_i]) / (parseFloat(foreR[foreL_i]) + parseInt(midR[foreL_i]) + parseInt(heelR[foreL_i])))
              MR.push(parseInt(midR[foreL_i]) / (parseFloat(foreR[foreL_i]) + parseInt(midR[foreL_i]) + parseInt(heelR[foreL_i])))
              HR.push(parseInt(heelR[foreL_i]) / (parseFloat(foreR[foreL_i]) + parseInt(midR[foreL_i]) + parseInt(heelR[foreL_i])))
          }
      });        
    var fl_sum = 0; 
    var ml_sum = 0; 
    var hl_sum = 0; 
    var fr_sum = 0; 
    var mr_sum = 0; 
    var hr_sum = 0; 
    
	var fl_avg_raw = 0; 
    var ml_avg_raw = 0; 
    var hl_avg_raw = 0; 
    var fr_avg_raw = 0; 
    var mr_avg_raw = 0; 
    var hr_avg_raw = 0;
	
    var fl_avg = 0; 
    var ml_avg = 0; 
    var hl_avg = 0; 
    var fr_avg = 0; 
    var mr_avg = 0; 
    var hr_avg = 0; 
	
      FL.forEach(function (fl_val, fl_i) {
      fl_sum = parseFloat(fl_sum) + parseFloat(fl_val);    
      ml_sum = parseFloat(ml_sum)+parseFloat(ML[fl_i]);    
      hl_sum = parseFloat(hl_sum)+parseFloat(HL[fl_i]); 
    });
    
    FR.forEach(function (fr_val, fr_i) {
      fr_sum = parseFloat(fr_sum)+parseFloat(FR[fr_i]);    
      mr_sum = parseFloat(mr_sum)+parseFloat(MR[fr_i]);    
      hr_sum = parseFloat(hr_sum)+parseFloat(HR[fr_i]);    
   });
  
    fl_avg = Math.round((fl_sum /FL.length) * 100);
    fl_pdf[0] = fl_avg;
    $('#FL').text(fl_avg + '%')
    ml_avg = Math.round((ml_sum /FL.length) * 100);
    ml_pdf[0] = ml_avg;
    $('#ML').text(ml_avg + '%')
    hl_avg = Math.round((hl_sum /FL.length) * 100);
    hl_pdf[0] = hl_avg;
    $('#HL').text(hl_avg + '%') 
	
	fr_avg = Math.round((fr_sum /FR.length) * 100);
    fr_pdf[0] = fr_avg;
    $('#FR').text(fr_avg + '%')
    mr_avg = Math.round((mr_sum /FR.length) * 100);
    mr_pdf[0] = mr_avg;
    $('#MR').text(mr_avg + '%')
    hr_avg = Math.round((hr_sum /FR.length) * 100);
    hr_pdf[0] = hr_avg;
    $('#HR').text(hr_avg + '%')
	
		
		
}	
          
         
      </script>
   </body>
</html>
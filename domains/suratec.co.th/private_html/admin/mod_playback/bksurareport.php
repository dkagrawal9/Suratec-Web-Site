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
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title><?php echo TITLE; ?></title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.7 -->
      <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
      <!-- daterange picker -->
      <link rel="stylesheet" media="all" type="text/css" href="jquerydatepicker/jquery-ui.css" />
      <link rel="stylesheet" media="all" type="text/css" href="jquerydatepicker/jquery-ui-timepicker-addon.css" />
      <!-- Theme style -->
      <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
      <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
      <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
      <!-- Pace style -->
      <link rel="stylesheet" href="../plugins/pace/pace.min.css">
      <!--Css table -->
      <link rel="stylesheet" href="css/app.css">
      <!-- Google Font -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
      <link rel="stylesheet" href="../plugins/sweetalert2/dist/sweetalert2.min.css">
      <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
      <script src ="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
   </head>
   <style>
      .insideWrapper {
      width:100%;
      height:100%;
      position:relative;
      }
      .coveredImage {
      /*
      width:100%;
      height:100%;
      */
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
      
      ?>
   <body class="hold-transition skin-blue fixed sidebar-mini " onload="startTime()">
      <div class="wrapper">
      <?php require_once '../template/nav_menu.php'; ?>
      <?php require_once '../library/permission.php'; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <h1>
            <?=$title?>
         </h1>
         <ol class="breadcrumb">
            <li><a href="../page_home/index.php"></i> Dashboard</a></li>
            <li class="active"><?=$title?></li>
         </ol>
      </section>
      <!-- Main content -->
      <section class="content">
         <div class="row">
            <div class="col-md-4">
               <div class="box box-success box-solid">
                  <div class="box-header with-border">
                     <h3 class="box-title">หมวดหมู่บริการ</h3>
                  </div>
                  <div class="box-body" >
                     <div class="form-horizontal">
                        <div class="box-body">
                           <ul>
                              <li  ><a href="javascript:newPressure_Map()" id="pressure_map_btn"><img src="../../img/bg-img/foot.png"> Pressure Map</a></li>
                              <!-- <li><a href="playback_sport_GA.php?id_customer=<?php echo $id_customer ?>"><i class="fa fa-handshake-o"></i> Gait Analysis</a></li>   --> 
                              <li><a href="javascript:newGait_Analysis()"><img src="../../img/bg-img/line-chart.png"> Gait Analysis</a></li>
                              <li class="active"><a href="javascript:newBalance_Board()" ><img src="../../img/bg-img/dot-and-circle.png"> Balance Board</a></li>
                              <li><a href="javascript:newReportData()" ><img src="../../img/bg-img/reportui.png" width="16px" height="16px"> Report</a></li>
                              <li><a href="javascript:newDasboard()" ><img src="../../img/bg-img/ui.png"> Dasboard</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-8">
               <div class="box box-success box-solid">
                  <div class="box-header with-border">
                     <h3 class="box-title">Report Data</h3>
                  </div>
                  <div class="box-body" >
                     <div class="form-horizontal">
                        <div class="box-body">
                           <div class="box-header with-border">
                              <fieldset style="border: solid 3px #B0C4DE ;padding-left: 20px; padding-right: 20px; padding-bottom: 20px">
                                 <legend style="width: auto; ">ค้นหา</legend>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <div class="col-sm-3">
                                          <label>กลุ่มผู้ใช้งาน (user group)</label>
                                          <div  class='input-group date col-md-12' >
                                             <SELECT <?php echo $disable_type ?> class="form-control" name="playback_type" id='playback_type' onchange="playback_time_func()">
                                                <option value="0">ประเภท Playback</option>
                                                <option 
                                                   <?php
                                                      if ($playback_type == '1') {
                                                        echo "selected";
                                                      }
                                                      ?>
                                                   value="1">การแพทย์</option>
                                                <option 
                                                   <?php
                                                      if ($playback_type == '2') {
                                                        echo "selected";
                                                      }
                                                      ?>
                                                   value="2">การกีฬา</option>
                                             </SELECT>
                                          </div>
                                       </div>
                                       <div class="col-sm-3">
                                          <label>วันที่ ( ป/ด/ว)</label>
                                          <div class='input-group date col-md-12' >
                                             <input type='text' class="form-control" name="datetimepicker" id='datetimepicker' autocomplete="off" onchange="playback_time_func()" value="<?php echo $datetimepicker ?>"/>
                                             <span class="input-group-addon">
                                             <span class="glyphicon glyphicon-calendar"></span>
                                             </span>
                                          </div>
                                       </div>
                                       <div class="col-sm-3">
                                          <label>เวลา (ชม. : นาที : วินาที)</label>
                                          <div class='input-group date col-md-12' >
                                             <SELECT class="form-control" name="playback_time" id='playback_time'>
                                                <option value="0">เวลา Playback</option>
                                             </SELECT>
                                          </div>
                                       </div>
                                       <div class="col-sm-3">
                                          <button onclick="function_play()" type="button" class="btn btn-primary search_date" id="search_date"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;<?=lang('Play', 'Play')?></button>&nbsp;&nbsp;&nbsp;
                                       </div>
                                    </div>
                                 </div>
                              </fieldset>
                           </div>
                           <canvas id="balance_left" width="500" height="500"></canvas>
                           <canvas id="cop" width="500" height="500"></canvas>
                           <canvas id="balance_right" width="500" height="500"></canvas>
                           <canvas id="gait_left" width="600" height="400"></canvas>
                           <canvas id="gait_right" width="600" height="400"></canvas>
                           <div id="show_data"></div>
                           <div class="col-md-6" style="text-align: center;display: none;" align="center">
                              <h4>Pressure Map</h4>
                              <div class="col-md-6">
                                 <div class="outsideWrapper">
                                    <div class="insideWrapper">
                                       <img src="img/foot_left.png" style="max-width: 160;" class="coveredImage">
                                       <canvas class="itemleft" id="itemleft" width="350" height="500"></canvas>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="outsideWrapper">
                                    <div class="insideWrapper">
                                       <img src="img/foot_right.png" style="max-width: 160;" class="coveredImage">
                                       <canvas class="itemright" id="itemright" width="350" height="500"></canvas>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
      </section>
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
      <div class="control-sidebar-bg"></div>
      </div>
      <!-- ./wrapper -->
      <script src="../bower_components/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap 3.3.7 -->
      <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
      <!-- AdminLTE App -->
      <script src="../dist/js/adminlte.min.js"></script>
      <script type="text/javascript" src="jquerydatepicker/jquery-ui.min.js"></script>
      <!-- SlimScroll -->
      <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
      <!-- date-range-picker -->
      <script src="../bower_components/moment/min/moment-with-locales.min.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="../dist/js/demo.js"></script>
      <!-- PACE -->
      <script src="../bower_components/PACE/pace.min.js"></script>
      <!-- <script src="js/front-manage-attr.js"></script> -->
      <script src="js/timer.js"></script>
      <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script src="../plugins/sweetalert2/dist/sweetalert2.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
      <script src="https://d3js.org/d3.v4.min.js"></script>
      <script src="https://d3js.org/d3-hsv.v0.1.min.js"></script>
      <script src="https://d3js.org/d3-contour.v1.min.js"></script>
      <script src="js/kign.js"></script>
      <script src="https://d3js.org/d3.v4.js"></script>
      <!-- Color scale -->
      <script src="https://d3js.org/d3-scale-chromatic.v1.min.js"></script>
      <script type="text/javascript" src="js/jquery.redirect.js"></script>
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
      <script>
         // แปลง $invalid_date ให้เป็น JSON
         // เช่น $invalid_date = array('4-22');
         // ก็จะได้ JSON ["4-22"]
         var invalidDate = <?php echo json_encode($invalid_date); ?>;
         console.log(invalidDate,'***********')
         function beforeShowDay(date) {
           // ทำวันที่ที่ Datepicker ส่งมา ให้อยู่ในรูปแบบเดียวกันกับที่ส่งออกมาจาก PHP
           
         
            var date = new Date(date),
             mnth = ("0" + (date.getMonth() + 1)).slice(-2),
             day = ("0" + date.getDate()).slice(-2);
           var searchDate = date.getFullYear() + '-' +mnth + '-' + day;
           // indexOf() จะให้ค่า -1 หากไม่มีค่าที่ตรวจสอบอยู่ใน Array
           //console.log(invalidDate.indexOf(searchDate))
           console.log(searchDate)
           if (invalidDate.indexOf(searchDate) === -1) {
             // บอก Datepicker ว่า วันที่นี้สามารถเลือกได้
             //console.log('false')
             return [false, "", ""];
           }
           // นอกนั้นเลือกไม่ได้ เพราะเป็นวันที่ที่มีอยู่ใน Array invalidDate
           //console.log('true')
           return [true, "", ""];
         }
         $("#datetimepicker").datepicker({
           beforeShowDay: beforeShowDay,
           dateFormat: 'yy-mm-dd',
         changeMonth: true,
         changeYear: true
         });
         
         
      </script>
      <script>  
         const left_x = [
           3, 7, 3, 3,
           5, 7, 5, 7,
           3, 5, 7, 5,
           7, 5, 7, 7,
           3, 5, 7, 5,
           7, 3, 5, 7
         ]
         const axis_y = [
           3, 3, 5, 7,
           7, 7, 11, 11,
           13, 13, 13, 15,
           15, 17, 17, 19,
           21, 21, 21, 23,
           23, 24, 24, 24
         ]
         const right_x = [
           1.5, 5.5, 5.5, 1.5,
           3.5, 5.5, 1.5, 3.5,
           1.5, 3.5, 5.5, 1.5,
           3.5, 1.5, 3.5, 1.5,
           1.5, 3.5, 5.5, 1.5,
           3.5, 1.5, 3.5, 5.5
         ]
         
         const n = 8, m = 24;
         
         function findLeftContourArray(lsensor) {
           const dataleft = [
             1, lsensor[0], 0, lsensor[1],
             0, lsensor[2], 0, 0,
             lsensor[3], 0, 0, 0,
             0, 0, 0, 0,
             0, lsensor[4], 0, 0,
             0, 0, 0, 0
           ]
           var variogram = kriging.train(
             dataleft,
             left_x,
             axis_y,
             'exponential',
             0,
             100)
           var lvalues = new Array(8 * 24)
           for (let j = 0.5, k = 0; j < m; ++j) {
             for (let i = 0.5; i < n; ++i, ++k) {
               lvalues[k] = kriging.predict(i, j, variogram);
               lvalues[k] = lvalues[k] > 0 ? lvalues[k] : 0;
             }
           }
           return lvalues
         }
         
         function findRightContourArray(rsensor) {
         const dataright = [
           rsensor[0], 0, 0, rsensor[1],
           0, rsensor[2], 0, 0,
           0, 0, rsensor[3], 0,
           0, 0, 0, 0,
           0, rsensor[4], 0, 0,
           0, 0, 0, 1
         ]
         var variogram = kriging.train(
           dataright,
           right_x,
           axis_y,
           'exponential',
           0,
           100)
         var rvalues = new Array(8 * 24)
         for (let j = 0.5, k = 0; j < m; ++j) {
           for (let i = 0.5; i < n; ++i, ++k) {
             rvalues[k] = kriging.predict(i, j, variogram);
             rvalues[k] = rvalues[k] > 0 ? rvalues[k] : 0;
           }
         }
         return rvalues;
         }  
         
         var values = findLeftContourArray([
           Math.floor(Math.random() * 600),
           Math.floor(Math.random() * 600),
           Math.floor(Math.random() * 600),
           Math.floor(Math.random() * 600),
           Math.floor(Math.random() * 600)
         ])
         
         var valuesright = findRightContourArray([
           Math.floor(Math.random() * 600),
           Math.floor(Math.random() * 600),
           Math.floor(Math.random() * 600),
           Math.floor(Math.random() * 600),
           Math.floor(Math.random() * 600),  
         ])
         
         function getColor(t) {
             t = Math.max(0, Math.min(1, t));
             return "rgb("
               + Math.max(0, Math.min(255, Math.round(34.61 + t * (1172.33 - t * (10793.56 - t * (33300.12 - t * (38394.49 - t * 14825.05))))))) + ", "
               + Math.max(0, Math.min(255, Math.round(23.31 + t * (557.33 + t * (1225.33 - t * (3574.96 - t * (1073.77 + t * 707.56))))))) + ", "
               + Math.max(0, Math.min(255, Math.round(27.2 + t * (3211.1 - t * (15327.97 - t * (27814 - t * (22569.18 - t * 6838.66)))))))
               + ")";
         }
         
         var canvas = document.getElementById("itemleft"),
           context = canvas.getContext("2d"),  
           color = d3.scaleSequential(getColor).domain(d3.extent(d3.range(0, 600, 50))),
           pathleft = d3.geoPath(null, context),
           thresholds = d3.range(0, 600, 50),
           contours = d3.contours().size([8, 24]);
         
         var canvasr = document.getElementById("itemright"),
           contextr = canvasr.getContext("2d"),  
           colorr = d3.scaleSequential(getColor).domain(d3.extent(d3.range(0, 600, 50))),
           pathr = d3.geoPath(null, contextr),
           thresholds = d3.range(0, 600, 50),
           contoursr = d3.contours().size([8, 24]);
         
           context.scale(20, 20);
           context.translate(0, 0);
         
         contextr.scale(20, 20);
           contextr.translate(0, 0);  
         
         
         
            
         function fill(geometry) {
           context.beginPath();
           pathleft(geometry);
           context.fillStyle = color(geometry.value);
           context.fill();
         }
         
         function value(x, y) {
           return Math.sin(x + y) * Math.sin(x - y);
         }
         
         function fillr(geometry) {
           contextr.beginPath();
           pathr(geometry);
           contextr.fillStyle = colorr(geometry.value);
           contextr.fill();
         }
         
         function value(x, y) {
           return Math.sin(x + y) * Math.sin(x - y);
         }   
         
         
         
      </script>
      <!-- Load d3.js -->
      <script src="https://d3js.org/d3.v4.js"></script>
      <!-- Color scale -->
      <script src="https://d3js.org/d3-scale-chromatic.v1.min.js"></script>
      <script>
         function ppp_left(y1,y2){
             var canvas_b = document.getElementById('myCanvas_l');
             var context_b = canvas_b.getContext('2d');
             var centerX_b = canvas_b.width / 2;
             var centerY_b = canvas_b.height / 2;
             var radius_b = 70;
         
         
         
         context_b.fillStyle = "#fff";
         context_b.beginPath();
         context_b.setLineDash([0]); 
         context_b.arc(142.5, 142.5, 126.75, 0, Math.PI*2, false);
         
         context_b.closePath();
         context_b.lineWidth = 1;
         context_b.strokeStyle = '#999';
         context_b.fill();
         context_b.stroke(); 
         
         context_b.fillStyle = "#fff";
         context_b.beginPath();
         context_b.setLineDash([8]); 
         context_b.arc(142.5, 142.5, 103, 0, Math.PI*2, false);
         
         context_b.closePath();
         context_b.lineWidth = 1;
         context_b.strokeStyle = '#999';   
         context_b.fill();
         context_b.stroke();   
         
         context_b.fillStyle = "#fff";
         context_b.beginPath();
         context_b.setLineDash([0]); 
         context_b.arc(142.5, 142.5, 79.25, 0, Math.PI*2, false);
         
         context_b.closePath();
         context_b.lineWidth = 1;
         context_b.strokeStyle = '#999';   
         context_b.fill();
         context_b.stroke();
         
         context_b.fillStyle = "#fff";
         context_b.beginPath();
         context_b.setLineDash([8]); 
         context_b.arc(142.5, 142.5, 55.5, 0, Math.PI*2, false);
         
         context_b.closePath();
         context_b.lineWidth = 1;
         context_b.strokeStyle = '#999';   
         context_b.fill();
         context_b.stroke(); 
         
         context_b.fillStyle = "#fff";
         context_b.beginPath();
         context_b.setLineDash([0]); 
         context_b.arc(142.5, 142.5, 31.75, 0, Math.PI*2, false);
         context_b.moveTo(142.5, 0);
         context_b.lineTo(142.5, 285);
         context_b.moveTo(285, 142.5);
         context_b.lineTo(0, 142.5);   
         context_b.closePath();
         context_b.lineWidth = 1;
         context_b.strokeStyle = '#999';   
         context_b.fill();
         context_b.stroke(); 
         
         context_b.fillStyle = "yellow";
         context_b.beginPath();
         context_b.arc(y1,y2, 8, 0, Math.PI*2, false);
         context_b.closePath();
         context_b.lineWidth = 1;
         context_b.strokeStyle = '#999';   
         context_b.fill();
         context_b.stroke();  
         } 
      </script>
  
      <!--balance r-->
      <script>
         function ppp_right(y1,y2){
             var canvas_r = document.getElementById('myCanvas_r');
             var context_r= canvas_r.getContext('2d');
             var centerX_r = canvas_r.width / 2;     
           var centerY_r = canvas_r.height / 2;
             var radius_r = 70;
         
         
         context_r.fillStyle = "#fff";
         context_r.beginPath();
         context_r.setLineDash([0]); 
         context_r.arc(142.5, 142.5, 126.75, 0, Math.PI*2, false);
         
         context_r.closePath();
         context_r.lineWidth = 1;
         context_r.strokeStyle = '#999';
         context_r.fill();
         context_r.stroke(); 
         
         context_r.fillStyle = "#fff";
         context_r.beginPath();
         context_r.setLineDash([8]); 
         context_r.arc(142.5, 142.5, 103, 0, Math.PI*2, false);
         
         context_r.closePath();
         context_r.lineWidth = 1;
         context_r.strokeStyle = '#999';   
         context_r.fill();
         context_r.stroke();   
         
         context_r.fillStyle = "#fff";
         context_r.beginPath();
         context_r.setLineDash([0]); 
         context_r.arc(142.5, 142.5, 79.25, 0, Math.PI*2, false);
         
         context_r.closePath();
         context_r.lineWidth = 1;
         context_r.strokeStyle = '#999';   
         context_r.fill();
         context_r.stroke();
         
         context_r.fillStyle = "#fff";
         context_r.beginPath();
         context_r.setLineDash([8]); 
         context_r.arc(142.5, 142.5, 55.5, 0, Math.PI*2, false);
         
         context_r.closePath();
         context_r.lineWidth = 1;
         context_r.strokeStyle = '#999';   
         context_r.fill();
         context_r.stroke(); 
         
         context_r.fillStyle = "#fff";
         context_r.beginPath();
         context_r.setLineDash([0]); 
         context_r.arc(142.5, 142.5, 31.75, 0, Math.PI*2, false);
         context_r.moveTo(142.5, 0);
         context_r.lineTo(142.5, 285);
         context_r.moveTo(285, 142.5);
         context_r.lineTo(0, 142.5);   
         context_r.closePath();
         context_r.lineWidth = 1;
         context_r.strokeStyle = '#999';   
         context_r.fill();
         context_r.stroke();
         
         
         
         
         context_r.fillStyle = "yellow";
         context_r.beginPath();
         
         context_r.arc(y1,y2, 8, 0, Math.PI*2, false);
         
         context_r.closePath();
         context_r.lineWidth = 1;
         context_r.strokeStyle = '#999';   
         context_r.fill();
         context_r.stroke(); 
         }
      </script>
      <script></script>
      <!-- Load d3.js -->
      <script></script>
      <script type="text/javascript">
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
         //  console.log(playback_type)  
         if (id_customer != '' && playback_type != '0' && datetimepicker!= '') {
            $.ajax({   
                     url:'test_time.php?id_customer='+id_customer, 
                     method:'POST',  
                     data:{id_customer:id_customer, playback_type:playback_type, datetimepicker:datetimepicker,get_time:get_time},  
                         success:function(data){  
                            // console.log(data);
                        
                         $("#playback_time").html(data); 
                         status_play =  $("#status_play").val();  
                         if (status_play=='1') {
                           search_date();
                         }
         
                         }, 
         
                            
                    });
              }
          
         } 
         
          // $(document).on('click','#search_date',function(){
           function search_date(){
           $("#show_data").html(''); 
           playback_time =  $("#playback_time").val(); 
         
         
             // var playback_time_arr = [playback_time];
             // console.log(playback_time_arr) 
         playback_left_right = playback_time.split("/");
         
         playback_time_arr_left = playback_left_right[0].split("***");
              playback_time_arr = playback_left_right[0].split("***");
           
         
         
              playback_time_arr_right = playback_left_right[1].split("***");
              playback_time_arr = playback_left_right[1].split("***");
             
         
         //for (var i = 0; i < playback_time_arr_left.length; i++) {
           //////ซ้าย/////
           ileft=0;
           xy_left_total=0;
         
                  var setleft = setInterval(function (t) {
                   console.log(playback_time_arr_left.length)
                   console.log(playback_time_arr_right[ileft])
                   
         
         
         
                    data_test = playback_time_arr_left[ileft];
                    data_test2 = data_test.split(",");
                    data_test3=[];
                    //data_test3=parseInt(data_test2[0])
                    for (var i = 0; i < data_test2.length; i++) {
                      // data_test3[]=println(data_test2[1])
                      data_test3.push(parseInt(data_test2[i]));
                    }
                    $("#p_time").html(data_test3[5]+' s'); 
                 balance_Y  = ((data_test3[0]+data_test3[1]+data_test3[2]) / 3) - data_test3[4]
                 balance_X = data_test3[2] - data_test3[1] 
                 y = (balance_Y / 850) * 142.5
                 x = (balance_X / 850) * 142.5
                 x1 = x+142.5
                 y1 = y+142.5
                //  ppp_left(x1,y1)
                 console.log(x1,y1)
         
         xy_left = ((142.5 - x1) * (142.5 - x1) + (142.5 - y1) * (142.5 - y1))
         xy_left_1 = Math.sqrt(xy_left)
         if (xy_left_1<=28.5  ) {
           $("#p_text_left").html('ดี')
         }else if (xy_left_1>28.5 && xy_left_1<=114){
           $("#p_text_left").html('ปานกลาง')
         }else{
           $("#p_text_left").html('พอใช้')
         }
         xy_left_total = xy_left_1 + xy_left_total;
         xy_left_total1=xy_left_total/(ileft+1)
                 $("#p_left").html(xy_left_total.toFixed(2)); 
                  console.log(data_test3)
         
                   var data_test1 = [0,0,0,0,364];
                   console.log(data_test1)
             values = findLeftContourArray(   
               data_test3
             )
         
               
             ileft++
             if (ileft==playback_time_arr_left.length) {
               clearInterval(setleft)
             }
         
               contours
                 .thresholds (d3.range(0, 600, 50))
                 (values)
                 .forEach(fill);
           }, 1000)
         //////ขวา/////
         iright=0;
         xy_right_total = 0;
           var setright = setInterval(function (ttr) {
              data_testright = playback_time_arr_right[iright];
                    data_test2right = data_testright.split(",");
                    data_test3right=[];
                    for (var i = 0; i < data_test2right.length; i++) {
                      data_test3right.push(parseInt(data_test2right[i]));
                    }
         
                    balance_Y_right  = ((data_test3right[0]+data_test3right[1]+data_test3right[2]) / 3) - data_test3right[4]
                 balance_X_right = data_test3right[2] - data_test3right[1] 
                 y_right = (balance_Y_right / 850) * 142.5
                 x_right = (balance_X_right / 850) * 142.5
                 x1_right = x_right+142.5
                 y1_right = y_right+142.5
                //  ppp_right(x1_right,y1_right)
                console.log(x1_right+','+y1_right)
         
                 xy_right = ((142.5 - x1_right) * (142.5 - x1_right) + (142.5 - y1_right) * (142.5 - y1_right))
         xy_right_1 = Math.sqrt(xy_right)
         console.log('รูท'+xy_right_1)
         if (xy_right_1<=28.5  ) {
           $("#p_text_right").html('ดี')
         }else if (xy_right_1>28.5 && xy_right_1<=114){
           $("#p_text_right").html('ปานกลาง')
         //p_text_right
         }else{
           $("#p_text_right").html('พอใช้')
         }
         xy_right_total = xy_right_1 + xy_right_total;
         console.log('xy_right_total='+xy_right_1+'+'+xy_right_total)
         console.log(xy_right_total)
         xy_right_total1=xy_right_total/(iright+1)
         console.log(xy_right_total1)
                 $("#p_right").html(xy_right_total1.toFixed(2)); 
         
               valuesright = findRightContourArray(
                 data_test3right
               )
         iright++
             if (iright==playback_time_arr_right.length) {
               clearInterval(setright)
             }
         
               contoursr
                 .thresholds(d3.range(0, 600, 50))
                 (valuesright)
                 .forEach(fillr);
             }, 1000)       
         }
         
         
         
           function newPressure_Map() {
           id_customer =  $("#id_customer").val();  
           playback_type =  $("#playback_type").val();  
           datetimepicker =  $("#datetimepicker").val();  
           playback_time =  $("#playback_time").val();  
           $.redirect("playback.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time}, "POST", ""); 
         }
         
         function newGait_Analysis() {
           id_customer =  $("#id_customer").val();  
           playback_type =  $("#playback_type").val();  
           datetimepicker =  $("#datetimepicker").val();  
           playback_time =  $("#playback_time").val();  
           $.redirect("playback_sport_GA.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time}, "POST", ""); 
         }
         function newBalance_Board() {
           id_customer =  $("#id_customer").val();  
           playback_type =  $("#playback_type").val();  
           datetimepicker =  $("#datetimepicker").val();  
           playback_time =  $("#playback_time").val();  
           $.redirect("balance_board.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time}, "POST", ""); 
         }
         function newReportData() {
           id_customer =  $("#id_customer").val();  
           playback_type =  $("#playback_type").val();  
           datetimepicker =  $("#datetimepicker").val();  
           playback_time =  $("#playback_time").val();  
           $.redirect("reportData.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time}, "POST", ""); 
         }
         function newDasboard() {
           id_customer =  $("#id_customer").val();  
           playback_type =  $("#playback_type").val();  
           datetimepicker =  $("#datetimepicker").val();  
           playback_time =  $("#playback_time").val();  
           $.redirect("playback_sport_DB.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time}, "POST", ""); 
         }
         
         
         function function_play() {
           id_customer =  $("#id_customer").val();  
           playback_type =  $("#playback_type").val();  
           datetimepicker =  $("#datetimepicker").val();  
           playback_time =  $("#playback_time").val();  
         
           $.redirect("reportData.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time, status_play: '1'}, "POST", ""); 
         }
         
          
            
         
         playback_time_func();
      </script>
      <script>
      // Declare All Arrays    
const xlabels = [];
const foreL = [];
const midL = [];
const heelL = [];
const foreR = [];
const midR = [];
const heelR = [];
//const newL = [];
const storage_left_balance = [];
const storage_right_balance = [];
const storage_cop = [];

call(); // Function Call to plot All Canvas

async function call() {
	await getData(); // Get Data from CSV File

	chartIt_left_balance();
	chartIt_cop();
	chartIt_right_balance();
	chartIt_left_gait();
	chartIt_right_gait();
}


// Function for Canvas 1 Plot (left_balance)	
function chartIt_left_balance() {
	//await getData();
	const ctx = document.getElementById('balance_left').getContext('2d');
	const myChart1 = new Chart(ctx, {
		type: 'scatter',
		options: {
			responsive: false,
			hover: true,
			legend: {
				display: false
			},
			title: {
				display: true,
				text: 'Left Balance'
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
				},
				{
					type: 'scatter',
					showLine: true,
					fill: false,
					borderColor: "#888",
					borderWidth: 1,
					pointRadius: 0,
					data: [{
							x: -1000,
							y: 1000
						},
						{
							x: 1000,
							y: 1000
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
	const myChart1 = new Chart(ctx, {
		type: 'scatter',
		options: {
			responsive: false,
			hover: true,
			legend: {
				display: false
			},
			title: {
				display: true,
				text: 'COP'
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
					ticks: {
						min: -2000,
						max: 2000,
						stepSize: 500
					},
					scaleLabel: {
						display: true,
						labelString: 'COP-Y'
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
				{
					type: 'scatter',
					showLine: true,
					fill: false,
					borderColor: "#888",
					borderWidth: 1,
					pointRadius: 0,
					data: [{
							x: -2000,
							y: 2000
						},
						{
							x: 2000,
							y: 2000
						}
					]
				}
			],
		}

	});
}


// Function for Canvas 3 Plot (right_balance)	
function chartIt_right_balance() {
	//await getData();
	const ctx = document.getElementById('balance_right').getContext('2d');
	const myChart1 = new Chart(ctx, {
		type: 'scatter',
		options: {
			responsive: false,
			hover: true,
			legend: {
				display: false
			},
			title: {
				display: true,
				text: 'Right Balance'
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
				},
				{
					type: 'scatter',
					showLine: true,
					fill: false,
					borderColor: "#888",
					borderWidth: 1,
					pointRadius: 0,
					data: [{
							x: -1000,
							y: 1000
						},
						{
							x: 1000,
							y: 1000
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
	const myChart1 = new Chart(ctx, {
		type: 'line',
		options: {
			responsive: false,
			hover: true,
			scales: {
				xAxes: [{
					scaleLabel: {
						display: true,
						labelString: 'Time (Second)',
					},
					gridLines: {
						color: "rgba(0, 0, 0, 0)",
					}
				}],
				yAxes: [{
					scaleLabel: {
						display: true,
						labelString: 'ADC Values'
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
				text: 'Left Foot'
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
			responsive: false,
			hover: true,

			scales: {
				xAxes: [{

					scaleLabel: {
						display: true,
						labelString: 'Time (Second)'
					},
					gridLines: {
						color: "rgba(0, 0, 0, 0)",
					}
				}],
				yAxes: [{

					scaleLabel: {
						display: true,
						labelString: 'ADC Values'
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
				text: 'Right Foot'
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
async function getData() {
 <?php
  $strSQL = "SELECT
    surasole.*,
    mod_customer.fname,
    mod_customer.lname
FROM
    `surasole`
LEFT JOIN mod_customer ON mod_customer.id_customer = surasole.id_customer
WHERE surasole.`id_customer`='$id_customer' AND  surasole.`type`='$playback_type'  AND date(surasole.action) BETWEEN '$datetimepicker' AND '$datetimepicker'";
$result = mysqli_query($objConnect, $strSQL);
$i = 2;

while($objResult = mysqli_fetch_array($result)){ 
?>
// const response = await fetch('../../img/bg-img/D01.csv'); // Upload CSV 
	// const data = await response.text();
	//console.log(data);

	// const table = data.split('\n').slice(1);
	// console.log(table, 'table+++++++++++++++');
	// table.forEach(row => {
    /* Start loop */
		// const columns = row.split(',');
		// const time = columns[1];
		// xlabels.push(time);
		// const fore_left = columns[12];
		// foreL.push(fore_left);
		// const mid_left = columns[5];
		// midL.push(mid_left);
		// const heel_left = columns[6];
		// heelL.push(heel_left);

		// const lx = columns[13]
		// const ly = columns[14]
		// var json_left = {
		// 	x: lx,
		// 	y: ly
		// };
		// storage_left_balance.push(json_left);

		// const cop_x = columns[18]
		// const cop_y = columns[19]
		// var json_cop = {
		// 	x: cop_x,
		// 	y: cop_y
		// };
		// storage_cop.push(json_cop);

		// const rx = columns[16]
		// const ry = columns[17]
		// var json_right = {
		// 	x: rx,
		// 	y: ry
		// };
		// storage_right_balance.push(json_right);


		// const fore_right = columns[15];
		// foreR.push(fore_right);
		// const mid_right = columns[10];
		// midR.push(mid_right);
		// const heel_right = columns[11];
		// heelR.push(heel_right);

    // const columns = row.split(',');
		const time1 = $objResult["action"];
		xlabels.push(time);
		// const fore_left = "=F".$i."-E".$i."";
		const fore_left = $i;
		foreL.push(fore_left);
		const mid_left = $objResult["left_sensor2"];
		midL.push(mid_left);
		const heel_left = $objResult["left_sensor3"];
		heelL.push(heel_left);

		// const lx = "=I".$i."-K".$i;
		const lx = $i;
		const ly = $objResult["WeChat"]
		var json_left = {
			x: lx,
			y: ly
		};
		storage_left_balance.push(json_left);

		const cop_x = $objResult["left_stance_phase"]
		const cop_y = $objResult["right_sensor1"]
		var json_cop = {
			x: cop_x,
			y: cop_y
		};
		storage_cop.push(json_cop);

		const rx = $objResult["left_peak_pressure_value"]
		const ry = $objResult["left_swing_phase"]
		var json_right = {
			x: rx,
			y: ry
		};
		storage_right_balance.push(json_right);


		const fore_right = $objResult["left_peak_pressure_position"];
		foreR.push(fore_right);
		const mid_right = "=G".$i;
		midR.push(mid_right);
		const heel_right = "=H".$i;
		heelR.push(heel_right);
    /* End loop */
	// });
<?php

$i++;
}
?>
}
         
      </script>
   </body>
</html>
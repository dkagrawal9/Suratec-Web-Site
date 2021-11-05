<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser($objConnect);

$title = 'Playback';
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

    <!-- bootstrap datepicker -->
    <!-- <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> -->
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
//var_dump($_SESSION);
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
// if (isset($_GET)) {
//     $id_customer = $_GET['id_customer'];
//     $playback_type = $_GET['playback_type'];
//     $datetimepicker = $_GET['datetimepicker'];
//     $playback_time = $_GET['playback_time'];

    
// }else{
//     $id_customer = '';
//     $playback_type = '';
//     $datetimepicker = '';
//     $playback_time = '';
    
// }

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
                    <li class="active" ><a href="javascript:newPressure_Map()" id="pressure_map_btn"><img src="../../img/bg-img/foot.png"> Pressure Map</a></li>     
                    <!-- <li><a href="playback_sport_GA.php?id_customer=<?php echo $id_customer ?>"><i class="fa fa-handshake-o"></i> Gait Analysis</a></li>   --> 
                    <li><a href="javascript:newGait_Analysis()"><img src="../../img/bg-img/line-chart.png"> Gait Analysis</a></li>    
                    <li><a href="javascript:newBalance_Board()" ><img src="../../img/bg-img/dot-and-circle.png"> Balance Board</a></li>     
                    <li><a href="javascript:newReportData()" ><img src="../../img/bg-img/reportui.png" target="_blank" width="16px" height="16px"> Report</a></li>
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
                                    <h3 class="box-title">Pressure Map</h3>
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
                                                    <div class='input-group date col-md-12' >
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
                                                      <!-- onchange="playback_time_func()" -->
                                                        <input onchange="playback_time_func()" type='text' class="form-control" name="datetimepicker" id='datetimepicker' autocomplete="off"  value="<?php echo $datetimepicker ?>"/>
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
                                                 
                                                  <div class="col-sm-3 row">
                                                   <br>
                                <!-- <button onclick=" myStopFunction()" type="button" class="btn btn-primary search_date" id="search_date"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;<?=lang('Play', 'Play')?></button>&nbsp;&nbsp;&nbsp; -->
                                <button onclick="function_play()" type="button" class="btn btn-primary search_date" id="search_date"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;<?=lang('Play', 'Play')?></button>&nbsp;


                                <button onclick="export_date()"  type="button" class="btn btn-primary export_date" id="export_date"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;<?=lang('Export Excel', 'Export Excel')?></button>&nbsp;&nbsp;&nbsp;
                                

                            
                           
                                                  </div>
                                                
                                            </div>
                                        </div>
                                        </fieldset>

                        </div>


<div id="show_data"></div>


<div class="col-md-12" style="text-align: center;" align="center">
   <!--  <h4>Pressure Map</h4> -->
<div class="col-md-3">              
<div class="outsideWrapper">
    <div class="insideWrapper">
        <img id="coveredImage_left" src="img/foot_left.png" style="max-width: 160px !important;background: #000000;" class="coveredImage">
        <canvas class="itemleft" id="itemleft" width="350" height="500"></canvas>
    </div>
</div>
</div>
<div class="col-md-6" style="text-align: center;" align="center">


 <!--  <span style="float: left; font: bold; font-size: 16px;">Balance Board</span><br><br> -->
              <div class="col-lg-12 col-12">
                <div class="row" style="text-align: center;" id="mycan_l" >
                  <div class="col-lg-1 col-12"> 
                  </div>
                  <div class="col-lg-11 col-12" style="display: none;">
                    <canvas id="myCanvas_l" width="285" height="285" style="border:1px solid #d3d3d3;" ></canvas>
                  </div>
                </div><br>
                <div class="row" style="text-align: center;" id="mycan_r" >
                  <div class="col-lg-1 col-12"> 
                  </div>
                  <div class="col-lg-11 col-12">
                    <canvas id="myCanvas_r" width="285" height="285" style="border:1px solid #d3d3d3;"></canvas>
                  </div>
                </div><br>
              <div class="row" style="text-align: center; ">
                <div class="col-lg-1 col-12"> 
                  </div>
               <!--  <div class="col-lg-11 col-12">
                  <span class="btn btn-success but_lr">ซ้าย</span>
                  <span class="btn btn-success but_lr">ขวา</span>
                </div> -->
              </div><br>  


              <div class="row" style="text-align: center;">

                <div class="col-md-12">
                  <table class="table" border="1">
                    <tr>
                      <th style="background: #cccccc; border: 1px;">คะแนนการทรงตัว </th>
                     <!--  <th style="background: #cccccc;">Balance Board Right</th> -->
                      <th style="background: #cccccc; border: 1px;">Time in Zone</th>
                      <th style="background: #cccccc; border: 1px;">การทรงตัว</th>
                      <!-- <th style="background: #cccccc;">การทรงตัวขวา</th> -->
                    </tr>
                    <tr>
                      <!-- <td><p id="p_left"> 0  </p></td> -->
                      <td><p id="p_right"> 0  </p></td>
                      <td><p id="p_time"> 0 s </p></td>
                      <!-- <td><p id="p_text_left"> -  </p></td> -->
                      <td><p id="p_text_right"> - </p></td>
                    </tr>
                  </table>
                </div>


              </div>    
          </div>

</div>
<div class="col-md-3"> 
<div class="outsideWrapper">
    <div class="insideWrapper">
        <img id="coveredImage_right" src="img/foot_right.png" style="max-width: 160px !important;background: #000000;" class="coveredImage">
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

    <!-- bootstrap datepicker -->
    <!-- <script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
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
console.log(invalidDate)
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
      document.getElementById("coveredImage_left").style.background = "rgba(0, 0, 0, 0)";
      document.getElementById("coveredImage_right").style.background = "rgba(0, 0, 0, 0)";
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
<!--
<script>
      var canvas2 = document.getElementById('myCanvas');
      var context2 = canvas.getContext('2d');
      var centerX2 = canvas.width / 2;
      var centerY2 = canvas.height / 2;
      var radius2 = 70;

      context2.beginPath();
      context2.arc(142.5, 142.5, 16, 0, 2 * Math.PI, false);
//      context2.fillStyle = 'yellow';
      context2.fill();
      context2.lineWidth = 1;
//      context2.strokeStyle = '#003300';
      context2.stroke();  
</script> -->


<!--balance r-->
<script>
  function ppp_right(y1,y2){
      var canvas_r = document.getElementById('myCanvas_r');
      var context_r= canvas_r.getContext('2d');
      var centerX_r = canvas_r.width / 2;     
    var centerY_r = canvas_r.height / 2;
      var radius_r = 70;

//      context_b.beginPath();
//      context_b.arc(142.5, 142.5, 6, 0, 2 * Math.PI, false);
//    context_b.closePath();
//    context_b.arc(142.5, 142.5, 16, 0, 2 * Math.PI, false);
////    context_b.arc(142.5, 142.5, 46, 0, 2 * Math.PI, false);
////    context_b.arc(142.5, 142.5, 66, 0, 2 * Math.PI, false);
////    context_b.arc(142.5, 142.5, 66, 0, 2 * Math.PI, false);
////    context_b.fillStyle = 'yellow';
////    context_b.fill();
//      context_b.lineWidth = 1;
////      context.strokeStyle = '#003300';
//      context_b.stroke(); 

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


//  var yellow = [142.5,170.5];
  
//  for (var i = 0; i < yellow.length; i++) {   
 




// }


  context_r.fillStyle = "yellow";
context_r.beginPath();

context_r.arc(y1,y2, 8, 0, Math.PI*2, false);
 
context_r.closePath();
context_r.lineWidth = 1;
context_r.strokeStyle = '#999';   
context_r.fill();
context_r.stroke(); 
}

// context_r.fillStyle = "white";
// context_r.beginPath();

// context_r.arc(142.5,142.5, 8, 0, Math.PI*2, false);
 
// context_r.closePath(); 



</script>


<script>
 



  </script>

<!-- Load d3.js -->

<script>


</script>
<script type="text/javascript">
function myStopFunction() {

  if(typeof(setleft) != "undefined" && setleft !== null) {
  clearInterval(setleft);
  clearInterval(setright);
  }

}
 $(document).on('click','#pressure_map_btn',function(){
 
   
 // id_customer =  $("#id_customer").val();              
 //                $.ajax({   
 //            url:'select_playback_sport1.php?id_customer='+id_customer, 
 //            method:'POST',  
 //            data:{_method:'pressure_map'},  
 //                success:function(data){  
 //                    //console.log(response.data[0]['path_slip']);
               
 //                $("#show_data").html(data); 

 //                }, 

                   
 //           });  
            })





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

//  $(document).on('change','#playback_time',function(){
//     playback_time =  $("#playback_time").val();  
//     // var playback_time_arr = [playback_time];
//     // console.log(playback_time_arr) 
// playback_left_right = playback_time.split("/");
// playback_time_arr_left = playback_left_right[0].split("***");
//      playback_time_arr = playback_left_right[0].split("***");
//      fruits = [];
//      for (var i = 0; i < playback_time_arr.length; i++) {
//        playback_time_arr1 = playback_time_arr[i].split(",");
//        var playback_time_arr2 = [playback_time_arr1];
       
//        fruits.push(playback_time_arr2);
//      }
//      console.log(playback_time_arr) 


//      playback_time_arr_right = playback_left_right[1].split("***");
//      playback_time_arr = playback_left_right[1].split("***");
//      fruits = [];
//      for (var i = 0; i < playback_time_arr.length; i++) {
//        playback_time_arr1 = playback_time_arr[i].split(",");
//        var playback_time_arr2 = [playback_time_arr1];
       
//        fruits.push(playback_time_arr2);
//      }
//      console.log(playback_time_arr)

//        $.ajax({   
//             url:'select_playback_sport.php?id_customer='+id_customer, 
//             method:'POST',  
//             data:{fruits:fruits,playback_time_arr_left:playback_time_arr_left,playback_time_arr_right:playback_time_arr_right},  
//                 success:function(data){  
//                     //console.log(response.data[0]['path_slip']);
               
//                 $("#show_data").html(data); 

//                 }, 

                   
//            });
     
    
//   })


 // $(document).on('click','#search_date',function(){
  function search_date(){
  $("#show_data").html(''); 
  playback_time =  $("#playback_time").val(); 


    // var playback_time_arr = [playback_time];
    // console.log(playback_time_arr) 
playback_left_right = playback_time.split("/");

playback_time_arr_left = playback_left_right[0].split("***");
     playback_time_arr = playback_left_right[0].split("***");
     // fruits = [];
     // for (var i = 0; i < playback_time_arr.length; i++) {
     //   playback_time_arr1 = playback_time_arr[i].split(",");
     //   var playback_time_arr2 = [playback_time_arr1];
       
     //   fruits.push(playback_time_arr2);
     // }
     // console.log(playback_time_arr) 


     playback_time_arr_right = playback_left_right[1].split("***");
     playback_time_arr = playback_left_right[1].split("***");
     // fruits = [];
     // for (var i = 0; i < playback_time_arr.length; i++) {
     //   playback_time_arr1 = playback_time_arr[i].split(",");
     //   var playback_time_arr2 = [playback_time_arr1];
       
     //   fruits.push(playback_time_arr2);
     // }
     // console.log(playback_time_arr_left.length)
     // console.log(playback_time_arr_right)

//for (var i = 0; i < playback_time_arr_left.length; i++) {
  //////ซ้าย/////
  ileft=0;
  xy_right_total=0;

         var setleft = setInterval(function (t) {
          // console.log(playback_time_arr_left.length)
          // console.log(playback_time_arr_right[ileft])
          



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
        //ppp_left(x1,y1)
       // console.log(x1+','+y1)

xy_left = ((142.5 - x1) * (142.5 - x1) + (142.5 - y1) * (142.5 - y1))
xy_left_1 = Math.sqrt(xy_left)
//console.log('รูทซ้าย'+xy_left_1)
// if (xy_left_1<=28.5  ) {
//   $("#p_text_left").html('ดี')
// }else if (xy_left_1>28.5 && xy_left_1<=114){
//   $("#p_text_left").html('ปานกลาง')
// }else{
//   $("#p_text_left").html('พอใช้')
// }
xy_right_total = xy_left_1 + xy_right_total;
xy_left_total1=xy_right_total/(ileft+1)
        //$("#p_left").html(xy_right_total.toFixed(2)); 
         //console.log(data_test3)

          var data_test1 = [0,0,0,0,364];
          //console.log(data_test1)
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
//////ซ้าย/////

//////ขวา/////
iright=0;
// xy_right_total = 0;
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
        xx= (x1 + x1_right) / 2
        yy =(y1 + y1_right ) /2
        ppp_right(xx,yy)
      // console.log(x1_right+','+y1_right)

        xy_right = ((142.5 - x1_right) * (142.5 - x1_right) + (142.5 - y1_right) * (142.5 - y1_right))
xy_right_1 = Math.sqrt(xy_right)
//console.log('รูทขวา'+xy_right_1)
xy_sqrt = (xy_left_1+xy_right_1) / 2
if (xy_sqrt<=57  ) {
  $("#p_text_right").html('ดี')
}else if (xy_sqrt>57 && xy_sqrt<=228){
  $("#p_text_right").html('ปานกลาง')
//p_text_right
}else{
  $("#p_text_right").html('พอใช้')
}
xy_right_total = xy_right_1 + xy_right_total;
//console.log('xy_right_total='+xy_right_1+'+'+xy_right_total)
//console.log(xy_right_total)
xy_right_total1=xy_right_total/ ((iright+1) +(ileft+1))
//console.log(xy_right_total1)
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
//////ขวา/////
// }        
//for (var i = 0; i < playback_time_arr_left.length; i++) {
       // $.ajax({   
       //      url:'select_playback_sport.php?id_customer='+id_customer, 
       //      method:'POST',  
       //      data:{fruits:fruits,playback_time_arr_left:playback_time_arr_left,playback_time_arr_right:playback_time_arr_right},  
       //          success:function(data){  
       //              //console.log(response.data[0]['path_slip']);
               
       //          $("#show_data").html(data); 
               
       //          }, 

                   
       //     });

// if (i==5) {
//   clearInterval(setleft);
//   clearInterval(setright);
// }
  //    }

// })
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
          //window.open("newReportData.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time}, "POST", ""); 
          window.open("newReportData4.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time}, "POST", ""); 
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
  $.redirect("playback.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time, status_play: '1'}, "POST", ""); 
}

function export_date() {
  console.log('ccccc')
  id_customer =  $("#id_customer").val();  
  playback_type =  $("#playback_type").val();  
  datetimepicker =  $("#datetimepicker").val();  
  
  if (id_customer == '' || playback_type == '' || datetimepicker == '') {
    swal("คำเตือน", "กรุณาเลือกประเภท และวันที่", "warning")
        return false;
  }else{
    $.redirect("export_excel.php?id_customer="+id_customer, {id_customer:id_customer,playback_type: playback_type, datetimepicker: datetimepicker}, "POST", ""); 
  }
  
}

playback_time_func();



</script>
  


</body>
</html>

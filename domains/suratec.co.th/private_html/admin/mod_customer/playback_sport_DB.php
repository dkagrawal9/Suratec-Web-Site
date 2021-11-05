<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser($objConnect);

$title = 'Dasboard';
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

</head>

<style type="text/css">
  .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    background: #00efb8 ;
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

$sql_customer = "SELECT `sex`,`height` FROM `mod_customer` WHERE `id_customer` = '$id_customer' ";
$query_customer = mysqli_query($objConnect, $sql_customer);
$result_customer = mysqli_fetch_array($query_customer);
$sex = $result_customer["sex"];
$height = $result_customer["height"];
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
                    <!-- <li><a onclick="newPressure_Map()" id="pressure_map_btn"><i class="fa fa-list"></i> Pressure Map</a></li>     
                    <li><a onclick="newGait_Analysis()"><i class="fa fa-handshake-o"></i> Gait Analysis</a></li>    
                    <li><a onclick="newBalance_Board()" ><i class="fa fa-gavel"></i> Balance Board</a></li>     
                    <li class="active"><a onclick="newDasboard()" ><i class="fa fa-globe"></i> Dasboard</a></li>        -->


                    <li  ><a href="javascript:newPressure_Map()" id="pressure_map_btn"><img src="../../img/bg-img/foot.png"> Pressure Map</a></li>     
                    <!-- <li><a href="playback_sport_GA.php?id_customer=<?php echo $id_customer ?>"><i class="fa fa-handshake-o"></i> Gait Analysis</a></li>   --> 
                    <li><a href="javascript:newGait_Analysis()"><img src="../../img/bg-img/line-chart.png"> Gait Analysis</a></li>    
                    <li ><a href="javascript:newBalance_Board()" ><img src="../../img/bg-img/dot-and-circle.png"> Balance Board</a></li>     
                    <li class="active"><a href="javascript:newDasboard()" ><img src="../../img/bg-img/ui.png"> Dasboard</a></li>  

                  </ul>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>


                            <div class="col-md-8">
                              <div class="box box-success box-solid">
                                 <div class="box-header with-border">
                                    <h3 class="box-title">Dasboard</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
                                        <div class="box-body">
 <div class="box-header with-border">
                          <fieldset style="border: solid 3px #B0C4DE ;padding-left: 20px; padding-right: 20px; padding-bottom: 20px">  
                    <legend style="width: auto; ">ค้นหา</legend>

                               <div class="col-md-12">
                                     <div class="form-group">
                                             
                                                 
                                                 <div class="col-sm-6">
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
                                                
                                                <div class="col-sm-6">
                                                  <label>วันที่ ( ป/ด/ว)</label>
                                                    <div class='input-group date col-md-12' >
                                                        <input type='text' class="form-control" name="datetimepicker" id='datetimepicker' autocomplete="off" onchange="playback_time_func()" value="<?php echo $datetimepicker ?>"/>
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                            </span>
                                                    </div>
                                                 </div>

                                                 <div class="col-sm-3" style="display: none;">
                                                  <label>เวลา (ชม. : นาที : วินาที)</label>
                                                    <div class='input-group date col-md-12' >
                                                        <SELECT class="form-control" name="playback_time" id='playback_time'>
                                                            <option value="0">เวลา Playback</option>
                                                        </SELECT>
                                                            
                                                    </div>
                                                 </div>
                                                 
                                                  <div class="col-sm-3" style="display: none;">
                                                   
                                <button onclick=" myStopFunction()" type="button" class="btn btn-primary search_date" id="search_date"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;<?=lang('Play', 'Play')?></button>&nbsp;&nbsp;&nbsp;
                                

                            
                           
                                                  </div>
                                                
                                            </div>
                                        </div>
                                        </fieldset>

                        </div>


<div id="show_data"></div>

<div class="col-md-12"> 
<div class="col-md-6">
              <span>สรุป Peak Pressure  รวม ซ้าย-ขวา (%)</span>
                <div style="overflow-x:auto;">
                <table class="table" border="1">
                  <thead>
    <tr>
      <th width="50%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Zone</th>
      <th width="25%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">AVG</th>
      <th width="25%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Max</th>
    </tr>
                  </thead>
  <tbody>
    <tr>
      <td>Toe</td>
      <td><p id="p_toe_avg"></p></td>
      <td><p id="p_toe_max"></p></td>
    </tr>
    <tr>
      <td>Medial Metatarsal</td>
      <td><p id="p_medial_metatarsal_avg"></p></td>
      <td><p id="p_medial_metatarsal_max"></p></td>
    </tr>
    <tr>
      <td>Lateral Metatarsal</td>
      <td><p id="p_lateral_metatarsal_avg"></p></td>
      <td><p id="p_lateral_metatarsal_max"></p></td>
    </tr>
    <tr>
      <td>Medial Midfoot</td>
      <td><p id="p_medial_midfoot_avg"></p></td>
      <td><p id="p_medial_midfoot_max"></p></td>
    </tr>
    <tr>
      <td>Heel</td>
      <td><p id="p_heal_avg"></p></td>
      <td><p id="p_heal_max"></p></td>
    </tr>
  </tbody>
</table>
              </div>
            
            </div>

            <div class="col-md-6" style="" >
        <table class="table" border="1">
          <thead>
            <th style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Duration</th>
            <th style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Pace</th>
          </thead>
          <tbody>
            <td><span id="span_duration">0</span></td>
            <td><span id="span_pace">0 min/km.</span></td>
          </tbody>
        </table>

        <table class="table" border="1">
          <thead>
            <th style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Distance</th>
            <th style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Total Steps</th>
          </thead>
          <tbody>
            <td><span id="span_distance">0 km.</span></td>
            <td><span id="span_total_steps">0</span></td>
          </tbody>
        </table>

        <table class="table" border="1">
          <thead>
            <th style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Peak Pessure</th>
            <th style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">CG Swing</th>
          </thead>
          <tbody>
            <tr>
            <td>
              <div class="col-md-12">
                  <select id="zone_option" onchange="change_zone()" class="form-control">
                    <option value="Zone">Zone</option>
                    <option value="0">Toe</option>
                    <option value="1">Medial Metatarsal </option>
                    <option value="2">Lateral Metatarsal</option>
                    <option value="3">Medial Midfoot</option>
                    <option value="4">Heel</option>
                  </select> 
                  
              </div>
              <div class="col-md-12" align="center">
                <span id="val_kps">0 KPS</span>
              </div>
            </td>
            <td>
              <span id="span_CG_Swing">0</span>
            </td>
            </tr>
            
          </tbody>
        </table>

             
     
            </div>
<!-- <div class="col-md-6"><br>
              <div class="row" style="text-align: center;">
                <div class="col-lg-1 col-12"> 
                </div>
                <div class="col-lg-5 col-12" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span>Duration</span>
                </div>
                <div class="col-lg-1 col-12"> 
                </div>
                <div class="col-lg-5 col-12" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span>Pace</span>
                </div>
              </div>
              <div class="row" style="text-align: center;">
                <div class="col-lg-1 col-12"> 
                </div>
                <div class="col-lg-5 " style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span id="span_duration">0</span>
                </div>
                <div class="col-lg-1 col-12"> 
                </div>
                <div class="col-lg-5 col-12" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span id="span_pace">0 min/km.</span>
                </div>
              </div><br>
              <div class="row" style="text-align: center;">
                <div class="col-lg-1 col-12"> 
                </div>
                <div class="col-lg-5 col-12" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span>Distance</span>
                </div>
                <div class="col-lg-1 col-12"> 
                </div>
                <div class="col-lg-5 col-12" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span>Total Steps</span>
                </div>
              </div>
              <div class="row" style="text-align: center;">
                <div class="col-lg-1">  
                </div>
                <div class="col-lg-5" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span id="span_distance">0 km.</span>
                </div>
                <div class="col-lg-1">  
                </div>
                <div class="col-lg-5" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span id="span_total_steps">0</span>
                </div>
              </div><br>
     
              <div class="row" style="text-align: center;">
                <div class="col-lg-1">  
                </div>
                <div class="col-lg-5" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span>Peak Pessure</span>
                </div>
                <div class="col-lg-1">  
                </div>
                <div class="col-lg-5" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span>CG Swing</span>
                </div>
              </div>
              <div class="row" style="text-align: center;">
                <div class="col-lg-1">  
                </div>
                <div class="col-lg-5" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;" >
                  <select id="zone_option" onchange="change_zone()" class="form-control">
                    <option value="Zone">Zone&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                    <option value="0">Toe</option>
                    <option value="1">Medial Metatarsal </option>
                    <option value="2">Lateral Metatarsal</option>
                    <option value="3">Medial Midfoot</option>
                    <option value="4">Heel</option>
                  </select> <br>
                  <span id="val_kps">0 KPS</span>
                </div>
                <div class="col-lg-1">  
                </div>
                <div class="col-lg-5" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span id="span_CG_Swing">0</span>
                </div>
              </div>
            </div> -->
</div>

<div class="col-md-12">

<div class="col-md-6">
              <span>สรุป Peak Pressure ซ้าย (%)</span>
                <div style="overflow-x:auto;">
                <table class="table" border="1">
                  <thead>
    <tr>
      <th width="50%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Zone</th>
      <th width="25%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">AVG</th>
      <th width="25%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Max</th>
    </tr>
                  </thead>
  <tbody>
    <tr>
      <td>Toe</td>
      <td><p id="p_toe_avg_left"></p></td>
      <td><p id="p_toe_max_left"></p></td>
    </tr>
    <tr>
      <td>Medial Metatarsal</td>
      <td><p id="p_medial_metatarsal_avg_left"></p></td>
      <td><p id="p_medial_metatarsal_max_left"></p></td>
    </tr>
    <tr>
      <td>Lateral Metatarsal</td>
      <td><p id="p_lateral_metatarsal_avg_left"></p></td>
      <td><p id="p_lateral_metatarsal_max_left"></p></td>
    </tr>
    <tr>
      <td>Medial Midfoot</td>
      <td><p id="p_medial_midfoot_avg_left"></p></td>
      <td><p id="p_medial_midfoot_max_left"></p></td>
    </tr>
    <tr>
      <td>Heel</td>
      <td><p id="p_heal_avg_left"></p></td>
      <td><p id="p_heal_max_left"></p></td>
    </tr>
  </tbody>
</table>
              </div>
            
</div>

<div class="col-md-6">
              <span>สรุป Peak Pressure ขวา (%)</span>
                <div style="overflow-x:auto;">
                <table class="table" border="1">
                  <thead>
    <tr>
      <th width="50%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Zone</th>
      <th width="25%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">AVG</th>
      <th width="25%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Max</th>
    </tr>
                  </thead>
  <tbody>
    <tr>
      <td>Toe</td>
      <td><p id="p_toe_avg_right"></p></td>
      <td><p id="p_toe_max_right"></p></td>
    </tr>
    <tr>
      <td>Medial Metatarsal</td>
      <td><p id="p_medial_metatarsal_avg_right"></p></td>
      <td><p id="p_medial_metatarsal_max_right"></p></td>
    </tr>
    <tr>
      <td>Lateral Metatarsal</td>
      <td><p id="p_lateral_metatarsal_avg_right"></p></td>
      <td><p id="p_lateral_metatarsal_max_right"></p></td>
    </tr>
    <tr>
      <td>Medial Midfoot</td>
      <td><p id="p_medial_midfoot_avg_right"></p></td>
      <td><p id="p_medial_midfoot_max_right"></p></td>
    </tr>
    <tr>
      <td>Heel</td>
      <td><p id="p_heal_avg_right"></p></td>
      <td><p id="p_heal_max_right"></p></td>
    </tr>
  </tbody>
</table>
              </div>
            
</div>

</div>

    <div class="col-md-12">
              
              <span>Peak Pressure เกินกว่าที่กำหนด</span>
              <div style="overflow-x:auto;">
                <table class="table" border="1">
                  <thead>
    <tr>
      <th width="30%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Date Time</th>
      <th width="20%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Zone</th>
      <th width="50%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Peak Pressure</th>
    </tr>
                  </thead>
  <tbody id="playback_time_table">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
              </div>
            </div>

<input type="hidden" name="toe_kps" id="toe_kps">
<input type="hidden" name="medial_metatarsal_kps" id="medial_metatarsal_kps">
<input type="hidden" name="lateral_metatarsal_kps" id="lateral_metatarsal_kps">
<input type="hidden" name="medial_midfoot_kps" id="medial_midfoot_kps">
<input type="hidden" name="heal_kps" id="heal_kps">

<input type="hidden" name="sex" id="sex" value="<?php echo $sex ?>">
<input type="hidden" name="height" id="height" value="<?php echo $height ?>">





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
    <script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
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

<script type="text/javascript" src="jquerydatepicker/jquery-ui.min.js"></script>

<!-- Load d3.js -->
<script src="https://d3js.org/d3.v4.js"></script>
<!-- Color scale -->
<script src="https://d3js.org/d3-scale-chromatic.v1.min.js"></script>

<!-- Load d3.js -->
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
<script type="text/javascript">
function myStopFunction() {

  if(typeof(setleft) != "undefined" && setleft !== null) {
  clearInterval(setleft);
  clearInterval(setright);
  }

}




  // $(function () {
    
  //           $('#datetimepicker').datepicker({
  //      todayBtn: "linked",
  //      language: "it",
  //      autoclose: true,
  //      todayHighlight: true,
  //      format: 'yyyy-mm-dd'
       
  //  });
  //       });

function playback_time_func(){
  id_customer =  $("#id_customer").val();  
  playback_type =  $("#playback_type").val();  
  datetimepicker =  $("#datetimepicker").val();
  get_time =  $("#get_time").val();
  console.log(id_customer+'...'+playback_type+'...'+datetimepicker)  
if (id_customer != '' && playback_type != '0' && datetimepicker!= '') {
   $.ajax({   
            url:'select_duration_dasboard.php?id_customer='+id_customer, 
            method:'POST',  
            data:{id_customer:id_customer, playback_type:playback_type, datetimepicker:datetimepicker,get_time:get_time},  
                success:function(data){  
                    console.log(data.duration_num);
                   if (data.status == '0') {
               retData=data.retData
                $("#playback_time").html(data.option); 
                $("#playback_time_table").html(data.table); 
ms = data.duration_num
if (ms=='0') {
  curtime="0:00:00";
}else{
curhr = Math.floor(ms/3600);
curmin=Math.floor(ms/60)%60;
cursec=ms%60

      if(curhr < 10){
                curhr = "0"+curhr;
            }
            if(curmin < 10 ){
                curmin = "0"+curmin;
            }
            if(cursec < 10 ){
                cursec = "0"+cursec;
            }
           
                curtime=+curhr+":"+curmin+":"+cursec;
}


                $("#span_duration").html(curtime); 
                conclude_peak_pressure(retData)
                duration_peak_pressure(retData)
                total_stepe(retData,ms)
                conclude_peak_pressure_leftright(retData)
                }else{
$("#playback_time_table").html(data.table); 
$("#span_duration").html("0:00:00"); 
//conclude_peak_pressure(retData)
$("#span_CG_Swing").html('0'); 
$("#p_toe_max").html('0'); 
$("#p_toe_avg").html('0'); 
$("#p_medial_metatarsal_max").html('0'); 
$("#p_medial_metatarsal_avg").html('0'); 
$("#p_lateral_metatarsal_max").html('0'); 
$("#p_lateral_metatarsal_avg").html('0'); 
$("#p_medial_midfoot_max").html('0'); 
$("#p_medial_midfoot_avg").html('0'); 
$("#p_heal_max").html('0'); 
$("#p_heal_avg").html('0'); 
$("#toe_kps").val('0'); 
$("#medial_metatarsal_kps").val('0'); 
$("#lateral_metatarsal_kps").val('0'); 
$("#medial_midfoot_kps").val('0'); 
$("#heal_kps").val('0'); 
//total_stepe(retData,ms)
$("#span_total_steps").html('0'); 
$("#span_distance").html('0 km.'); 
$("#span_pace").html('0 min/km.');
//conclude_peak_pressure_leftright(retData)
$("#p_toe_max_left").html('0'); 
$("#p_toe_avg_left").html('0');
$("#p_toe_max_right").html('0'); 
$("#p_toe_avg_right").html('0'); 
$("#p_medial_metatarsal_max_left").html('0'); 
$("#p_medial_metatarsal_avg_left").html('0'); 
$("#p_medial_metatarsal_max_right").html('0'); 
$("#p_medial_metatarsal_avg_right").html('0'); 
$("#p_lateral_metatarsal_max_left").html('0'); 
$("#p_lateral_metatarsal_avg_left").html('0'); 
$("#p_lateral_metatarsal_max_right").html('0'); 
$("#p_lateral_metatarsal_avg_right").html('0'); 
$("#p_medial_midfoot_max_left").html('0'); 
$("#p_medial_midfoot_avg_left").html('0'); 
$("#p_medial_midfoot_max_right").html('0'); 
$("#p_medial_midfoot_avg_right").html('0');
$("#p_heal_max_left").html('0'); 
$("#p_heal_avg_left").html('0'); 
$("#p_heal_max_right").html('0'); 
$("#p_heal_avg_right").html('0');

                }
                }, 

                   
           });
}
 
} 



function total_stepe(retData,ms){
total_stepe=0
  for (var i = 0; i < retData.length; i++) {
    for (var c = 0; c <  retData[i].left.length; c++) {

                //toe
                    sensor_left = parseInt(retData[i].left[c][0]) + parseInt(retData[i].left[c][1]) + parseInt(retData[i].left[c][2]) + parseInt(retData[i].left[c][3]) +parseInt(retData[i].left[c][4])

                    sensor_right = parseInt(retData[i].right[c][0]) + parseInt(retData[i].right[c][1]) + parseInt(retData[i].right[c][2]) + parseInt(retData[i].right[c][3]) +parseInt(retData[i].right[c][4])

                   if(sensor_left >= sensor_right) {
                    total_sensor = sensor_left -  sensor_right
                   }else{
                    total_sensor = sensor_right - sensor_left 
                   }
                    
                   if (total_sensor >= 1000) {
                    total_stepe++
                   }
                   //console.log('total_sensor'+c+'=='+total_sensor)


       

    }



                 
                }



  //console.log('total_stepe =='+total_stepe)
$("#span_total_steps").html(total_stepe); 

sex = $("#sex").val(); 
height = $("#height").val(); 
if (sex == '0') {
  distance = parseInt(height) * 0.415 * total_stepe
}else{
  distance = parseInt(height) * 0.413 * total_stepe
}
distance_km = distance/100000
$("#span_distance").html(distance_km.toFixed(2)+' km.'); 
if (ms=='0') {
  pace = 0
}else{
  pace = (ms / 60) / (distance / 1000)
}

$("#span_pace").html(pace.toFixed(2)+' min/km.'); 
}


function duration_peak_pressure(retData){
max_sensor_total=[]
  for (var i = 0; i < retData.length; i++) {


                //toe
                sensor0=0
                max_sensor0_total = []

                //Medial Metatarsal
                sensor3=0
                max_sensor3_total = []

                //Lateral Metatarsal
                sensor1=0
                max_sensor1_total = []

                //Medial Midfoot
                sensor2=0
                max_sensor2_total = []

                //Heal
                sensor4=0
                max_sensor4_total = []

    for (var c = 0; c <  retData[i].left.length; c++) {

                //toe
                    sensor0 += parseInt(retData[i].left[c][0])
                    max_sensor0_total.push(parseInt(retData[i].left[c][0]));
                    sensor0 += parseInt(retData[i].right[c][0])
                    max_sensor0_total.push(parseInt(retData[i].right[c][0]));

                    //Medial Metatarsal
                    sensor3 += parseInt(retData[i].left[c][3])
                    max_sensor3_total.push(parseInt(retData[i].left[c][3]));
                    sensor3 += parseInt(retData[i].right[c][3])
                    max_sensor3_total.push(parseInt(retData[i].right[c][3]));

                    //Lateral Metatarsal
                    sensor1 += parseInt(retData[i].left[c][1])
                    max_sensor1_total.push(parseInt(retData[i].left[c][1]));
                    sensor1 += parseInt(retData[i].right[c][1])
                    max_sensor1_total.push(parseInt(retData[i].right[c][1]));

                    //Medial Midfoot
                    sensor2 += parseInt(retData[i].left[c][2])
                    max_sensor2_total.push(parseInt(retData[i].left[c][2]));
                    sensor2 += parseInt(retData[i].right[c][2])
                    max_sensor2_total.push(parseInt(retData[i].right[c][2]));

                    //Heal
                    sensor4 += parseInt(retData[i].left[c][4])
                    max_sensor4_total.push(parseInt(retData[i].left[c][4]));
                    sensor4 += parseInt(retData[i].right[c][4])
                    max_sensor4_total.push(parseInt(retData[i].right[c][4]));

    }

//toe
max_sensor0 = Math.max.apply(Math, max_sensor0_total)  

//Medial Metatarsal
max_sensor3 = Math.max.apply(Math, max_sensor3_total)  

//Lateral Metatarsal
max_sensor1 = Math.max.apply(Math, max_sensor1_total)  

//Medial Midfoot
max_sensor2 = Math.max.apply(Math, max_sensor2_total)  

//Heal
max_sensor4 = Math.max.apply(Math, max_sensor4_total)  


max_sensor_total.push({
  toe : parseInt(max_sensor0),
  Medial_Metatarsal : parseInt(max_sensor3),
  Lateral_Metatarsal : parseInt(max_sensor1),
  Medial_Midfoot : parseInt(max_sensor2),
  Heal : parseInt(max_sensor4)});
                 
                }

for (var y = 0; y < max_sensor_total.length; y++) {
  let arr = Object.values(max_sensor_total[y]);
  let max = Math.max(...arr);
  //console.log(arr)
  zone = ''
  for (var q = 0; q < arr.length; q++) {
    //console.log(arr[q] +'==='+ max)
    
    if(arr[q] === max) {
          // console.log(q)
           if (q===0) {
             zone = 'Toe,'
           }else if (q===1) {
             zone += 'Medial Metatarsal,'
           }else if (q===2) {
             zone += 'Lateral Metatarsal,'
           }else if (q===3) {
             zone += 'Medial Midfoot,'
           }else if (q===4) {
             zone += 'Heel,'
           }
 
           
           
        }
 
  }
$("#td_duration_zone"+y).html(zone.substr(0, zone.length-1)); 
$("#td_duration_pp"+y).html(max.toFixed(2));
 
}


// console.log(max)
// console.log(max_sensor_total[0])
  

}

function conclude_peak_pressure_leftright(retData){

 // left_sensor_i = 0;

                //toe
                sensor0_left=0
                max_sensor0_total_left = []

                sensor0_right=0
                max_sensor0_total_right = []

                //Medial Metatarsal
                sensor3_left=0
                max_sensor3_total_left = []

                sensor3_right=0
                max_sensor3_total_right = []

                //Lateral Metatarsal
                sensor1_left=0
                max_sensor1_total_left = []

                sensor1_right=0
                max_sensor1_total_right = []

                //Medial Midfoot
                sensor2_left=0
                max_sensor2_total_left = []

                sensor2_right=0
                max_sensor2_total_right = []

                //Heal
                sensor4_left=0
                max_sensor4_total_left = []

                sensor4_right=0
                max_sensor4_total_right = []

               

                for (var i = 0; i < retData.length; i++) {
                  // console.log( retData.length);
                  // console.log( retData[i].left);
                  for (var c = 0; c <  retData[i].left.length; c++) {
                    //console.log(retData[i].left[c]);
                    //console.log(retData[i].right[c]);

                    //toe
                    sensor0_left += parseInt(retData[i].left[c][0])
                    max_sensor0_total_left.push(parseInt(retData[i].left[c][0]));
                    sensor0_right += parseInt(retData[i].right[c][0])
                    max_sensor0_total_right.push(parseInt(retData[i].right[c][0]));

                    //Medial Metatarsal
                    sensor3_left += parseInt(retData[i].left[c][3])
                    max_sensor3_total_left.push(parseInt(retData[i].left[c][3]));
                    sensor3_right += parseInt(retData[i].right[c][3])
                    max_sensor3_total_right.push(parseInt(retData[i].right[c][3]));

                    //Lateral Metatarsal
                    sensor1_left += parseInt(retData[i].left[c][1])
                    max_sensor1_total_left.push(parseInt(retData[i].left[c][1]));
                    sensor1_right += parseInt(retData[i].right[c][1])
                    max_sensor1_total_right.push(parseInt(retData[i].right[c][1]));

                    //Medial Midfoot
                    sensor2_left += parseInt(retData[i].left[c][2])
                    max_sensor2_total_left.push(parseInt(retData[i].left[c][2]));
                    sensor2_right += parseInt(retData[i].right[c][2])
                    max_sensor2_total_right.push(parseInt(retData[i].right[c][2]));

                    //Heal
                    sensor4_left += parseInt(retData[i].left[c][4])
                    max_sensor4_total_left.push(parseInt(retData[i].left[c][4]));
                    sensor4_right += parseInt(retData[i].right[c][4])
                    max_sensor4_total_right.push(parseInt(retData[i].right[c][4]));

                
                
                  }

}

//toe
max_sensor0_left = Math.max.apply(Math, max_sensor0_total_left)  
length_data_left = max_sensor0_total_left.length
avg_sensor0_left = sensor0_left / length_data_left ;
$("#p_toe_max_left").html(max_sensor0_left); 
$("#p_toe_avg_left").html(avg_sensor0_left.toFixed(2)); 

max_sensor0_right = Math.max.apply(Math, max_sensor0_total_right)  
length_data_right = max_sensor0_total_right.length
avg_sensor0_right = sensor0_right / length_data_right ;
$("#p_toe_max_right").html(max_sensor0_right); 
$("#p_toe_avg_right").html(avg_sensor0_right.toFixed(2)); 


//Medial Metatarsal
max_sensor3_left = Math.max.apply(Math, max_sensor3_total_left)  
length_data_left = max_sensor3_total_left.length
avg_sensor3_left = sensor3_left / length_data_left ;
$("#p_medial_metatarsal_max_left").html(max_sensor3_left); 
$("#p_medial_metatarsal_avg_left").html(avg_sensor3_left.toFixed(2)); 

max_sensor3_right = Math.max.apply(Math, max_sensor3_total_right)  
length_data_right = max_sensor3_total_right.length
avg_sensor3_right = sensor3_right / length_data_right ;
$("#p_medial_metatarsal_max_right").html(max_sensor3_right); 
$("#p_medial_metatarsal_avg_right").html(avg_sensor3_right.toFixed(2)); 

//Lateral Metatarsal
max_sensor1_left = Math.max.apply(Math, max_sensor1_total_left)  
length_data_left = max_sensor1_total_left.length
avg_sensor1_left = sensor1_left / length_data_left;
$("#p_lateral_metatarsal_max_left").html(max_sensor1_left); 
$("#p_lateral_metatarsal_avg_left").html(avg_sensor1_left.toFixed(2)); 

max_sensor1_right = Math.max.apply(Math, max_sensor1_total_right)  
length_data_right = max_sensor1_total_right.length
avg_sensor1_right = sensor1_right / length_data_right ;
$("#p_lateral_metatarsal_max_right").html(max_sensor1_right); 
$("#p_lateral_metatarsal_avg_right").html(avg_sensor1_right.toFixed(2)); 


//Medial Midfoot
max_sensor2_left = Math.max.apply(Math, max_sensor2_total_left)  
length_data_left = max_sensor2_total_left.length
avg_sensor2_left = sensor2_left / length_data_left ;
$("#p_medial_midfoot_max_left").html(max_sensor2_left); 
$("#p_medial_midfoot_avg_left").html(avg_sensor2_left.toFixed(2)); 

max_sensor2_right = Math.max.apply(Math, max_sensor2_total_right)  
length_data_right = max_sensor2_total_right.length
avg_sensor2_right = sensor2_right / length_data_right ;
$("#p_medial_midfoot_max_right").html(max_sensor2_right); 
$("#p_medial_midfoot_avg_right").html(avg_sensor2_right.toFixed(2)); 


//Heal
max_sensor4_left = Math.max.apply(Math, max_sensor4_total_left)  
length_data_left = max_sensor4_total_left.length
avg_sensor4_left = sensor4_left / length_data_left ;
$("#p_heal_max_left").html(max_sensor4_left); 
$("#p_heal_avg_left").html(avg_sensor4_left.toFixed(2)); 

max_sensor4_right = Math.max.apply(Math, max_sensor4_total_right)  
length_data_right = max_sensor4_total_right.length
avg_sensor4_right = sensor4_right / length_data_right ;
$("#p_heal_max_right").html(max_sensor4_right); 
$("#p_heal_avg_right").html(avg_sensor4_right.toFixed(2));






}


function conclude_peak_pressure(retData){

 // left_sensor_i = 0;

                //toe
                sensor0=0
                max_sensor0_total = []

                //Medial Metatarsal
                sensor3=0
                max_sensor3_total = []

                //Lateral Metatarsal
                sensor1=0
                max_sensor1_total = []

                //Medial Midfoot
                sensor2=0
                max_sensor2_total = []

                //Heal
                sensor4=0
                max_sensor4_total = []

                //CG Swing
                xy_right_total = 0;

                for (var i = 0; i < retData.length; i++) {
                  // console.log( retData.length);
                  // console.log( retData[i].left);
                  for (var c = 0; c <  retData[i].left.length; c++) {
                    //console.log(retData[i].left[c]);
                    //console.log(retData[i].right[c]);

                    //toe
                    sensor0 += parseInt(retData[i].left[c][0])
                    max_sensor0_total.push(parseInt(retData[i].left[c][0]));
                    sensor0 += parseInt(retData[i].right[c][0])
                    max_sensor0_total.push(parseInt(retData[i].right[c][0]));

                    //Medial Metatarsal
                    sensor3 += parseInt(retData[i].left[c][3])
                    max_sensor3_total.push(parseInt(retData[i].left[c][3]));
                    sensor3 += parseInt(retData[i].right[c][3])
                    max_sensor3_total.push(parseInt(retData[i].right[c][3]));

                    //Lateral Metatarsal
                    sensor1 += parseInt(retData[i].left[c][1])
                    max_sensor1_total.push(parseInt(retData[i].left[c][1]));
                    sensor1 += parseInt(retData[i].right[c][1])
                    max_sensor1_total.push(parseInt(retData[i].right[c][1]));

                    //Medial Midfoot
                    sensor2 += parseInt(retData[i].left[c][2])
                    max_sensor2_total.push(parseInt(retData[i].left[c][2]));
                    sensor2 += parseInt(retData[i].right[c][2])
                    max_sensor2_total.push(parseInt(retData[i].right[c][2]));

                    //Heal
                    sensor4 += parseInt(retData[i].left[c][4])
                    max_sensor4_total.push(parseInt(retData[i].left[c][4]));
                    sensor4 += parseInt(retData[i].right[c][4])
                    max_sensor4_total.push(parseInt(retData[i].right[c][4]));

                    //CG Swing  xy_right_total = 0;

                    balance_Y  = ((parseInt(retData[i].left[c][0])+parseInt(retData[i].left[c][1])+parseInt(retData[i].left[c][2])) / 3) - parseInt(retData[i].left[c][4])
                    balance_X = parseInt(retData[i].left[c][2]) - parseInt(retData[i].left[c][3])
                    y = (balance_Y / 850) * 142.5
                    x = (balance_X / 850) * 142.5
                    x1 = x+142.5
                    y1 = y+142.5
                    xy_left = ((142.5 - x1) * (142.5 - x1) + (142.5 - y1) * (142.5 - y1))
                    xy_left_1 = Math.sqrt(xy_left)

                    balance_Y_right  = ((parseInt(retData[i].right[c][0])+parseInt(retData[i].right[c][1])+parseInt(retData[i].right[c][2])) / 3) - parseInt(retData[i].right[c][4])
                    balance_X_right = parseInt(retData[i].right[c][2]) - parseInt(retData[i].right[c][3])
                    y_right = (balance_Y_right / 850) * 142.5
                    x_right = (balance_X_right / 850) * 142.5
                    x1_right = x_right+142.5
                    y1_right = y_right+142.5
                    xx= (x1 + x1_right) / 2
                    yy =(y1 + y1_right ) /2
                    xy_right = ((142.5 - x1_right) * (142.5 - x1_right) + (142.5 - y1_right) * (142.5 - y1_right))
                    xy_right_1 = Math.sqrt(xy_right)

                    xy_sqrt = (xy_left_1+xy_right_1) / 2
                    //console.log('xy_sqrt='+xy_sqrt)
                    xy_right_total = xy_sqrt + xy_right_total;
                    xy_right_total1=xy_right_total/c
                    $("#span_CG_Swing").html(xy_right_total1.toFixed(2)); 


                    

                
                  }

}
// console.log(max_sensor0_total.length)
// console.log(left_sensor0+'/'+left_sensor0_i +'='+left_sensor0/left_sensor0_i)

//toe
max_sensor0 = Math.max.apply(Math, max_sensor0_total)  
length_data = max_sensor0_total.length
avg_sensor0 = sensor0 / length_data ;
$("#p_toe_max").html(max_sensor0); 
$("#p_toe_avg").html(avg_sensor0.toFixed(2)); 


//Medial Metatarsal
max_sensor3 = Math.max.apply(Math, max_sensor3_total)  
length_data = max_sensor3_total.length
avg_sensor3 = sensor3 / length_data ;
$("#p_medial_metatarsal_max").html(max_sensor3); 
$("#p_medial_metatarsal_avg").html(avg_sensor3.toFixed(2)); 


//Lateral Metatarsal
max_sensor1 = Math.max.apply(Math, max_sensor1_total)  
length_data = max_sensor1_total.length
avg_sensor1 = sensor1 / length_data ;
$("#p_lateral_metatarsal_max").html(max_sensor1); 
$("#p_lateral_metatarsal_avg").html(avg_sensor1.toFixed(2)); 


//Medial Midfoot
max_sensor2 = Math.max.apply(Math, max_sensor2_total)  
length_data = max_sensor2_total.length
avg_sensor2 = sensor2 / length_data ;
$("#p_medial_midfoot_max").html(max_sensor2); 
$("#p_medial_midfoot_avg").html(avg_sensor2.toFixed(2)); 


//Heal
max_sensor4 = Math.max.apply(Math, max_sensor4_total)  
length_data = max_sensor4_total.length
avg_sensor4 = sensor4 / length_data ;
$("#p_heal_max").html(max_sensor4); 
$("#p_heal_avg").html(avg_sensor4.toFixed(2)); 

//kps
toe_kps =  ((5.6 * 10 ** -4) * Math.exp(parseInt(max_sensor0_total) / 53.36) + 6.72) / 0.796
medial_metatarsal_kps =  ((5.6 * 10 ** -4) * Math.exp(parseInt(max_sensor3_total) / 53.36) + 6.72) / 0.796
lateral_metatarsal_kps =  ((5.6 * 10 ** -4) * Math.exp(parseInt(max_sensor1_total) / 53.36) + 6.72) / 0.796
medial_midfoot_kps =  ((5.6 * 10 ** -4) * Math.exp(parseInt(max_sensor2_total) / 53.36) + 6.72) / 0.796
heal_kps =  ((5.6 * 10 ** -4) * Math.exp(parseInt(max_sensor4_total) / 53.36) + 6.72) / 0.796

//console.log(toe_kps)
$("#toe_kps").val(toe_kps.toFixed(2)); 
$("#medial_metatarsal_kps").val(medial_metatarsal_kps.toFixed(2)); 
$("#lateral_metatarsal_kps").val(lateral_metatarsal_kps.toFixed(2)); 
$("#medial_midfoot_kps").val(medial_midfoot_kps.toFixed(2)); 
$("#heal_kps").val(heal_kps.toFixed(2)); 




}



function change_zone(){
zone_option = $("#zone_option").val(); 
//console.log(zone_option)
if (zone_option=='0') {
  $("#val_kps").html(toe_kps.toFixed(2)+' KPS'); 
}else if (zone_option=='1') {
  $("#val_kps").html(medial_metatarsal_kps.toFixed(2)+' KPS'); 
}else if (zone_option=='2') {
  $("#val_kps").html(lateral_metatarsal_kps.toFixed(2)+' KPS'); 
}else if (zone_option=='3') {
  $("#val_kps").html(medial_midfoot_kps.toFixed(2)+' KPS'); 
}else if (zone_option=='4') {
  $("#val_kps").html(heal_kps.toFixed(2)+' KPS'); 
}else{
  $("#val_kps").html('0 KPS'); 
}
}



 $(document).on('click','#search_date',function(){
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
  xy_left_total=0;

         var setleft = setInterval(function (t) {
          // console.log(playback_time_arr_left.length)
          // console.log(playback_time_arr_right[ileft])
          $("#p_time").html(ileft+' s'); 



           data_test = playback_time_arr_left[ileft];
           data_test2 = data_test.split(",");
           data_test3=[];
           //data_test3=parseInt(data_test2[0])
           for (var i = 0; i < data_test2.length; i++) {
             // data_test3[]=println(data_test2[1])
             data_test3.push(parseInt(data_test2[i]));
           }

        balance_Y  = ((data_test3[0]+data_test3[1]+data_test3[2]) / 3) - data_test3[4]
        balance_X = data_test3[2] - data_test3[1] 
        y = (balance_Y / 850) * 142.5
        x = (balance_X / 850) * 142.5
        x1 = x+142.5
        y1 = y+142.5
        //ppp_left(x1,y1)
        //console.log(x1+','+y1)

xy_left = ((142.5 - x1) * (142.5 - x1) + (142.5 - y1) * (142.5 - y1))
xy_left_1 = Math.sqrt(xy_left)
// console.log('รูทซ้าย'+xy_left_1)
// if (xy_left_1<=28.5  ) {
//   $("#p_text_left").html('ดี')
// }else if (xy_left_1>28.5 && xy_left_1<=114){
//   $("#p_text_left").html('ปานกลาง')
// }else{
//   $("#p_text_left").html('พอใช้')
// }
xy_left_total = xy_left_1 + xy_left_total;
xy_left_total1=xy_left_total/(ileft+1)
        $("#p_left").html(xy_left_total.toFixed(2)); 
         // console.log(data_test3)

          var data_test1 = [0,0,0,0,364];
          // console.log(data_test1)
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
        xx= (x1 + x1_right) / 2
        yy =(y1 + y1_right ) /2
        ppp_right(xx,yy)
       // console.log(x1_right+','+y1_right)

        xy_right = ((142.5 - x1_right) * (142.5 - x1_right) + (142.5 - y1_right) * (142.5 - y1_right))
xy_right_1 = Math.sqrt(xy_right)
// console.log('รูทขวา'+xy_right_1)
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
// console.log('xy_right_total='+xy_right_1+'+'+xy_right_total)
// console.log(xy_right_total)
xy_right_total1=xy_right_total/(iright+1)
// console.log(xy_right_total1)
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

})

</script>
  
<script type="text/javascript">
  function conclude_peak_pressure_test(retData){
  
  left_sensor_i = 0;

                //toe
                left_sensor0=0
                max_left_sensor0_total = []
                right_sensor0=0
                max_right_sensor0_total = []

                //Medial Metatarsal
                left_sensor3=0
                max_left_sensor3_total = []

                //Lateral Metatarsal
                left_sensor1=0
                max_left_sensor1_total = []

                //Medial Midfoot
                left_sensor2=0
                max_left_sensor2_total = []

                //Heal
                left_sensor4=0
                max_left_sensor4_total = []

                for (var i = 0; i < retData.length; i++) {
                  // console.log( retData.length);
                  // console.log( retData[i].left);
                  for (var c = 0; c <  retData[i].left.length; c++) {
                    // console.log(retData[i].left[c]);
                    left_sensor0 += parseInt(retData[i].left[c][0])
                    max_left_sensor0_total.push(parseInt(retData[i].left[c][0]));

                    // console.log(retData[i].right[c]);
                    right_sensor0 += parseInt(retData[i].right[c][0])
                    max_right_sensor0_total.push(parseInt(retData[i].right[c][0]));

                    left_sensor_i++;
                  }

                  // for (var c = 0; c <  retData[i].right.length; c++) {
                  //   console.log(retData[i].right[c]);
                  //   left_sensor0 += parseInt(retData[i].right[c][0])
               
                   
                  //   max_left_sensor0_total.push(parseInt(retData[i].right[c][0]));

                  //   left_sensor_i++;
                  // }
                  
                }
 max_left_sensor0 = Math.max.apply(Math, max_left_sensor0_total) 
 max_right_sensor0 = Math.max.apply(Math, max_left_sensor0_total) 

// console.log(max_left_sensor0_total)
// console.log(max_left_sensor0)
//                 console.log(left_sensor0+'/'+left_sensor0_i +'='+left_sensor0/
// left_sensor0_i)

// $("#p_toe_max").html(data.option); 
// $("#p_toe_avg").html(data.table); 

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
function newDasboard() {
  id_customer =  $("#id_customer").val();  
  playback_type =  $("#playback_type").val();  
  datetimepicker =  $("#datetimepicker").val();  
  playback_time =  $("#playback_time").val();  
  $.redirect("playback_sport_DB.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time}, "POST", ""); 
}


// function function_play() {
//   id_customer =  $("#id_customer").val();  
//   playback_type =  $("#playback_type").val();  
//   datetimepicker =  $("#datetimepicker").val();  
//   playback_time =  $("#playback_time").val();  

//   $.redirect("playback_sport_GA.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time, status_play: '1'}, "POST", ""); 
// }

 
   

playback_time_func();

</script>

</body>
</html>

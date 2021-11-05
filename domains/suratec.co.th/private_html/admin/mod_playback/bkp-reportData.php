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
      <script async src="//jsfiddle.net/crabbly/kL68ey5z/embed/"></script>
      <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
      

      
   </head>
   <style>
    div#contour_div {
        margin-left: 60px;
    }
   .myfontsize p{
    font-size: 12px;
   }
   .myboxtext{
        border: 1px solid grey !important;          
        padding: 12px; 
        margin-top: -40px;
        margin-left: -20px;
   }
    .col-md-12.myboxtext p {
        font-size: 12px;
    }
   .mb20{
       margin-bottom: 20px;
   }
       .myline{
            border-top:1px solid #000;
       }
       ul li{
           padding: 5px;
       }
       ul {
        list-style-type: none;
        }
       .mt200{
           margin-top: 120px;        
       }
    .mybox
    {
        border: 1px solid;
        height: 54px;
        width: 80%;
        text-align: center;
        margin-left: 62px;
        margin-top: 20px;
    }

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
       .report-page-box .chappalNodata {
          border: 1px solid #333;
          height: 150px;
          align-content: center;
          display: flex;
          justify-content: center;
          flex-flow: wrap;
          max-width: 320px;
          margin: 20px auto 35px;
          padding: 0 15px;
      }
      .report-page-box .chappalNodata h3 {
        margin: 0;
      }
      .main-text-center .col-md-4 {
          text-align: center;
      }
      .report-page-box .chappalYesData.align-center-p {
          margin-top: 200px;
          border: 1px solid #000;
          text-align: center;
          padding: 14px;
      }
      .report-page-box .chappalYesData p {
        color: #000;
        font-weight: 500;
       font-size: 10px;
        margin: 0;
    }
    .chappalYesData.length-width p {
        font-weight: 500;
    }

    .chappalYesData.length-width {
        text-align: center;
        margin-bottom: 20px;
    }
  canvas#chappal_chart {
      display: none !important;
  }
  .main-text-center .col-md-4:nth-child(2) {
      font-size: 18px;
  }
  .main-text-center .col-md-4:nth-child(1), 
  .main-text-center .col-md-4:nth-child(3) {
      margin-top: 50px;
      margin-bottom: 15px;
  }
    .top-align-one { 
      margin-top: 190px;
    }
    .top-align-two { 
      margin-top: 170px;
    }

    @media only screen and (max-width: 1380px) {
         .top-align-one { 
          margin-top: 140px;
        }
        .top-align-two { 
          margin-top: 120px;
        }
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
           $userData = "SELECT fname,email FROM `mod_customer` WHERE `id_customer` = '".$id_customer."' AND (`delete_datetime` IS NULL OR delete_datetime IS NULL)";
           $query_type = mysqli_query($objConnect,$userData);
          while ($userDataRec = mysqli_fetch_array($query_type)) {
              $fname =  $userDataRec['fname'];
              $email =  $userDataRec['email'];
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

    //   echo "<pre>"; 
    //   print_r($_REQUEST);
    //   print_r($_FILES['upload_csv']);
    //    die;
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
            <?=$title.' for '.$fname?>
         </h1>
         <ol class="breadcrumb">
            <li><a href="../page_home/index.php"></i> Dashboard</a></li>
            <li class="active"><?=$title?></li>
         </ol>
      </section>
      <!-- Main content -->
      <section class="content">
         <div class="row">
            <div class="col-md-12">
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
                                          <label>CSV</label>
                                          <div class='input-group date col-md-12' >
                                          <span id="file_error"></span>
                                             <input type="file" class="form-control" name="chappal_csv" id="chappal_csv" value="<?=$str_photo?>">
                                          </div>
                                       </div>
                                       <div class="col-sm-3" style="margin-top: 26px;">
                                       <label></label>
                                          <button onclick="function_play()" type="button" class="btn btn-primary search_date" id="search_date"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Report</button>&nbsp;  
                                          <button type="button" class="btn btn-primary " id="download-pdf">PDF</button>
                                       </div>
                                    </div>
                                 </div>
                              </fieldset>
                           </div>
                           <div id="reportPage">
                           <div class="report-page-box" >
                            <div class="row">
                           <div class="col-md-12" >
                               <div class="col-md-2">
                                    <div class="chappalYesData align-center-p">
                                            <p><b>Arch Index : <span id="ai1"> 0</span></b></p>
                                            <!-- <p>Foot Type : <span id="ft1"> 0</span></p> -->
                                            <img src="img/foottype1.jpeg" id="ft1"  style="height: 50%; width: 50%;"/>  
											<p  class="myfontsize">Foot Length: <span id="lfl"> 0</span> cm</p>	
											<p class="myfontsize">Foot Width: <span id="lfw"> 0</span> cm</p>			
                                    </div> 
                               </div>
                               <div class="col-md-8" >
                                       <div class="chappalNodata" style="border: 1px solid;padding: 70px;">
                                            <h3 style="text-align: center;">No Data Found</h3>
                                        </div>
                                       <div id="contour_div"></div>
                                       <canvas id="chappal_chart" style="margin-bottom: -100px;"></canvas>
                                       <img src="img/foottype.jpeg"  style="height: 145px; width: 100%;"/>
									   
                                       <div class="chappalYesData length-width">
                                        </div>
                                       
                                              
                               </div>
                                <div class="col-md-2">
                                    <div class="chappalYesData align-center-p">
                                         <p><b>Arch Index : <span id="ai2"> 0</span><b></p>
                                        <!-- <p>Foot Type : <span id="ft2"> Normal</span></p> -->
                                        <img src="img/foottype1.jpeg" id="ft2"  style="height: 50%; width: 50%;"/>  
										<p class="myfontsize">Foot Length: <span id="rfl"> 0</span> cm</p>	
										<p class="myfontsize">Foot Width: <span id="rfw"> 0</span> cm</p>		

                                    </div>  
                                   </div>
                                </div>
                              </div>
                           <div class="col-md-12 myline" style="margin-bottom: 15px; margin-top: 0em;"></div>
                          
                                 <div class="main-text-center">
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <div class="col-md-4">
                                                    <strong >Walking Speed (steps/min) : <span id="ws">0</span></strong>
                                            </div>
                                            <div class="col-md-4">
                      
                                                    <strong id="sub">Dynamic Data</strong>
                                            </div>
                                            <div class="col-md-4">
                                                    <strong id="sub">Step count:  <span id="sc">0</span></strong>
                                            </div>
                                       </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb20" >
                                <div class="col-md-4">
                                <canvas id="balance_left" width="320"  height="320" ></canvas>
                                    <div class="col-md-12 mybox">
                                        <p> Sway Time : <span id="lsw">1.2</span> sec</p>
                                        <p>Stance Time <span id="lst">1.2</span> sec</p>
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                <canvas id="cop" width="320" height="320"></canvas>
                                <div class="col-md-12 mybox">
                                        <p>Cycle Time : <span id="gst">1.2</span> sec</p>
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <canvas id="balance_right" width="320"  height="320"></canvas>
                                <div class="col-md-12 mybox">
                                        <p>Sway Time : <span id="rsw">1.2</span> sec</p>
                                        <p>Stance Time <span id="rst">1.2</span> sec</p>
                                    </div>
                                </div>
                            </div>
                           <div class="col-md-12 myline"></div>
                           <div class="col-md-12" >
                                <div id="plotly_div" ></div>
                                <canvas id="box_chart"  style="position: relative; height:5vh; width:80vw;" ></canvas>
                                <!-- <div id='box_chart' >Plotly chart will be drawn inside this DIV</div> -->
                            </div>
                           <div class="col-md-12 mb20">
                                <div class="col-md-6 " style="padding-left:100px">
                                        <strong>Normal Person : x = -<span id="np1">189</span> ± <span id="np1">67</span>, y = -<span id="np3">134</span> ± <span id="np4">55</span></strong>
                                </div>
                                <div class="col-md-6" style="padding-left: 161px;">
                                        <strong >Subject : x = <span id="sub1">0</span> ± <span id="sub2">0</span>, y = <span id="sub3">0</span> ± <span id="sub4">0</span></strong>
                                </div>
                            </div>
							<div class="col-md-12 myline"></div>
							<p style="text-align: center; margin-top:5px; font-size: 18px;"><strong>PHASES OF A GAIT CYCLE</strong></p><br><br>
							<div class="col-md-12 mb20">
                                <div class="col-md-12 mb20" >
                                <div class="col-md-6 " >
                                    <img src="img/gait.jpeg"  style="height: 400px;width: 90%;"/>
                                    <div class="col-md-12 myboxtext">
                                        <div class="col-md-3">
                                        <p> Time: <span id="l1t">1.2</span> s</p>
                                            <p>Cycle%: <span id="l1p">1.2</span> </p>
                                        </div>
                                        <div class="col-md-3">
                                        <p> Time: <span id="l2t">1.2</span> s</p>
                                            <p>Cycle%: <span id="l2p">1.2</span> </p>
                                        </div>
                                        <div class="col-md-3">
                                        <p> Time: <span id="l3t">1.2</span> s</p>
                                            <p>Cycle%: <span id="l3p">1.2</span> </p>
                                        </div>
                                        <div class="col-md-3">
                                        <p> Time: <span id="l4t">1.2</span> s</p>
                                            <p>Cycle%: <span id="l4p">1.2</span> </p>
                                        </div>  
                                    </div>
                                </div>
                                <div class="col-md-6 " >
                                    <img src="img/gait.jpeg"  style="height: 400px;width: 90%;"/>
                                    <div class="col-md-12 myboxtext" style="border: 1px solid grey !important;     font-size: 11px   padding: 12px;    margin-top: -40px;    margin-left: -20px;">
                                        <div class="col-md-3">
                                        <p> Time: <span id="r1t">1.2</span> s</p>
                                            <p>Cycle%: <span id="r1p">1.2</span> </p>
                                        </div>
                                        <div class="col-md-3">
                                        <p> Time: <span id="r2t">1.2</span> s</p>
                                            <p>Cycle%: <span id="r2p">1.2</span> </p>
                                        </div>
                                        <div class="col-md-3">
                                        <p> Time: <span id="r3t">1.2</span> s</p>
                                            <p>Cycle%: <span id="r3p">1.2</span> </p>
                                        </div>
                                        <div class="col-md-3">
                                        <p> Time: <span id="r4t">1.2</span> s</p>
                                            <p>Cycle%: <span id="r4p">1.2</span> </p>
                                        </div>  
                                    </div>
                                </div>
                                </div>
                            </div>
							
                           
                         <div class="col-md-12 myline">
                         <p style="text-align: center; margin-top:5px; font-size: 18px;"><strong>GAIT CYCLE</strong></p>
                         </div>
                            <!-- <div class="col-lg-11 col-md-11 col-sm-11" tyle="position: relative; height:80vh; width:80vw >  -->
                              <div class="chart-one chart-display">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="col-lg-11 col-md-11 col-sm-11" style="margin-top: 20px; position: relative; height:60vh; width:65vw;" >                            
                                          <canvas id="gait_left" ></canvas>
                                   
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 top-align-one">
                                        <ul>
                                            <li><strong ><img src="img/fore_foot.png" width="41px" height="37px"/> <span id="FL">0</span>% </strong></li>
                                            <li><strong ><img src="img/mid_foot.png" width="41px" height="37px"/> <span id="ML">0</span>% </strong></li>
                                            <li><strong ><img src="img/heel.png" width="41px" height="37px"/> <span id="HL">0</span>% </strong></li>
                                        </ul>
                                    </div>
                                  </div>
                                </div>
                              </div>
                               <div class="chart-two chart-display">
                                <div class="row">
                                  <div class="col-md-12">
                                        <div class="col-lg-11 col-md-11 col-sm-11" style="position: relative; height:60vh; width:65vw;" >                          
                                            <canvas id="gait_right" ></canvas>
                                       </div>
                                       <div class="col-lg-1 col-md-1 col-sm-1 top-align-two">
                                            <ul>
                                                <li><strong ><img src="img/fore_foot.png" width="41px" height="37px"/> <span id="FR">0</span>% </strong></li>
                                                <li><strong ><img src="img/mid_foot.png" width="41px" height="37px"/> <span id="MR">0</span>% </strong></li>
                                                <li><strong ><img src="img/heel.png" width="41px" height="37px"/> <span id="HR">0</span>% </strong></li>
                                            </ul>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                          
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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.debug.js"></script>
      
      
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
         $("#datetimepicker").datepicker({
           beforeShowDay: beforeShowDay,
           dateFormat: 'yy-mm-dd',
         changeMonth: true,
         changeYear: true
         });
      </script>
      <script>  
      //original canvas
      

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
         
         
         function function_play() {
           id_customer =  $("#id_customer").val();  
           playback_type =  $("#playback_type").val();  
           datetimepicker =  $("#datetimepicker").val();  
           playback_time =  $("#playback_time").val();  
        //    upload_csv =   $('#chappal_csv')[0].files[0];

           var files = $('#chappal_csv')[0].files;
           $.redirect("reportData.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time, status_play: '1',upload_csv:files[0]}, "POST", ""); 
         }
         
          
            
         
         playback_time_func();
      </script>
      <script>
      // Declare All Arrays    
const xlabels = [];
const xlabels_int = [];
const new_xlabels = [];
const foreL = [];
const midL = [];
const heelL = [];
const midLeft = [];
const heelLeft = [];
const midRight = [];
const heelRight = [];
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
/* **********Start*********** */
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
/* ********End************* */

call(); // Function Call to plot All Canvas

async function call() {
    await getData(); // Get Data from CSV File

    chartIt_left_balance();
    chartIt_cop();
    chartIt_right_balance();
    chartIt_left_gait();
    chartIt_right_gait();
}
  /* **********************Start Box Chart **************** */
  var box_d3 = Plotly.d3
        var canvas = document.getElementById('box_chart');
        var context = canvas.getContext('2d');
        var graph_image = new Image();
        var xx_data = [];
        var yy_data = [];
        var xy_data= [];
        var new_xy_data= [];
        var new_xx_data = [];
        var new_yy_data = [];
        var i;
        for (i = 0; i < box_length; i++) {
            xx_data.push('X');
            yy_data.push('Y');  
            new_xx_data.push(box_new_x[0][i]);
            new_yy_data.push(box_new_y[0][i]);
        }
        xy_data = xx_data.concat(yy_data);
    
        new_xy_data = new_xx_data.concat(new_yy_data);
    
        var normal = ['X','X','X','X','X','X','X', 'X','X','X','X','X','X','X', 'X','X','X','X','X','X','X', 'X','X','X','X','X','X','X', 'X','X','X','X','X','X','X', 'X','X','X','X','X','X','X', 'X','X','X','X','X','X','X', 'Y','Y','Y','Y','Y','Y','Y', 'Y','Y','Y','Y','Y','Y','Y', 'Y','Y','Y','Y','Y','Y','Y', 'Y','Y','Y','Y','Y','Y','Y', 'Y','Y','Y','Y','Y','Y','Y', 'Y','Y','Y','Y','Y','Y','Y', 'Y','Y','Y','Y','Y','Y','Y']
        var subject = xy_data
        arr1 = [-507, -555, -278, -573, -579, -574, -390, -560, -441, -397, -451, -518, -439, -376, -368, -455, -524, -220, -536, -416, -436, -377, -337, -577, -390, -466, 476, -319, -635, -672, 11, 63, -16, 166, -55, -694, 167, -386, -142, -632, -681, 78, 74, -420, -356, -393, -511, -597, -564, 112, 51, 136, 82, 66, 117, 127, 121, 111, 110, 127, 206, 183, 385, 168, 104, 127, 187, 136, 178, 184, 212, 197, 173, 270, 188, -200, -103, 66, -21, 70, 127, 73, 238, -26, 119, 604, -20, -134, -40, -91, 93, 143, -104, -58, -75, -225, -10, 35]

        var trace1 = {
        x: arr1,
        y: normal,
        name: 'Normal',
        marker: {color: '#3D9970'},
        type: 'box',
        boxmean: false,
        orientation: 'h'
        };

        var trace2 = {
        x: new_xy_data,
        y: subject,
        name: 'Subject',
        marker: {color: '#FF4136'},
        type: 'box',
        boxmean: false,
        orientation: 'h'
        };


        var data = [trace1, trace2];

        var layout = {
        title: 'Cross Section Boxplot',
        xaxis: {
            title: 'Cross Section Boxplot',
			range: [-2000,2000],
            zeroline: true
        },
        boxmode: 'group'
        };
        Plotly.plot(
            'plotly_div',
            data,
            layout)
            .then(
            function(gd) {
                Plotly.toImage(gd, {
                    height: 500,
                    width: 700
                })
                .then(
                    function(url) {
                    graph_image.src = url;
                    return Plotly.toImage(gd, {
                        format: 'svg',
                        height: 800,
                        width: 800
                    });
                    })

            });
          /* **********************End Box Chart **************** */

// Function for Canvas 1 Plot (left_balance)    
function chartIt_left_balance() {
    //await getData();
    
    const ctx = document.getElementById('balance_left').getContext('2d');
    const balance_left = new Chart(ctx, {
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
                        min: -400,
                        max: 400,
                        stepSize: 100
                    },
                    gridLines: {
                        color: '#888',
                        drawOnChartArea: true
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: -400,
                        max: 400,
                        stepSize: 100
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
                    data: storage_left_balance_kpa,
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
                            x: -400,
                            y: 0
                        },
                        {
                            x: 400,
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
                            y: 400
                        },
                        {
                            x: 0,
                            y: -400
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
                        min: -400,
                        max: 400,
                        stepSize: 100
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
                        min: -400,
                        max: 400,
                        stepSize: 100
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
                    data: storage_cop_kpa,
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
                            x: -400,
                            y: 0
                        },
                        {
                            x: 400,
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
                            y: 400
                        },
                        {
                            x: 0,
                            y: -400
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
                        min: -400,
                        max: 400,
                        stepSize: 100
                    },
                    gridLines: {
                        color: '#888',
                        drawOnChartArea: true
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: -400,
                        max: 400,
                        stepSize: 100
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
                    data: storage_right_balance_kpa,
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
                            x: -400,
                            y: 0
                        },
                        {
                            x: 400,
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
                            y: 400
                        },
                        {
                            x: 0,
                            y: -400
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
                    maxTicksLimit: new_ticks,
					},
                    gridLines: {
                        color: "rgba(0, 0, 0, 0)",
                    },
                    
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Pressure (kPa)'
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
            labels: xlabels_int,
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
                    maxTicksLimit: new_ticks
					},
                    gridLines: {
                        color: "rgba(0, 0, 0, 0)",
                    }
                }],
                yAxes: [{

                    scaleLabel: {
                        display: true,
                        labelString: 'Pressure (kPa)'
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
            labels: xlabels_int,
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
					map2[x][y] = (3.68177 * Math.pow(1.00163,( map[x][y]))).toFixed(2);
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
            }
            }
            ];

            var layout = {
            title: 'Static Pressure Distribution',
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
			autosize: false,
  			width: 520,
  			height: 520
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
                        if (columandata >= 50 &&  columandata !='NaN'){
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
                $('#lfl').text((foot_length_left.toFixed(1)));
				$('#rfl').text((foot_length_right.toFixed(1)));
				$('#lfw').text((foot_width_left));
				$('#rfw').text((foot_width_right));
                
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
                    // $('#ft1').text('High');
                    $('#ft1').attr("src", "img/High1.jpeg");
                 }else if(left_arch_index > 0.28){
                    // $('#ft1').text('Flat');
                    $('#ft1').attr("src", "img/Flat1.jpeg");
                 }else{
                    // $('#ft1').text('Normal');
                    $('#ft1').attr("src", "img/Normal1.jpeg");
                 }
                 if (right_arch_index < 0.21){
                    // $('#ft2').text('High');
                    $('#ft2').attr("src", "img/High2.jpeg");
                 }else if(right_arch_index > 0.28){
                    // $('#ft2').text('Flat');
                    $('#ft2').attr("src", "img/Flat2.jpeg");
                 }else{
                    // $('#ft2').text('Normal');
                    $('#ft2').attr("src", "img/Normal2.jpeg");
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
      
    $strSQL = "SELECT ROUND(surasole.action-(SELECT `action` FROM `surasole` LEFT JOIN mod_customer ON mod_customer.id_customer = surasole.id_customer WHERE surasole.`id_customer`='$id_customer' AND  surasole.`type`='$playback_type'  AND surasole.action BETWEEN '$datetimepicker $startTime' AND '$datetimepicker $addedtime' ORDER BY `duration` ASC limit 1),1) as duration
    ,surasole.left_sensor1,surasole.left_sensor2,surasole.left_sensor3,
    surasole.left_sensor4,surasole.left_sensor5,surasole.right_sensor1,surasole.right_sensor2,
    surasole.right_sensor3,surasole.right_sensor4,surasole.right_sensor5,(surasole.left_sensor2+surasole.left_sensor3)/2 as left_stride_F,
    (surasole.left_sensor3-surasole.left_sensor2) as left_balance_x,(((surasole.left_sensor2+surasole.left_sensor3)/2)-surasole.left_sensor5) as left_balance_y,(surasole.right_sensor2+surasole.right_sensor3)/2 as right_stride_F,(surasole.right_sensor3-surasole.right_sensor2) as right_balance_x,
    (((surasole.right_sensor2+surasole.right_sensor3)/2)-surasole.right_sensor5) as right_balance_y,(((surasole.right_sensor2+surasole.right_sensor3)/2)+(surasole.right_sensor4+surasole.right_sensor5))-(((surasole.left_sensor2+surasole.left_sensor3)/2)+(surasole.left_sensor4+surasole.left_sensor5)) as body_COP_x,(((surasole.left_sensor2+surasole.left_sensor3)/2)+((surasole.right_sensor2+surasole.right_sensor3)/2))-(surasole.right_sensor5+surasole.left_sensor5) as body_COP_y
    
FROM
    `surasole`
LEFT JOIN mod_customer ON mod_customer.id_customer = surasole.id_customer
WHERE surasole.`id_customer`='$id_customer' AND  surasole.`type`='$playback_type'  AND surasole.action BETWEEN '$datetimepicker $startTime' AND '$datetimepicker $addedtime'";
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
var new_sec = 1+(selectsec - Math.round(selectsec*0.40));
new_ticks = new_sec -1;
new_sec_pdf[0] = new_sec;
columnsData12 = '<?php echo json_encode($mainData); ?>';
const columnsDataFinal = columnsData12.split('","').slice(1);
    columnsDataFinal.forEach(function (row, i) {
        const columns = row.split(',');
        const time = columns[0];
        xlabels.push(time);
		xlabels_int.push(parseInt(time));
        const fore_left = columns[11];
		const fore_left_kpa = (1.15037 * Math.pow(1.00774,fore_left)).toFixed(2);
        foreL.push(fore_left_kpa);
        const mid_left = columns[4];
		midLeft.push(mid_left);
		const mid_left_kpa = (1.15037 * Math.pow(1.00774,mid_left)).toFixed(2);
        midL.push(mid_left_kpa);
        const heel_left = columns[5];
		heelLeft.push(heel_left);
		const heel_left_kpa = (1.15037 * Math.pow(1.00774,heel_left)).toFixed(2);
        heelL.push(heel_left_kpa);

        const lx = columns[12]
        const ly = columns[13]
        var json_left = {
            x: lx,
            y: ly
        };
        storage_left_balance.push(json_left);

        const cop_x = columns[17]
        const cop_y = columns[18]
        var json_cop = {
            x: cop_x,
            y: cop_y
        };
        storage_cop.push(json_cop);
		
		
		
        const rx = columns[15]
        const ry = columns[16]
        var json_right = {
            x: rx,
            y: ry
        };
        storage_right_balance.push(json_right);


        const fore_right = columns[14];
		const fore_right_kpa = (1.15037 * Math.pow(1.00774,fore_right)).toFixed(2);;
        foreR.push(fore_right_kpa);
        const mid_right = columns[9];
		midRight.push(mid_right);
		const mid_right_kpa = (1.15037 * Math.pow(1.00774,mid_right)).toFixed(2);
        midR.push(mid_right_kpa);
        const heel_right = columns[10];
		heelRight.push(heel_right);
		const heel_right_kpa = (1.15037 * Math.pow(1.00774,heel_right)).toFixed(2);
        heelR.push(heel_right_kpa);
		
		
		/* COP KPA Conversion */
		const cop_x_kpa = (parseFloat(fore_right_kpa) + parseFloat(mid_right_kpa) + parseFloat(heel_right_kpa)) -(parseFloat(fore_left_kpa) + parseFloat(mid_left_kpa) + parseFloat(heel_left_kpa))
		const cop_y_kpa = (parseFloat(fore_right_kpa) + parseFloat(fore_left_kpa)) - (parseFloat(heel_right_kpa) + parseFloat(heel_left_kpa))
		var json_cop_kpa = {
			x: cop_x_kpa,
			y: cop_y_kpa
		};
		storage_cop_kpa.push(json_cop_kpa);
		
		const left_s2 = columns[2];
		const left_s2_kpa = (1.15037 * Math.pow(1.00774,left_s2)).toFixed(2);
		const left_s3 = columns[3];
		const left_s3_kpa = (1.15037 * Math.pow(1.00774,left_s3)).toFixed(2);
		const lx_kpa = parseFloat(left_s3_kpa) - parseFloat(left_s2_kpa);
		
		const ly_kpa = parseFloat(fore_left_kpa) - parseFloat(heel_left_kpa);
		var json_left_kpa = {
			x: lx_kpa,
			y: ly_kpa
		};
		storage_left_balance_kpa.push(json_left_kpa);
		
		const right_s2 = columns[7];
		const right_s2_kpa = (1.15037 * Math.pow(1.00774,right_s2)).toFixed(2);
		const right_s3 = columns[8];
		const right_s3_kpa = (1.15037 * Math.pow(1.00774,right_s3)).toFixed(2);
		const rx_kpa = parseFloat(right_s3_kpa) - parseFloat(right_s2_kpa);
		const ry_kpa = parseFloat(fore_right_kpa) - parseFloat(heel_right_kpa);
		var json_right_kpa = {
			x: rx_kpa,
			y: ry_kpa
		};
		storage_right_balance_kpa.push(json_right_kpa);
		
		
        //const total_left = (parseInt(fore_left_kpa) + parseInt(mid_left_kpa)+ parseInt(heel_left_kpa));
        //totalL.push(total_left);
        //const total_right = (parseInt(fore_right_kpa) + parseInt(mid_right_kpa)+ parseInt(heel_right_kpa));
        //totalR.push(total_right);

        columns[29] = (parseInt(columns[1])+parseInt(columns[2])+parseInt(columns[3])+parseInt(columns[4])+parseInt(columns[5]));
        columns[30] = (parseInt(columns[6])+parseInt(columns[7])+parseInt(columns[8])+parseInt(columns[9])+parseInt(columns[10]));
        columns[31] = (parseInt(columns[29]) - parseInt(columns[30]));      
        columns[32] = (parseInt(columns[30]) - parseInt(columns[29]));  
		columns[33] = parseInt((parseInt(columns[1])+parseInt(columns[2])+parseInt(columns[3])) /3);
		columns[34] = parseInt((parseInt(columns[6])+parseInt(columns[7])+parseInt(columns[8])) /3);
    
        column29.push(columns[29]);
        column30.push(columns[30]);
        column31.push(columns[31]);
        column32.push(columns[32]);
		column33.push(columns[33]); 
        column34.push(columns[34]);
        
        
    });
    //console.log($cut_time, '***Cut Time****');
    // Step Count for above 3 diagram
var subject_count = [];
var new_x = [];
var new_y = [];
var step_count = 0;
    column31.forEach(function (row1, ival) {
        if((column31[ival] < 0 && column31[ival+1] >= 0) || (column31[ival] > 0 && column31[ival+1] <= 0)){
            step_count = step_count + 1
        }
        step_count_pdf[0] = step_count;
        $('#sc').text(step_count);  
        $('#ws').text(Math.round((step_count/new_sec)*60))
        if(column31[ival] < 0 && column31[ival+1] >= 0){
            subject_count.push(ival)        
        }
    });
/* **********************Start subject count************************** */

   

length = subject_count.length;


subject_count.forEach(function (sub, sub_i) {
    new_x.push(storage_cop[subject_count[sub_i]].x);
    new_y.push(storage_cop[subject_count[sub_i]].y);    

});
box_new_x.push(new_x);
box_new_y.push(new_y);
box_length.push(length);

// // # Mean and SD Calculation of both x and y parts
// var mean_x = Math.round(new_x/(new_x.length),2)
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
    $('#sub1').text(new_x_mean);

   new_x.forEach(function (new_x_sd_val, new_x_sd_i) {
    sd_x = Math.pow((new_x_sd_val-new_x_mean),2);
    new_x_sd_tot = new_x_sd_tot + parseFloat(sd_x);
   });
   new_x_sd = new_x_sd_tot / new_x.length;
   new_x_sd_square = Math.round(Math.sqrt(new_x_sd),2);
   new_x_sd_square_pdf[0] = new_x_sd_square;    
   $('#sub2').text(new_x_sd_square);
      new_y.forEach(function (new_y_val, new_y_i) {
    new_y_sum = new_y_sum+parseFloat(new_y_val);    
   });
   new_y_mean = Math.round(new_y_sum/new_y.length,2);
   new_y_mean_pdf[0] = new_y_mean;
   $('#sub3').text(new_y_mean);

   new_y.forEach(function (new_y_sd_val, new_y_sd_i) {
    sd_y = Math.pow((new_y_sd_val-new_y_mean),2);
      new_y_sd_tot = new_y_sd_tot + parseFloat(sd_y);
   });
   new_y_sd = new_y_sd_tot / new_y.length;
   new_y_sd_square = Math.round(Math.sqrt(new_y_sd),2);
   new_y_sd_square_pdf[0] = new_y_sd_square;
   $('#sub4').text(new_y_sd_square);
   
   
   //-------------------------------------------------------------------------------------------------Sway Start------------------------------------------
// Variable Declaration
/*
var count = [];
var count_left = [];
var count_right = [];
var l_total_distance = 0
var r_total_distance = 0
var l_total_time = 0
var r_total_time = 0

//GAIT Cycle
    column31.forEach(function (row1, ival) {
        if((column31[ival] < 0 && column31[ival+1] >= 0) || (column32[ival] < 0 && column32[ival+1] >= 0)){
            count.push(ival);
        }
        if(column31[ival] < 0 && column31[ival+1] >= 0){
            count_left.push(ival)       
        }
        if(column32[ival] < 0 && column32[ival+1] >= 0){
            count_right.push(ival)      
        }
    });


var length_left = count_left.length
var length_right = count_right.length
var length = count.length
var start = Math.min(count_left[0], count_right[0])
var end = Math.max(count_left[length_left-1], count_right[length_right-1])
 if(start == count_left[0]){
    var j;
        for (j = 0; j < length-1; j++) {
                if (j %2 == 0){
                var i;
                for (i = count[j]; i < count[j+1]+1; i++) {
                    l_total_distance = l_total_distance + Math.sqrt(Math.pow((storage_cop[i+1].x - storage_cop[i].x) ,2) + Math.pow((storage_cop[i+1].y  - storage_cop[i+1].y ),2))
                    l_total_time = parseFloat(l_total_time) + parseFloat(xlabels[i+1]) - parseFloat(xlabels[i])
                }
                }else{ 
                    var k;
                for (k = count[j]; k < count[j+1]+1; k++) {
                    r_total_distance = r_total_distance + Math.sqrt(Math.pow((storage_cop[k+1].x  - storage_cop[k].x),2) + Math.pow((storage_cop[k+1].y  - storage_cop[k].y ),2))
                    r_total_time = parseFloat(r_total_time) + parseFloat(xlabels[k+1]) - parseFloat(xlabels[k])
                }
            }
        }
 }

 if(start == count_right[0]){
    var j;
        for (j = 0; j < length-1; j++) {
                if (j %2 == 0){
                var i;
                for (i = count[j]; i < count[j+1]+1; i++) {
                    r_total_distance = r_total_distance + Math.sqrt(Math.pow((storage_cop[i+1].x  - storage_cop[i].x ),2) + Math.pow((storage_cop[i+1].y  - storage_cop[i].y ),2))
                    r_total_time = parseFloat(r_total_time) + parseFloat(xlabels[i+1]) - parseFloat(xlabels[i])
                }
                }else{
                    var k;
                for (k = count[j]; k < count[j+1]+1; k++) {
                     l_total_distance = l_total_distance + Math.sqrt(Math.pow((storage_cop[k+1].x  - storage_cop[k].x ),2) + Math.pow((storage_cop[k+1].y - storage_cop[k].y),2))
                     l_total_time = parseFloat(l_total_time) + parseFloat(xlabels[k+1]) - parseFloat(xlabels[k])
                     

                }
            }
        }
 } 
left_sway_time = l_total_time / length_left;
left_sway_distance = Math.round(l_total_distance / length_left);
right_sway_time = r_total_time / length_right;
right_sway_distance = Math.round(r_total_distance / length_right);

total_distance = l_total_distance + r_total_distance
total_time = l_total_time + r_total_time
sway_time = total_time / (length/2);
sway_distance = Math.round(total_distance / (length/2));
 $('#sd1').text(left_sway_distance);
 $('#st1').text(left_sway_time.toFixed(2));
 $('#sd2').text(sway_distance);
 $('#st2').text(sway_time.toFixed(2));
 $('#sd3').text(right_sway_distance);
 $('#st3').text(right_sway_time.toFixed(2));

//---------------------------------------------------------------------Sway End--------------------------------------------------
 */  
   //-------------------------------------------------------------------------------------------------Sway Start------------------------------------------
// Variable Declaration


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
		if(heelLeft[i-1] ==0 && heelLeft[i] > 0){
			count_left1.push(i);
		}
		
		if(heelLeft[i] >100 && midLeft[i] > 100 && column33[i] > 60){
        count_left2.push(i);
		}
		
		if(heelLeft[i] <100 && midLeft[i] < 100 && column33[i] > 80 && column30[i] > 200){
			count_left3.push(i);
			}
		if(column29[i] < 200 && column30[i] > 200){
			count_left4.push(i);
		}  
		
	}
 //console.log(count_left1,"**********1********");
 //console.log(count_left2,"**********2********");
 //console.log(count_left3,"**********3********");
 //console.log(count_left4,"**********4********");
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

var l1_time = parseFloat(l1_total_time / left_phase_count).toFixed(2);
var l2_time = parseFloat(l2_total_time / left_phase_count).toFixed(2);
var l3_time = parseFloat(l3_total_time / left_phase_count).toFixed(2);
var l4_time = parseFloat(l4_total_time / left_phase_count).toFixed(2);

var left_total_time = (parseFloat(l1_time) + parseFloat(l2_time) + parseFloat(l3_time) + parseFloat(l4_time)).toFixed(2);
var l1_per = Math.round(parseFloat((l1_time / left_total_time)*100));
var l2_per = Math.round(parseFloat((l2_time / left_total_time)*100));
var l3_per = Math.round(parseFloat((l3_time / left_total_time)*100));
var l4_per = Math.round(parseFloat((l4_time / left_total_time)*100));
//console.log(l1_time, l2_time, l3_time,l4_time);
var left_stance_time = parseFloat(left_total_time - l4_time).toFixed(2);
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
		if(heelRight[i-1] ==0 && heelRight[i] > 0){
			count_right1.push(i);
		}
		
		if(heelRight[i] >100 && midRight[i] > 100 && column34[i] > 60){
        count_right2.push(i);
		}
		
		if(heelRight[i] <100 && midRight[i] < 100 && column34[i] > 80 && column29[i] > 200){
			count_right3.push(i);
			}
		if(column30[i] < 200 && column29[i] > 200){
			count_right4.push(i);
		}  
		
	}
// console.log(count_right1,"**********1********");
 //console.log(count_right2,"**********2********");
 //console.log(count_right3,"**********3********");
 //console.log(count_right4,"**********4********");
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


var r1_time = parseFloat(r1_total_time / right_phase_count).toFixed(2);
var r2_time = parseFloat(r2_total_time / right_phase_count).toFixed(2);
var r3_time = parseFloat(r3_total_time / right_phase_count).toFixed(2);
var r4_time = parseFloat(r4_total_time / right_phase_count).toFixed(2);

var right_total_time = parseFloat(r1_time) + parseFloat(r2_time) + parseFloat(r3_time) + parseFloat(r4_time);
var r1_per = Math.round(parseFloat((r1_time / right_total_time)*100));
var r2_per = Math.round(parseFloat((r2_time / right_total_time)*100));
var r3_per = Math.round(parseFloat((r3_time / right_total_time)*100));
var r4_per = Math.round(parseFloat((r4_time / right_total_time)*100));
//console.log(r1_per,r2_per,r3_per,r4_per,"*********");
//console.log(l1_per,l2_per,l3_per,l4_per,"*********");
//console.log(r1_time, r2_time, r3_time,r4_time);
var right_stance_time = (parseFloat(right_total_time - r4_time)).toFixed(2);
var right_sway_time = r4_time;
//console.log(left_total_time,left_stance_time, "*****Left Stance");
//console.log(left_sway_time, "*****Left Sway");

 $('#l1t').text(l1_time);
 $('#l2t').text(l2_time);
 $('#l3t').text(l3_time);
 $('#l4t').text(l4_time);
 $('#r1t').text(r1_time);
 $('#r2t').text(r2_time);
 $('#r3t').text(r3_time);
 $('#r4t').text(r4_time);
 $('#l1p').text(l1_per);
 $('#l2p').text(l2_per);
 $('#l3p').text(l3_per);
 $('#l4p').text(l4_per);
 $('#r1p').text(r1_per);
 $('#r2p').text(r2_per);
 $('#r3p').text(r3_per);
 $('#r4p').text(r4_per);






 $('#lsw').text(left_sway_time);
 $('#lst').text(left_stance_time);
 $('#gst').text(left_total_time);
 $('#rsw').text(right_sway_time);
 $('#rst').text(right_stance_time);

//---------------------------------------------------------------------Sway End--------------------------------------------------
   

   

      // # Array Declaration
      const FL = [];
      const ML = [];
      const HL = [];
      const FR = [];
      const MR = [];
      const HR = [];

      foreL.forEach(function (foreL_val, foreL_i) { 
	  
		  if(column31[foreL_i] > 0){
              FL.push(parseFloat(foreL_val) / (parseFloat(foreL_val) + parseInt(midL[foreL_i]) + parseInt(heelL[foreL_i])))
              ML.push(parseInt(midL[foreL_i]) / (parseFloat(foreL_val) + parseInt(midL[foreL_i]) + parseInt(heelL[foreL_i])))
              HL.push(parseInt(heelL[foreL_i]) / (parseFloat(foreL_val) + parseInt(midL[foreL_i]) + parseInt(heelL[foreL_i])))
           }
              
         if(column32[foreL_i] > 0){
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
    $('#FL').text(fl_avg)
    ml_avg = Math.round((ml_sum /FL.length) * 100);
    ml_pdf[0] = ml_avg;
    $('#ML').text(ml_avg)
    hl_avg = Math.round((hl_sum /FL.length) * 100);
    hl_pdf[0] = hl_avg;
    $('#HL').text(hl_avg)   
    fr_avg = Math.round((fr_sum /FR.length) * 100);
    fr_pdf[0] = fr_avg;
    $('#FR').text(fr_avg)
    mr_avg = Math.round((mr_sum /FR.length) * 100);
    mr_pdf[0] = mr_avg;
    $('#MR').text(mr_avg)
    hr_avg = Math.round((hr_sum /FR.length) * 100);
    hr_pdf[0] = hr_avg;
    $('#HR').text(hr_avg)
/* *******************End***************************** */
}
  
document.getElementById('download-pdf').addEventListener("click", downloadPDF);
    //donwload pdf from original canvas
    function downloadPDF() {
      //creates image
      var canvas = document.querySelector('#balance_left');
      var canvasImg  = canvas.toDataURL(canvas, '#ffffff', {    type: 'image/jpeg',    encoderOptions: 1.0});
      //creates image
      var canvas1 = document.querySelector('#cop');
      var canvasImg1 = canvas1.toDataURL(canvas, '#ffffff', {    type: 'image/jpeg',    encoderOptions: 1.0});
      //creates image
      var canvas2 = document.querySelector('#balance_right');
      var canvasImg2 = canvas2.toDataURL(canvas, '#ffffff', {    type: 'image/jpeg',    encoderOptions: 1.0});
      //creates image
      var canvas3 = document.querySelector('#gait_left');
      var canvasImg3 = canvas3.toDataURL(canvas, '#ffffff', {    type: 'image/jpeg',    encoderOptions: 1.0});
      //creates image
      var canvas4 = document.querySelector('#gait_right');
      var canvasImg4 = canvas4.toDataURL(canvas, '#ffffff', {    type: 'image/jpeg',    encoderOptions: 1.0});
      
      //creates PDF from img
      var doc = new jsPDF();
      var img = new Image;
        img.onload = function() {
            doc.addImage(this,8,0,30,10);
            doc.text("Suratec Surasole Report",70,7);           
            doc.rect(8, 10, doc.internal.pageSize.width - 18, doc.internal.pageSize.height - 18, 'S');
            doc.text("<?php echo 'Email :  '.$email ?>",10,18,{align: "right",lang: 'th'});
            doc.setFontSize(12);
            doc.text("Walking Speed (steps/min) : "+Math.round((step_count_pdf[0]/new_sec_pdf[0])*60),15,27);          
            doc.setFontSize(12);
            doc.text("Step count: "+step_count_pdf[0],135,27);          
            doc.setFontSize(12);
            doc.text("Normal Person : x = -189 ± 67, y = -134 ± 55",10,101);            
            doc.setFontSize(12);
            doc.text("Subject : x = "+new_x_mean_pdf[0]+" ± "+new_x_sd_square_pdf[0]+", y = "+new_y_mean_pdf[0]+" ± "+new_y_sd_square_pdf[0],100,101);  
            doc.text("FL: "+fl_pdf[0]+"%",65,187);  
            doc.text("ML: "+ml_pdf[0]+"%",95,187);  
            doc.text("HL: "+hl_pdf[0]+"%",125,187); 
            doc.text("FR: "+fr_pdf[0]+"%",65,275);  
            doc.text("MR: "+mr_pdf[0]+"%",95,275);  
            doc.text("HR: "+hr_pdf[0]+"%",125,275); 
                
            doc.addImage(canvasImg, 'JPEG',5,30, 65, 60 );
            doc.addImage(canvasImg1, 'JPEG',70,30, 65, 60 );
            doc.addImage(canvasImg2, 'JPEG',135,30, 65, 60 );
            doc.addImage(canvasImg3, 'JPEG',5,105, 195, 75 );
            doc.addImage(canvasImg4, 'JPEG',5,190, 195, 75 );
            doc.save('canvas.pdf');
        
        };
        img.crossOrigin = "";  // for demo as we are at different origin than image
        img.src = "https://www.suratec.co.th/admin/img/nav-menu/logopdf.jpeg"; 
     
    } 
  
      </script>
   </body>
</html>
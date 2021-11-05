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
      <title>Dashboard | Suratec</title>
      <!-- Bootstrap -->
      <link href="css/style.css" rel="stylesheet">
   </head>
   <style>
     .s-peak-div {
      width:unset;
     }
     .s-phase-item p { 
        color: #000;
    }
     .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 3px;
     }
      .s-phase-two-box {
          margin-top: 30px;
          font-size: 20 !important;
      }
     
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
    .red{
    color: red;
    font-weight: bold;
    }
    .green{
    color: green;
    font-weight: bold;
    }
    .yellow{
    color: yellow;
    font-weight: bold;
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
      
        $sql_customer = "SELECT `sex`,`height` FROM `mod_customer` WHERE `id_customer` = '$id_customer' ";
        $query_customer = mysqli_query($objConnect, $sql_customer);
        $result_customer = mysqli_fetch_array($query_customer);
        $sex = $result_customer["sex"];
       $height = $result_customer["height"];
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
                              Fill in the Dashboard
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
                                 <input type="button" onclick="function_play()"  class="s-report s-common-btn search_date" value="Show Dashboard">                               
                              </div>
                           </div>
                        </div>
                        <p class="s-note text-color"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">*All fields should be filled in before clicking the Show Dashboard button.</font></font></p>
                     </div>
                     
                  </div>
                        <input type="hidden" name="sex" id="sex" value="<?php echo $sex ?>">
                        <input type="hidden" name="height" id="height" value="<?php echo $height ?>">
                    <div class="s-box-shadow s-br-16 bg-secondary s-p20 s-statistic-box">
                      <h5 class="s-title-big">
                          Dynamic Parameters
                      </h5>
                      <div class="s-box-wrapper">
                          <div class="s-peak-div">
                          <div class="">
                              <table class="table table-striped mytable" border="1">
                                <thead>
                                  <th>Duration</thstyle=>
                                  <th>Pace</th>
                                  <th>Est. Distance</th>
                                  <th>Total Steps</th>
                                  <th>Left Stance Time</th>
                                  <th>Right Stance Time</th>
                                  <th>Left Swing Time</th>
                                  <th>Right Swing Time</th>
                                </thead>
                                <tbody>
                                  <td><span id="span_duration">0</span></td>
                                  <td><span id="span_pace">0 min/km.</span></td>
                                  <td><span id="span_distance">0 km.</span></td>
                                  <td><span id="span_total_steps">0</span></td>
                                  <td><span id="span_lst">0.00 sec</span></td>
                                  <td><span id="span_rst">0.00 sec</span></td>
                                  <td><span id="span_lwt">0.00 sec</span></td>
                                  <td><span id="span_rwt">0.00 sec</span></td>
                                </tbody>
                            </table>
                            </div>
                      </div>
                    </div>  
                    </div>  
                    <div class="s-box-shadow s-br-16 bg-secondary s-p20 s-phase-box">
                     <h5 class="s-title-big">
                      สรุป Peak Pressure
                     </h5>
                     <div class="s-phase-two-box" style="font-size:16px">
                        <div class="s-phase-item" style="width: 49%;">
                           <p class="s-phase-title">สรุป Peak Pressure ซ้าย</p>
                              <div class="col-md-12">
                                <table class="table table-striped mytable" border="1" style="padding: 0px !important;">
                                  <thead>
                                    <tr>
                                    <th>Zone</th>
                                        <th>AVG</th>
                                        <th>Max</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                        <td>Toe</td>
                                        <td>
                                          <p id="ls1_avg"></p>
                                        </td>
                                        <td>
                                          <p id="ls1_max"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Medial Metatarsal</td>
                                        <td>
                                          <p id="ls2_avg"></p>
                                        </td>
                                        <td>
                                          <p id="ls2_max"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lateral Metatarsal</td>
                                        <td>
                                          <p id="ls3_avg"></p>
                                        </td>
                                        <td>
                                          <p id="ls3_max"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Medial Midfoot</td>
                                        <td>
                                          <p id="ls4_avg"></p>
                                        </td>
                                        <td>
                                          <p id="ls4_max"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Heel</td>
                                        <td>
                                          <p id="ls5_avg"></p>
                                        </td>
                                        <td>
                                          <p id="ls5_max"></p>
                                        </td>
                                    </tr>
                                  </tbody>
                              </table>
                            </div>
                        </div>
                        <div class="s-phase-item">
                           <p class="s-phase-title">สรุป Peak Pressure ขวา</p>
                           <div class="col-md-12" >
                           <table class="table table-striped mytable" border="1" style="padding: 0px !important;">
                                <thead>
                                  <tr>
                                      <th>Zone</th>
                                      <th>AVG</th>
                                      <th>Max</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                      <td>Toe</td>
                                      <td>
                                        <p id="rs1_avg"></p>
                                      </td>
                                      <td>
                                        <p id="rs1_max"></p>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>Medial Metatarsal</td>
                                      <td>
                                        <p id="rs2_avg"></p>
                                      </td>
                                      <td>
                                        <p id="rs2_max"></p>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>Lateral Metatarsal</td>
                                      <td>
                                        <p id="rs3_avg"></p>
                                      </td>
                                      <td>
                                        <p id="rs3_max"></p>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>Medial Midfoot</td>
                                      <td>
                                        <p id="rs4_avg"></p>
                                      </td>
                                      <td>
                                        <p id="rs4_max"></p>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>Heel</td>
                                      <td>
                                        <p id="rs5_avg"></p>
                                      </td>
                                      <td>
                                        <p id="rs5_max"></p>
                                      </td>
                                  </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                     </div>
                     <div class="s-box-shadow s-br-16 bg-secondary s-p20 s-peak-box">
                     <h5 class="s-title-big">
                       Peak Pressure ขีดสุด
                     </h5>
                     
                     <div class="s-peak-div">
                     <img src="images/ulcer_updated2.png" alt="peak" /> <br><br>
                      <div class="">
                          <table class="table table-striped mytable" border="1">
                          <thead>
                            <tr>
                              <th>Time</th>
                              <th>Zone</th>
                              <th>Max. Peak Pressure</th>
                              <th>Risk of Ulcer</th>
                            </tr>
                          </thead>
                          <tbody id="playback_time_table">
                           <tr>
                             <td><p id="span_time"></p></td>
                             <td><p id="span_zone"></p></td>
                             <td><p id="span_pp"></p></td>
                             <td><p id="span_risk"></p></td>                                         
                           </tr>
                         </tbody>
                        </table>
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
        
          
          function function_play() {
            id_customer =  $("#id_customer").val();  
         
            playback_type =  $("#playback_type").val();  
            datetimepicker =  $("#datetimepicker").val();  
            playback_time =  $("#playback_time").val();  
         
           
            $.redirect("playback_sport_DB2.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time, status_play: '1'}, "POST", ""); 
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
           
            
            async function call(){
                await getData(); // Get Data from CSV File
            }
         
            async function getData() { 
         <?php
            $sec =explode(".",$playback_time)[2]; 
            $originalTime = date("H:i:s", strtotime(explode(".",$playback_time)[0]));
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
         var mysec = '<?=$sec?>';
        
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
         var left_sen4 = [];
         var left_sen5 = [];
         var right_sen1 = [];
         var right_sen2 = [];
         var right_sen3 = [];
         var right_sen4 = [];
         var right_sen5 = [];
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
         const left_s4 = parseInt(columns[4]);
         const left_s5 = parseInt(columns[5]);
         const right_s1 = parseInt(columns[6]);
         const right_s2 = parseInt(columns[7]);
         const right_s3 = parseInt(columns[8]);
         const right_s4 = parseInt(columns[9]);
         const right_s5 = parseInt(columns[10]);
         left_sen1.push(left_s1);
         left_sen2.push(left_s2);
         left_sen3.push(left_s3);
         left_sen4.push(left_s4);
         left_sen5.push(left_s5);
         
         right_sen1.push(right_s1);
         right_sen2.push(right_s2);
         right_sen3.push(right_s3);
         right_sen4.push(right_s4);
         right_sen5.push(right_s5);
         
         
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
           if (gait_dis > 0){
               gait_speed = (gait_dis / mysec).toFixed(2);
           }
           $('#span_total_steps').text(step_count);
         
           $('#ws').text(Math.round((step_count/new_sec)*60))
           $('#gs').text((gait_speed));
         if (new_sec=='0') {
         curtime="0:00:00";
         }else{
         curhr = Math.floor(new_sec/3600);
         curmin=Math.floor(new_sec/60)%60;
         cursec=new_sec%60
         
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
         sex = $("#sex").val(); 
         height = $("#height").val(); 
         if (sex == '0') {
         distance = parseFloat(height * 0.415) * (step_count/2)
         }else{
         distance = parseFloat(height * 0.413) * (step_count/2)
         }
         //distance_km = (distance/100000).toFixed(2);
         distance_m = (distance/100).toFixed(2);
         $("#span_distance").html(distance_m+' m.'); 
         if (new_sec=='0') {
         pace = 0
         }else{
         pace = (new_sec / 60) / (distance_m /1000)
         }
         
         pace_sec = (pace + "").split(".");
         pace_second = (pace_sec[1] * 0.6);

         pace_1 = pace_sec[0].toString();
         pace_2 = pace_second.toString();
         pace = parseFloat(pace_1+ "." + pace_2).toFixed(2);
         pace = pace || 0;
         $("#span_pace").html(pace+' min/km.'); 
         
           
         
         
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
         
         var ls1_max_value = Math.max.apply(Math, left_sen1);
         var ls2_max_value = Math.max.apply(Math, left_sen2);
         var ls3_max_value = Math.max.apply(Math, left_sen3);
         var ls4_max_value = Math.max.apply(Math, left_sen4);
         var ls5_max_value = Math.max.apply(Math, left_sen5);
         
         var rs1_max_value = Math.max.apply(Math, right_sen1);
         var rs2_max_value = Math.max.apply(Math, right_sen2);
         var rs3_max_value = Math.max.apply(Math, right_sen3);
         var rs4_max_value = Math.max.apply(Math, right_sen4);
         var rs5_max_value = Math.max.apply(Math, right_sen5);
         
         max_peak_l1_kpa = (0.497 * Math.exp(0.0088* ls1_max_value)).toFixed(2);
         max_peak_l2_kpa = (0.497 * Math.exp(0.0088* ls2_max_value)).toFixed(2);
         max_peak_l3_kpa = (0.497 * Math.exp(0.0088* ls3_max_value)).toFixed(2);
         max_peak_l4_kpa = (0.497 * Math.exp(0.0088* ls4_max_value)).toFixed(2);
         max_peak_l5_kpa = (0.497 * Math.exp(0.0088* ls5_max_value)).toFixed(2);
         
         max_peak_r1_kpa = (0.497 * Math.exp(0.0088* rs1_max_value)).toFixed(2);
         max_peak_r2_kpa = (0.497 * Math.exp(0.0088* rs2_max_value)).toFixed(2);
         max_peak_r3_kpa = (0.497 * Math.exp(0.0088* rs3_max_value)).toFixed(2);
         max_peak_r4_kpa = (0.497 * Math.exp(0.0088* rs4_max_value)).toFixed(2);
         max_peak_r5_kpa = (0.497 * Math.exp(0.0088* rs5_max_value)).toFixed(2);
         
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
         $('#ls1_avg').text(avg_peak_l1_kpa);  
         $('#ls2_avg').text(avg_peak_l2_kpa);  
         $('#ls3_avg').text(avg_peak_l3_kpa);  
         $('#ls4_avg').text(avg_peak_l4_kpa);  
         $('#ls5_avg').text(avg_peak_l5_kpa);  
         
         $('#rs1_avg').text(avg_peak_r1_kpa);  
         $('#rs2_avg').text(avg_peak_r3_kpa);  // Medial and Lateral Opposite of left foot
         $('#rs3_avg').text(avg_peak_r2_kpa);  
         $('#rs4_avg').text(avg_peak_r4_kpa);  
         $('#rs5_avg').text(avg_peak_r5_kpa);  
         
         $('#ls1_max').text(max_peak_l1_kpa);  
         $('#ls2_max').text(max_peak_l2_kpa);  
         $('#ls3_max').text(max_peak_l3_kpa);  
         $('#ls4_max').text(max_peak_l4_kpa);  
         $('#ls5_max').text(max_peak_l5_kpa);  
         
         $('#rs1_max').text(max_peak_r1_kpa);  
         $('#rs2_max').text(max_peak_r3_kpa);  // Medial and Lateral Opposite of left foot
         $('#rs3_max').text(max_peak_r2_kpa);  
         $('#rs4_max').text(max_peak_r4_kpa);  
         $('#rs5_max').text(max_peak_r5_kpa);  
         
         
         //Calculation of Zone 
         var original = '<?=$originalTime?>';
         $("#span_time").html(original); 

         var max_peak = Math.max(max_peak_l1_kpa,max_peak_l2_kpa,max_peak_l3_kpa,max_peak_l4_kpa,max_peak_l5_kpa,max_peak_r1_kpa,max_peak_r2_kpa,max_peak_r3_kpa,max_peak_r4_kpa,max_peak_r5_kpa);   
         var zone = 'Not defined';
         var level = 'Normal'
    
         $("#span_pp").html(max_peak); 
         if(max_peak < 355){
            level = 'Normal'
            $('#span_pp').addClass("green");
         }
         else if(max_peak < 588){
           level = "Low Risk"
           $('#span_pp').addClass("yellow");
         }
         else{
           level = "High Risk"
           $('#span_pp').addClass("red");
         }

         $("#span_risk").html(level); 
         
         if(level == "Normal"){
          $('#span_risk').addClass("green");
         }
         else if(level == "Low Risk"){
          $('#span_risk').addClass("yellow");
         }
         else{
          $('#span_risk').addClass("red");
         }
         //Zone 
         if(max_peak == max_peak_l1_kpa){
           zone = "Left Toe";
         }
         else if(max_peak == max_peak_l2_kpa){
           zone = "Left Medial Metatarsal";
         }
         else if(max_peak == max_peak_l3_kpa){
           zone = "Left Lateral Metatarsal";
         }
         else if(max_peak == max_peak_l4_kpa){
           zone = "Left Medial Midfoot";
         }
         else if(max_peak == max_peak_l5_kpa){
           zone = "Left Heel";
         }
         else if(max_peak == max_peak_r1_kpa){
           zone = "Right Toe";
         }
         else if(max_peak == max_peak_r2_kpa){
           zone = "Right Lateral Metatarsal";
         }
         else if(max_peak == max_peak_r3_kpa){
           zone = "Right Medial Metatarsal";
         }
         else if(max_peak == max_peak_r4_kpa){
           zone = "Right Medial Midfoot";
         }
         else if(max_peak == max_peak_r5_kpa){
           zone = "Right Heel";
         }
         $("#span_zone").html(zone); 
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
         
         
         
         
         left_sway_time = left_sway_time || 0;
         right_sway_time = right_sway_time || 0;
         left_stance_time = left_stance_time || 0;
         right_stance_time = right_stance_time || 0;

         
         $('#span_lwt').text(left_sway_time.toFixed(2) + ' sec');
         $('#span_lst').text(left_stance_time.toFixed(2) + ' sec');
         $('#span_rwt').text(right_sway_time.toFixed(2) + ' sec');
         $('#span_rst').text(right_stance_time.toFixed(2) + ' sec');
         
         //---------------------------------------------------------------------OLD GAIT CYCLE End--------------------------------------------------
         
         }	
      </script>
   </body>
</html>
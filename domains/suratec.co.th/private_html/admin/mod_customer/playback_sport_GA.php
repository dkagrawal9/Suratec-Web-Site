<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser($objConnect);

$title = 'Gait Analysis';
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
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.16/c3.css">

</head>
<style>
  .bb-axis-x:last-child text {
    visibility: hidden;
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
// var_dump($_POST);
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

$sqlpro = "SELECT   *,mod_customer.telephone AS telephone ,mod_customer.id_customer AS id_customer, mod_customer.fname AS fname, mod_customer.lname AS lname FROM  mod_customer 
LEFT JOIN tbl_member ON mod_customer.id_customer = tbl_member.id_data_role
LEFT JOIN  mod_customer_address ON mod_customer_address.id_customer = mod_customer.id_customer
WHERE  mod_customer.id_customer = '$id_customer' ";
$queryPro = mysqli_query($objConnect, $sqlpro);
$resultPro = mysqli_fetch_array($queryPro);


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
                    <li class="active"><a onclick="newGait_Analysis()"><i class="fa fa-handshake-o"></i> Gait Analysis</a></li>    
                    <li><a onclick="newBalance_Board()" ><i class="fa fa-gavel"></i> Balance Board</a></li>     
                    <li><a onclick="newDasboard()" ><i class="fa fa-globe"></i> Dasboard</a></li>     -->


                    <li  ><a href="javascript:newPressure_Map()" id="pressure_map_btn"><img src="../../img/bg-img/foot.png"> Pressure Map</a></li>     
                    <!-- <li><a href="playback_sport_GA.php?id_customer=<?php echo $id_customer ?>"><i class="fa fa-handshake-o"></i> Gait Analysis</a></li>   --> 
                    <li class="active"><a href="javascript:newGait_Analysis()"><img src="../../img/bg-img/line-chart.png"> Gait Analysis</a></li>    
                    <li><a href="javascript:newBalance_Board()" ><img src="../../img/bg-img/dot-and-circle.png"> Balance Board</a></li>     
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
                                    <h3 class="box-title">Gait Analysis</h3>
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
                                                            <option value="1"
                                                            <?php
                                                              if ($playback_type == '1') {
                                                                echo "selected";
                                                              }
                                                            ?>
                                                            >การแพทย์</option>
                                                            <option value="2"
                                                            <?php
                                                              if ($playback_type == '2') {
                                                                echo "selected";
                                                              }
                                                            ?>
                                                            >การกีฬา</option>
                                                        </SELECT>
                                                            
                                                    </div>
                                                 </div>
                                                
                                                <div class="col-sm-3">
                                                  <label>วันที่ ( ป/ด/ว)</label>
                                                    <div class='input-group date col-md-12' >
                                                        <input type='text' class="form-control" name="datetimepicker" id='datetimepicker' autocomplete="off" onchange="playback_time_func()" value="<?php echo $datetimepicker ?>" />
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

<!-- <div class="col-md-6">
  <div id="my_datavizleft"><i class="fa fa-info-circle" style="color: #0998CC"></i> พื้นรองเท้าด้านซ้าย</div>
</div>
<div class="col-md-6">
  <div id="my_datavizright"><i class="fa fa-info-circle" style="color: #0998CC"></i> พื้นรองเท้าด้านขวา</div>
</div> -->
<div class="col-md-6">
  <i class="fa fa-info-circle" style="color: #0998CC"></i> เท้าซ้าย (Left foot)
  <div id="chart_left"></div>
</div>


<div class="col-md-6">
  <i class="fa fa-info-circle" style="color: #0998CC"></i> เท้าขวา (Right foot)
  <div id="chart_right" style=""></div>
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

<script src="js/d3.v3.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.16/c3.js"></script>

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
<script type="text/javascript">





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


  var margin = {top: 10, right: 10, bottom: 80, left: 15},
    width = 460 - margin.left - margin.right,
    height = 400 - margin.top - margin.bottom;





 // $(document).on('click','#search_date',function(){
function search_date(){
  $("#show_data").html(''); 
  playback_time =  $("#playback_time").val(); 

playback_left_right = playback_time.split("/");

playback_time_arr_left = playback_left_right[0].split("***");
playback_time_arr_right = playback_left_right[1].split("***");
// console.log(playback_time_arr_left)
// console.log(playback_time_arr_left.length)

 
  //////ซ้าย/////
  ileft=0;
  xy_left_total=0;

         var setleft = setInterval(function (t) {
          // console.log(playback_time_arr_left.length)
          // console.log(playback_time_arr_right[ileft])

           data_test = playback_time_arr_left[ileft];
           data_test2 = data_test.split(",");
           data_test3=[];
         
           for (var i = 0; i < data_test2.length; i++) {
             data_test3.push(parseInt(data_test2[i]));
           }
Fweight = (data_test3[0]+data_test3[1]+data_test3[2]) / 3
Mweight = data_test3[3]
Hweight = data_test3[4]
Sumweight = (Fweight + Mweight + Hweight ) / 3
// console.log('ppp:'+Fweight+','+Mweight+','+Hweight+','+Sumweight)
chart_add_data_left(Fweight,Mweight,Hweight,Sumweight)

      
    ileft++
    if (ileft==playback_time_arr_left.length) {
      clearInterval(setleft)
    }

    
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
Fweight = (data_test3right[0]+data_test3right[1]+data_test3right[2]) / 3
Mweight = data_test3right[3]
Hweight = data_test3right[4]
Sumweight = (Fweight + Mweight + Hweight ) / 3
// console.log('ppp:'+Fweight+','+Mweight+','+Hweight+','+Sumweight)
chart_add_data_right(Fweight,Mweight,Hweight,Sumweight)

 
iright++
    if (iright==playback_time_arr_right.length) {
      clearInterval(setright)
    }

    }, 1000)       
//////ขวา/////


// })
}

 function myStopFunction() {

  if(typeof(setleft) != "undefined" && setleft !== null) {
  clearInterval(setleft);
  clearInterval(setright);
 console.log(setleft)
  }
 date_chart_left = [
            ['Min-foot'],
            ['ForeFoot'],
            ['Heel'],
            ['Enter Foot']
          ]
   date_chart_left[0].push(0);
   date_chart_left[1].push(0);
   date_chart_left[2].push(0);
   date_chart_left[3].push(0);
   // console.log(date_chart_left)
 var chart_left = c3.generate({
  bindto: '#chart_left',
        data: {
          columns: date_chart_left,
          type: 'spline', // กำหนดรูปแบบ เป็น barChart 
        },
        color:{
              pattern: ["#FF0000", "#00CC00", "#000000", "#0000CC"],//สามารถระบุ Code สี ที่ต้องการได้
        },
        zoom: {
          enabled: true
        },
        point: {
          show: false
        },
        subchart: {
          show: true,


        },
      });

 date_chart_right = [
            ['Min-foot'],
            ['ForeFoot'],
            ['Heel'],
            ['Enter Foot']
          ]
date_chart_right[0].push(0);
   date_chart_right[1].push(0);
   date_chart_right[2].push(0);
   date_chart_right[3].push(0);
 var chart_right = c3.generate({
   bindto: '#chart_right',
 
        data: {
          columns: date_chart_right,
          type: 'spline', // กำหนดรูปแบบ เป็น barChart 
        },
        color:{
              pattern: ["#FF0000", "#00CC00", "#000000", "#0000CC"],//สามารถระบุ Code สี ที่ต้องการได้
        },
        zoom: {
          enabled: true,
          type: "scroll",
        },
        point: {
          show: false
        },
        subchart: {
          show: true,
        },
});

}

  date_chart_left = [
            ['ForeFoot'],
            ['Min-foot'],
            ['Heel'],
            ['Enter Foot']
          ]
function chart_add_data_left(Mweight,Fweight,Hweight,Sumweight){
 

   date_chart_left[0].push(Fweight);
   date_chart_left[1].push(Mweight);
   date_chart_left[2].push(Hweight);
   date_chart_left[3].push(Sumweight);
   // console.log(date_chart_left)
 var chart_left = c3.generate({
  bindto: '#chart_left',
        data: {
          columns: date_chart_left,
          type: 'spline', // กำหนดรูปแบบ เป็น barChart 
        },
        color:{
              pattern: ["#FF0000", "#00CC00", "#000000", "#0000CC"],//สามารถระบุ Code สี ที่ต้องการได้
        },
        zoom: {
          enabled: true
        },
        point: {
          show: false
        },
        subchart: {
          show: false,


        },
      });
}



date_chart_right = [
            ['ForeFoot'],
            ['Min-foot'],
            ['Heel'],
            ['Enter Foot']
          ]
          width_chart = 340
function chart_add_data_right(Mweight,Fweight,Hweight,Sumweight){
 width_chart = width_chart+5

   date_chart_right[0].push(Fweight);
   date_chart_right[1].push(Mweight);
   date_chart_right[2].push(Hweight);
   date_chart_right[3].push(Sumweight);
   // console.log(date_chart_right)
 var chart_right = c3.generate({
   bindto: '#chart_right',
 
        data: {
          columns: date_chart_right,
          type: 'spline', // กำหนดรูปแบบ เป็น barChart 
        },
        color:{
              pattern: ["#FF0000", "#00CC00", "#000000", "#0000CC"],//สามารถระบุ Code สี ที่ต้องการได้
        },
        zoom: {
          enabled: true,
          type: "scroll",
        },
        point: {
          show: false
        },
        subchart: {
          show: false,
          type: "scroll",
        },
        // size: {
        //   width: width_chart
        // }

      });


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


function function_play() {
  id_customer =  $("#id_customer").val();  
  playback_type =  $("#playback_type").val();  
  datetimepicker =  $("#datetimepicker").val();  
  playback_time =  $("#playback_time").val();  

  $.redirect("playback_sport_GA.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time, status_play: '1'}, "POST", ""); 
}

 
   

playback_time_func();

</script>
  


</body>
</html>

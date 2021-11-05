<?php
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser($objConnect);

$title = 'รายละเอียดคูปอง';
?>

<style type="text/css">
   .select2-container--default .select2-selection--multiple .select2-selection__choice {

    background-color: #00c0ef !important;
    border: 1px solid #aaa;
    border-radius: 4px;
    cursor: default;
    float: left;
    margin-right: 5px;
    margin-top: 5px;
    padding: 0 5px;
}
</style>
<style type="text/css">             
@media screen and (max-width:479px){  /* 0px - 479px */
 #div_table_show{
overflow: auto;
 }
}
</style>
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
    <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" type="text/css" href="css/up_pre.css">
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- Pace style -->
    <link rel="stylesheet" href="../plugins/pace/pace.min.css">
    <!--Css table -->
    <link rel="stylesheet" href="css/app.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="../plugins/sweetalert2/dist/sweetalert2.min.css">
     <!-- address thailande -->
   <!--  <link rel="stylesheet" href="js/jquery.Thailand.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
          <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <style type="text/css">
    /*.swal2-popup {
        font-size: 1.5rem !important;
    }*/
        .nopad {
        padding-left: 0 !important;
        padding-right: 0 !important;
        }
        /*image gallery*/
        .image-checkbox {
            cursor: pointer;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            border: 4px solid transparent;
            margin-bottom: 0;
            outline: 0;
        }
        .image-checkbox input[type="checkbox"] {
            display: none;
        }

        .image-checkbox-checked {
            border-color: #4783B0;
        }
        .image-checkbox .fa {
          position: absolute;
          color: #4A79A3;
          background-color: #fff;
          padding: 10px;
          top: 0;
          right: 0;
        }
        .image-checkbox-checked .fa {
          display: block !important;
        }
    </style>

</head>
<body class="hold-transition skin-blue fixed sidebar-mini " onload="startTime()">

        <!-- Main content -->
        <section class="content" ng-app="NewCustomer" ng-controller="AddUserFormController">
            <!-- SELECT2 EXAMPLE -->
<!-- start form -->

<!-- start form -->
            <div class="row">
  


  <?php
           $sql_coupon = "SELECT  coupon.customer, coupon.code,coupon.coupon_id,coupon.name,coupon.discount,coupon.quantity,coupon.start_date,coupon.end_date FROM `coupon` WHERE `delete_datetime` is null AND coupon_id = '".$_GET["id_da"]."'";
 $query_coupon = mysqli_query($objConnect, $sql_coupon);
$result_coupon = mysqli_fetch_array($query_coupon);

 ?>        
 <form  id="upload-form-add" enctype="multipart/form-data">
<input type="hidden" name="_method" value="up_team_member">     
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="box box-info box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">ข้อมูลคูปอง</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
<form class="upload-form-add-thumbnail"  method="post" enctype="multipart/form-data" id="frmADD_thumbnail">

                                           <input type="hidden" name="_method" value="edit"> 
                                            <input type="hidden" name="id" id="id" value="<?php echo $result_coupon["id"] ?>">
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อคูปอง</label>

                                                <div class="col-sm-8">
                                                    <input type="text" name="coubon_code" class="form-control" id="coubon_code" autocomplete="off"  value="<?php echo $result_coupon["name"] ?>" disabled >
                                         
                                                   
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">Code Coupon</label>

                                                <div class="col-sm-8">
                                                    <input type="text" name="" class="form-control" id="" autocomplete="off"  value="<?php echo $result_coupon["code"] ?>" disabled >
                                         
                                                   
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ส่วนลด (%)</label>

                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control" name="" id="" value="<?php echo $result_coupon["discount"] ?>" disabled  >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">จำนวนคูปอง</label>

                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control"  name="num_coubon" id="num_coubon" value="<?php echo $result_coupon["quantity"] ?>" disabled >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">วันที่เริ่มต้น - วันที่สิ้นสุด</label>
                                                <input type="hidden" class="form-control"  name="s_date" id="s_date" value="<?php echo $result_coupon["start_date"] ?>">
                                                <input type="hidden" class="form-control"  name="e_date" id="e_date" value="<?php echo $result_coupon["end_date"] ?>">
                                                <div class="col-sm-8">
                                                    <div class='input-group date col-md-12' >
                                                        <input type='text' class="form-control" name="datetimepicker" id='datetimepicker' value="<?php echo $result_coupon["start_date"]; echo ' ถึง '; echo $result_coupon["end_date"];  ?>"  disabled />
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                            </span>
                                                    </div>
                                                 </div>
                                                
                                            </div>
                                            
                                             
                                           

                                                <div class="col-sm-12" id="div_table_show" >
                                                   <table class="table" id="table_show" style="border: solid 3px #A0AFFF;">
                                                     <thead style="background: #A0AFFF">
                                                      <tr>
                                                       <th>อีเมลล์ลูกค้า</th>
                                                       <th>สถานะการใช้งาน</th>
                                                       <th>วันที่ใช้งาน</th>
                                                     </tr>
                                                     </thead>
                                                     <tbody>
                                                       
                                                     
                                         
                                    <?php
                                
//  $sql = "SELECT CONCAT(mod_customer.fname,mod_customer.lname ) AS name_customer ,coupon_history.id,coupon_history.customer_id,coupon_history.create_time FROM `coupon_history` 
// LEFT JOIN mod_customer ON coupon_history.customer_id = mod_customer.id_customer
// WHERE coupon_history.`coupon_id` =  '".$_GET["id_da"]."'";
// $query = mysqli_query($objConnect,$sql);

//   while ($result = mysqli_fetch_array($query)) { } 
    $rest = array();
 $id_customer = $result_coupon["customer"];
  $id_customer = substr($id_customer, 0, -1);
 // echo $rest1;
 $rest1 = explode(",", $id_customer);
 for ($i=0; $i < count($rest1) ; $i++) { 
   if (!empty($rest1[$i])) {
   array_push($rest,$rest1[$i]);
 }else{
 
 }
 }
 //print_r($rest);
  for($i = 0 ; $i < count($rest) ; $i++){

    $sql = "SELECT  coupon_history.create_time,coupon_history.id FROM `mod_customer` LEFT JOIN coupon_history ON mod_customer.id_customer=coupon_history.customer_id WHERE coupon_history.coupon_id='".$_GET["id_da"]."' AND mod_customer.id_customer='".$rest[$i]."'";
$query = mysqli_query($objConnect,$sql);
$result = mysqli_fetch_array($query);

 $sql_email = "SELECT mod_customer.email FROM `mod_customer` WHERE `id_customer` ='".$rest[$i]."'";
$query_email = mysqli_query($objConnect,$sql_email);
$result_email = mysqli_fetch_array($query_email);

?>
<tr>
  <td style="background: #D2D2FF; "><?php echo $result_email["email"] ?></td>
  <?php if ($result["id"]=='') {
     echo "<td style='background: #006400;color: #EBFBFF; text-align: center; '>ยังไม่ใช้งาน</td>";
  }else{
    echo "<td style='background: #EB0000;color: #EBFBFF; text-align: center;'>ใช้งานแล้ว</td>";
  }  ?>
  <td style="background: #D2D2FF; text-align: center;"><?php echo $result["create_time"] ?></td>
</tr>
            
                               
 <?php   
}
?>
                                                   
                                                </tbody>
                                              </table>
                                                 </div>
                                           
                                            
                                        
                                           
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
        
            
 
                    
                </div>
          <div class = "modal-footer">
            <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               ปิด
            </button>
         </div>
</div>     

<!-- end form -->

<!-- end form -->
 
    </section>
      

   
</div>

<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script src="js/timer.js"></script>


<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- date-range-picker -->
<script src="../bower_components/moment/min/moment-with-locales.min.js"></script>

<!-- thailand -->
<!-- <script src="js/jquery.Thailand.min.js"></script>
<script src="js/JQL.min.js"></script>
<script src="js/typeahead.bundle.js"></script>
<script src="js/zip.js"></script> -->
<!-- PACE -->
<script src="../bower_components/PACE/pace.min.js"></script>
<!-- <script src="js/timer.js"></script> -->

<link rel="stylesheet" href="css/ui-bootstrap-csp.css">
<!-- <script src="js/sweetalert2.all.min.js"></script> -->
<script src="js/up_pre.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="../plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
       $('#table_show').DataTable(); 
       })
     </script>


</body>
</html>

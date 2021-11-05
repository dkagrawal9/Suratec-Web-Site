<?php
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser($objConnect);

$title = 'แก้ไขทีม';

$str = "SELECT  mod_customer_address.id_address, mod_customer_address.tax_id, mod_customer.*, tbl_member.user_member,tbl_member.id_member  FROM mod_customer LEFT JOIN tbl_member ON mod_customer.id_customer = tbl_member.id_data_role
LEFT JOIN mod_customer_address ON mod_customer.id_customer=mod_customer_address.id_customer WHERE mod_customer.id_customer = '".$_GET['id']."'";
$query = mysqli_query($objConnect,$str);
$result = mysqli_fetch_array($query);

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
    <link rel="stylesheet" href="js/jquery.Thailand.min.css">

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
<div class="wrapper" >
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
                <li><a href="../page_home/index.php"> Dashboard</a></li>
                <li><a href="front-manage.php"> การจัดการลูกค้า</a></li>
                <li class="active"><?=$title?></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content" ng-app="NewCustomer" ng-controller="AddUserFormController">
            <!-- SELECT2 EXAMPLE -->
<!-- start form -->
<form id="upload-form-add" enctype="multipart/form-data">
<input type="hidden" name="_method" value="edit">
<input type="hidden" name="id_address" value="<?php echo $result['id_address']; ?>">
<input type="hidden" name="id_member" value="<?php echo $result['id_member']; ?>">
<input type="hidden" name="id_customer" value="<?php echo $result['id_customer']; ?>">
<!-- start form -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" >
                    <!-- Start box warning for ADD system -->
                 
                <div class="col-lg-4 col-md-4 col-sm-12">
            <!-- Start box warning for ADD system -->
                   
                </div>
               <!--  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="box box-success box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">เพิ่มที่อยู่ใหม่</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
                                        <form id="frmData1">
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อ</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="fname_add" id="fname_add" required> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">นามสกุล</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="lname_add" id="lname_add" required>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ที่อยู่</label >

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="address" id="address" required>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ตำบล</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control " id="district" name="district" placeholder="ตำบล" required>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">อำเภอ</label>

                                                <div class="col-sm-8">
                                                   <input type="text" class="form-control " id="amphor" name="amphur" placeholder="อำเภอ" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">จังหวัด</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control " id="province" name="province" placeholder="จังหวัด" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">รหัสไปรษณีย์</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control " id="zipcode" name="postalcode" placeholder="รหัสไปรษณีย์" required>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">เบอร์โทร</label>

                                                <div class="col-sm-8">-->
                                                    <!-- <input type="text" class="form-control"  name="telephone" id="telephone" OnKeyPress="return check_tel(this)" autocomplete="off" required> -->
                                                   <!--  <input name="tp" type="text" class="form-control" id="tp" value="" size="20" maxlength="10" autocomplete="off"  OnKeyPress="return check_tel(this)" />
                                                </div>
                                            </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
        
            <div class="text-center">
                              <button type="button" class="btn btn-sm btn-info" onclick="add_row()">
                                <i class="fa fa-plus"></i>&nbsp;เพิ่มรายการ
                            </button>
            </div>
            <br>  -->
            <!-- Start box warning for ADD system -->
                   <!--  <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <div class="col-md-6">
                                <h3 class="box-title">ที่อยู่จัดส่งสินค้า</h3>
                            </div> -->
                            <!-- <div class="col-md-6" align="right">
                                <a  href="add_address.php"   data-toggle="modal" data-target="#modal_showdetail">
                                    <button type="button" class="btn  btn-success"><i class="fa fa-fw fa-plus"></i>เพิ่มที่อยู่</button>
                                </a> 
                            </div> -->
                       <!--  </div>
                        <div class="box-body" >
     <input type="hidden" class="form-control validate_from" name="total_cost" id="total_cost" value=0 readonly/>
                            <table class="table" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>ชื่อ-สกุล</th>
                                            <th>ที่อยู่</th>
                                            <th>รหัสไปรษณีย์</th>
                                            <th>เบอร์โทร</th>
                                            <th>ควบคุม</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                           
                        </div>
                    </div>
                </div>
            </div> -->
<!-- end form -->
</form>
<!-- end form -->
 <!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalTitle"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title" id="myModalTitle">แก้ไขรายการ</h5>
                            </div>
                            <div class="modal-body">
                                <form id="frmDataEdit" class="form-horizontal">
                                    <input type="hidden" id="data_id_edit" name="data_id_edit">
                                    <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อ</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="fname_add_edit" id="fname_add_edit" required> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">นามสกุล</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="lname_add_edit" id="lname_add_edit" required>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ที่อยู่</label >

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="address_edit" id="address_edit" required>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ตำบล</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control " id="district_edit" name="district_edit" placeholder="ตำบล" required>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">อำเภอ</label>

                                                <div class="col-sm-8">
                                                   <input type="text" class="form-control " id="amphor_edit" name="amphur_edit" placeholder="อำเภอ" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">จังหวัด</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control " id="province_edit" name="province_edit" placeholder="จังหวัด" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">รหัสไปรษณีย์</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control " id="zipcode_edit" name="postalcode_edit" placeholder="รหัสไปรษณีย์" required>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">เบอร์โทร</label>

                                                <div class="col-sm-8">
                                                      <input type="hidden" class="form-control " id="index_i" name="index_i" >-->
                                                    <!-- <input type="text" class="form-control"  name="telephone" id="telephone" OnKeyPress="return check_tel(this)" autocomplete="off" required> -->
                                                    <!-- <input name="tp_edit" type="text" class="form-control" id="tp_edit" value="" size="20" maxlength="10" autocomplete="off"  OnKeyPress="return check_tel(this)" />
                                                </div>
                                            </div>
                                    -->
                               <!--   </form>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success" onclick="change_data()">Save
                                    changes</button>
                            </div> -->
                        </div>
                    </div>
                </div> 
    </section>
<!-- <div class="modal fade" id="modal_showdetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">-->
    <!-- load from file !-->
    </div>
  </div>
</div> 
    <div class="boxsave">
        <button type="button" class="btn btn-info pull-right btnSendAdd" id="btnSendAdd" style="transition: 0.4s; margin-left: 5px;"><i class="fa fa-check"></i>&nbsp;Save</button>
        <button type="button" class="btn btn-warning pull-right btnSendClear" style="border:1px solid #e08e0b; margin-left: 5px;" onclick="javascript:document.getElementById('upload-form-add').reset(); $('#img-upload').attr('src', 'img/upload.jpg');">
            <i class="fa fa-remove"></i>&nbsp;Clear
        </button>
        <!-- <button type="button" class="btn btn-primary pull-right "style=" margin-left: 5px;" onClick="javascript:location.href='front-add.php'">
            <i class="fa fa-clone"></i>&nbsp;New Form
        </button> -->
        <button type="button" class="btn btn-default pull-right " id="btnSendClear" style="margin-left: 5px;" onClick="javascript:location.href='front-manage.php'">
            <i class="fa fa-list"></i>&nbsp;Customer List
        </button>
    </div>
</div>

<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- date-range-picker -->
<script src="../bower_components/moment/min/moment-with-locales.min.js"></script>
<!-- thailand -->
<script src="js/jquery.Thailand.min.js"></script>
<script src="js/JQL.min.js"></script>
<script src="js/typeahead.bundle.js"></script>
<script src="js/zip.js"></script>
<!-- PACE -->
<script src="../bower_components/PACE/pace.min.js"></script>
<!-- <script src="js/timer.js"></script> -->

<link rel="stylesheet" href="css/ui-bootstrap-csp.css">
<!-- <script src="js/sweetalert2.all.min.js"></script> -->
<script src="js/up_pre.js"></script>

<script src="../plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<script type="text/javascript">
  $("#modal_showdetail").on('hidden.bs.modal', function () {
    $(this).data('bs.modal', null);
  });
  $("#modal_showdetail").on('hidden.bs.modal', function () {
    $(this).data('bs.modal', null);
  });
</script>
<script type="text/javascript">
function check_tel(ele)
  {
  var vchar = String.fromCharCode(event.keyCode);
  if ((vchar<'0' || vchar>'9') ) return false;
  ele.onKeyPress=vchar;
  }
  function check_pass() {
    
  var username = document.getElementById("username");
  var x = document.getElementById("password");
  var x1 = document.getElementById("password1");
  if (x.value == x1.value ){
   username.value = username.value.toLowerCase();
   
  }else{
    alert("รหัสผ่านไม่ตรงกัน");
    username.value = username.value.toLowerCase();
    document.getElementById('password').value="";
    document.getElementById('password1').value="";
   
  }
 
}
// function check_pass()
//   {
//   password = $('#password').val();
//   password1 = $('#password1').val();
  
  

//   //$('#password1').val("รหัสผ่านไม่ตรงกัน");
//   }

function edit_row(r){
 var i = r.parentNode.parentNode.rowIndex;
 // count_rows = table.getElementsByTagName("tr").length;
  //fname_add_edit = tbody.getElementById("fname_add"+[i]).value();

    fname_add = $('#fname_add'+i).val();
    lname_add = $('#lname_add'+i).val();
    address = $('#address'+i).val();
    district = $('#district'+i).val();
    amphor = $('#amphor'+i).val();
    province = $('#province'+i).val();
    zipcode = $('#zipcode'+i).val();
    tp = $('#tp'+i).val();
    //tp = $('#tp'+i).val();

 $('#fname_add_edit').val(fname_add);
 $('#lname_add_edit').val(lname_add);
 $('#address_edit').val(address);
 $('#district_edit').val(district);
 $('#amphor_edit').val(amphor);
 $('#province_edit').val(province);
 $('#zipcode_edit').val(zipcode);
 $('#tp_edit').val(tp);
 $('#index_i').val(i);
            // show modal
 $('#myModal').modal('show')

        };

function del_row(r){
  var data = {
  sum_total_price: $('#numsum').val(),
    sum_total_cost: $('#total_cost').val(),
  } ;
     var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("myTable").deleteRow(i);

                 result1 = parseInt(data.sum_total_cost);

                document.getElementById('total_cost').value=result1-1;
}

function change_data() {

    var table = document.getElementById("myTable");
    fname_add = $('#fname_add_edit').val();
    lname_add = $('#lname_add_edit').val();
    address = $('#address_edit').val();
    district = $('#district_edit').val();
    amphor = $('#amphur_edit').val();
    province = $('#province_edit').val();
    zipcode = $('#zipcode_edit').val();
    tp = $('#tp_edit').val();
    index_i = $('#index_i').val();


 var data = {
  sum_total_cost: $('#total_cost').val(),
  } ;
                

    
    if(fname_add == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ชื่อ", "warning")
        return false;
      }
      if(lname_add == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่นามสกุล", "warning")
        return false;
      }
    if(address == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ที่อยู่", "warning")
        return false;
      }
    if(district == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ตำบล", "warning")
        return false;
      }
    if(amphor == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่อำเภอ", "warning")
        return false;
      }
    if(province == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่จังหวัด", "warning")
        return false;
      }
    if(zipcode == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่รหัสไปรษณีย์", "warning")
        return false;
      }
    if(tp == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่เบอร์โทร", "warning")
        return false;
      }

 document.getElementById("myTable").deleteRow(index_i);
    count_rows = table.getElementsByTagName("tr").length;

    var row = table.insertRow(count_rows);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
 
 
    cell1.innerHTML = fname_add+' '+lname_add;
    cell2.innerHTML = address+' '+district;
    cell3.innerHTML = amphor+' '+province+' '+zipcode;
    cell4.innerHTML = tp
    
    cell5.innerHTML = "<button style='background-color: white;' type='button' class='edit-catagory btn btn-default' onclick='del_row(this)'> <i class='fa fa-fw fa-trash'></i></button> <button style='background-color: white;' type='button' class='edit-catagory btn btn-default' onclick='edit_row(this)'> <i class='fa fa-edit'></i></button> ";

    cell6.innerHTML = "<input class='form-control ' TYPE=\'hidden\'  name='fname_add[]' id=\'fname_add"+index_i+"\' value=\'"+fname_add+"\'> <input class='form-control ' TYPE=\'hidden\'  name='lname_add[]' id=\'lname_add"+index_i+"\''  value=\'"+lname_add+"\'> <input class='form-control ' TYPE=\'hidden\'  name='address[]' id=\'address"+index_i+"\' value=\'"+address+"\'><input class='form-control ' TYPE=\'hidden\'  name='district[]' id=\'district"+index_i+"\' value=\'"+district+"\'><input class='form-control ' TYPE=\'hidden\'  name='amphor[]' id=\'amphor"+index_i+"\' value=\'"+amphor+"\'><input class='form-control ' TYPE=\'hidden\'  name='province[]' id=\'province"+index_i+"\' value=\'"+province+"\'><input class='form-control ' TYPE=\'hidden\'  name='zipcode[]' id=\'zipcode"+index_i+"\' value=\'"+zipcode+"\'><input class='form-control ' TYPE=\'hidden\'  name='tp[]' id=\'tp"+index_i+"\' value=\'"+tp+"\'>";
    
   

           $('#myModal').modal('hide');     
                
    }
function add_row() {

    var table = document.getElementById("myTable");
    fname_add = $('#fname_add').val();
    lname_add = $('#lname_add').val();
    address = $('#address').val();
    district = $('#district').val();
    amphor = $('#amphor').val();
    province = $('#province').val();
    zipcode = $('#zipcode').val();
    tp = $('#tp').val();


 var data = {
  sum_total_cost: $('#total_cost').val(),
  } ;
                

    
    if(fname_add == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ชื่อ", "warning")
        return false;
      }
      if(lname_add == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่นามสกุล", "warning")
        return false;
      }
    if(address == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ที่อยู่", "warning")
        return false;
      }
    if(district == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ตำบล", "warning")
        return false;
      }
    if(amphor == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่อำเภอ", "warning")
        return false;
      }
    if(province == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่จังหวัด", "warning")
        return false;
      }
    if(zipcode == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่รหัสไปรษณีย์", "warning")
        return false;
      }
    if(tp == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่เบอร์โทร", "warning")
        return false;
      }


    count_rows = table.getElementsByTagName("tr").length;

    var row = table.insertRow(count_rows);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
 
 
    cell1.innerHTML = fname_add+' '+lname_add;
    cell2.innerHTML = address+' '+district;
    cell3.innerHTML = amphor+' '+province+' '+zipcode;
    cell4.innerHTML = tp
    
    cell5.innerHTML = "<button style='background-color: white;' type='button' class='edit-catagory btn btn-default' onclick='del_row(this)'> <i class='fa fa-fw fa-trash'></i></button> <button style='background-color: white;' type='button' class='edit-catagory btn btn-default' onclick='edit_row(this)'> <i class='fa fa-edit'></i></button> ";

    cell6.innerHTML = "<input class='form-control ' TYPE=\'hidden\'  name='fname_add[]' id=\'fname_add"+count_rows+"\' value=\'"+fname_add+"\'> <input class='form-control ' TYPE=\'hidden\'  name='lname_add[]' id=\'lname_add"+count_rows+"\''  value=\'"+lname_add+"\'> <input class='form-control ' TYPE=\'hidden\'  name='address[]' id=\'address"+count_rows+"\' value=\'"+address+"\'><input class='form-control ' TYPE=\'hidden\'  name='district[]' id=\'district"+count_rows+"\' value=\'"+district+"\'><input class='form-control ' TYPE=\'hidden\'  name='amphor[]' id=\'amphor"+count_rows+"\' value=\'"+amphor+"\'><input class='form-control ' TYPE=\'hidden\'  name='province[]' id=\'province"+count_rows+"\' value=\'"+province+"\'><input class='form-control ' TYPE=\'hidden\'  name='zipcode[]' id=\'zipcode"+count_rows+"\' value=\'"+zipcode+"\'><input class='form-control ' TYPE=\'hidden\'  name='tp[]' id=\'tp"+count_rows+"\' value=\'"+tp+"\'>";
    
   

                 result1 = parseInt(data.sum_total_cost);
                document.getElementById('total_cost').value=result1+1;
                inputClear();
}



         function inputClear(){
            $('#fname_add').val('');
            $('#lname_add').val('');
            $('#address').val('');
            $('#district').val('');
            $('#amphor').val('');
            $('#province').val('');
            $('#zipcode').val('');
            $('#tp').val('');
        }

</script>
<script type="text/javascript">
$(document).ready(function(){
        $.Thailand({
            $district: $('#district'), // input ของตำบล
            $amphoe: $('#amphor'), // input ของอำเภอ
            $province: $('#province'), // input ของจังหวัด
            $zipcode: $('#zipcode'), // input ของรหัสไปรษณีย์
        });
        // $.Thailand_edit({
        //     $district: $('#district_edit'), // input ของตำบล
        //     $amphoe: $('#amphor_edit'), // input ของอำเภอ
        //     $province: $('#province_edit'), // input ของจังหวัด
        //     $zipcode: $('#zipcode_edit'), // input ของรหัสไปรษณีย์
        // });
})
    //------------------------------------------------------------ADD Customer--------------------------------------------------------------
       


    $(document).on('click', '#btnSendAdd', function(){
        check_pass();
        var formData = new FormData($('#upload-form-add')[0]);

    fname = $('#fname').val();
    lname = $('#lname').val();
    emails = $('#emails').val();
    tel = $('#tel').val();
    username = $('#username').val();
    password = $('#password').val();
    password1 = $('#password1').val();
    Tax_ID = $('#Tax_ID').val();
    total_cost = $('#total_cost').val();
  

    if(fname == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ชื่อ", "warning")
        return false;
      }
    if(lname == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่นามสกุล", "warning")
        return false;
      }
    if(emails == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ E-mail", "warning")
        return false;
      }
    if(tel == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่เบอร์โทรศัพท์", "warning")
        return false;
      }
    if(Tax_ID == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่เลขที่ผู้เสียภาษี", "warning")
        return false;
      }
    if(username == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ username", "warning")
        return false;
      }
    // if(password == ""){
    //     swal("คำเตือน", "คุณยังไม่ได้ใส่ password", "warning")
    //     return false;
    //   }
    // if(password1 == ""){
    //     swal("คำเตือน", "คุณยังไม่ได้ใส่ยืนยัน password", "warning")
    //     return false;
    //   }
    
    if(total_cost == 0){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ที่อยู่", "warning")
        return false;
      }

        swal({
          title: 'ยืนยัน?',
          text: "ยืนยันการแก้ไขข้อมูลลูกค้า?",
          type: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'ยืนยัน',
          showLoaderOnConfirm: true
        }).then((result) => {
             $.ajax({
                type: "POST",
                url: "functions.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                console.log(data);
                $.ajax({
            type: "POST",
            url: "mail_to.php",
            data: formData,
            processData: false,
            contentType: false
                  })
                if (result.value) {
                 swal('สำเร็จ','แก้ไขข้อมูลลูกค้าเรียบร้อยแล้ว.','success')
                 document.getElementById('upload-form-add').reset();
                }
                // alert(data);
                // swal('สำเร็จ','แก้ไขข้อมูลลูกค้าเรียบร้อยแล้ว.','success')
                // document.getElementById('upload-form-add').reset();
                //$('#img-upload').attr('src', 'img/upload.jpg');
                },
            });
            
        })
    });




</script>

</body>
</html>

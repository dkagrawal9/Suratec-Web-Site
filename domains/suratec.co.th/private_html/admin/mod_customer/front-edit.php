<?php
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser($objConnect);

$title = 'แก้ไขลูกค้า';

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
    <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
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
<input type="hidden" name="id_customer" id="id_customer" value="<?php echo $result['id_customer']; ?>">

<!-- start form -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" >
                    <!-- Start box warning for ADD system -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-success box-solid">
                                 <div class="box-header with-border">
                                    <h3 class="box-title">ข้อมูลส่วนตัว</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อ</label>

                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control"  name="fname" id="fname" value="<?php echo $result['fname']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">นามสกุล</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $result['lname']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">E-mail</label>

                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control"  name="emails" id="emails" value="<?php echo $result['email']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">เบอร์โทร</label>

                                                <div class="col-sm-8">
                                                    <!-- <input type="text" class="form-control"  name="telephone" id="telephone" OnKeyPress="return check_tel(this)" autocomplete="off" required> -->
                                                     <input type="text" class="form-control"  name="tel" id="tel" value="<?php echo $result['telephone']; ?>" maxlength="10" OnKeyPress="return check_tel(this)">
                                                   <!--  <input name="tel" type="text" class="form-control" id="tel" value="" size="20" maxlength="10"   OnKeyPress="return check_tel(this)" value="<?php echo $result['telephone']; ?>" /> -->
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">เลขประจำตัวผู้เสียภาษี</label>

                                                <div class="col-sm-8">

                                                    <input type="text" class="form-control" maxlength="13" name="Tax_ID" id="Tax_ID" value="<?php echo $result['tax_id']; ?>" OnKeyPress="return check_tel(this)">
                                                </div>
                                            </div>
                                         </div>
                                    </div>
                                </div>
                                <div class="box-header with-border">
                                    <h3 class="box-title">ข้อมูลการเข้าสู่ระบบ</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
                                        <div class="box-body">
                                            
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อผู้ใช้งาน</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="username" id="username" value="<?php echo $result['user_member']; ?>" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                               

                                                <div class="col-sm-12">
                                                    <button class="btn btn-success" id="" onclick='toggle1()'>เปลี่ยนรหัสผ่าน</button>
                                                  <!--   <input type="button" name="btn" id="btn" value="Show" onclick='toggle()' /> -->
                                                </div>
                                            </div>
                                            <div style="display: none;" id="re_password">
                                                <div class="form-group">
                                                 <label for="" class="col-sm-12 control-label" style="color: red" >Password *กรณีเปลี่ยนพาสเวิร์ดใหม่</label>

                                                <label for="" class="col-sm-3 control-label">รหัสผ่าน</label>

                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="password" id="password" autocomplete="off" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ยืนยันรหัสผ่าน</label>

                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="password1" id="password1" onblur="check_pass()" >
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
                <div class="col-lg-4 col-md-4 col-sm-12">
            <!-- Start box warning for ADD system -->
                   
                </div>
           
</form>

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
<script src="js/timer.js"></script>

<link rel="stylesheet" href="css/ui-bootstrap-csp.css">
<!-- <script src="js/sweetalert2.all.min.js"></script> -->
<!-- <script src="js/up_pre.js"></script> -->

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
   $(document).on('click', '#repassword', function(){
        var ds = document.getElementById("re_password");
        if(ds.style.display == 'none')
            ds.style.display = 'block';
        else 
            ds.style.display = 'none';
    } )     


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
    id_customer = $('#id_customer').val();

        
        
       
  

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
            text: "ยืนยันการแก้ไขหรือไม่?",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
            return new Promise(function (resolve) {
            $.ajax({
            type: "POST",
            url: "functions.php",
            data: formData,
            processData: false,
            contentType: false
                  })

// in case of successfully understood ajax response
            .done(function (myAjaxJsonResponse) {
            console.log(myAjaxJsonResponse);
  swal({
            title: 'สำเร็จ',
            text: "บันทึกการแก้ไขเรียบร้อยแล้ว?",
            type: 'success',
      
            confirmButtonColor: '#3085d6',
          
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
            return new Promise(function (resolve) {
          
            // alert('การบันทึก');
         swal(window.location.href='front-edit.php?id='+id_customer)
            //location.reload();
           
            .fail(function (erordata) {
// คือไม่สำรเ็จ
            console.log(erordata);
            swal('ไม่สำเร็จ', 'เกิดปัญหากับระบบ', 'error');
            })
          })
        },    
      })
            })
            .fail(function (erordata) {
// คือไม่สำรเ็จ
            console.log(erordata);
            swal('ไม่สำเร็จ', 'เกิดปัญหากับระบบ', 'error');
            })
          })
        },    
      })
    });




</script>

</body>
</html>

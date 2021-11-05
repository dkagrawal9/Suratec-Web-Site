<?php 
  require_once '../library/connect.php';
  require_once '../library/functions.php';
  checkAdminUser($objConnect);
  
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=TITLE?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
      <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!--Css table ใช้ของ เมนู -->
  <!-- <link rel="stylesheet" href="css/table-employee.css"> -->
  <!-- upload template css-->
  <link rel="stylesheet" type="text/css" href="css/up_pre.css">

  <!-- Include external CSS. -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
  <!-- Include Editor style. -->
  <link href="../page_froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css">
  <link href="../page_froala/css/froala_style.min.css" rel="stylesheet" type="text/css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
</head>

<style type="text/css">
   .box-detail-em{
    padding: 10px;
    text-align: left;
  }
  .box-detail-em>div>.input-group-addon{
    background-color: #ddd;
  }
  .box-login{
    width: 100%;
  }
  .box-box-center{
    max-width: 400px;
 /*   margin-top: 45px;*/
  }
  .box-box-center>.box-detail-em>p{
    font-weight: bold;
    margin-bottom: 3px;
    text-align: left;
  }
  .box-box-center>.box-detail-em>label{
    margin-bottom: 0;
  }
  .warning-text-check{
    color: orange;
  }
  .warning-text-check-b2{
    color: orange;
  }
  .authen-active{
    cursor: pointer;
  }
  .active-authen{
     box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }
  .authen{
    display: none;
  }
  .Authentication>div>span{
    border-radius: 0;
  }
  .Authentication>div{
    padding: 0;
    margin-bottom: 5px;
    transition: 0.4s
  }
      #share{
      opacity: 0.5;
      transform: rotate(90deg);
  }
  .authen_acitve-block{
    background-color: #00a65a;
    border-color: #008d4c;
    color: white;
  }
  .text_general{
    color: white;
  }



  .button-switch {
  font-size: 1em;
  height: 1.875em;
  margin-bottom: 0.625em;
  position: relative;
  width: 6.5em;
  display: inline-block;
}
.button-switch .lbl-off,
.button-switch .lbl-on {
  cursor: pointer;
  display: block;
  font-size: 0.9em;
  font-weight: bold;
  line-height: 1em;
  position: absolute;
  top: 0.5em;
  transition: opacity 0.25s ease-out 0.1s;
  text-transform: uppercase;
}
.button-switch .lbl-off {
  right: 1.9375em;
}
.button-switch .lbl-on {
  color: #fefefe;
  opacity: 0;
  left: 0.4375em;
}
.button-switch .switch {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  height: 0;
  font-size: 1em;
  left: 0;
  line-height: 0;
  outline: none;
  position: absolute;
  top: 0;
  width: 0;
}
.button-switch .switch:before, .button-switch .switch:after {
  content: '';
  font-size: 1em;
  position: absolute;
}
.button-switch .switch:before {
  border-radius: 1.25em;
  background: #bdc3c7;
  height: 1.875em;
  left: -0.25em;
  top: -0.1875em;
  transition: background-color 0.25s ease-out 0.1s;
  width: 6.5em;
}
.button-switch .switch:after {
  box-shadow: 0 .0625em .375em 0 #666;
  border-radius: 50%;
  background: #fefefe;
  height: 1.5em;
  -webkit-transform: translate(0, 0);
          transform: translate(0, 0);
  transition: -webkit-transform 0.25s ease-out 0.1s;
  transition: transform 0.25s ease-out 0.1s;
  transition: transform 0.25s ease-out 0.1s, -webkit-transform 0.25s ease-out 0.1s;
  width: 1.5em;
}
.button-switch .switch:checked:after {
  -webkit-transform: translate(4.5em, 0);
          transform: translate(4.5em, 0);
}
.button-switch .switch:checked ~ .lbl-off {
  opacity: 0;
}
.button-switch .switch:checked ~ .lbl-on {
  opacity: 1;
}
.button-switch .switch#switch-orange:checked:before {
  background: #00a65a;
}
.button-switch .switch#switch-blue:checked:before {
  background: #f39c12;
}

.switch-label1{
    background: #00a65a99;
    padding: 1%;
    border-radius: 5px;
}
.switch-label2{
    background: #f39c1296;
    padding: 1%;
    border-radius: 5px;
}

.switch-label3{
    background: #34db4adc;
    color: #fafafa !important ; 
    padding: 1%;
    border-radius: 5px;
}


.switch-row{
    background: #3498db5d;
    /* padding: 1%; */
    border-radius: 5px;
}


</style>
<body class="hold-transition skin-blue sidebar-mini fixed" onload="startTime()">
<div class="wrapper">
 
  <?php require_once '../template/nav_menu.php'; ?>
  <?php require_once '../library/permission.php'; 
   if(($key = array_search($id_cookie,$task_view)) !== false){
      if($task_authen[$key]==3){
       echo "<script>location.href='front-manage.php';</script>";
      }
    }
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        เพิ่มพนักงาน
      </h1>
      <ol class="breadcrumb">
        <li><a href="../page_home/index.php"></i> แดชบอร์ด</a></li>
        <li><a href="front-manage.php"></i> จัดการพนักงาน</a></li>
        <li class="active">เพิ่มพนักงาน</li>
      </ol>
    </section>
    <section class="content">
    <!-- Main content -->
    <!-- SELECT2 EXAMPLE -->
     
      <!-- /.box -->
      <div class="alert alert-success alert-dismissible" id="result_add_cat" style="display: none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <div id="loader_add_cat">
          <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
          Inserting...
        </div>
        <div id="success_add_cat">
          <h4><i class="icon fa fa-check"></i> Increase!</h4>
          Increase Catagory successful.
        </div>
      </div>

      <div class="alert alert-success alert-dismissible" id="result_add" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <div id="loader_add">
              <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
              Inserting...
            </div>
            <div id="success_add">
              <h4><i class="icon fa fa-check"></i> Increase!</h4>
              Increase data successful.
            </div>
          </div>

      <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i>เสร็จสิ้น</h4>
              </div>
              <div class="modal-body">
                <center><h4>เพิ่มพนักงานเรียบร้อยแล้ว คุณจะไปหน้าจัดการบทความหรือไม่</h4></center>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">เพิ่มเนื้อหาต่อ..</button>
                <button type="button" class="btn btn-primary" id="btnYes">ยืนยัน</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

      <form action="back_article-add.php" method="post" enctype="multipart/form-data" id="frmADD" class="upload-form-add">
        <input type="hidden" name="form" value="add">
<?php 
  if($_SESSION['permission']=='Read'){
?>
                    <div class="box box-danger box-solid">
                      <div class="box-header ">
                        <h3 class="box-title">คำเตือน</h3>
                      </div>
                      <div class="box-body">
                        คุณไม่ได้รับสิทธิ์ให้ใช้งานระบบนี้
                      </div>
                    </div>
<?php
  }else{
?>
        <div class="row">
          <div class="col-md-4">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">รูปภาพพนักงาน</h3>
              </div>
              <div class="box-body" style="padding-top: 0">
                <div class="row">
                  <div class="col-lg-6" style="margin-top: 10px;">
                    <div style="width: 100%; padding-bottom: 10px;" align="center">
                      <img id='img-upload' src="img/upload.jpg" />
                    </div>
                    <div class="input-group" style="width: 100%">
                      <input type="text" class="form-control" readonly >
                      <span class="input-group-btn" style="display: none;">
                        <span class="btn btn-default btn-file" style="background-color: white !important;">
                          <i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;&nbsp;เลือกรูปภาพ <input type="file" name="image_employee" accept="image/*" id="imgInp" class="checkfileemployee">
                        </span>
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-6" style="margin-top: 10px;">
                    <h4>รายละเอียดเบื้องต้น</h4>
                    <hr>
                    <p>ชื่อ : <font id="name-ex"></font><br></p>
                    <p>นามสกุล : <font id="sur-ex"></font><br></p>
                    <p>รหัสพนักงาน : <font id="code-ex"></font><br></p>
                    <p>ตำแหน่ง : <font id="posi-ex"></font><br></p>

                  </div>
                </div>                
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
            <!-- /.col (right) -->
          <div class="col-md-8">
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">ข้อมูลพนักงาน</h3>
            

              </div>
              <div class="Authentication">
                <div class="col-lg-4">
                  <span class="btn btn-info btn-block" id="Description">Description</span>
                </div>
                <div class="col-lg-4">
                  <span class="btn btn-default btn-block" id="Username">Username</span>
                </div>
                <div class="col-lg-4">
                  <span class="btn btn-default btn-block" id="view">Authentication</span>
                </div>
              </div>
              <div class="nav-tabs-custom" style="box-shadow: none;" id="tab-description">
                <ul class="nav nav-tabs">
                  <li class="active">
                    <a href="#thai" data-toggle="tab" aria-expanded="true">
                      <img class="flag-lang" src="../img/th-fl.png" width="22" height="15">
                      ภาษาไทย
                    </a>
                  </li>
                  <li id="back-thai">
                    <a href="#english" data-toggle="tab" aria-expanded="false">
                      <img class="flag-lang" src="../img/en-fl.jpg" width="22" height="15">
                      ภาษาอังกฤษ
                    </a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="thai">
                    <div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="box-detail-em">
                            ชื่อพนักงาน <font class="warning-text-check" id="employee-name-text">*</font>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                              <input type="text" class="form-control " id="employee-name" name="employee-name" placeholder="ชื่อพนักงาน">
                            </div>   
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="box-detail-em">
                            นามสกุล <font class="warning-text-check" id="employee-sur-text">*</font>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                              <input type="text" class="form-control " id="employee-sur" name="employee-sur" placeholder="นามสกุล">
                            </div>   
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="box-detail-em">
                            รหัสประชาชน <font class="warning-text-check" id="employee-code-text">*</font>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                              <input type="text" class="form-control " id="employee-code" name="employee-code" placeholder="รหัสประจำตัวประชาชน" maxlength="13" onkeypress="return isNumber(event)">
                            </div>   
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="box-detail-em"> 
                            วันเกิด <font class="warning-text-check" id="employee-birth-text">*</font> วัน/เดือน/ปี
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="employee-date" name="employee-date">
                            </div> 
                          </div>
                        </div>

                        <!--  <div class="form-group">
                          <label>Date:</label>

                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="employee-date" name="employee-date">
                          </div>
                        </div> -->


                        <div class="col-md-6">
                          <div class="box-detail-em">
                            ตำแหน่ง 
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                              <input type="text" class="form-control " id="employee-opti" name="employee-opti" placeholder="ตำแหน่งพนักงาน">
                            </div>   
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="box-detail-em">
                            เบอร์โทรศัพท์
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                              <input type="text" class="form-control " id="tel" name="tel" placeholder="เบอร์โทรศัพท์" maxlength="10" onkeypress="return isNumber(event)">
                            </div>   
                          </div>
                        </div>
                       

                       

                       <div class="col-md-12"> <hr style="border: 1px solid #ccc;">

                        <div class="col-md-6">
                          <div class="box-detail-em">
                            ที่อยู่
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-address-book-o"></i></span>
                              <input type="text" class="form-control " id="address" name="address" placeholder="ที่อยู่">
                            </div>   
                          </div>
                        </div>



                        <div class="col-md-6">
                          <div class="box-detail-em">
                          อำเภอ 
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-address-book-o"></i></span>
                              <input class="form-control" type="text" name="amphures" id="amphures" placeholder="อำเภอ">
                            </div>   
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="box-detail-em">
                          ตำบล 
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-address-book-o"></i></span>
                              <input class="form-control" type="text" name="district" id="district" placeholder="ตำบล">
                            </div>   
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="box-detail-em">
                          จังหวัด 
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-address-book-o"></i></span>
                              <input class="form-control" type="text" name="province" id="province" placeholder="จังหวัด">
                            </div>   
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="box-detail-em">
                          รหัสไปรษณีย์ 
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-address-book-o"></i></span>
                              <input class="form-control" type="text" name="zip_code" id="zip_code" placeholder="รหัสไปรษณีย์">
                            </div>   
                          </div>
                        </div>

                        </div>


<!-- <div class="col-md-12" >
<hr style="border: 1px solid #ccc;">
<label for="" class="switch-label1" id="MyPage" style="text-align:left; ">สามารถอนุมัติได้ (Approver)</label>
<div class="box-detail-em" >
<div class="button-switch">
<input type="checkbox" id="switch-orange"   name="approver"  value="1" class="switch  check1 "  />
  <label for="switch-orange" class="lbl-off">No</label>
  <label for="switch-orange" class="lbl-on">Yes</label>
</div>
<br>

</div>
<hr style="border: 1px solid #ccc;">
</div> --> 



                      </div> 
                    </div>  
                  </div>
                  <div class="tab-pane" id="english">
                    <div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="box-detail-em">
                            ชื่อพนักงาน
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-header"></i></span>
                              <input type="text" class="form-control " id="employee-name-en" name="employee-name-en" placeholder="ชื่อพนักงาน">
                            </div>   
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="box-detail-em">
                            นามสกุล
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-header"></i></span>
                              <input type="text" class="form-control " id="employee-sur-en" name="employee-sur-en" placeholder="นามสกุล">
                            </div>   
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="box-detail-em">
                            ตำแหน่ง
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-header"></i></span>
                              <input type="text" class="form-control " id="employee-opti-en" name="employee-opti-en" placeholder="ตำแหน่งพนักงาน">
                            </div>   
                          </div>
                        </div>
                        <!-- <div class="col-md-6">
                          <div class="box-detail-em">
                            รายละเอียดพนักงาน        
                              <textarea class="form-control " id="employee-detail-en" name="employee-detail-en" placeholder="ชื่อพนักงาน""> </textarea> 
                          </div>  
                        </div> -->




                      </div> 
                    </div> 
                  </div>
                </div>
              </div>
              <div id="tab-username" style="display: none;"> 
                <div class="box-login" align="center">
                  <div class="box-box-center">
                    <div class="box-detail-em">
                      <p>อีเมลล์ <font class="" id="employee-email-text" style="display: none;">*</font></p>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input type="text" class="form-control " id="employee-email" name="employee-email" placeholder="อีเมลล์ Exam. yourname@gmail.com">
                      </div>   
                    </div>
                    <div class="box-detail-em">
                      <p>ชื่อผู้ใช้งาน  <font class="warning-text-check-b2" id="employee-user-text">*</font>
                                        <i class="fa fa-spinner fa-spin spin-check" style="position:absolute; margin-left: 10px; color: green !important; display: none; "></i>
                                        <i class="fa fa-check success-check" style="position:absolute;margin-left: 10px; color: green !important; display: none;"></i>
                                        <i class="fa fa-times-circle wrong-check" style="position:absolute; margin-left: 10px; color: orange !important; display: none;"> username has exists.</i></p>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control " id="employee-user" name="employee-user" placeholder="ชื่อผู้ใช้งานสำหรับเข้าสู่ระบบ">
                      </div>   
                    </div>
                    <div class="box-detail-em">
                      <p>รหัสผ่าน <font class="warning-text-check-b2" id="employee-pass-text">*</font></p>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control " id="employee-pass" name="employee-pass" placeholder="รหัสผ่านสำหรับเข้าสู่ระบบ"  >
                      </div>   
                    </div>
                    <div class="box-detail-em">
                      <p>รหัสผ่านอีกครั้ง <font class="warning-text-check-b2" id="employee-passA-text">*</font></p>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control " id="employee-pass-again" name="employee-again-pass" placeholder="รหัสผ่านสำหรับเข้าสู่ระบบ">
                      </div> 
                      <font class="" id="employee-passA-again" style="display: none;">*กรุณากรอกรหัสผ่านให้ตรงกัน</font>  
                    </div>
                  </div>
                </div>
              </div>      
              <!--  -->
              <div id="tab-view" style="display: none;"> 
                <div class="box-login" align="center">
                   <div class="col-md-12">
                          <div class="box-detail-em">
                            ประเภทผู้ใช้งาน        
                              <select  class="form-control selectpicker" id="role" name="role" data-show-subtext="true" data-live-search="true">
                                <option value="0">ประเภทผู้ใช้งาน</option>
<?php
$str = "SELECT `role_id`,`role_name` FROM `role` WHERE 1";
$query = mysqli_query($objConnect,$str);
while ( $result = mysqli_fetch_array($query)) {
?>
                                <option value="<?php echo $result["role_id"] ?>"><?php echo $result["role_name"] ?></option>
<?php } ?>
                              </select>
                          </div>  
                        </div>
                  
<div id="tbody_type" >
  
</div>
<div id="tbody_default">
 
                      </div>








<!-- -------------------------------------------------------POS---------------------------------------------------------------- -->
<div class="col-md-12" id="pos_show" style="display: none; margin-top: 10px;">
                        <div class="box box-danger box-solid">
                          <div class="box-header ">
                            <h3 class="box-title">สิทธิ์การใช้งาน POS</h3>
                          </div>
                          <div class="box-body">
<!-- ------------------------------------------------------------------------------------------------ -->
<hr style="border: 1px solid #ccc;">

<div style="background-color: #00c0ef66;">


                          <div class="col-md-6" style="background-color: #dd4b3994;">
                          <div class="box-detail-em">
                           <label for="">ร้านค้า</label> 
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                              <select class="form-control" name="branch">
                                <option value="" disabled>-select-</option>
<?php 
  $str = 'SELECT * FROM mod_erp_branch where delete_datetime is null';
  $query = mysqli_query($objConnect,$str);
  while($result = mysqli_fetch_array($query)){
    ?>
     <option value="<?php echo $result['id_branch'] ?>"><?php echo $result['name_branch']; ?></option> 
<?php
  }
 ?>
 <!-- ------------------------------------------------------------------------------------------------ -->
                              </select>
                            </div>   
                          </div>
                        </div>

                        <div class="col-md-6" style="background-color: #dd4b3994;">
                          <div class="box-detail-em">
                          <label for="">POS</label>  
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                              <select class="form-control" name="branch">
                                <option value="" disabled>-select-</option>
<?php 
  $str = 'SELECT * FROM mod_erp_branch where delete_datetime is null';
  $query = mysqli_query($objConnect,$str);
  while($result = mysqli_fetch_array($query)){
    ?>
    <option value="<?php echo $result['id_branch'] ?>"><?php echo $result['name_branch']; ?></option> 
<?php
  }
 ?>
                              </select>
                            </div>   
                          </div>
                        </div>

</div>
<hr style="border: 1px solid #ccc;">
<!-- ------------------------------------------------------------------------------------------------ -->

                            <table width="100%">
                              <tbody>                       
<?php
  
  $module = explode(",", $result['task_view']);
  $authen = explode(",", $result['task_authen']);

  $str = "SELECT * FROM system WHERE type = '3' AND level = '1'";
  $query = mysqli_query($objConnect,$str);
  $output = '';
  $i = 0;
 
  while ($objResult = mysqli_fetch_array($query)) {
  if(($key = array_search($objResult['id_system'],$module)) !== false){
    echo $key;
    if($authen[$key]==1){
      $check1 = "checked";
      $check2 = "";
      $check3 = "";
      $check0 = "";

      $class1 = "authen_acitve-block";
      $class2 = "";
      $class3 = "";
      $class0 = ""; 
    }elseif($authen[$key]==2){
      $check1 = "";
      $check2 = "checked";
      $check3 = "";
      $check0 = "";

      $class1 = "";
      $class2 = "authen_acitve-block";
      $class3 = "";
      $class0 = ""; 
    }elseif($authen[$key]==3){
      $check1 = "";
      $check2 = "";
      $check3 = "checked";
      $check0 = "";

      $class1 = "";
      $class2 = "";
      $class3 = "authen_acitve-block";
      $class0 = ""; 
    }
  }else{
    $check1 = "";
    $check2 = "";
    $check3 = "";
    $check0 = "checked";

    $class1 = "";
    $class2 = "";
    $class3 = "";
    $class0 = "authen_acitve-block"; 
  }

  if($objResult['icon']==''){
    $icon = '<i class="fa fa-circle-o text-yellow"></i>';
  }else{
    $icon = $objResult['icon'];
  }
  $i++;
    $output .= '<tr>
                  <td>
                    <div class="form-group">
                      <label style="cursor:pointer; font-weight:normal !important;">
                       
                          '.$icon.'
                          &nbsp;'.$objResult["name_system"].'
                      </label> 
                                
                    </div>
                  </td>
                  <td>
                    <div style="float:right">
                      <label><span class="btn btn-default set_authen_p authen_p'.$i.' '.$class1.'" data-id="'.$i.'">Manage 
                             <input type="radio" name="pos'.$i.'" value="1,'.$objResult["id_system"].'" style="display:none;" '.$check1.'> </span></label>
                      <label><span class="btn btn-default set_authen_p authen_p'.$i.' '.$class2.'" data-id="'.$i.'">Write 
                             <input type="radio" name="pos'.$i.'" value="2,'.$objResult["id_system"].'" style="display:none;" '.$check2.'> </span></label>
                      <label><span class="btn btn-default set_authen_P authen_p'.$i.' '.$class3.'" data-id="'.$i.'">Read 
                             <input type="radio" name="pos'.$i.'" value="3,'.$objResult["id_system"].'" style="display:none;" '.$check3.'> </span></label>
                      <label><span class="btn btn-default set_authen_P authen_p'.$i.' '.$class0.'" data-id="'.$i.'">Disable 
                             <input type="radio" name="pos'.$i.'" value="0,'.$objResult["id_system"].'" style="display:none;" '.$check0.'> </span></label>
                    </div>
                  </td>
                ';    
//---------------------------------------------------------------------------------------sub2-----------------------------------------------------------------------------------------   
  $strSQL2 = "SELECT * FROM system WHERE level ='2' AND groups = '".$objResult['id_system']."'";
  $objQuery2 = mysqli_query($objConnect,$strSQL2);
  while ($objResult2 = mysqli_fetch_array($objQuery2)) {   
  if(($key = array_search($objResult2['id_system'],$module)) !== false){
    // echo $key;
    if($authen[$key]==1){
      $check1 = "checked";
      $check2 = "";
      $check3 = "";
      $check0 = "";

      $class1 = "authen_acitve-block";
      $class2 = "";
      $class3 = "";
      $class0 = ""; 
    }elseif($authen[$key]==2){
      $check1 = "";
      $check2 = "checked";
      $check3 = "";
      $check0 = "";

      $class1 = "";
      $class2 = "authen_acitve-block";
      $class3 = "";
      $class0 = ""; 
    }elseif($authen[$key]==3){
      $check1 = "";
      $check2 = "";
      $check3 = "checked";
      $check0 = "";

      $class1 = "";
      $class2 = "";
      $class3 = "authen_acitve-block";
      $class0 = ""; 
    }
  }else{
    $check1 = "";
    $check2 = "";
    $check3 = "";
    $check0 = "checked";

    $class1 = "";
    $class2 = "";
    $class3 = "";
    $class0 = "authen_acitve-block"; 
  }   
  if($objResult2['icon']==''){
    $icon2 = '<i class="fa fa-circle-o text-yellow"></i>';
  }else{
    $icon2 = $objResult2['icon'];
  }
  $i++;
  $output .= '
              <tr>
                  <td>
                      <div class="form-group" style="padding-left:25px;">
                      <label style="cursor:pointer; font-weight:normal !important;">
           

                      '.$icon2.'
                      &nbsp;'.$objResult2["name_system"].'
                      </label>
                      
                      </div>
                  </td>
                  <td>
                    <div class="btn-group pull-right">
                      <label><span class="btn btn-default set_authen_p authen_p'.$i.' '.$class1.'" data-id="'.$i.'">Manage
                        <input type="radio" name="pos'.$i.'" value="1,'.$objResult2["id_system"].'" style="display:none;" '.$check1.'></span></label>
                      <label><span class="btn btn-default set_authen_p authen_p'.$i.' '.$class2.'" data-id="'.$i.'">Write
                        <input type="radio" name="pos'.$i.'" value="2,'.$objResult2["id_system"].'" style="display:none;" '.$check2.'></span></label>
                      <label><span class="btn btn-pos set_authen_p authen_p'.$i.' '.$class3.'" data-id="'.$i.'">Read
                        <input type="radio" name="pos'.$i.'" value="3,'.$objResult2["id_system"].'" style="display:none;" '.$check3.'></span></label>
                      <label><span class="btn btn-default set_authen_p authen_p'.$i.' '.$class0.'" data-id="'.$i.'">Disable
                        <input type="radio" name="pos'.$i.'" value="0,'.$objResult2["id_system"].'" style="display:none;" '.$check0.'></span></label>
                    </div>
                  </td>   
                   
                  '; 
//------------------------------------------------------------------------------------------sub3--------------------------------------------------------------------------------------
    $strSQL3 = "SELECT * FROM system WHERE level ='3' AND groups = '".$objResult2['id_system']."'";
    $objQuery3 = mysqli_query($objConnect,$strSQL3);
    while ($objResult3 = mysqli_fetch_array($objQuery3)) {  
        if(($key = array_search($objResult3['id_system'],$module)) !== false){
        // echo $key;
        if($authen[$key]==1){
          $check1 = "checked";
          $check2 = "";
          $check3 = "";
          $check0 = "";

          $class1 = "authen_acitve-block";
          $class2 = "";
          $class3 = "";
          $class0 = ""; 
        }elseif($authen[$key]==2){
          $check1 = "";
          $check2 = "checked";
          $check3 = "";
          $check0 = "";

          $class1 = "";
          $class2 = "authen_acitve-block";
          $class3 = "";
          $class0 = ""; 
        }elseif($authen[$key]==3){
          $check1 = "";
          $check2 = "";
          $check3 = "checked";
          $check0 = "";

          $class1 = "";
          $class2 = "";
          $class3 = "authen_acitve-block";
          $class0 = ""; 
        }
      }else{
        $check1 = "";
        $check2 = "";
        $check3 = "";
        $check0 = "checked";

        $class1 = "";
        $class2 = "";
        $class3 = "";
        $class0 = "authen_acitve-block"; 
      }   
    if($objResult3['icon']==''){
      $icon3 = '<i class="fa fa-circle-o text-yellow"></i>';
    }else{
      $icon3 = $objResult3['icon'];
    }
    $i++;   
    $output .= '<tr>
                  <td>
             <div class="form-group" style="padding-left:50px;">
                        <label style="cursor:pointer; font-weight:normal !important;">
                           

                        '.$icon3.'   
                        &nbsp;'.$objResult3["name_system"].'
                        </label>
                        
                         </div>
                    </td>
                    <td>
                        <div class="btn-group pull-right">
                           <label><span class="btn btn-default set_authen_p authen_p'.$i.' '.$class1.'" data-id="'.$i.'">Manage 
                              <input type="radio" name="pos'.$i.'" value="1,'.$objResult3["id_system"].'" style="display:none;" '.$check1.'></span></label>
                           <label><span class="btn btn-default set_authen_p authen_p'.$i.' '.$class2.'" data-id="'.$i.'">Write 
                              <input type="radio" name="pos'.$i.'" value="2,'.$objResult3["id_system"].'" style="display:none;" '.$check2.'></span></label>
                           <label><span class="btn btn-default set_authen_p authen_p'.$i.' '.$class3.'" data-id="'.$i.'">Read 
                              <input type="radio" name="pos'.$i.'" value="3,'.$objResult3["id_system"].'" style="display:none;" '.$check3.'></span></label>
                           <label><span class="btn btn-default set_authen_p authen_p'.$i.' '.$class0.'" data-id="'.$i.'">Disable 
                              <input type="radio" name="pos'.$i.'" value="0,'.$objResult3["id_system"].'" style="display:none;" '.$check0.'></span></label>
                        </div> 
                     </td>
                    </tr>   
                     
                    '; 
     }
  }     
}
$output .=' <input id="count_pos" type="hidden" value="'.$i.'" name="count_pos">';
echo $output;
?>                  
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>

                   <div class="box box-danger box-solid" style="<?php echo $task_alert ?>">
                      <div class="box-header ">
                        <h3 class="box-title">คำเตือน</h3>
                      </div>
                      <div class="box-body">
                        คุณไม่ได้รับสิทธิ์ในการกำหนดสิทธิ์ในการมองเห็น
                      </div>
                    </div>

                  </div>
                </div>
              </div>        
              <div class="box-footer" style="border: none;">

                <button type="button" class="btn btn-success pull-right" id="next-login" disabled style="transition: 0.4s; margin-left: 5px;"></i>&nbsp;ถัดไป</button>
                <button type="button" class="btn btn-success pull-right" id="next-view" style="transition: 0.4s; margin-left: 5px; display: none;"></i>&nbsp;ถัดไป</button>
                <button type="button" class="btn btn-success pull-left" id="back-login" style="transition: 0.4s; margin-left: 5px; display: none;"></i>&nbsp;ย้อนกลับ</button>
                <button type="button" class="btn btn-success pull-left" id="back-view" style="transition: 0.4s; margin-left: 5px; display: none;"></i>&nbsp;ย้อนกลับ</button>
              </div>
            </div>
            <!-- /.box -->

          </div>
          <!-- /.col (left) -->
        </div>
        <!-- /.row -->
<?php 
  }
?>
      </form>
      <div class="boxsave">
          <button type="button" class="btn btn-info pull-right btnSendAdd" id="btnSendAdd" style="transition: 0.4s; margin-left: 5px;" ><i class="fa fa-check"></i>&nbsp;บันทึก</button>
          <button type="button" class="btn btn-warning pull-right btnSendClear" id="btnSendClear"><i class="fa fa-remove"></i>&nbsp;เคลียร์</button>
      </div>
        <!-- /.box --> 
      
      <!-- /.form send to DB-->
      <div class="modal fade" id="modal-default-image">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i>คำเตือน</h4>
              </div>
              <div class="modal-body">
                <div id="image">
                  <center><img src="../img/warning.png" width="60" height="60"><h4>กรูณาเลือกรูปภาพ</h4></center>
                </div>
                <div id="checkbox">
                  <center><img src="../img/warning.png" width="60" height="60"><h4>กรูณาเลือกหมวดหมู่บทความ</h4>
                    ในกรณีไม่มีหมวดหมู่ที่ต้องการสามารถเพิ่มหมวดหมู่ที่ปุ่ม เพิ่มหมวดหมู่</center>
                </div>
                <div id="clearbox">
                  <center><img src="../img/warning.png" width="60" height="60"><h4>การเคลียร์หน้าเพิ่มพนักงานจะเป็นการล้างหน้าจอรวมถึงภาพ/หมวดหมู่/เนื้อหาจะถูกล้างไปด้วย</h4></center>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-block btn-primary" data-dismiss="modal">ฉันเข้าใจแล้ว</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="modal-alert">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i>คำเตือน</h4>
              </div>
              <div class="modal-body">
                <div id="clearbox">
                  <h4>กรุณากรอกข้อมูลที่มีเครื่องหมาย <font style="color: orange;">*</font> ให้ครบทุกช่อง</h4>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">ฉันเข้าใจแล้ว</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </section>
    <!-- /.content -->
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- Include external JS libs. -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>
<!-- Include JS files. -->
<script type="text/javascript" src="../page_froala/js/froala_editor.pkgd.min.js"></script>
<!-- bootstrap datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- upload js-->
<script src="js/up_pre.js"></script>


<script src="asset/jquery.thailand.js/dependencies/JQL.min.js"></script>
<script src="asset/jquery.thailand.js/dependencies/typeahead.bundle.js"></script>
<script src="asset/jquery.thailand.js/dependencies/zip.js/zip.js"></script>
<script src="asset/jquery.thailand.js/dependencies/zip.js/inflate.js"></script>
<script src="asset/jquery.thailand.js/dependencies/zip.js/z-worker.js"></script>

<script src="asset/jquery.thailand.js/jquery.Thailand.js"></script>
<link href="asset/jquery.thailand.js/jquery.Thailand.min.css" rel="stylesheet">


<script>


$(function () {
        $.Thailand({
            $district: $('#district'), // input ของตำบล
            $amphoe: $('#amphures'), // input ของอำเภอ
            $province: $('#province'), // input ของจังหวัด
            $zipcode: $('#zip_code'), // input ของรหัสไปรษณีย์
        });
    });



      $(document).ready(function(){
      $('#employee-date').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
      })


        $(document).on('click', '.check_cat', function(){
          var level = $(this).attr('data-lev');
          var data_id = $(this).attr('data-id');
          var id = $(this).val();
          var id_t = $(this).attr('data-top');
          // alert(level+' '+data_id);
          if(level ==2){
            if($('.check_top2'+id).is(':checked')){
               $('.check_top1'+id_t).prop('checked', true);
            }else{
               $('.input_top2'+id).val('');
               $('.input_top3-ex2'+id).val('');
               $('.check_top3-ex2'+id).prop('checked', false);
            }
          }else if(level==3){
            if($('.check_top3'+id).is(':checked')){
              $('.check_top2'+id_t).prop('checked', true);
              var id_t2 = $('.check_top2'+id_t).attr('data-top');
              $('.check_top1'+id_t2).prop('checked', true);
            }else{
              $('.input_top3'+id).val('');
            }
          }else{
             if(!$('.check_top1'+id).is(':checked')){

              $('.input_top1'+id).val('');
              $('.input_top2-ex1'+id).val('');
              $('.input_top3-ex1'+id).val('');
               // alert(id);
              $('.check_top3-ex1'+id).prop('checked', false);
              $('.check_top2-ex1'+id).prop('checked', false);
              // $('#general23').val('');
             }
          }
        });
        //----------------------------------------------------------------------------------------------Next to mission------------------------------------------------------------------------------
        //---------------------------------------------------click Description
        $(document).on('click','.set_authen', function(){
          var i = $(this).attr('data-id');
          $('.authen'+i).removeClass('authen_acitve-block');
          $(this).addClass('authen_acitve-block');
        })

        $(document).on('click','.set_authen_d', function(){
          var i = $(this).attr('data-id');
          $('.authen_d'+i).removeClass('authen_acitve-block');
          $(this).addClass('authen_acitve-block');
        })


        $(document).on('click','.set_authen_p', function(){
          var i = $(this).attr('data-id');
          $('.authen_p'+i).removeClass('authen_acitve-block');
          $(this).addClass('authen_acitve-block');
        })



        $(document).on('click','#general', function(){
          $(this).addClass('btn-info');
          $(this).addClass('text_general');
          $('#system').removeClass('btn-warning');
          $('#system').removeClass('text_general');

          $('#pos').removeClass('btn-danger');
          $('#pos').removeClass('text_general');


          $('#general_show').show();
          $('#pos_show').hide();
          $('#system_show').hide();
        });

        $(document).on('click','#system', function(){
          $(this).addClass('btn-warning');
          $(this).addClass('text_general');
          $('#general').removeClass('btn-info');
          $('#general').removeClass('text_general');

          $('#pos').removeClass('btn-danger');
          $('#pos').removeClass('text_general');
          
          $('#general_show').hide();
          $('#pos_show').hide();
          $('#system_show').show();
        });

        $(document).on('click','#pos', function(){
          $(this).addClass('btn-danger');
          $(this).addClass('text_general');

          $('#general').removeClass('btn-info');
          $('#general').removeClass('text_general');
          $('#system').removeClass('btn-warning');
          $('#system').removeClass('text_general');

          $('#pos').removeClass('text_general');
          $('#general_show').hide();
          $('#system_show').hide();
          $('#pos_show').show();
        });

          $(document).on('click','#general_type', function(){
          $(this).addClass('btn-info');
          $(this).addClass('text_general');
          $('#system').removeClass('btn-warning');
          $('#system').removeClass('text_general');

          $('#pos').removeClass('btn-danger');
          $('#pos').removeClass('text_general');


          $('#general_show').show();
          $('#pos_show').hide();
          $('#system_show').hide();
        });

        $(document).on('click','#system_type', function(){
          $(this).addClass('btn-warning');
          $(this).addClass('text_general');
          $('#general').removeClass('btn-info');
          $('#general').removeClass('text_general');

          $('#pos').removeClass('btn-danger');
          $('#pos').removeClass('text_general');
          
          $('#general_show').hide();
          $('#pos_show').hide();
          $('#system_show').show();
        });



        // $(document).on('click','#general', function(){
        //   $(this).addClass('btn-info');
        //   $(this).addClass('text_general');
        //   $('#system').removeClass('btn-warning');
        //   $('#system').removeClass('text_general');
        //   $('#general_show').show();
        //   $('#system_show').hide();
        // });

        // $(document).on('click','#system', function(){
        //   $(this).addClass('btn-warning');
        //   $(this).addClass('text_general');
        //   $('#general').removeClass('btn-info');
        //   $('#general').removeClass('text_general');
        //   $('#general_show').hide();
        //   $('#system_show').show();
        // });

        $(document).on('click','#Description', function(){
          $('#tab-description').show();
          $('#tab-username').hide();
          $('#tab-authen').hide();
          $('#tab-view').hide();

          $('#next-login').show();
          $('#back-login').hide();
          $('#back-authen').hide();
          $('#next-authen').hide();
          $('#back-view').hide();
          $('#next-view').hide();

          $('#Username').addClass('btn-default');
          $('#Username').removeClass('btn-info');

          $('#Description').addClass('btn-info');
          $('#Description').removeClass('btn-default');

          $('#Authentication').addClass('btn-default');
          $('#Authentication').removeClass('btn-info');

          $('#view').addClass('btn-default');
          $('#view').removeClass('btn-info');
        })
        //----------------------------------------------------click Username
        $(document).on('click','#Username', function(){
          if($('#next-login').is(':disabled',true)){
            $('#modal-alert').modal('show');
            return false;
          }
          $('#tab-authen').hide();
          $('#tab-description').hide();
          $('#tab-username').show();
          $('#tab-view').hide();

          $('#next-login').hide();
          $('#back-login').show();
          $('#back-view').hide();
          $('#next-view').show();

          $('#Username').addClass('btn-info');
          $('#Username').removeClass('btn-default');

          $('#Description').addClass('btn-default');
          $('#Description').removeClass('btn-info');

          $('#Authentication').addClass('btn-default');
          $('#Authentication').removeClass('btn-info');

          $('#view').addClass('btn-default');
          $('#view').removeClass('btn-info');
        })
              //-----------------------------------------------------click view
        $(document).on('click','#view', function(){
          if($('#next-login').is(':disabled',true)){
            $('#modal-alert').modal('show');
            return false;
          }

          $('#tab-view').show();
          $('#tab-authen').hide();
          $('#tab-description').hide();
          $('#tab-username').hide();

          $('#next-login').hide();
          $('#back-login').hide();
          $('#back-authen').hide();
          $('#next-authen').hide();
          $('#back-view').show();
          $('#next-view').hide();

          $('#Username').addClass('btn-default');
          $('#Username').removeClass('btn-info');

          $('#Description').addClass('btn-default');
          $('#Description').removeClass('btn-info');

          $('#Authentication').addClass('btn-default');
          $('#Authentication').removeClass('btn-info');

          $('#btnSendAdd').prop('disabled',false);
          $('#view').addClass('btn-info');
          $('#view').removeClass('btn-default');
        })

        //---------------------------------------next login------------------------------------------
        $(document).on('click','#next-login',function(){
          $('#tab-description').hide();
          $('#tab-username').show();

          $('#next-login').hide();
          $('#back-login').show();
          $('#next-view').show();
          $('#back-view').hide();

          $('#Username').addClass('btn-info');
          $('#Username').removeClass('btn-default');

          $('#Description').addClass('btn-default');
          $('#Description').removeClass('btn-info');

          $('#Authentication').addClass('btn-default');
          $('#Authentication').removeClass('btn-info');

          $('#view').addClass('btn-default');
          $('#view').removeClass('btn-info');

        })
         $(document).on('click','#back-login',function(){
          $('#tab-description').show();
          $('#tab-username').hide();
          $('#tab-authen').hide();

          $('#next-login').show();
          $('#back-login').hide();
          $('#back-authen').hide();
          $('#next-authen').hide();
          $('#next-view').hide();
          $('#back-view').hide();

          $('#Username').addClass('btn-default');
          $('#Username').removeClass('btn-info');

          $('#Description').addClass('btn-info');
          $('#Description').removeClass('btn-default');

          $('#Authentication').addClass('btn-default');
          $('#Authentication').removeClass('btn-info');

          $('#view').addClass('btn-default');
          $('#view').removeClass('btn-info');


        })
       
         $(document).on('click','#back-view',function(){
          $('#tab-description').hide();
          $('#tab-username').show();

          $('#tab-view').hide();
          $('#next-login').hide();
          $('#back-login').show();
          $('#next-view').show();
          $('#back-view').hide();

          $('#Username').addClass('btn-info');
          $('#Username').removeClass('btn-default');

          $('#Description').addClass('btn-default');
          $('#Description').removeClass('btn-info');

          $('#Authentication').addClass('btn-default');
          $('#Authentication').removeClass('btn-info');

          $('#view').addClass('btn-default');
          $('#view').removeClass('btn-info');
        })

         $(document).on('click','#next-view',function(){
          $('#tab-authen').hide();
          $('#tab-description').hide();
          $('#tab-username').hide();
          $('#tab-view').show();

          $('#next-login').hide();
          $('#back-login').hide();
          $('#back-authen').hide();
          $('#next-authen').hide();
          $('#next-view').hide();
          $('#back-view').show();

          $('#Username').addClass('btn-default');
          $('#Username').removeClass('btn-info');

          $('#Description').addClass('btn-default');
          $('#Description').removeClass('btn-info');

  
          $('#Authentication').addClass('btn-default');
          $('#Authentication').removeClass('btn-info');

          $('#view').addClass('btn-info');
          $('#view').removeClass('btn-default');

          $('#btnSendAdd').prop('disabled',false);
        })

        $(document).on('click', '.authen-active', function(){
          $('.authen-active').removeClass('active-authen');
          $(this).addClass('active-authen');
        });

        $(document).on('click', '#img-upload', function(){
          $('.btn-file :file').trigger('click');
        })
        //------------------------------------------------------------------------------------------------input employee-------------------------------------------------------------------------------
        $(document).on('keyup', '#employee-name', function(){
          var name = $(this).val();
          if(name!=''){
            $('#employee-name-text').hide();
            $('#employee-name-text').removeClass('warning-text-check');
          }else{
            $('#employee-name-text').show();
            $('#employee-name-text').addClass('warning-text-check');
          }

          var i =0;
          $('.warning-text-check').each(function(){
            i++;            
          });

          if(i==0){
            $('#next-login').prop('disabled',false);
          }else{
            $('#next-login').prop('disabled',true);
          }
          $('#name-ex').html(name);
        });

        $(document).on('keyup', '#employee-sur', function(){
          var name = $(this).val();
          if(name!=''){
            $('#employee-sur-text').hide();
            $('#employee-sur-text').removeClass('warning-text-check');
          }else{
            $('#employee-sur-text').show();
            $('#employee-sur-text').addClass('warning-text-check');
          }

          var i =0;
          $('.warning-text-check').each(function(){
            i++;            
          });

          if(i==0){
            $('#next-login').prop('disabled',false);
          }else{
            $('#next-login').prop('disabled',true);
          }
          $('#sur-ex').html(name);
        });
        $(document).on('change', '#employee-date', function(){
          var name = $(this).val();
          if(name!=''){
            $('#employee-birth-text').hide();
            $('#employee-birth-text').removeClass('warning-text-check');
          }else{
            $('#employee-birth-text').show();
            $('#employee-birth-text').addClass('warning-text-check');
          }

          var i =0;
          $('.warning-text-check').each(function(){
            i++;            
          });

          if(i==0){
            $('#next-login').prop('disabled',false);
          }else{
            $('#next-login').prop('disabled',true);
          }

        });
        $(document).on('keyup', '#employee-code', function(){
          var name = $(this).val();
          if(name.length >= 13){
            $('#employee-code-text').hide();
            $('#employee-code-text').removeClass('warning-text-check');
          }else{
            $('#employee-code-text').show();
            $('#employee-code-text').addClass('warning-text-check');
          }

          var i =0;
          $('.warning-text-check').each(function(){
            i++;            
          });
          
          if(i==0){
            $('#next-login').prop('disabled',false);
          }else{
            $('#next-login').prop('disabled',true);
          }
          $('#code-ex').html(name);
        });

        $(document).on('keyup', '#employee-opti', function(){
          var name = $(this).val()
          $('#posi-ex').html(name);
        })
//-----------------------------------------------------------------------------------------------------------------Input Username--------------------------------------
        $(document).on('keyup', '#employee-email', function(){
            var email = new String($(this).val());
            var v_email = email.indexOf('@');
            if(email==''){
              $('#employee-email-text').hide();
              $('#employee-email-text').removeClass('warning-text-check-b2');
            }else{
              if(v_email>0){
                var num = email.length;
                var sum = num-1;
                if(sum > v_email){
                  $('#employee-email-text').hide();
                  $('#employee-email-text').removeClass('warning-text-check-b2');
                }else{
                  $('#employee-email-text').show();
                  $('#employee-email-text').addClass('warning-text-check-b2');
                }
              }else{
                  $('#employee-email-text').show();
                  $('#employee-email-text').addClass('warning-text-check-b2');
              }
            }
          var i =0;
          $('.warning-text-check-b2').each(function(){
            i++;            
          });

          if(i==0){
            $('#next-authen').prop('disabled',false);
          }else{
            $('#next-authen').prop('disabled',true);
          }
        });      

         $(document).on('keyup', '#employee-user', function(){
          var username = $(this).val();
          var form = 'check_user_ex';
          if(username.length >= 4){
             $.ajax({  
                beforeSend:function(){
                  $('.spin-check').show();
                  $('.success-check').hide();
                  $('.wrong-check').hide();
                },
                complete:function(){
                  $('.spin-check').hide();
                },
                url:"functions.php",  
                method:"POST",  
                data: {username:username,
                       form:form},
                success:function(data){
                // alert(data);  
                if(data.status==0){
                  $('#employee-user-text').removeClass('warning-text-check-b2');
                  $('#employee-user-text').hide();
                  $('.wrong-check').show();
                  $('.success-check').hide();
                }else{
                  $('#employee-user-text').removeClass('warning-text-check-b2');
                  $('.success-check').show();
                  $('.wrong-check').hide();
                  $('#employee-user-text').hide(); 
                }
              }  
            });
          }else{
            $('.success-check').hide();
            $('.wrong-check').hide();
            $('#employee-user-text').show();
            $('#employee-user-text').addClass('warning-text-check-b2');
          }

          var i =0;
          $('.warning-text-check-b2').each(function(){
            i++;            
          });

          if(i==0){
            $('#next-authen').prop('disabled',false);
          }else{
            $('#next-authen').prop('disabled',true);
          }
        });        

        $(document).on('keyup', '#employee-pass', function(){
          var pass = $(this).val();
          var ck_pass = $('#employee-pass-again').val();
          if(pass != ''){
            $('#employee-pass-text').hide();
            $('#employee-pass-text').removeClass('warning-text-check-b2');
          }else{
            $('#employee-pass-text').show();
            $('#employee-pass-text').addClass('warning-text-check-b2');
          }

          if(pass == ck_pass){
            $('#employee-passA-text').hide();
            $('#employee-passA-text').removeClass('warning-text-check-b2');
            $('#employee-passA-again').removeClass('warning-text-check-b2');
            $('#employee-passA-again').hide();
          }else{
            $('#employee-passA-text').show();
            $('#employee-passA-text').addClass('warning-text-check-b2');
            $('#employee-passA-again').addClass('warning-text-check-b2');
            $('#employee-passA-again').show();    
          }

          var i =0;
          $('.warning-text-check-b2').each(function(){
            i++;            
          });
          if(i==0){
            $('#next-view').prop('disabled',false);
          }else{
            $('#next-view').prop('disabled',true);
          }
        });

        $(document).on('keyup', '#employee-pass-again', function(){
          var pass = $(this).val();
          var ck_pass = $('#employee-pass').val();
          if(pass != ''){
            if(pass == ck_pass){
              $('#employee-passA-text').hide();
              $('#employee-passA-text').removeClass('warning-text-check-b2');
              $('#employee-passA-again').removeClass('warning-text-check-b2');
              $('#employee-passA-again').hide();
            }else{
              $('#employee-passA-text').show();
              $('#employee-passA-text').addClass('warning-text-check-b2');
              $('#employee-passA-again').addClass('warning-text-check-b2');
              $('#employee-passA-again').show();
            }
          }else{
            $('#employee-passA-text').show();
            $('#employee-passA-text').addClass('warning-text-check-b2');
            $('#employee-passA-again').addClass('warning-text-check-b2');
            $('#employee-passA-again').show();
          }

          var i =0;
          $('.warning-text-check-b2').each(function(){
            i++;            
          });

          if(i==0){
            $('#next-view').prop('disabled',false);
          }else{
            $('#next-view').prop('disabled',true);
          }
        });


        //---------------------------------------clear form----------------------------------------------------------------------------------
        $(document).on('click', '.btnSendClear', function() {
          document.getElementById('frmADD').reset();
          $('#img-upload').attr('src', 'img/upload.jpg');
          $('#name-ex').html('');
          $('#sur-ex').html('');
          $('#code-ex').html('');
          $('#posi-ex').html('');
        });
     //------------------------------------------------------------ADD article--------------------------------------------------------------
        $(document).on('click', '.btnSendAdd', function(){ 
            if($('#next-view').is(':disabled',true) || $('#next-login').is(':disabled',true)){
              $('#modal-alert').modal('show');
              return false;
            } 
             var employee_user = $('#employee-user').val();
             var employee_pass = $('#employee-pass').val();
             var employee_pass_again = $('#employee-pass-again').val();

            if(employee_user == ''){
              $('#modal-alert').modal('show');
              return false;
            } 
            if(employee_pass == ''){
              $('#modal-alert').modal('show');
              return false;
            } 
            if(employee_pass_again == ''){
              $('#modal-alert').modal('show');
              return false;
            } 


            var formData = new FormData($('.upload-form-add')[0]);
              $.ajax({
                  beforeSend: function() {
                    // setting a timeout
                    $('#result_add').show();
                    $('#success_add').hide();
                    $('#loader_add').show();
                  },
                  complete: function() {
                      $('#loader_add').hide();
                      $('#success_add').show();  
                      setTimeout(function(){$("#result_add").hide(0)}, 10000);
                      $('#modal-default').modal('show');

                  },
                   type: "POST",
                   url: "functions.php",
                   data: formData,
                   processData: false,
                   contentType: false,
                   success: function(data) {
                    // alert(data);
                    // console.log(data);
                    document.getElementById('frmADD').reset();
                    $('#img-upload').attr('src', 'img/upload.jpg');
                    $('#name-ex').html('');
                    $('#sur-ex').html('');
                    $('#code-ex').html('');
                    $('#posi-ex').html('');
                  },
              });
          });

        $(document).on('click', '#btnYes', function (){
          location.href = "front-manage.php";
        })
      });
      
        //------------------------------------------------------------------------------------------------------validation--------------
        function startTime() {
          var today = new Date();
          var h = today.getHours();
          var m = today.getMinutes();
          var s = today.getSeconds();
          m = checkTime(m);
          s = checkTime(s);
          document.getElementById('realtime').innerHTML =
          h + ":" + m + ":" + s;
          var t = setTimeout(startTime, 500);
        }
        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }
               //----------------------------------------------Check isnumber-----------------------------------------------------------------
       function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
          }
        return true;
      } 
</script>


<script>

document.addEventListener('DOMContentLoaded', function () {
  var checkbox = document.querySelector('.check1');

  checkbox.addEventListener('change', function () {
    if (checkbox.checked) {
      // do this
      console.log('Checked');

      document.getElementById('MyPage').style.backgroundColor = "#00a65a";
      document.getElementById('MyPage').style.color = "#fafafa";



        status = 1;
        let status_val = new FormData();
        status_val.append('status',status);   

        // $.ajax({  
        //         url: "product_add_statusShow.php?id_product= ",  
        //         method: "POST",  
        //         data: status_val,  
        //         success:function(data)  
        //         {  
        //           // console.log(data);
        //           // alert(data);

        //                 setTimeout(function() {
        //                 swal.fire({
        //                     title: "บันทึกการเปลี่ยนแปลง !",
        //                     text: "สำเร็จ",
        //                     type: "success"
        //                   }).then(function() {
        //                     // window.location = "";
        //                   });
        //             }, 500);

        
        //         }  
        //    });

    // });

    } else {
      // do that
      console.log('Not checked');

      document.getElementById('MyPage').style.backgroundColor = "#00a65a99";
      document.getElementById('MyPage').style.color = "#0d61c0";


      status = 0;
        let status_val = new FormData();
        status_val.append('status',status);   

        // $.ajax({  
        //         url: "product_add_statusShow.php?id_product= ",  
        //         method: "POST",  
        //         data: status_val,  
        //         success:function(data)  
        //         {  
        //           // console.log(data);
        //           // alert(data);

        //                 setTimeout(function() {
        //                 swal.fire({
        //                     title: "บันทึกการเปลี่ยนแปลง !",
        //                     text: "สำเร็จ",
        //                     type: "success"
        //                   }).then(function() {
        //                     // window.location = "";
        //                   });
        //             }, 500);

        
        //         }  
        //    });

    }
  });
});


$( "#role" ).change(function() {
   var role = $('#role').val();

   $.ajax({
        url: "select_type_em.php?role="+role,
        type:"POST",
        data:{role:role},
        success:function(data){
          console.log(data);
           
     $('#tbody_type').html(data);
    

          
         
        }
      })

});
role();
function role(){
     var role = $('#role').val();

   $.ajax({
        url: "select_type_em.php?role="+role,
        type:"POST",
        data:{role:role},
        success:function(data){
          console.log(data);
           
     $('#tbody_type').html(data);
    

          
         
        }
      })
}




</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

</body>
</html>

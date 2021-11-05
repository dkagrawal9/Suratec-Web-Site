<!--  -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MCtive | Product</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link href="css/bootstrap-toggle.min.css" rel="stylesheet"> 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/iCheck/all.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <!-- upload template css-->
  <link rel="stylesheet" type="text/css" href="upload_file_template/style.css">

  <!--sweet alert -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css.map">
  <!-- Include external CSS. -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
  <!-- Include Editor style. -->
  <link href="../froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css">
  <link href="../froala/css/froala_style.min.css" rel="stylesheet" type="text/css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" type="text/css" href="css/modal_view.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">

  
  <style type="text/css">
    .control-label{
      padding-top: 7px;
      text-align: right;
      padding-right: 0px;
    }
    .input-group{
      margin-bottom: 13px;
    }
    .table-attribute th,td{
      padding: 5px;
    }
    .overlay-allpage{
      position: fixed;
      width: 100%;
      height: 100%;
      top:0;
      left:0;
      background-color: rgba(0,0,0,0.7);
      cursor: pointer;
      z-index: 999999;
    }
     /* transition: 0.5s;
    }*/
    .hidden-xy{
      overflow: hidden;
    }
    .overlay-allpage>.fa{
      position: absolute;
      color: white;
      top:50%;
      left:50%;
      font-size: 60px;
      margin-top: -35px;
      margin-left: -35px;
      z-index: 999999;
    }
    .text-image .fa{
      font-size: 40px;
    }
    table tr,td{
      vertical-align: top;
      height: 50px;
      border-bottom:1px solid #efefef;
    }
    .form-group{
      margin-bottom: 5px;
    }
    .btn-default.active{
      border:none;
    }
  /*  .btn-default:hover{
      border:none;
    }*/
    .btn-primary.active{
      border:none;
    }
/*    .btn-primary:hover{
      border:none;
    }*/
    .btn-success{
      background-color: #5cb85c;
      border: none;
    }
    .btn-warning{
      border:none;
    }
    .style{
      background-color: #e6e6e6;
       border:1px solid #b5b5b5;
      transition: 0.4s;
    }
    .style:hover{
      background-color: #f7f7f7;
      border:1px solid #b5b5b5;
      /*color: white;*/
    }
    .style:focus{
      color: white;
    }
    .check-active-ready{
      background-color:#4cad40 !important;
      border-color:#4cad40 !important; 
      color:white !important;
    }
    .check-active-ready:hover{
      background-color: white !important;
      border-color: #4cad40 !important;
      color: #4cad40 !important;
    }
    .check-active-soon{
      background-color:#FDA323 !important;
      border-color:#FDA323 !important;
      color:white !important;
    }
    .check-active-soon:hover{
      background-color: white !important;
      border-color: #FDA323 !important;
      color: #FDA323 !important;
    }
    .check-active-out{
      background-color:#FD6F3B !important;
      border-color:#FD6F3B !important;
      color:white !important;
    }
    .check-active-out:hover{
      background-color: white !important;
      border-color: #FD6F3B !important;
      color: #FD6F3B !important;
    }
    .check-active-des{
      background-color:#EFA694 !important;
      border-color: #EFA694 !important;
      color:white !important;
    }
    .check-active-des:hover{
      background-color: white !important;
      border-color:#EFA694 !important;
      color: #EFA694 !important;
    }
    .sweet-alert .sa-icon{
      margin-bottom: 35px;
    }
    /*
        .checkbox label{
          padding-left: 0;
          float: left;
        }
        .checkbox label:after, 
        .radio label:after {
            content: '';
            display: table;
            clear: both;
        }

        .checkbox .cr,
        .radio .cr {
            position: relative;
            display: inline-block;
            border: 1px solid #a9a9a9;
            background-color: #f2f2f2;
            color: white;
            width: 1.3em;
            height: 1.2em;
            float: left;
            margin-right: .5em;
            transition: 0.4s;
        }
        .checkbox .cr:hover{
          background-color: #FF9797;   
        }
        .active_widget{
          background-color: #FF9797 !important;
        }
        .radio .cr {
            border-radius: 50%;
        }

        .checkbox .cr .cr-icon,
        .radio .cr .cr-icon {
            position: absolute;
            font-size: .8em;
            line-height: 0;
            top: 50%;
            left: 20%;
        }

        .radio .cr .cr-icon {
            margin-left: 0.04em;
        }

        .checkbox label input[type="checkbox"],
        .radio label input[type="radio"] {
            display: none;
        }

        .checkbox label input[type="checkbox"] + .cr > .cr-icon,
        .radio label input[type="radio"] + .cr > .cr-icon {
            transform: scale(3) rotateZ(-20deg);
            opacity: 0;
            transition: all .3s ease-in;
        }

        .checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
        .radio label input[type="radio"]:checked + .cr > .cr-icon {
            transform: scale(1) rotateZ(0deg);
            opacity: 1;
        }

        .checkbox label input[type="checkbox"]:disabled + .cr,
        .radio label input[type="radio"]:disabled + .cr {
            opacity: .5;
        }
  </style>
  </head>
  <body class="hold-transition skin-blue sidebar-mini fixed" onload="startTime()">
  <div id="allpage" style="display: none">
    <img src="../image-folder/loaderpage.gif" class="fa" width="32" height="26">
  </div>
  <div class="wrapper">

  <header class="main-header">
     <!-- Logo -->
    <a href="../../index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="../image-folder/logo-meet-low.png" width="35" height="25"></span>
      <!-- logo for regular state and mobile devices -->
      <img src="../image-folder/logo-black.png" width="100px">
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../image-folder/suite.png" class="user-image" alt="User Image">
              <span class="hidden-xs">RAYONGSUIT</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../image-folder/suite.png" class="img-circle" alt="User Image">

                <p>
                  RAYONGSUIT
                  <small>since 1995</small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="http://mctive.com?id=1" class="btn btn-default btn-flat">ออกจากระบบ</a>
                </div>
              </li>
            </ul>
          </li>        
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../image-folder/suite.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><a href="http://www.mctive.com/rayongsuit" target="_blank" style="color: white;">RAYONGSUIT</a></p>
          <div id="realtime"></div>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">หน้าหลัก</li>
        <li>
          <a href="../../index.php">
            <i class="fa fa-dashboard"></i> <span>แดชบอร์ด</span>
            <span class="pull-right-container">
              <!-- <small class="label pull-right bg-green">new</small> -->
            </span>
          </a>
        </li>
        <li class="header">บริหารสินค้า</li>
        <li class="treeview active">
          <a href="#">
            <i class="ion ion-bag"></i>
            <span>สินค้า</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="#"><i class="fa fa-caret-right"></i>เพิ่มสินค้า</a></li>
            <li><a href="front-manage.php"><i class="fa fa-caret-right"></i>จัดการสินค้า</a></li>
          <!--   <li><a href="front-info.php"><i class="fa fa-caret-right"></i>จัดการคุณลักษณะสินค้า</a></li> -->
            <li><a href="front-catagory.php"><i class="fa fa-caret-right"></i>จัดการหมวดหมู่สินค้า</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-line-chart"></i>
            <span>บริหารการขาย</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-caret-right"></i>รายงานสั่งซื้อ</a></li>
            <li><a href="#"><i class="fa fa-caret-right"></i>รายงานสินค้าขายดี</a></li>
            <li><a href="#"><i class="fa fa-caret-right"></i>รายงานการเข้าชมสินค้า</a></li>
            <li><a href="#"><i class="fa fa-caret-right"></i>จัดการสต๊อกสินค้า</a></li>
            <li><a href="#"><i class="fa fa-caret-right"></i>รายงานการชำระเงิน</a></li>
          </ul>
        </li>
        <li class="header">บริหารหน้าหลัก</li>
        <li>
          <a href="../manage-logo.php">
            <i class="fa fa-gg"></i> <span>จัดการโลโก้</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li>
          <a href="../manage-slide.php">
            <i class="fa fa-clone"></i> <span>จัดการสไลด์</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li>
          <a href="../manage-menu.php">
            <i class="fa fa-list-ul"></i> <span>จัดการเมนู</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-send-o"></i>
            <span>หน้าอิสระ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../freedom_page/front-add.php"><i class="fa fa-caret-right"></i>เพิ่มหน้าอิสระ</a></li>
            <li><a href="../freedom_page/front-manage.php"><i class="fa fa-caret-right"></i>จัดการหน้าอิสระ</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-sticky-note-o"></i>
            <span>จัดการบทความ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../article/front-add.php"><i class="fa fa-caret-right"></i>เพิ่มบทความ</a></li>
            <li><a href="../article/front-manage.php"><i class="fa fa-caret-right"></i>จัดการบทความ</a></li>
            <li><a href="../article/front-catagory.php"><i class="fa fa-caret-right"></i>จัดการหมวดหมู่</a></li>
          </ul>
        </li>
<!--         <li class="treeview">
          <a href="#">
            <i class="fa fa-connectdevelop"></i>
            <span>จัดการแบรนด์</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../brand/front_brand-add.php"><i class="fa fa-caret-right"></i>เพิ่มแบรนด์</a></li>
            <li><a href="../brand/front-manage.php"><i class="fa fa-caret-right"></i>จัดการแบรนด์</a></li>
          </ul>
        </li>
        <li>
          <a href="manage-first.php">
            <i class="glyphicon glyphicon-home"></i> <span>จัดการหน้าแรก</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <h1>
        เพิ่มสินค้า
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"></i> แดชบอร์ด</a></li>
        <li class="active">เพิ่มสินค้า</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-warning collapsed-box" >
        <div class="box-header with-border">
          <h3 class="box-title">คำแนะนำการใช้งาน</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div style="padding-left: 10px;">
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;การเพิ่มสินค้า ควรสร้างหมวดหมู่สินค้าก่อน เพื่อจัดกลุ่มสินค้าในเว็บไซต์ เช่น ขายเสื้อยืดคอวี ควรมีการสร้างหมวดหมู่ เสื้อผ้าแฟชั่นผู้หญิง เอาไว้ก่อนเพิ่มสินค้า<br>
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถสร้างหมวดหมู่สินค้าเร่งด่วนได้ที่ หมวดหมู่สินค้า และคลิกปุ่ม เพิ่ม และกรอกชื่อหมวดหมู่สินค้าตามต้องการ<br>  
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถเพิ่มยี่ห้อสินค้าใหม่ได้ที่ ยี่ห้อสินค้า และคลิกปุ่ม เพิ่ม และกรอกชื่อหมวดหมู่สินค้าตามต้องการ หรือเลือกยี่ห้อเดิมที่มีอยู่ได้เลย<br> 
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถใส่รายละเอียดสินค้าเพิ่มเติม เช่น รหัสสินค้า , แท็กของสินค้าได้ เป็นต้น<br>
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถตั้งค่าสิทธิการเข้าดูข้อมูลสินค้า เฉพาะสมาชิกได้<br>
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถเลือกป้ายสถานะให้สินค้าได้หลายแบบ เช่น สินค้าใหม่ , สินค้ายอดนิยม , สินค้าแนะนำ และสินค้าลดราคา เป็นต้น<br>
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถตั้งเวลาเปิด - ปิดการแสดงผลของสินค้าได้ โดยเลือกสถานะ เปิด และกำหนดวันที่แสดงผล และหมดอายุ<br>
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถตั้งค่า คะแนนสะสม ของสินค้า กรณีที่ลูกค้าสั่งซื้อสินค้าดังกล่าว จะได้รับคะแนนสะสมตามที่คุณตั้งค่าไว้<br> 
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถกำหนดให้หน้ารายละเอียดสินค้า แสดงสินค้าที่เกี่ยวข้องจาก สินค้าที่อยู่ในหมวดหมู่เดียวกัน , สินค้าที่มี Tags เดียวกัน หรือกำหนดสินค้าที่จะแสดงได้เอง<br>
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถใส่รูปภาพสินค้าได้มากกว่า 1 รูป ขนาดรูปภาพไม่ควรเกิน 500KB รองรับไฟล์นามสกุล .jpg, .gif, .png<br> 
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถกำหนดราคาสินค้าได้หลายรูปแบบ ราคาขาย , ราคาปกติ , ระบุราคาแบบข้อความ<br>
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถกำหนด จำนวนสินค้าคงเหลือ หรือสต็อกสินค้าได้<br>
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถเพิ่มน้ำหนักสินค้าหน่วยเป็นกรัมได้<br>
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถกำหนดจำนวนสั่งซื้อขั้นต่ำต่อสินค้าชิ้นนี้ได้<br>
          </div>
        </div>
        <!-- /.box-body -->
      </div>

      <div class="row">
          <div class="col-md-8">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">ชื่อสินค้า</h3>
              </div>
              <div class="box-body">
                <div class="input-group" style="margin-bottom: 0;">
                  <span class="input-group-addon"><i class="fa fa-header"></i></span>
                  <input type="text" class="form-control" id="product_name" name="product_name" placeholder="ชื่อสินค้า" onkeyup="checklength()">
                </div>
              </div>
            </div>

            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">คำอธิบายเกี่ยวกับสินค้า</h3>
              </div>
              <div class="box-body">
                <div id="editor" style="margin-top: 10px;">
                  <textarea id='edit' name="editor" style="margin-top: 20px;"></textarea>
                </div>
              </div>
            </div>
            <!-- /.box -->
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">รูปภาพสินค้า</h3>
              </div>
              <div class="box-body">
                <div id="live-thumb" style="padding-left: 10px; padding-right: 10px;"></div>
              </div>
              <div id="check_upload" class="overlay" style="display: none;">
              	<i class="fa fa-spinner fa-spin" style="color:#228896;"></i>
              </div>
              <div class="box-footer" style="border-top: none;">
              	<form class="upload-form-add-thumbnail"  method="post" enctype="multipart/form-data" id="frmADD_thumbnail">
			          <div class="input-group">
	                  <span class="input-group-btn">
	                  	<span class="btn btn-default btn-file remove" style="background-color: #ff4e4e !important; color:white; display: none;">
	                      <i class="glyphicon glyphicon-trash"></i>&nbsp;&nbsp;ลบทั้งหมด 
	                    </span>
	                    <span class="btn btn-default btn-file" style="background-color: white !important;">
	                      <i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;&nbsp;เลือกรูปภาพ 
	                      <input type="file" name="files[]" method="post" entype="multipart/form-data" multiple class="upload-form-add-thumbnail checkfile" id="files">
	                    </span>
	                  </span>
                    <span style="float: right; padding-top: 15px;"><b>คำแนะนำ: </b>คลิกที่ภาพเพื่อเลือกเป็นภาพหน้าปกสินค้า</span>
               	 	</div>
              	</form>
              </div>
            </div>
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">ราคาสินค้า</h3>
              </div>
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active normal"><a href="#normal" data-toggle="tab">สินค้ามีแบบเดียว</a><input id="tab1" type="radio" name="tabcheck" hidden></li>
                    <li class="objective"><a href="#objective" data-toggle="tab">สินค้าหลายรูปแบบ</a><input id="tab2" type="radio" name="tabcheck" hidden></li>
                    <!-- <li class="fixtext"><a href="#fixtext" data-toggle="tab">สินค้าแบบเดียวระบุข้อความ</a><input id="tab3" type="radio" name="tabcheck" hidden></li> -->
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="normal">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="group">
                            <label for="variant_price" class="col-sm-4 control-label">ราคาขาย</label>
                            <div class="col-sm-7">
                              <div class="js-validate-group">
                                <div class="input-group">
                                  <div class="required">
                                    <input type="text" name="price" id="variant_price" value data-parsley-type="number" class="form-control numeric" onkeypress="return isNumber_s(event);" onkeyup="formatMoney_s(value);">
                                  </div>
                                  <span class="input-group-addon">THB</span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="group">
                            <label for="variant_price" class="col-sm-4 control-label">ราคาปกติ</label>
                            <div class="col-sm-7">
                              <div class="js-validate-group">
                                <div class="input-group">
                                  <div class="required">
                                    <input type="text" name="price" id="variant_price_normal" value data-parsley-type="number" class="form-control numeric" onkeypress="return isNumber_n(event);" onkeyup="formatMoney_n(value);">
                                  </div>
                                  <span class="input-group-addon">THB</span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="group">
                            <label for="variant_price" class="col-sm-4 control-label">SKU</label>
                            <div class="col-sm-7">
                              <div class="js-validate-group">
                                <div class="input-group">
                                  <div class="required">
                                    <input type="text" name="price" id="variant_SKU" value data-parsley-type="number" class="form-control numeric">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="group">
                            <label for="variant_price" class="col-sm-4 control-label">สต็อก</label>
                            <div class="col-sm-7">
                              <div class="js-validate-group">
                                <div class="input-group">
                                  <div class="required">
                                    <input type="text" name="price" id="variant_stock" value data-parsley-type="number" class="form-control numeric" onkeypress="return isNumber(event);">
                                  </div>
                                  <span class="input-group-addon">U</span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="group">
                            <label for="variant_price" class="col-sm-4 control-label">น้ำหนัก</label>
                            <div class="col-sm-7">
                              <div class="js-validate-group">
                                <div class="input-group">
                                  <div class="required">
                                    <input type="text" name="price" id="variant_weight" value data-parsley-type="number" class="form-control numeric" onkeypress="return isNumber(event);">
                                  </div>
                                  <span class="input-group-addon">G</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                         <?php
                          include("../Connect/back_connectDB.php");
                          $str = "SELECT * FROM product_image_thumb WHERE active = 'active'";
                          $query = mysqli_query($objConnect,$str);
                          $result = mysqli_fetch_array($query);
                          $row = mysqli_num_rows($query);
                          if($row > 0){
                            $path = "image_product/thumbnail/".$result['name_thumb'];
                          }else{
                            $path = "../image-folder/suit.jpg";
                          }
                         ?>
                        <div class="col-sm-5 price-preview" align="center">
                          <div style="width: 180px; border: 1px solid #ede7e7;">
                            <div style="width:180px; height:118px; position:relative; padding-bottom: 10px;" align="center">
                              <img id="img-preview" src="<?php echo $path; ?>" style="width:auto; height:auto; max-width:100%; max-height:100%; cursor: pointer;">
                            </div>
                            <div class="caption" style="padding-bottom: 10px;">
                              <h5 id="normal_price" style="display: none;">ราคาปกติ: <strike><span id="price_n" style="color:#ff5858;"></span></strike>
                              </h5>
                              <h5>ราคาขาย : <span id="price_s" style="color:green; font-size:18px;"></span>
                              </h5>
                            </div>
                            <button type="button" class="btn btn-primary btn-block" style="border-radius: 0px; padding-bottom: 5px;" disabled>Add to cart</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane objective" id="objective"> 
                      <form method="post" id="frm_attribute">
                      <table class="table-attribute" id="table-attribute">
                        <tbody>
                          <tr>
                            <td height="50">
                              <button class="btn btn-block" style="height: 100% !important; padding: 5px;" disabled><i class="glyphicon glyphicon-trash"></i></button>
                              <!-- <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-trash"></i></button> -->
                            </td>
                            <!-- <td>
                              <img src="../image-folder/suit.jpg" width="35" height="35">
                            </td> -->
                            <td>
                              <div class="input-group" style="margin-bottom: 0; padding-bottom: 5px;">
                                <span class="input-group-addon" style="background-color: #228896; color:white; width: 57px;">สี</span>
                                <input type="text" name="color[]" class="form-control a_color" style="border-radius: 2px;" placeholder="ตัวอย่าง : สีดำ">
                              </div>
                              <div class="input-group" style="margin-bottom: 0; padding-bottom: 5px;">  
                                <span class="input-group-addon" style="background-color: #228896; color:white;">ขนาด</span>  
                                <input type="text" name="size[]" class="form-control a_size" style="border-radius: 2px;" placeholder="ตัวอย่าง : S,M,L">
                              </div>
                              <div class="input-group" style="margin-bottom: 0;">  
                                <span class="input-group-addon" style="background-color: #228896; color:white; width: 57px;">SKU</span>  
                                <input type="text" name="SKU[]" class="form-control a_sku" style="border-radius: 2px;" placeholder="ตัวอย่าง : SS-MM-BL-42">
                              </div>
                            </td>
                            <td>
                              <div class="input-group" style="margin-bottom: 0; padding-bottom: 5px;">  
                                <span class="input-group-addon" style="background-color: #228896; color:white; width: 79px;">ราคาขาย</span>                    
                                <input type="text" name="price[]" class="form-control a_price" style="border-radius: 2px;" placeholder="ตัวอย่าง : 1,999">
                                <span class="input-group-addon">THB</span>
                              </div>
                              <div class="input-group" style="margin-bottom: 0;"> 
                                <span class="input-group-addon" style="background-color: #228896; color:white;">ราคาปกติ</span>
                                <input type="text" name="normal[]" class="form-control a_price_normal" style="border-radius: 2px;" placeholder="ตัวอย่าง : 2,999">
                                <span class="input-group-addon">THB</span>
                              </div>
                            </td>
                            <td>    
                              <div class="input-group" style="margin-bottom: 0; padding-bottom: 5px;">  
                                <span class="input-group-addon" style="background-color: #228896; color:white; width: 65px;">สต็อก</span>                    
                                <input type="text" name="stock[]" class="form-control a_stock" style="border-radius: 2px;" placeholder="ตัวอย่าง : 100">
                                <span class="input-group-addon">U</span>
                              </div>
                              <div class="input-group" style="margin-bottom: 0;"> 
                                <span class="input-group-addon" style="background-color: #228896; color:white; border-color: #228896;">น้ำหนัก</span>
                                <input type="text" name="weight[]" class="form-control a_weight" style="border-radius: 2px;" placeholder="ตัวอย่าง : 52">
                                <span class="input-group-addon"> G </span>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      </form>
                      <!-- <button type="button" class="btn btn-warning" style="border:none;" id="Add-attribute"><i class="fa fa-plus"></i>ทดสอบ AJAX</button> -->
                      <button type="button" class="btn btn-success" style="border:none;" id="Add-attribute" onclick="Addattribute();"><i class="fa fa-plus"></i> เพิ่มแบบ</button>              
                    </div>
                    <div class="tab-pane" id="fixtext">
                      <div class="row" style="padding-bottom: 14px;">
                        <div class="col-sm-6">
                          <div class="group">
                            <label for="variant_price" class="col-sm-4 control-label">ราคาขาย</label>
                            <div class="col-sm-7">
                              <div class="js-validate-group">
                                <div class="input-group">
                                  <div class="required">
                                    <input type="text" name="price" id="price_text_check" value data-parsley-type="number" class="form-control numeric" placeholder="ตัวอย่าง: ติดต่อร้าน" onkeyup="show_text(value);">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-5 price-preview" align="center">
                          <div style="width: 180px; border: 1px solid #ede7e7;">
                            <div style="width:180px; height:118px; position:relative; padding-bottom: 10px;" align="center">
                              <img id="img-preview" src="../image-folder/suit.jpg" style="width:auto; height:auto; max-width:100%; max-height:100%; cursor: pointer;">
                            </div>
                            <div class="caption" style="padding-bottom: 10px;">
                              <h5>ราคาขาย : <span id="price_text" style="display:none; color: #bcbcbc;"></span>
                              </h5>
                            </div>
                            <button type="button" class="btn btn-primary btn-block" style="border-radius: 0px; padding-bottom: 5px;" disabled>Add to cart</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
              </div>
          </div>
          <!-- /.col (left) -->
          <div class="col-md-4">
            <!-- iCheck -->
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">หมวดหมู่สินค้า</h3><button type="button" class="btn btn-default btn-xs pull-right" onclick="javascript:location.href='front-catagory.php'">จัดการหมวดหมู่</button>
              </div>
              <div class="box-body" style="padding-left: 20px; padding-right: 20px;">
                <div id="catagory"></div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer" style="padding-left: 20px; padding-right: 20px;">
                <button type="button" class="btn btn-sm show-add" style="background: #838383; color: white;"><i class="fa fa-plus"></i>&nbsp;&nbsp;เพิ่ม</button>
                <div id="add-cat" class="form-group" style="padding-top: 15px; display: none;">
                  <div class="input-group">
                    <input type="text" name="name" id="name_cat" class="form-control" placeholder="กรุณากรอกชื่อหมวดหมู่" onkeyup="checklengthcat()">
                    <!-- /btn-group -->
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-info btnSendAddCat" id="btnSendAddCat"  style="float: right; transition: 0.4s;" disabled>
                        <i class="fa fa-spinner fa-spin" id="loader_cat" style="display: none;"></i>
                        <i class="fa fa-check" id="success_cat"></i>&nbsp;บันทึก</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                คุณสามารถเพิ่ม/ลบ/แก้ไขหมวดหมู่ได้ในหน้าจัดการหมวดหมู่
              </div>
            </div>
            <!-- /.box -->
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">สถานะเกี่ยวกับสินค้า</h3>
              </div>
              <div class="box-body" style="padding-left: 20px; padding-right: 20px;">
                <span>สถานะการขาย</span>
                <div class="btn-group" style="width: 100%; padding-top: 5px;">
                  <button id="tickChk_status1" class="btn style check-active-ready" style="width: 25%; min-width: 70px;" onclick="tickChk_status(1,'soon','out','des','ready')">มีจำหน่าย</button>
                  <button id="tickChk_status2" class="btn style" style="width: 25%; min-width: 50px;" onclick="tickChk_status(2,'ready','out','des','soon')">เร็วๆนี้</button>
                  <button id="tickChk_status3" class="btn style" style="width: 25%; min-width: 70px;" onclick="tickChk_status(3,'ready','soon','des','out')">สินค้าหมด</button>
                  <button id="tickChk_status4" class="btn style" style="width: 25%; min-width: 80px;" onclick="tickChk_status(4,'ready','soon','out','des')">เลิกจำหน่าย</button>
                </div>
                <ul style="list-style-type: none; padding-left: 0px; display: none;">
                  <li>
                    <input id="status1" type="radio" name="status_product[]" value="มีจำหน่าย" checked>
                    มีจำหน่าย
                  </li>
                  <li>
                    <input id="status2" type="radio" name="status_product[]" value="เร็วๆนี้">
                    เร็วๆนี้
                  </li>
                  <li>
                    <input id="status3" type="radio" name="status_product[]" value="สินค้าหมด">
                    สินค้าหมด
                  </li>
                  <li>
                    <input id="status4" type="radio" name="status_product[]" value="เลิกจำหน่าย">
                    เลิกจำหน่าย
                  </li>
                </ul>
              </div>
              <div class="box-footer" style="padding-left: 20px;">
                <span>สถานะสินค้า</span>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"  data-toggle="toggle" id="sign_status1" name="sign_product[]" value="สินค้าพรีออเดอร์" data-size="small">
                      สินค้าพรีออเดอร์
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input id="sign_status2" data-toggle="toggle" type="checkbox" name="sign_product[]" value="สินค้าใหม่" data-size="small">
                        สินค้าใหม่
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input id="sign_status3" data-toggle="toggle" type="checkbox" name="sign_product[]" value="สินค้ายอดนิยม" data-size="small">
                        สินค้ายอดนิยม
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                       <input id="sign_status4" data-toggle="toggle" type="checkbox" name="sign_product[]" value="สินค้าแนะนำ" data-size="small">
                        สินค้าแนะนำ
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                       <input id="sign_status5" id="sign_status5" data-toggle="toggle" type="checkbox" name="sign_product[]" value="สินค้าลดราคา" data-size="small">
                        สินค้าลดราคา
                    </label>
                  </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer" style="padding-left: 20px; padding-right: 20px;">
                <div class="row">
                  <div class="col-md-6" style="padding: 15px;">
                    <span>ความพร้อมในการจัดส่ง</span>
                  </div>
                  <div class="col-md-6" align="right">
                    <div class="checkbox">
                      <label>
                        <input id="transport" data-toggle="toggle" type="checkbox" name="transport" value="1" data-size="normall" data-on="พร้อมส่ง" data-off="สั่งตัด" data-onstyle="success" data-offstyle="warning" checked>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            <!-- /.box -->
          </div>
          <!-- /.col (right) -->
        <!-- /.col -->
        </div>
        <!-- /.row -->
     
        <div class="boxsave">
          <button type="button" class="btn btn-info pull-right btnSendAdd" id="btnSendAdd" style="transition: 0.4s; margin-left: 5px;" disabled><i class="fa fa-check"></i>&nbsp;บันทึก</button>
          <button type="button" class="btn btn-warning pull-right btnSendClear" id="btnSendClear" style="border:1px solid #e08e0b;"><i class="fa fa-remove"></i>&nbsp;เคลียร์</button>
      </div>
      <div class="modal fade" id="modal-exists">
      	
          <div class="modal-dialog">
            <div class="modal-content">
            	<div class="box box-danger box-solid" style="border:none;">
            		<div class="box-body" style="padding:0px;">
		              <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                  <span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i>คำเตือน</h4>
		              </div>
		              <div class="modal-body">
		                <div id="image">
		                  	<center>
		                  		<img src="../image-folder/warning.png" width="60" height="60">
		                  			<h4>คุณมีการทำงานค้างอยู่ที่ยังทำไม่เสร็จ จะดำเนินการต่อหรือไม่</h4>
		                  			<h5 style="color:orange;">ถ้าเลือก ยกเลิกการทำ จะเป็นการล้างข้อมูลที่ทำค้างอยู่ทั้งหมด</h5>
		                  	</center>
		                </div>          
		              </div>
		              <div class="modal-footer">
		                <button type="button" class="btn btn-danger btnSendDeleteAll">ยกเลิกการทำ</button>
		                <button type="button" class="btn btn-primary" data-dismiss="modal">ดำเนินการต่อ</button>
		              </div>
		            </div>
		            <div id="check-exists" class="overlay" style="display: none;">
		            	<i class="fa fa-spinner fa-spin" style="color:#228896;"></i>
		            </div>
	             </div>
              </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<!-- Include external JS libs. -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>
<!-- Include JS files. -->
<script type="text/javascript" src="../froala/js/froala_editor.pkgd.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script src="js/bootstrap-toggle.min.js"></script>
<script>
 $(function() {
          $('#edit').froalaEditor({
            language: 'ar',
            heightMin: 300,
            heightMax: 400,
            imageUploadURL:"upload.php",
            imageUploadParam:"fileName",
            imageManagerLoadMethod:"GET",
            imageManagerLoadURL:"select.php",
            imageManagerDeleteURL:"delete.php",
            imageManagerDeleteMethod:"POST"

          }).on('froalaEditor.image.uploaded', function (e, editor, response) {
            console.log(response);
          }).on('froalaEditor.imageManager.beforeDeleteImage', function (e, editor, $img) {
            console.log($img);
          }).on('froalaEditor.imageManager.imageDeleted', function (e, editor, res) {
            console.log(res);
          });
  //iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass   : 'iradio_minimal-blue'
  });
 $(".show-add").click(function(){
    $("#add-cat").toggle();
 });  
});
//----------------------------------------------Check length for open button save(forcategory)------------------------------------------
function checklengthcat() {
var input = document.getElementById("name_cat") ;
    if(input.value.length > 0)
    {
      document.getElementById("btnSendAddCat").disabled = false;
    }else{
      document.getElementById("btnSendAddCat").disabled = true;
    }
  }
//-------------------------------------------------------------------------------------------------------------------------------------- 
$(document).ready(function(){
 	function fetch_thumb(){
 		$.ajax({
 			url: "select_data_thumb.php",
 			method: "POST",
 			success:function(data){
 				$("#live-thumb").html(data);
 			}
 		});
 	}
 	fetch_thumb();
  function fetch_data_cat()  {  
    $.ajax({  
      url:"select_cat.php",  
      method:"POST",  
      success:function(data){  
        $('#catagory').html(data);  
      }  
    });  
  }  
  fetch_data_cat();
 	function fetch_exists(){
    // alert('yes');
 		$.ajax({
 			url: "select_data_exists.php",
 			method: "POST",
 			success:function(data){
 				if(data == "Yes"){
 					$("#modal-exists").modal('show');
 				}
 			}
 		});
 	}
 	fetch_exists();

 	function fetch_btnremove(){
 		$.ajax({
 			url: "select_data_exists.php",
 			method: "POST",
 			success:function(data){
 				if(data == "Yes"){
 					$(".remove").show();
 				}else{
 					$(".remove").hide();
 				}
 			}
 		});
 	}
 	fetch_btnremove();
  //--------------------------------------------------------------------------------add catagory----------------------------
  $(document).on('click', '.btnSendAddCat', function(){ 
    var name = $("#name_cat").val();
      $.ajax({
        beforeSend: function() {
        // setting a timeout
          $('#loader_cat').show();
          $('#success_cat').hide();
        },
        complete: function() {
         $('#loader_cat').hide();
         $('#success_cat').show();
        },
        type: "POST",
        url: "back_catagory-add.php",
        data: 'name='+name,
        success: function(data) {
        fetch_data_cat();
        $('#name_cat').val('');
        },
      });
   });
 	$(document).on('click', '.btnSendDeleteAll', function(){
 		$.ajax({
 				beforeSend: function() {
          $("#check-exists").show();
        },
        complete: function() {
          $("#modal-exists").modal('hide');
          $('#img-preview').attr('src', '../image-folder/suit.jpg');
        },
        url:'select_data_DeleteAll.php',              
          success:function(data){
          fetch_btnremove();
          fetch_thumb();
        },  
 		})
 	})
  $(".normal").on('click', function(){
      // alert('normal');
      document.getElementById('tab1').checked = true;
  });
  $(".objective").on('click', function(){
      // alert('objective');
      document.getElementById('tab2').checked = true;
  });

 	//------------------------------------------------------------------remove image all--------------------------------------------------
 	$(document).on('click', '.remove', function(){
 		$.ajax({
 				beforeSend: function() {
                   $("#check_upload").show();
                },
                complete: function() {
                   $("#check_upload").hide();
                   $('#img-preview').attr('src', '../image-folder/suit.jpg');
                },
                url:'select_data_DeleteAll.php',              
                success:function(data){
                  fetch_thumb();
                  fetch_btnremove();
                },  
 		});
 	});
 	$(document).on('change', '#files', function(){
 		var formData = new FormData($('.upload-form-add-thumbnail')[0]);
 		$.ajax({
 				     beforeSend: function() {
              $("#check_upload").show();
              },
              complete: function() {
              $("#check_upload").hide();
                },
	 			      method: "POST",
	            url: "back_product_add-thumbnail.php",
	           	data: formData,
	            cache: false,
              contentType: false,
              processData: false,
	            success: function(data) {
                $('#img-preview').attr('src', 'image_product/thumbnail/'+data);
	            	fetch_thumb(); //--------------refresh image area
	            	fetch_btnremove(); //----------refresh btn remove
	            	// document.getElementById('frmADD_thumbnail').reset();//------------------refresh box
            },
        });
 	});
 	$(document).on('click', '.btnSendAdd', function(){
 		var name = $('#product_name').val();
    var editor = $('#edit').val();
    var old_price = $('#variant_price').val();
    var price = new String(old_price.replace(",",""));
    var old_normal = $('#variant_price_normal').val();
    var normal = new String(old_normal.replace(",",""));
    var SKU = $('#variant_SKU').val();
    var stock = $('#variant_stock').val();
    var weight = $('#variant_weight').val();
    if($('#transport').is(':checked')){
      var transport = "1";
    }else{
      var transport = "0";
    }
    if($('#tab2').is(':checked')){
      var tab = "1";
      var a_price = $('.a_price').val();
      var a_price_normal = $('.a_price_normal').val();
      var a_color = $('.a_color').val();
      var a_size = $('.a_size').val();
      if(a_size == "" && a_color == ""){
        swal("คำเตือน", "คุณยังไม่ได้ไส่แบบสินค้า กรุณาใส่สีหรือขนาดและราคาเพื่อแจำแนกแบบสินค้า", "warning")
        return false;
      }
    }else{
      var tab = "0";
      if(price == ""){
        swal("คำเตือน", "คุณยังไม่ได้ไส่ราคาสินค้า", "warning")
        return false;
      }
    }

    if($(".check_cat:checked").length==0){ // ถ้าไม่มีการเลือก checkbox ใดๆ เลย  
        swal("คำเตือน", "คุณยังไม่ได้เลือกหมวดหมู่สินค้า", "warning")
        return false;
    }
   if(!$('.discard').hasClass('overlay-cover')){
        swal({
          title: "ไม่มีรูปภาพ",
          text: "คุณยังไม่ได้เลือกรูปภาพสินค้า",
          imageUrl: '../image-folder/noimage.png'
        });
        return false;
    }
    //---------------------------------------------------for id_catagory
    var count_cat = $('#count_cat').val();
    var id_catagory = '';
    for(var i=1;i<=count_cat;i++){
      if($('#id_product-catagory' + i).is(":checked")){
        var catagory_value = $('#id_product-catagory'+i).val();
        id_catagory += catagory_value+',';
      }
    }
    // alert(id_catagory);
    // alert(id_catagory);
    //---------------------------------------------------for id_status
    // var count_cat = $('#count_status').val();
    var sign_status = '';
    for(var i=1;i<=5;i++){
      if($('#sign_status' + i).is(":checked")){
        var sign_status_value = $('#sign_status'+i).val();
        sign_status += sign_status_value+',';
      }
    }
     // alert(sign_status);
    // alert(status);
    //----------------------------------------------------send value
    var status = '';
    for(var i=1;i<=5;i++){
      if($('#status' + i).is(":checked")){
        var status_value = $('#status'+i).val();   
      }
    }
    // alert(status_value);
    //----------------------------------------------------send value
     swal({
      title: "ยืนยัน?",
      text: "ยืนยันการเพิ่มสินค้า",
      type: "info",
      showCancelButton: true,
      cancelButtonText: "ยกเลิก",
      confirmButtonText: "ยืนยัน",
      closeOnConfirm: false,
      showLoaderOnConfirm: true
    }, function () {
      $.ajax({
            type: "POST",
            url: "back_product_add.php",
            data: {name: name,
                   editor: editor,
                   id_catagory: id_catagory,
                   sign_status: sign_status,
                   status_value: status_value,
                   price: price,
                   normal: normal,
                   SKU: SKU,
                   stock: stock,
                   weight: weight,
                   tab: tab,
                   tran: transport},
            success: function(data) {
              alert(data);
                  var id = data;
                  var formData = new FormData($('#frm_attribute')[0]);
                  if($('#tab2').is(':checked')){
                      $.ajax({
                        complete: function() {
                          swal({
                              title: "บันทึกสำเร็จ",
                              text: "ไปหน้าจัดการสินค้าหรือไม่?",
                              type: "success",
                              showCancelButton: true,
                              confirmButtonClass: "btn-info",
                              cancelButtonText: "เพิ่มสินค้าต่อ",
                              confirmButtonText: "ไปหน้าจัดการ",
                              closeOnConfirm: false
                            },
                            function(){
                              window.location.href = 'front-manage.php';
                            });
                        },
                        method: "POST",
                        url: "back_product_add-attribute.php?id="+id,
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(test) {
                        },
                      });
                  }else{
                      swal({
                        title: "บันทึกสำเร็จ",
                        text: "ไปหน้าจัดการสินค้าหรือไม่?",
                        type: "success",
                        showCancelButton: true,
                        cancelButtonText: "เพิ่มสินค้าต่อ",
                        confirmButtonClass: "btn-info",
                        confirmButtonText: "ไปหน้าจัดการ",
                        closeOnConfirm: false
                      },
                      function(){
                        window.location.href = 'front-manage.php';
                      });
                    }
              fetch_thumb();
            },
        });
    });
 	});
 	$(document).on('click', '.del-thumb', function(){
 		var id = $(this).attr('data-id');
 		$.ajax({
 				type:"POST",
        url:'back_product-delthumb.php',
        data: 'id='+id,             
        success:function(data){
          if($('#active'+id).is(":checked")){
            $('#img-preview').attr('src', 'image_product/thumbnail/'+data);
          }
          // alert(data);
          fetch_thumb(); 
          fetch_btnremove();
          },
        });
 	});
 	$('body').on('click','.image-preview',function(){
 		var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    $('#img-preview').attr('src', 'image_product/thumbnail/'+name);
 		$('.discard').removeClass('overlay-cover');
 		$('.text-image').hide();
 		// $('.text'+id).fadeIn('slow');
 		$('.text'+id).show();
 		$('.overlay-image'+id).show();
 		$('.overlay-image'+id).addClass('overlay-cover');
 		document.getElementById('active'+id).checked = true;
    $.ajax({
        beforeSend: function() {
        $("#check_active"+id).show();
        $("#check_active_true"+id).hide();
        },
        complete: function() {
        $("#check_active"+id).hide();
        $("#check_active_true"+id).show();
        },
        type:"POST",
        url:'back_product-updateactive.php',
        data: 'id='+id,             
        success:function(data){
          // alert(data);
          fetch_thumb(); 
          fetch_btnremove();
          },
        });
 	})   
  $(document).on('click', '.del-attribute', function(){
    var id = $(this).attr('data-id');
    document.getElementById('chk'+id).checked = true;
    try {
      var table = document.getElementById('table-attribute');
      var rowCount = table.rows.length;

      for(var i=0; i<rowCount; i++) {
        var row = table.rows[i];
        var chkbox = row.cells[0].childNodes[0];
        if(null != chkbox && true == chkbox.checked) {
          table.deleteRow(i);
          rowCount--;
          i--;
        }


      }
      }catch(e) {
        alert(e);
      }
  });
 }); 

// Open the Modal
function openModal() {
  document.getElementById('myModal').style.display = "block";
}

// Close the Modal
function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
function isNumber_n(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
  }
    return true;
}
function isNumber_s(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
  }
    return true;
}
// function Example(){
//   alert('555');
// }
function formatMoney_n(inum){ 
     // ฟังก์ชันสำหรับแปลงค่าตัวเลขให้อยู่ในรูปแบบ เงิน
    var s_inum=new String(inum.replace(/,/g, ""));
    if(s_inum != ""){
      $('#normal_price').show();
    }else{
      $('#normal_price').hide();
    }

    var num2=s_inum.split(".");
    var n_inum="";  
    if(num2[0]!=undefined){
        var l_inum=num2[0].length;  
        for(i=0;i<l_inum;i++){  
            if(parseInt(l_inum-i)%3==0){  
                if(i==0){  
                    n_inum+=s_inum.charAt(i);         
                }else{  
                    n_inum+=","+s_inum.charAt(i);         
                }     
            }else{  
                n_inum+=s_inum.charAt(i);  
            }  
        }  
    }else{
        n_inum=inum;
    }
    if(num2[1]!=undefined){
        n_inum+="."+num2[1];
    }
    $('#variant_price_normal').val(n_inum);
    $('#price_n').html(n_inum);
}
function formatMoney_s(inum){  // ฟังก์ชันสำหรับแปลงค่าตัวเลขให้อยู่ในรูปแบบ เงิน
    var s_inum=new String(inum.replace(/,/g, ""));
    var num2=s_inum.split(".");
    var n_inum="";  
    if(num2[0]!=undefined){
        var l_inum=num2[0].length;  
        for(i=0;i<l_inum;i++){  
            if(parseInt(l_inum-i)%3==0){  
                if(i==0){  
                    n_inum+=s_inum.charAt(i);         
                }else{  
                    n_inum+=","+s_inum.charAt(i);         
                }     
            }else{  
                n_inum+=s_inum.charAt(i);  
            }  
        }  
    }else{
        n_inum=inum;
    }
    if(num2[1]!=undefined){
        n_inum+="."+num2[1];
    }
    $('#variant_price').val(n_inum);
    $('#price_s').html(n_inum);
}
function show_text(val){
  var price = new String(val)
  if(price != ""){
      $("#price_text").show();
    }else{
      $('#price_text').hide();
    }
 $("#price_text").html(price);
}
function Addattribute() {
    var table = document.getElementById("table-attribute");
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    var num = rowCount;
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    cell1.innerHTML = "<input type='radio' name='chk[]' id='chk"+num+"' hidden><button type='button' style='height:100%; padding: 5px;' class='btn btn-block del-attribute' data-id='"+num+"'><i class='glyphicon glyphicon-trash'></i></button>";
    cell2.innerHTML = "<div class='input-group' style='margin-bottom: 0; padding-bottom: 5px;'><span class='input-group-addon' style='background-color: #228896; color:white; width: 57px;'>สี</span><input name='color[]' type='text' class='form-control' style='border-radius: 2px;'></div><div class='input-group' style='margin-bottom: 0; padding-bottom:5px;'><span class='input-group-addon' style='background-color: #228896; color:white;'>ขนาด</span><input name='size[]' type='text' class='form-control' style='border-radius: 2px;'></div>";
    cell2.innerHTML += "</div><div class='input-group' style='margin-bottom: 0;'><span class='input-group-addon' style='background-color: #228896; color:white; width: 57px;'>SKU</span><input name='SKU[]' type='text' class='form-control' style='border-radius: 2px;'></div>";
    cell3.innerHTML = "<div class='input-group' style='margin-bottom: 0; padding-bottom: 5px;'><span class='input-group-addon' style='background-color: #228896; color:white; width: 79px;'>ราคาขาย</span><input name='price[]' type='text' class='form-control' style='border-radius: 2px;'><span class='input-group-addon'>THB</span></div>";
    cell3.innerHTML += "<div class='input-group' style='margin-bottom: 0;'><span class='input-group-addon' style='background-color: #228896; color:white;'>ราคาปกติ</span><input name='normal[]' type='text' class='form-control' style='border-radius: 2px;'><span class='input-group-addon'>THB</span></div>";
    cell4.innerHTML = "<div class='input-group' style='margin-bottom: 0; padding-bottom: 5px;'><span class='input-group-addon' style='background-color: #228896; color:white; width: 65px;'>สต็อก</span><input name='stock[]' type='text' class='form-control' style='border-radius: 2px;'><span class='input-group-addon'>U</span></div>";
    cell4.innerHTML += "<div class='input-group' style='margin-bottom: 0;'><span class='input-group-addon' style='background-color: #228896; color:white;'>น้ำหนัก</span><input name='weight[]' type='text' class='form-control' style='border-radius: 2px;'><span class='input-group-addon'>G</span></div>";
}
function tickChk_status(i,a,b,c,active){
  $(".style").removeClass('check-active-'+a);
  $(".style").removeClass('check-active-'+b);
  $(".style").removeClass('check-active-'+c);
  $("#tickChk_status"+i).addClass('check-active-'+active);
  document.getElementById('status'+i).checked = true;
}
function checklength() {
  var input = document.getElementById("product_name") ;
    if(input.value.length > 0)
    {
      document.getElementById("btnSendAdd").disabled = false;
    }else{
    document.getElementById("btnSendAdd").disabled = true;
    }
}
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
</script>
</body>
</html>
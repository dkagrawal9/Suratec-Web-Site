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
    <title><?= TITLE ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link href="css/bootstrap-toggle.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../plugins/iCheck/all.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- upload template css-->
    <link rel="stylesheet" type="text/css" href="components/up_pre/style.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
    <!--sweet alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css.map">
    <!-- Include external CSS. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
    <!-- Include Editor style. -->
    <link href="../page_froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css">
    <link href="../page_froala/css/froala_style.min.css" rel="stylesheet" type="text/css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" type="text/css" href="css/modal_view.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

    <style type="text/css">
        .header-attribute td {
            padding: 3px;
            border: 1px solid #ddd;
        }

        .header-attribute th {
            padding: 8px;
            /*border:1px solid white;*/
            background-color: #ddd;
        }

        .control-label {
            padding-top: 7px;
            text-align: right;
            padding-right: 0px;
        }

        .normal-product {
            margin-bottom: 13px;
        }

        .table-attribute th, td {
            padding: 5px;
        }

        .overlay-allpage {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.7);
            cursor: pointer;
            z-index: 999999;
        }

        /* transition: 0.5s;
    }*/
        .hidden-xy {
            overflow: hidden;
        }

        .overlay-allpage > .fa {
            position: absolute;
            color: white;
            top: 50%;
            left: 50%;
            font-size: 60px;
            margin-top: -35px;
            margin-left: -35px;
            z-index: 999999;
        }

        .text-image .fa {
            font-size: 40px;
        }

        /*  table tr,td{
      vertical-align: top;
      height: 50px;
      border-bottom:1px solid #efefef;
    }*/
        .form-group {
            margin-bottom: 5px;
        }

        .btn-default.active {
            border: none;
        }

        /*  .btn-default:hover{
      border:none;
    }*/
        .btn-primary.active {
            border: none;
        }

        /*    .btn-primary:hover{
      border:none;
    }*/
        .btn-success {
            background-color: #5cb85c;
            border: none;
        }

        .btn-warning {
            border: none;
        }

        .style {
            background-color: #e6e6e6;
            border: 1px solid #b5b5b5;
            transition: 0.4s;
        }

        .style:hover {
            background-color: #f7f7f7;
            border: 1px solid #b5b5b5;
            /*color: white;*/
        }

        .style:focus {
            color: white;
        }

        .check-active-ready {
            background-color: #4cad40 !important;
            border-color: #4cad40 !important;
            color: white !important;
        }

        .check-active-ready:hover {
            background-color: white !important;
            border-color: #4cad40 !important;
            color: #4cad40 !important;
        }

        .check-active-soon {
            background-color: #FDA323 !important;
            border-color: #FDA323 !important;
            color: white !important;
        }

        .check-active-soon:hover {
            background-color: white !important;
            border-color: #FDA323 !important;
            color: #FDA323 !important;
        }

        .check-active-out {
            background-color: #FD6F3B !important;
            border-color: #FD6F3B !important;
            color: white !important;
        }

        .check-active-out:hover {
            background-color: white !important;
            border-color: #FD6F3B !important;
            color: #FD6F3B !important;
        }

        .check-active-des {
            background-color: #EFA694 !important;
            border-color: #EFA694 !important;
            color: white !important;
        }

        .check-active-des:hover {
            background-color: white !important;
            border-color: #EFA694 !important;
            color: #EFA694 !important;
        }

        .sweet-alert .sa-icon {
            margin-bottom: 35px;
        }

        .sps {
            border: 1px solid;
            border-color: #ddd;
            border-radius: 4px;
            width: 100%;
            max-height: 100%;
            padding-top: 10px;
            padding-bottom: 10px;
            cursor: pointer;
            transition: 0.4s
        }

        .sps:hover {
            border: 1px solid #399bf2;
            box-shadow: 0px 0px 5px 0px #16B1F0;
        }

        .check_suit {
            display: none;
        }

        .active_ssp {
            border-color: #399bf2 !important;
            color: #399bf2 !important;
            box-shadow: 0px 0px 5px 0px #16B1F0;
        }

        .text-cat::-webkit-scrollbar {
            width: 5px;
        }

        /* Track */
        .text-cat::-webkit-scrollbar-track {
            border-radius: 10px;
            background: #f1f1f1;
        }

        /* Handle */
        .text-cat::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background: #888;
        }

        /* Handle on hover */
        .text-cat::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .bg-option {
            background-color: #ddd;
            color: white;
        }

        .bg-option1 {
            background-color: grey;
            color: white;
        }

        .bootstrap-tagsinput {
            border: none;
            box-shadow: none;
        }

        .drop_area {
            transition: 0.4s;
        }

        /*    .browse {
      margin: 10px 32%;
      color: white;
      padding: 8px 16px;
      border-radius: 5px;
      background: #09f;
    }*/
        .active_item {
            background-color: #5cb85c !important;
            color: white !important;
        }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed" onload="startTime();">
<div id="allpage" style="display: none">
    <img src="../img/loaderpage.gif" class="fa" width="32" height="26">
</div>
<div class="wrapper">
    <?php require_once '../template/nav_menu.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                แก้ไขสินค้า
            </h1>
            <ol class="breadcrumb">
                <li><a href="../../index.php"></i> แดชบอร์ด</a></li>
                <li><a href="front-manage.php"></i> การจัดการสินค้า</a></li>
                <li class="active">แก้ไขสินค้า</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- SELECT2 EXAMPLE -->
           

            <?php
            $str = "SELECT product.*,mod_erp_branch.id_branch AS mod_id_branch,mod_erp_branch.name_branch AS mod_name_branch FROM `product` LEFT JOIN mod_erp_branch ON product.id_branch = mod_erp_branch.id_branch WHERE product.id_product = '" . $_GET['id'] . "'";
            $query = mysqli_query($objConnect , $str);
            $result = mysqli_fetch_array($query);
            $data_p = $result['id_product'];
            $data = $result['id_catagory'];
            $id_image = $_GET['id'];
            echo '<script type="text/javascript">';
            echo "var data = '$data';";  // ส่งค่า $data จาก PHP ไปยังตัวแปร data ของ Javascript
            echo "var data_p = '$data_p';";  // ส่งค่า $data จาก PHP ไปยังตัวแปร data ของ Javascript
            echo "var id_image = '$id_image';";  // ส่งค่า $data จาก PHP ไปยังตัวแปร data ของ Javascript
            echo '</script>';
            ?>
            <input type="hidden" name="" value="<?php echo $id_image; ?>" id="id_product">
            <div class="row">
                <div class="col-md-6">
                    <div class="row"  id="texts">
          <div class="col-md-12">
            <div class="box box-info">
              <div class="box-header">
                <h3 class="box-title">รายละเอียดสินค้า</h3>
              </div>
              <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#thai" data-toggle="tab" aria-expanded="0">
                    <img class="flag-lang" src="../img/th-fl.png" width="22" height="15">
                    ภาษาไทย
                  </a>
                </li>
                <li>
                  <a href="#english" data-toggle="tab" aria-expanded="1">
                    <img class="flag-lang" src="../img/en-fl.jpg" width="22" height="15">
                    ภาษาอังกฤษ
                  </a>
                </li>
                <li>
                  <a href="#chlish" data-toggle="tab" aria-expanded="2">
                    <img class="flag-lang" src="../img/ZH.png" width="22" height="15">
                    ภาษาจีน
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="thai">
                   <div class="box-body">
                <div class="input-group" style="margin-bottom: 0;">
                  <span class="input-group-addon"><i class="fa fa-header"></i></span>
                  <input type="text" class="form-control" id="name_product" name="name_product" placeholder="ชื่อสินค้า" value="<?php echo  $result['name_product'] ?>" onkeyup="checklength()">
                </div>
              </div>
   
   
                  <div id="editor" style="margin-top: 10px;">
                    <textarea class='edit' name="editor" id="input-editor" style="margin-top: 20px;"><?php echo  $result['detail_product'] ?></textarea>
                  </div>
                </div>
                <div class="tab-pane" id="english">
                  <div class="box-body">
                <div class="input-group" style="margin-bottom: 0;">
                  <span class="input-group-addon"><i class="fa fa-header"></i></span>
                  <input type="text" class="form-control" id="product_name_en" name="product_name_en" placeholder="ชื่อสินค้า" value="<?php echo  $result['name_product_en'] ?>">
                </div>
              </div>
              
                  <div id="editor" style="margin-top: 10px;">
                    <textarea class="edit"  name="editor_en"  id="input-editor_en" style="margin-top: 20px;"><?php echo  $result['detail_product_en'] ?></textarea> 
                  </div>
                </div>
                <div class="tab-pane" id="chlish">
                   <div class="box-body">
                <div class="input-group" style="margin-bottom: 0;">
                  <span class="input-group-addon"><i class="fa fa-header"></i></span>
                  <input type="text" class="form-control" id="product_name_ch" name="product_name_ch" placeholder="ชื่อสินค้า" value="<?php echo  $result['name_product_ch'] ?>">
                </div>
              </div>
                  <div id="editor" style="margin-top: 10px;">
                    <textarea class="edit"  name="editor_ch"  id="input-editor_ch" style="margin-top: 20px;"><?php echo  $result['detail_product_ch'] ?></textarea> 
                  </div>
                </div>
              </div>
            </div>
            </div>
            <!-- /.box -->

          </div>
          <!-- /.col (left) -->
         
          <!-- /.col (right) -->
        </div>
         <div class="row"  id="texts">
          <div class="col-md-12">
            <div class="box box-info">
              <div class="box-header">
                <h3 class="box-title">รีวิวสินค้า</h3>
              </div>
              <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#thai_re" data-toggle="tab" aria-expanded="0">
                    <img class="flag-lang" src="../img/th-fl.png" width="22" height="15">
                    ภาษาไทย
                  </a>
                </li>
                <li>
                  <a href="#english_re" data-toggle="tab" aria-expanded="1">
                    <img class="flag-lang" src="../img/en-fl.jpg" width="22" height="15">
                    ภาษาอังกฤษ
                  </a>
                </li>
                <li>
                  <a href="#chlish_re" data-toggle="tab" aria-expanded="2">
                    <img class="flag-lang" src="../img/ZH.png" width="22" height="15">
                    ภาษาจีน
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="thai_re">
                   <div class="box-body">
                <div class="input-group" style="margin-bottom: 0;">
                  
                </div>
              </div>
   
   
                  <div id="editor" style="margin-top: 10px;">
                    <textarea class='edit' name="editor_re" id="input-editor_re" style="margin-top: 20px;"><?php echo  $result['review_product'] ?></textarea>
                  </div>
                </div>
                <div class="tab-pane" id="english_re">
                  <div class="box-body">
                <div class="input-group" style="margin-bottom: 0;">
                  
                </div>
              </div>
              
                  <div id="editor" style="margin-top: 10px;">
                    <textarea class="edit"  name="editor_en_re"  id="input-editor_en_re" style="margin-top: 20px;"><?php echo  $result['review_product_en'] ?></textarea> 
                  </div>
                </div>
                <div class="tab-pane" id="chlish_re">
                   <div class="box-body">
                <div class="input-group" style="margin-bottom: 0;">
                 
                </div>
              </div>
                  <div id="editor" style="margin-top: 10px;">
                    <textarea class="edit"  name="editor_ch_re"  id="input-editor_ch_re" style="margin-top: 20px;"><?php echo  $result['review_product_ch'] ?></textarea> 
                  </div>
                </div>
              </div>
            </div>
            </div>
            <!-- /.box -->

          </div>
          <!-- /.col (left) -->
         
          <!-- /.col (right) -->
        </div>
         <div class="col-md-12">
                <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">รูปภาพสินค้า</h3>
                        </div>
                        <div class="box-body drop_area" style="z-index:3;min-height: 200px; border-radius: 0px;border: 1px solid rgb(218, 223, 227); background: transparent; margin:10px; padding: 0; " align="center">
                            <div class="drop_image" style="cursor: pointer; min-height: 200px;">
                                <i class="fa fa-cloud-upload" style="font-size: 5em; margin-top: 45px; color: gray"></i>
                                <h3 style="margin-top: -5px; color: gray">Drop file here</h3>
                                <!-- <div class="browse">
                    click here to browse
                  </div> -->
                            </div>
                            <div id="live-thumb-edit" style="padding-left: 10px; padding-right: 10px;z-index:5;"></div>
                        </div>
                        <div class="progress progress-xxs" style="margin:10px; margin-top: -10px;">
                            <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%; background-color: #3c8dbc;">0%</div>
                        </div>
                        <div id="check_upload" class="overlay" style="display: none;">
                            <i class="fa fa-spinner fa-spin" style="color:#228896;"></i>
                        </div>
                        <div class="box-footer" style="border-top: none;">
                            <form class="upload-form-add-imagemain" method="post" enctype="multipart/form-data" id="frmADD_imagemain">
                                <input type="hidden" name="id_product" value="<?php echo $result['id_product']; ?>" id="id_product">
                                <div class="input-group">
                      <span class="input-group-btn">
                        <span class="btn btn-default btn-file remove" data-id="<?php echo $result['id_product']; ?>" style="background-color: #ff4e4e !important; color:white; display: none;">
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
                    </div>
                </div>
                     
                <!-- /.col (left) -->
               
                     
                    <!-- iCheck -->
                    
                    <!-- /.box -->
                   
                    
                    <!-- /.box-body -->
                    <!-- <div class="box-footer" style="padding-left: 20px; padding-right: 20px;">
                <div class="row">
                  <div class="col-md-6" style="padding: 15px;">
                    <span>ความพร้อมในการจัดส่ง</span>
                  </div>
                  <div class="col-md-6" align="right">
                    <div class="checkbox">
                      <label>
                        <?php
                    if ($result['status_ready'] == '1') {
                        $check_ready = "checked";
                    } else {
                        $check_ready = "";
                    }
                    ?>
                        <input id="transport" data-toggle="toggle" type="checkbox" name="transport" value="1" data-size="normall" data-on="พร้อมส่ง" data-off="พรีออเดอร์" data-onstyle="success" data-offstyle="warning" <?php echo $check_ready; ?>>
                      </label>
                    </div>
                  </div>
                </div>
              </div> -->
                    
                
                <div class="col-md-6">
                    <?php
                    $str_attr = "SELECT * FROM product_attribute WHERE id_product = '" . $_GET['id'] . "' 
                                                                    ";
                    $query_attr = mysqli_query($objConnect , $str_attr);
                    $result_attr = mysqli_fetch_array($query_attr);
                    $row_attr = mysqli_num_rows($query_attr);
                    

                    ?>
                    <div class="box box-default">
                       <div class="box box-info">
                    <div class="box-header with-border">
                            <h3 class="box-title">รายละเอียดสินค้า</h3>
                        </div>
                        <div class="box-body" align="right">
                            <div id="printableTable">
                               <!-- <div class="box-body">
                                        <label class="col-sm-2 control-label">ชื่อสินค้า</label>
                                        <div class='col-sm-10' id='datetimepicker'>
                                            <input type='text'  class="form-control"  name="product_name" id="product_name" onkeyup="checklength()" value="<?php echo $result['name_product']; ?>">
                                        </div>
                                </div> -->
                                <div class="box-body">
                                        <label class="col-sm-2 control-label">SKU</label>
                                        <div class='col-sm-10' id='datetimepicker'>
                                            <input type='text' class="form-control"  name="SKU" id="SKU" value="<?php echo $result['sku']; ?>">
                                        </div>
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label">ราคาขาย</label>
                                        <div class='col-sm-10' id='datetimepicker'>
                                            <input type='number' class="form-control"  name="selling_price" id="selling_price" value="<?php echo $result['tmp_price']; ?>">
                                        </div>
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label">ราคาทุน</label>
                                        <div class='col-sm-10' id='datetimepicker'>
                                            <input type='number' class="form-control"  name="capital_cost" id="capital_cost" value="<?php echo $result['cost']; ?>">
                                        </div>
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label">น้ำหนักสินค้า(g)</label>
                                        <div class='col-sm-10' id='datetimepicker'>
                                            <input type='number' class="form-control"  name="weight" id="weight" value="<?php echo $result['weight']; ?>">
                                        </div>
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label">ร้านค้า</label>
                                        <div class='col-sm-10' id='datetimepicker'>
  <?php   $strSQL = "SELECT * FROM `mod_erp_branch` WHERE `delete_datetime` is null";
          $objQuery = mysqli_query($objConnect,$strSQL);
          ?>
                                            <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="id_branch" id="id_branch"> 
                                             
                                               <option value="<?php echo $result["mod_id_branch"] ?>"><?php echo $result["mod_name_branch"] ?> </option>

          <?php 
              while($objResult = mysqli_fetch_array($objQuery)){
                if ($result["mod_id_branch"]!=$objResult["id_branch"]) {
             

          ?>
                                              <option value="<?php echo $objResult["id_branch"] ?>"><?php echo $objResult["name_branch"] ?> </option>
          <?php }} ?>
                                            </select>
                                        </div>
                                </div>
                            </div>

                        </div>
                        </div>
                <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">สถานะเกี่ยวกับสินค้า</h3>
                        </div>
                        <div class="box-body" style="padding-left: 20px; padding-right: 20px;">
                            

                            <?php
                            $cut1 = explode("," , $result['status_product']);
                            if (in_array("สินค้าใหม่" , $cut1)) {
                                $check_s2 = 'checked';
                                $check_bg2 = 'bg-green';
                                $check_di2 = '';
                                $check_au2 = 'display:none;';
                            } else {
                                $check_bg2 = 'bg-option';
                                $check_s2 = '';
                                $check_di2 = 'display:none;';
                                $check_au2 = '';
                            }

                            if (in_array("สินค้ายอดนิยม" , $cut1)) {
                                $check_s3 = 'checked';
                                $check_bg3 = 'bg-red';
                                $check_di3 = '';
                                $check_au3 = 'display:none;';
                            } else {
                                $check_bg3 = 'bg-option';
                                $check_s3 = '';
                                $check_di3 = 'display:none;';
                                $check_au3 = '';
                            }

                            if (in_array("สินค้าแนะนำ" , $cut1)) {
                                $check_s4 = 'checked';
                                $check_bg4 = 'bg-blue';
                            } else {
                                $check_bg4 = 'bg-option';
                                $check_s4 = '';
                            }

                            
                            if ($result['status_ready'] == 1) {
                                $check_s5 = 'checked';
                                $check_bg5 = 'bg-blue';
                            } else {
                                $check_bg5 = 'bg-option';
                                $check_s5 = '';
                            }


                            ?>
                            
                            <div class="checkbox" style="width: 100%; padding-left:10px; padding-bottom: 10px;">
                                <div class="pull-right">
                                    <small class="label pull-left <?php echo $check_bg2; ?> new" style="margin-left: -51px; margin-top: 5px;">new</small>
                                    <label class="sign_status2">
                                        <input id="sign_status2" data-toggle="toggle" type="checkbox" name="sign_product[]" value="สินค้าใหม่" data-size="small" <?php echo $check_s2; ?>>
                                    </label>
                                </div>
                                สินค้าใหม่<br>
                                <font id="new_auto" style="color:gray; font-size: 12px; <?php echo $check_au2; ?>">อัติโนมัติ<a href="#"> *จัดการเงื่อนไข</a></font>
                                <font id="new_option" style="color:blue; font-size: 12px; <?php echo $check_di2; ?>">กำหนดเอง</font>
                            </div>
                            <div class="checkbox" style="width: 100%; padding-left:10px; padding-bottom: 10px;">
                                <div class="pull-right">
                                    <small class="label pull-left <?php echo $check_bg3; ?> hot" style="margin-left: -47px; margin-top: 5px;">hot</small>
                                    <label class="sign_status3">
                                        <input id="sign_status3" data-toggle="toggle" type="checkbox" name="sign_product[]" value="สินค้ายอดนิยม" data-size="small" <?php echo $check_s3; ?>>
                                    </label>
                                </div>
                                สินค้ายอดนิยม<br>
                                <font id="hot_auto" style="color:gray; font-size: 12px; <?php echo $check_au3; ?>">อัติโนมัติ<a href="#"> *จัดการเงื่อนไข</a></font></font>
                                <font id="hot_option" style="color:blue; font-size: 12px; <?php echo $check_di3; ?>">กำหนดเอง</font>
                            </div>
                            <div class="checkbox" style="width: 100%; padding-left:10px; padding-bottom: 10px;">
                                <div class="pull-right">
                                    <!-- <small class="label pull-left <?php echo $check_bg5; ?> hot" style="margin-left: -47px; margin-top: 5px;">hot</small> -->
                                    <label class="sign_status5">
                                        <input id="sign_ready" data-toggle="toggle" type="checkbox" name="sign_ready" value="1" data-size="small" <?php echo $check_s5; ?>>
                                    </label>
                                </div>
                                แสดงสินค้า<br>
                                <font id="hot_auto" style="color:gray; font-size: 12px; <?php echo $check_au5; ?>">อัติโนมัติ<a href="#"> *จัดการเงื่อนไข</a></font></font>
                                <font id="hot_option" style="color:blue; font-size: 12px; <?php echo $check_di5; ?>">กำหนดเอง</font>
                            </div>
                        </div>
                    </div>

                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">หมวดหมู่สินค้า</h3>
                            <!-- <button type="button" class="btn btn-default btn-xs pull-right" onclick="location.href='front-catagory.php'">จัดการหมวดหมู่</button> -->
                        </div>
                        <div class="box-body text-cat" style="padding-left: 20px; padding-right: 20px;  max-height: 250px; overflow: auto;">
                            <div id="catagory"></div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer" style="padding-left: 20px; padding-right: 20px;">
                           <!--  <button type="button" class="btn btn-sm show-add" style="background: #838383; color: white;"><i class="fa fa-plus"></i>&nbsp;&nbsp;เพิ่ม</button> -->
                            <div id="add-cat" class="form-group" style="padding-top: 15px; display: none;">
                                <div id="live-selected-catagory"></div>
                                <div class="input-group" style="margin-top: 10px;">
                                    <input type="text" name="name" id="name_cat" class="form-control" placeholder="กรุณากรอกชื่อหมวดหมู่" onkeyup="checklengthcat()">
                                    <!-- /btn-group -->
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-info btnSendAddCat" id="btnSendAddCat" style="float: right; transition: 0.4s;" disabled>
                                            <i class="fa fa-spinner fa-spin" id="loader_cat" style="display: none;"></i>
                                            <i class="fa fa-check" id="success_cat"></i>&nbsp;บันทึก
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            คุณสามารถเพิ่ม/ลบ/แก้ไขหมวดหมู่ได้ในหน้าจัดการหมวดหมู่
                        </div>
                    </div>

                   

                </div>
<?php
    $str_check_attr = "SELECT * FROM product_attribute WHERE id_product = '" . $_GET['id'] . "' AND`delete_datetime` IS null";
    $query_check_attr = mysqli_query($objConnect , $str_check_attr);
    $num_check_attr1 = mysqli_num_rows($query_check_attr);
    $result_check_attr = mysqli_fetch_array($query_check_attr);
?>
                <div style="display: none;">
<input type="radio" name="tab_ch" id="tab_ch1" <?php if ($num_check_attr1<=1  && $result_check_attr["attribute_name"]=='' && $result_check_attr["option_name"]==''){ ?>
                    checked="checked"
                <?php } ?> >
<input type="radio" name="tab_ch" id="tab_ch2" <?php if ($num_check_attr1>=1  && $result_check_attr["attribute_name"]!='' && $result_check_attr["option_name"]!=''){ ?>
                    checked="checked"
                <?php } ?>>                 
                        </div>

                                      <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li <?php if ($num_check_attr1<=1  && $result_check_attr["attribute_name"]=='' && $result_check_attr["option_name"]==''){ ?>
                    class="active"
                <?php } ?>>
                  <a href="#thai_attr" data-toggle="tab" aria-expanded="0" id="tab_1">
                   
                    สินค้ามีแบบเดียว
                  </a>
                </li>
                <li <?php if ($num_check_attr1>=1  && $result_check_attr["attribute_name"]!='' && $result_check_attr["option_name"]!=''){ ?>
                    class="active"
                <?php } ?>>
                  <a href="#english_attr" data-toggle="tab" aria-expanded="1" id="tab_mullti">
                   
                    สินค้ามีหลายรูปแบบ
                  </a>
                </li>
                
              </ul>
              <div class="tab-content">
                <div <?php if ($num_check_attr1<=1 && $result_check_attr["attribute_name"]=='' && $result_check_attr["option_name"]==''){ ?>
                    class="tab-pane active" 
                <?php } else{ ?>
                    class="tab-pane"
                <?php }
                ?> id="thai_attr">
                   <div class="box-body">
                <div class="input-group" style="margin-bottom: 0;">
                  
                </div>
              </div>
                  <div class="box-body">
                                  <label class="col-sm-2 control-label"><?=lang('SKU','SKU ')?></label>
                                    <div class='col-sm-9' id='datetimepicker'>
                <input type="hidden" name="sku_auto" id="sku_auto" class="sku_auto">
                <input type="hidden" name="SKU_1_id" id="SKU_1_id" value="<?php echo $result_check_attr["id_attr"]; ?>">
                                      <input  class="form-control sku_auto" type="text" name="SKU_1" id="SKU_1" value="<?php
                                      if ($num_check_attr1<=1 && $result_check_attr["attribute_name"]=='' && $result_check_attr["option_name"]==''){
                                       echo $result_check_attr["SKU_attr"];
                                       } else{ } ?>" readonly>

                                      <input class="form-control sku_auto" type="hidden" name="id_attr_product_1" id="id_attr_product_1"  value="<?php
                                      
                                      if ($num_check_attr1<=1 && $result_check_attr["attribute_name"]=='' && $result_check_attr["option_name"]==''){
                                       echo $result_check_attr["id_attr"];
                                       } else{ }  ?>" readonly>
                                    </div>
                                    
                                </div>
                </div>
                
                <div <?php if ($num_check_attr1>=1  && $result_check_attr["attribute_name"]!='' && $result_check_attr["option_name"]!=''){ ?>
                    class="tab-pane active" 
                <?php } else{ ?>
                    class="tab-pane"
                <?php }
                ?> id="english_attr">
                  <div class="box-body">
    <div class="box-header with-border">
                <div class="col-md-6" align="left">
                    <h3 class="box-title">คุณลักษณะสินค้า</h3>
                </div>
                <div class="col-md-6" align="right">
                   <!--  <a  href="product_features.php"   data-toggle="modal" data-target="#modal_showdetail">
                        <button type="button" class="btn btn-success"  ><i class="fa fa-plus"></i> เพิ่มคุณลักษณะ</button>
                    </a> -->
                </div>
                        <div class="nav-tabs-custom">
                            
                            <input type="hidden" name="" id="id_attr_one" value="<?php echo $result_attr['id_attr'] ?>">
                          
                                <div class="tab-pane active objective" id="objective">
                                    <div style="margin-bottom: 10px; margin-top: -9.5px;">
                                        <table width="100%" class="header-attribute" style="border:1px solid #ddd;">
                                            <thead>
                                            <tr style="font-weight: bold;">
                                                <th style="min-width: 50px; width: 10%" align="center">
                                                    เปิดใช้งาน
                                                </th>
                                                <th style="min-width: 75px; width: 30%">
                                                    คุณลักษณะ
                                                </th>
                                                <th>
                                                    Option
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="show-attribute">
                                            <?php
                                            $str_attr_h = "SELECT * FROM product_attribute_head";
                                            $query_attr_h = mysqli_query($objConnect , $str_attr_h);
                                            $num_head = 0;
                                            while ($result_attr_h = mysqli_fetch_array($query_attr_h)){
                                            //------------------------------------------------------------------------------------เช็ค id product_attribute ว่าตรงกับ ตาราง attribute_head
                                            $str_check_attr = "SELECT * FROM product_attribute WHERE id_product = '" . $_GET['id'] . "'";
                                            $query_check_attr = mysqli_query($objConnect , $str_check_attr);
                                            $num_check_attr = mysqli_num_rows($query_check_attr);
                                            $result_check_attr = mysqli_fetch_array($query_check_attr);
                                            $cut_check_attr = explode("," , $result_check_attr['attribute_name']);

                                            if (in_array($result_attr_h['id_attr_head'] , $cut_check_attr)) {
                                                $check_cut_attr_head = "checked";
                                                $class_check = "exist_check";
                                            } else {
                                                $check_cut_attr_head = "";
                                                $class_check = '';
                                            }
                                            // ! ----------------------------
                                            $num_head++;
                                            $text_sub = '';
                                            $str_sub_attr_h = "SELECT * FROM product_attribute_sub WHERE id_attr_head = '" . $result_attr_h['id_attr_head'] . "'";
                                            $query_sub_attr_h = mysqli_query($objConnect , $str_sub_attr_h);
                                            $num_sub = mysqli_num_rows($query_sub_attr_h);
                                            $i = 0;
                                            while ( $result_sub_attr_h = mysqli_fetch_array($query_sub_attr_h) ) {
                                                $i++;
                                                if ($num_sub - $i == 0) {
                                                    $text_sub .= $result_sub_attr_h['name_attr_sub'];
                                                } else {
                                                    $text_sub .= $result_sub_attr_h['name_attr_sub'] . ',';
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <td align="center">
                                                    <?php
                                                    echo '<input type="checkbox" name="" value="' . $text_sub . '" data-idhead="' . $result_attr_h['id_attr_head'] . '" 
                                                             data-attr="' . $result_attr_h['name_attr_head'] . '" 
                                                             class="smtp_changes' . $num_head . ' variants_change variants_num_check' . $num_head . ' ' . $class_check . '"
                                                             ' . $check_cut_attr_head . '>';
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo '<span>' . $result_attr_h['name_attr_head_show'] . '</span>';
                                                    ?>
                                                </td>
                                                <td>
                                                    <input type="text" value="<?php echo $text_sub; ?>" data-role="tagsinput" data-idhead="<?php echo $result_attr_h['id_attr_head'] ?>" id="tags" data-smtp="<?php echo $num_head; ?>" class="tagss form-control" style="border:none;">
                                                </td>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                            <tbody class="inclease-attribute">
                                            <tr>
                                                <td align="center">
                                                    <button class="btn btn-success btn-sm add-row">เพิ่ม</button>
                                                </td>
                                                <td>
                                                    <input type="text" value="" id="attribute_head" class="form-control" style="border:none;" placeholder="ชื่อคุณลักษณะ">
                                                </td>
                                                <td>
                                                    <input type="text" value="" id="attribute_text" data-role="tagsinput" data-smtp="" class="form-control" style="border:none;" placeholder="คุณลักษณะ">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <?php
                                        if ($num_check_attr > 0) {
                                            $radio_dev_exist = 'checked';
                                            $radio_dev_render = '';
                                        } else {
                                            $radio_dev_exist = '';
                                            $radio_dev_render = 'checked';
                                        }
                                        ?>
                                    </div>
                                    <form method="post" id="frm_attribute">
                                        <?php
                                        $str_ck_attr = "SELECT * FROM product_attribute WHERE id_product = '" . $_GET['id'] . "'";
                                        $query_ck_attr = mysqli_query($objConnect , $str_ck_attr);
                                        $ck_num_row = mysqli_num_rows($query_ck_attr);
                                        if ($ck_num_row > 0) {
                                            ?>
                                            <div style="margin-top: 10px; margin-left: 10px;">
                                                <label>
                                                    <span class="btn btn-sm old_item not_in active_item" style="background-color: white; color: gray; border:1px solid #5cb85c;">Old item</span>
                                                    <input type="radio" name="input_exist" id="radio_dev_exist" <?php echo $radio_dev_exist; ?> value="0" style="display: none;">
                                                </label>
                                                <label>
                                                    <span class="btn btn-sm new_gen not_in" style="background-color: white; color: gray; border:1px solid #5cb85c;">New Generated</span>
                                                    <input type="radio" name="input_exist" id="radio_dev_render" <?php echo $radio_dev_render; ?> value="1" style="display: none;">
                                                </label>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="sticky-table empty">
                                            <div class="table-product table-responsive">
                                                <table id="table-multiple-variant" class="table table-hover table-list">
                                                    <thead class="show-data">
                                                    <tr style="background-color: #ddd">
                                                        <th style="width: 60px; border-bottom: none;"></th>
                                                        <th style="width: 100px; min-width: 100px; border-bottom: none;">Options</th>
                                                        <th style="border-bottom: none;">ราคาขาย</th>
                                                        <th style="border-bottom: none;">ราคาทุน</th>
                                                        <th style="border-bottom: none;">SKU</th>
                                                        <!-- <th style="border-bottom: none;">Stock</th> -->
                                                        <th style="width: 100px; border-bottom: none;">น้ำหนัก</th>
                                                        <th style="width: 80px; max-width: 80px; border-bottom: none;">แสดงผล</th>
                                                       <!--  <th style="width: 80px; max-width: 80px; border-bottom: none; text-align: center">บาร์โค้ด</th> -->
                                                    </tr>
                                                    </thead>
                                                    <?php
                                                    if ($num_check_attr1>=1  && $result_check_attr["attribute_name"]!='' && $result_check_attr["option_name"]!=''){
                                                    $str_attr_cobi = "SELECT * FROM product_attribute WHERE id_product = '" . $_GET['id'] . "' ORDER BY orderby ASC";
                                                    $query_attr_cobi = mysqli_query($objConnect , $str_attr_cobi);
                                                    $num_attr_cobi = mysqli_num_rows($query_attr_cobi);
                                                    if ($num_attr_cobi > 0) {
                                                        $show_attr_cobi = 'display:none;';
                                                        $empty_attr_cobi = 'display:none;';
                                                    } else {
                                                        $show_attr_cobi = 'display:none;';
                                                        $empty_attr_cobi = '';
                                                    }
                                                    ?>
                                                    <tbody class="dev-product-variant-render" id="dev-product-variant-render" style="<?php echo $show_attr_cobi; ?>">
                                                    </tbody>

                                                    <tbody class="dev-product-variant-render-exits">
                                                    <?php
                                                    $a = 0;
                                                    while ( $result_attr_cobi = mysqli_fetch_array($query_attr_cobi) ) {
                                                        $str_image_attr = "SELECT * FROM product_image_attr WHERE id_attr = '" . $result_attr_cobi['id_attr'] . "'";
                                                        $query_image_attr = mysqli_query($objConnect , $str_image_attr);
                                                        $result_image_attr = mysqli_fetch_array($query_image_attr);
                                                        if ($result_image_attr['name_image'] != '') {
                                                            $image = '../../uploads/product_attribute/' . $result_image_attr['name_image'];
                                                        } else {
                                                            $image = 'https://www.igetweb.com/themes_v2/assets/img/default-img.png';
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <label>
                                                                    <img src="<?php echo $image; ?>" class="variant-img<?php echo $a; ?> item-list-img default-img" style="width:40px; cursor:pointer;">
                                                                    <input type="file" class="image_upload" data-id="<?php echo $a; ?>" style="display:none;" name="attr_file_ex[]"></label>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $cut_small = explode("/" , $result_attr_cobi['option_name']);
                                                                for ($i = 0; $i < count($cut_small); $i++) {
                                                                    ?>
                                                                    <small class="label pull-left bg-option1" style="margin-right: 5px; margin-bottom:5px;"><?php echo $cut_small[$i]; ?></small>
                                                                    <?php
                                                                }
                                                                ?>

                                                                <input type="hidden" value="<?php echo $result_attr_cobi['option_name']; ?>" name="option_attr_ex[]" id="option_attr<?php echo $a; ?>">
                                                                <input type="hidden" name="attr_head_ex[]" value="<?php echo $result_attr_cobi['attribute_name']; ?>" class="id_attr_head">
                                                                <input type="hidden" name="id_attr[]" value="<?php echo $result_attr_cobi['id_attr']; ?>" class="">
                                                            </td>
                                                            <td>
                                                                <div class="input-group input-group-sm">
                                                                    <input type="text" name="price_ex[]" value="<?php echo $result_attr_cobi['price_attr']; ?>" class="form-control">
                                                                    <span class="input-group-addon" style="padding:5px;">THB</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group input-group-sm">
                                                                    <input type="text" name="normal_ex[]" value="<?php echo $result_attr_cobi['price_n_attr']; ?>" class="form-control">
                                                                    <span class="input-group-addon" style="padding:5px;">THB</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control input-sm" name="SKU_ex[]" value="<?php echo $result_attr_cobi['SKU_attr']; ?>">
                                                            </td>
                                                            <!-- <td>
                                          <input name="stock_ex[]" type="text" readonly class="form-control input-sm" value="<?php echo $result_attr_cobi['sum_stock']; ?>" style="max-width:45px; padding-left:0; padding-right:0;">
                                        </td> -->
                                                            <td>
                                                                <div class="input-group input-group-sm">
                                                                    <input name="weight_ex[]" type="text" value="<?php echo $result_attr_cobi['weight_attr']; ?>" class="form-control">
                                                                    <span class="input-group-addon" style="padding:5px;">g</span>
                                                                </div>
                                                            </td>
                                                            <td style="text-align:center; width:60px; max-width:60px;">
                                                                <?php
                                                                if ($result_attr_cobi['show_attr'] == 1) {
                                                                    $check_show = "checked";
                                                                } else {
                                                                    $check_show = '';
                                                                }
                                                                ?>
                                                                <input type="checkbox" name="" class="check_value" value="1" data-id="<?php echo $a; ?>" <?php echo $check_show; ?> value="1" id="option_check<?php echo $a; ?>">
                                                                <input type="checkbox" name="show_ex[]" value="<?php echo $result_attr_cobi['show_attr'] ?>" id="option_check_hidden<?php echo $a; ?>" checked hidden>
                                                            </td>
                                                           <!--  <td>
                                                                <button class="btn btn-primary" id="print-barcode" data-id="<?php echo $result_attr_cobi['barcode'] ?>">
                                                                    <i class="fa fa-qrcode"></i> ปริ้นบาร์โค้ด
                                                                </button>
                                                            </td> -->
                                                        </tr>
                                                        <?php
                                                        $a++;
                                                    } }
                                                    ?>
                                                    <input type="hidden" name="" id="exist_num" value="<?php echo $a ?>">
                                                    </tbody>
                                                    <tbody class="empty-message " style="border:none; <?php echo $empty_attr_cobi; ?>">
                                                    <tr>
                                                        <td colspan="10" class="text-center" style="background-color: white !important;">
                                                            <div style="font-size: 18px; color: gray;">กรุณาเลือกลักษณะของสินค้าที่ต้องการเพิ่มข้อมูล</div>
                                                            <div class="fa fa-edit fa-3x" style="font-size: 70px; color: #ddd;"></div>
                                                        </td>
                                                    </tr>
                                                    </tbody>

                                                </table>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                              
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>

                </div></div>

                
                


                <div class="boxsave">
                    <button type="button" class="btn btn-info pull-right btnSendEdit" id="btnSendEdit" style="transition: 0.4s; margin-left: 5px;"><i class="fa fa-check"></i>&nbsp;บันทึก</button>
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
                                                <img src="../img/warning.png" width="60" height="60">
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
            <script src="../bower_components/jquery/dist/jquery.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>
            <!-- Include JS files. -->
            <script type="text/javascript" src="../page_froala/js/froala_editor.pkgd.min.js"></script>
            <script src="components/bootstrap-toggle.min.js"></script>
            <!-- <script src="js/bootstrap-toggle.min.js"></script> -->
            <!-- Select2 -->
            <script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
            <!-- Bootstrap 3.3.7 -->
            <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
            <!-- SlimScroll -->
            <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
            <!-- AdminLTE App -->
            <script src="../dist/js/adminlte.min.js"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="../dist/js/demo.js"></script>
            <!-- iCheck 1.0.1 -->
            <script src="../plugins/iCheck/icheck.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
            <script>
                $(function () {
                    $('.select2').select2();
                    $('.edit').froalaEditor({
                        language: 'ar',
                        heightMin: 300,
                        heightMax: 400,
                        imageUploadURL: "upload.php",
                        imageUploadParam: "fileName",
                        imageManagerLoadMethod: "GET",
                        imageManagerLoadURL: "select.php",
                        imageManagerDeleteURL: "delete.php",
                        imageManagerDeleteMethod: "POST",
                        // video
                        videoUploadURL: 'upload.php',
                        videoUploadParam: 'fileName',
                        videoUploadMethod: 'POST',
                        videoMaxSize: 50 * 1024 * 1024,
                        videoAllowedTypes: ['mp4', 'webm', 'jpg', 'ogg'],

                        fileUploadURL: 'upload.php',
                        fileUploadParam: 'fileName',
                        fileUploadMethod: 'POST',
                        fileMaxSize: 20 * 1024 * 1024,
                        fileAllowedTypes: ['*'],
                    }).on('froalaEditor.image.uploaded', function (e, editor, response) {
                        console.log(response);
                    }).on('froalaEditor.imageManager.beforeDeleteImage', function (e, editor, $img) {
                        console.log($img);
                    }).on('froalaEditor.imageManager.imageDeleted', function (e, editor, res) {
                        console.log(res);
                    }).on('froalaEditor.video.beforeUpload', function (e, editor, videos) {
                        console.log("beforeUpload");
                    }).on('froalaEditor.video.uploaded', function (e, editor, response) {
                        console.log("uploaded");
                    }).on('froalaEditor.video.inserted', function (e, editor, $img, response) {
                        console.log("inserted");
                    }).on('froalaEditor.video.replaced', function (e, editor, $img, response) {
                        console.log("replaced");
                    }).on('froalaEditor.video.error', function (e, editor, error, response) {
                        console.log("error");
                    }).on('froalaEditor.file.beforeUpload', function (e, editor, files) {
                        console.log("beforeUpload");
                    }).on('froalaEditor.file.uploaded', function (e, editor, response) {
                        console.log("uploaded");
                    }).on('froalaEditor.file.inserted', function (e, editor, $file, response) {
                        console.log("inserted");
                    }).on('froalaEditor.file.error', function (e, editor, error, response) {
                        console.log("error");
                    });
                    //iCheck for checkbox and radio inputs
                    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                        checkboxClass: 'icheckbox_minimal-blue',
                        radioClass: 'iradio_minimal-blue'
                    });
                    $(".show-add").click(function () {
                        $("#add-cat").toggle();
                    });
                });

                //----------------------------------------------Check length for open button save(forcategory)------------------------------------------

                function checklengthcat() {
                    var input = document.getElementById("name_cat");
                    if (input.value.length > 0) {
                        document.getElementById("btnSendAddCat").disabled = false;
                    } else {
                        document.getElementById("btnSendAddCat").disabled = true;
                    }
                }

                //--------------------------------------------------------------------------------------------------------------------------------------

                $(document).ready(function () {
                    // window.alert(data);
                    // window.alert(id_image);
//---------------------------------------fetch_data_category----------------------------------------------------------------------------
                    function fetch_data_cat() {
                        $.ajax({
                            url: "select_cat-edit.php",
                            method: "POST",
                            data: 'id=' + data,
                            success: function (data) {
                                $('#catagory').html(data);
                            }
                        });
                    }

                    fetch_data_cat();

                    //---------------------------------------fetch_data_category----------------------------------------------------------------------------
                    function fetch_move_attr() {
                        $.ajax({
                            url: "recycle-attribute-select.php",
                            method: "POST",
                            data: 'id=' + data_p,
                            success: function (data) {
                                // alert(data);
                                fetch_tr_attribute();
                            }
                        });
                    }

                    fetch_move_attr();

                    //---------------------------------------fetch_data_category----------------------------------------------------------------------------
                    function fetch_tr_attribute() {
                        $.ajax({
                            url: "recycle-attribute.php",
                            method: "POST",
                            data: 'id=' + id_image,
                            success: function (data) {
                                $('#tr_attribute').html(data);
                            }
                        });
                    }

                    //----------------------------------------fetch image in product-----------------------------------------------------------------------
                    function fetch_thumb() {
                        $.ajax({
                            url: "select_data_thumb_edit.php",
                            method: "POST",
                            data: 'id=' + id_image,
                            success: function (data) {
                                $("#live-thumb-edit").html(data);
                            }
                        });
                    }

                    fetch_thumb();

                    //----------------------------------------------check row image for remove btn show--------------------------------------------------------
                    function fetch_btnremove(id) {
                        $.ajax({
                            url: "select_data_exists-main.php",
                            method: "POST",
                            data: {id: id},
                            success: function (data) {
                                if (data.status == 1) {
                                    $(".remove").show();
                                } else {
                                    $(".remove").hide();
                                }
                            }
                        });
                    }

                    fetch_btnremove(data_p);

                    //-------------------------------------------------fetch cage page add for add in page increas data
                    function fetch_data_cat_live_add() {
                        $.ajax({
                            url: "select_cat-page-add.php",
                            method: "POST",
                            success: function (data) {
                                $('#live-selected-catagory').html(data);
                            }
                        });
                    }

                    fetch_data_cat_live_add();

                    $(document).on('click', '.sign_status1', function () {
                        if ($('#sign_status1').is(':checked')) {
                            $('.recom').removeClass('bg-option');
                            $('.recom').addClass('bg-blue');
                        } else {
                            $('.recom').addClass('bg-option');
                            $('.recom').removeClass('bg-blue');
                        }
                    });
                    $(document).on('click', '.sign_status2', function () {
                        if ($('#sign_status2').is(':checked')) {
                            $('.new').removeClass('bg-option');
                            $('.new').addClass('bg-green');
                            $('#new_option').show();
                            $('#new_auto').hide();
                        } else {
                            $('.new').addClass('bg-option');
                            $('.new').removeClass('bg-green');
                            $('#new_option').hide();
                            $('#new_auto').show();
                        }
                    });
                    $(document).on('click', '.sign_status3', function () {
                        if ($('#sign_status3').is(':checked')) {
                            $('.hot').removeClass('bg-option');
                            $('.hot').addClass('bg-red');
                            $('#hot_option').show();
                            $('#hot_auto').hide();
                        } else {
                            $('.hot').addClass('bg-option');
                            $('.hot').removeClass('bg-red');
                            $('#hot_option').hide();
                            $('#hot_auto').show();
                        }
                    });
                    //------------------------------------------------------check tab price type---------------------------------------------------------------
                    $(".normal").on('click', function () {
                        // alert('normal');
                        document.getElementById('tab1').checked = true;
                    });
                    $(".objective").on('click', function () {
                        // alert('objective');
                        document.getElementById('tab2').checked = true;
                    });
                    //------------------------------------------------------------------remove image all--------------------------------------------------------
                    $(document).on('click', '.remove', function () {
                        var id = $(this).attr('data-id');
                        var id_p = $(this).attr('data-p');
                        $.ajax({
                            beforeSend: function () {
                                $("#check_upload").show();
                            },
                            complete: function () {
                                $("#check_upload").hide();
                                $('#img-preview').attr('src', '../img/suit.jpg');
                            },
                            method: "POST",
                            url: 'select_data_DeleteAllmain.php',
                            data: {id: id},
                            success: function (data) {
                                fetch_thumb();
                                fetch_btnremove(id);
                            },
                        });
                    });
                    //--------------------------------------------------------------------------------add catagory----------------------------
                    $(document).on('click', '.btnSendAddCat', function () {
                        var name = $("#name_cat").val();
                        var id_catagory = $('#sub_catagory').val();
                        $.ajax({
                            beforeSend: function () {
                                // setting a timeout
                                $('#loader_cat').show();
                                $('#success_cat').hide();
                            },
                            complete: function () {
                                $('#loader_cat').hide();
                                $('#success_cat').show();
                            },
                            type: "POST",
                            url: "back_catagory-add.php",
                            data: {name: name, sub_catagory: id_catagory},
                            success: function (data) {
                                fetch_data_cat();
                                $('#name_cat').val('');
                            },
                        });
                    });
                    //---------------------------------------------------------------------drop area----------------
                    $('.drop_area').on('dragenter', function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                    });
                    $(".drop_area").on('dragover', function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                    });

                    $(".drop_area").on('drop', function (e) {
                        if (e.originalEvent.dataTransfer) {
                            $('.progress-bar').attr('style', 'width: 0%').attr('aria-valuenow', '0').text('0%'); // Bootstrap progress bar at 0%
                            if (e.originalEvent.dataTransfer.files.length) { // Check if we have files
                                e.preventDefault();
                                e.stopPropagation();
                                // Launch the upload function
                                upload(e.originalEvent.dataTransfer.files); // Access the dropped files with e.originalEvent.dataTransfer.files
                            }
                        }
                    });

                    function upload(files) { // upload function
                        var fd = new FormData(); // Create a FormData object
                        for (var i = 0; i < files.length; i++) { // Loop all files
                            fd.append('files' + i, files[i]); // Create an append() method, one for each file dropped
                        }
                        var id_product = $('#id_product').val();
                        fd.append('nbr_files', i); // The last append is the number of files
                        fd.append('id_product', id_product);
                        $.ajax({ // JQuery Ajax
                            beforeSend: function () {
                                $('.progress').addClass('active');
                            },
                            type: 'POST',
                            url: "back_product_add-imagemain.php", // URL to the PHP file which will insert new value in the database
                            data: fd, // We send the data string
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                alert(data);
                                $('#img-preview').attr('src', '../../uploads/product/' + data);
                                fetch_thumb(); //--------------refresh image area
                                fetch_btnremove(); //----------refresh btn remove
                                document.getElementById('frmADD_thumbnail').reset();//------------------refresh box // Display images thumbnail as result
                                $('.progress-bar').attr('style', 'width: 100%').attr('aria-valuenow', '100').text('100%');
                                $('.progress').removeClass('active'); // Progress bar at 100% when finish
                            },
                            xhrFields: { //
                                onprogress: function (e) {
                                    if (e.lengthComputable) {
                                        var pourc = e.loaded / e.total * 100;
                                        $('.progress-bar').attr('style', 'width: ' + pourc + '%').attr('aria-valuenow', pourc).text(pourc + '%');
                                    }
                                }
                            },
                        });
                    }

                    //----------------------------------------------------------------------------------------------

                    //------------------------------------------------when your click drop_area---------------------
                    $(document).on('click', '.drop_image', function () {
                        $('#files').trigger('click');
                    });
                    //---------------------------------------------------------------upload file auto----------------------------------------------------------
                    $(document).on('change', '#files', function () {
                        var formData = new FormData($('.upload-form-add-imagemain')[0]);
                        var id = $('.remove').attr('data-id');
                        $.ajax({
                            beforeSend: function () {
                                $("#check_upload").show();
                                $('.progress-bar').attr('style', 'width: 0%').attr('aria-valuenow', '0').text('0%');
                            },
                            complete: function () {
                                $("#check_upload").hide();
                            },
                            method: "POST",
                            url: "back_product_add-imagemain.php",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                // alert(data);
                                $('#img-preview').attr('src', '../../uploads/product/' + data);
                                $('.progress-bar').attr('style', 'width: 100%').attr('aria-valuenow', '100').text('100%');
                                // alert(data);
                                fetch_thumb(); //--------------refresh image area
                                fetch_btnremove(id); //----------refresh btn remove
                                document.getElementById('frmADD_imagemain').reset();//------------------refresh box
                            },
                            xhrFields: { //
                                onprogress: function (e) {
                                    if (e.lengthComputable) {
                                        var pourc = e.loaded / e.total * 100;
                                        $('.progress-bar').attr('style', 'width: ' + pourc + '%').attr('aria-valuenow', pourc).text(pourc + '%');
                                    }
                                }
                            },
                        });
                    });

                    $(document).on('click', '.check_cat', function () {
                        var level = $(this).attr('data-lev');
                        var id = $(this).val();
                        var id_t = $(this).attr('data-top');
                        if (level == 2) {
                            if ($('.check_top2' + id).is(':checked')) {
                                $('.check_top1' + id_t).prop('checked', true);
                            } else {
                                $('.check_top3-ex2' + id).prop('checked', false);
                            }
                        } else if (level == 3) {
                            if ($('.check_top3' + id).is(':checked')) {
                                $('.check_top2' + id_t).prop('checked', true);
                                var id_t2 = $('.check_top2' + id_t).attr('data-top');
                                $('.check_top1' + id_t2).prop('checked', true);
                            } else {

                            }
                        } else {
                            if (!$('.check_top1' + id).is(':checked')) {
                                // alert(id);
                                $('.check_top3-ex1' + id).prop('checked', false);
                                $('.check_top2-ex1' + id).prop('checked', false);
                            }
                        }
                    });
                    //---------------------------------------------------------------------send to EDIT file--------------------------------------------------
                    $(document).on('click', '.btnSendClear', function(){
  location.reload();
  })
                    $(document).on('click', '.btnSendEdit', function () {
                        var id_product = $('#id_product').val();
                        var product_name = $('#name_product').val();
                        var product_name_en = $('#product_name_en').val();
                        var product_name_ch = $('#product_name_ch').val();
                        
                        var selling_price = $('#selling_price').val();
                        var price = String(selling_price.replace(",", ""));
                        var capital_cost = $('#capital_cost').val();
                        var normal = String(capital_cost.replace(",", ""));
                        var SKU = $('#SKU').val();
                        var weight = $('#weight').val();
                        var id_branch = $('#id_branch').val();

                        var dev_exits = $('#radio_dev_exist').val();
                        var dev_render = $('#radio_dev_render').val();
                        var input_editor = $('#input-editor').val();
                        var input_editor_en = $('#input-editor_en').val();
                        var input_editor_ch = $('#input-editor_ch').val();

                        var editor_ch_re = $('#input-editor_ch_re').val();
                        var editor_en_re = $('#input-editor_en_re').val();
                        var editor_re = $('#input-editor_re').val();
                        // if($('#transport').is(':checked')){
                        //   var transport = "1";
                        // }else{
                        //   var transport = "0";
                        // }

                        var SKU_1 = $('#SKU_1').val();
                        var tab_mullti  = 0;
                            if($('#tab_ch2').is(":checked")){
                                tab_mullti = 1;
                            }

                        if ($('#tab2').is(':checked')) {
                            var tab = "1";
                            var a_price = $('.a_price').val();
                            var a_price_normal = $('.a_price_normal').val();
                            var a_color = $('.a_color').val();
                            var a_size = $('.a_size').val();
                            if (a_size == "" && a_color == "") {
                                swal("คำเตือน", "คุณยังไม่ได้ไส่แบบสินค้า กรุณาใส่สีหรือขนาดและราคาเพื่อแจำแนกแบบสินค้า", "warning");
                                return false;
                            }
                        } else {
                            var tab = "0";
                            if (price == "") {
                                swal("คำเตือน", "คุณยังไม่ได้ไส่ราคาสินค้า", "warning");
                                return false;
                            }
                            /*if (normal == "") {
                                swal("คำเตือน", "คุณยังไม่ได้ไส่ราคาสินค้า", "warning");
                                return false;
                            }*/
                            if (SKU == "") {
                                swal("คำเตือน", "คุณยังไม่ได้ไส่ร SKU สินค้า", "warning");
                                return false;
                            }
                            /*if (weight == "") {
                                swal("คำเตือน", "คุณยังไม่ได้ไส่ราคาสินค้า", "warning");
                                return false;
                            }*/
                        }
                        if ($(".check_cat:checked").length == 0) { // ถ้าไม่มีการเลือก checkbox ใดๆ เลย
                            swal("คำเตือน", "คุณยังไม่ได้เลือกหมวดหมู่สินค้า", "warning");
                            return false;
                        }
                        //---------------------------------------------------for id_catagory
                        var count_cat = $('#count_cat').val();
                        var id_catagory = '';
                        for (var i = 1; i <= count_cat; i++) {
                            if ($('#id_product-catagory' + i).is(":checked")) {
                                var catagory_value = $('#id_product-catagory' + i).val();
                                id_catagory += catagory_value + ',';
                            }
                        }
                        // if (!$('.discard').hasClass('overlay-cover')) {
                        //     swal({
                        //         title: "ไม่มีรูปภาพ",
                        //         text: "คุณยังไม่ได้เลือกรูปภาพสินค้า",
                        //         imageUrl: '../img/noimage.png'
                        //     });
                        //     return false;
                        // }
                        // alert(id_catagory);
                        // alert(id_catagory);
                        //---------------------------------------------------for id_status
                        // var count_cat = $('#count_status').val();
                        var sign_status = '';
                        for (var i = 1; i <= 5; i++) {
                            if ($('#sign_status' + i).is(":checked")) {
                                var sign_status_value = $('#sign_status' + i).val();
                                sign_status += sign_status_value + ',';
                            }
                        }
                        // alert(sign_status);
                        // alert(status);
                        //----------------------------------------------------send value
                        // var status = '';
                        // for(var i=1;i<=5;i++){
                        //   if($('#status' + i).is(":checked")){
                        //     var status_value = $('#status'+i).val();
                        //   }
                        // }
                        // alert(status_value);

                         var id_attr = $('#id_attr_one').val();
                        //var id_attr="1";
                        //----------------------------------------------------send value
                        var sign_ready  = 0;
                        if($('#sign_ready').is(":checked")){
                            sign_ready = 1;
                          }
                        swal({
                            title: "ยืนยัน?",
                            text: "ยืนยันการแก้ไขสินค้า",
                            type: "info",
                            showCancelButton: true,
                            cancelButtonText: "ยกเลิก",
                            confirmButtonText: "ยืนยัน",
                            closeOnConfirm: false,
                            showLoaderOnConfirm: true
                        }, function () {
                            $.ajax({
                                type: "POST",
                                url: "back_product_edit.php",
                                data: {
                                    product_name: product_name,
                                    product_name_en :product_name_en,
                                    product_name_ch :product_name_ch,
                                    id_catagory: id_catagory,
                                    sign_status: sign_status,
                                    price: price,
                                    normal: normal,
                                    SKU: SKU,
                                    weight: weight,
                                    id_branch: id_branch,
                                    id_product: id_product,
                                    input_editor: input_editor,
                                    input_editor_en: input_editor_en,
                                    input_editor_ch: input_editor_ch,
                                    editor_ch_re:editor_ch_re,
                                    editor_en_re:editor_en_re,
                                    editor_re:editor_re,
                                    sign_ready: sign_ready

                                },
                                success: function (data) {
                                    // console.log(data);
                                    //  alert(data);
                                    var id = data;
                                    var formData = new FormData($('#frm_attribute')[0]);
                                   // if ($('#tab2').is(':checked')) {
                                        $.ajax({
                                            complete: function () {
                                                swal({
                                                        title: "บันทึกสำเร็จ",
                                                        text: "ไปหน้าจัดการสินค้าหรือไม่?",
                                                        type: "success",
                                                        showCancelButton: true,
                                                        confirmButtonClass: "btn-info",
                                                        cancelButtonText: "แก้ไขสินค้าต่อ",
                                                        confirmButtonText: "ไปหน้าจัดการ",
                                                        closeOnConfirm: false
                                                    },
                                                    function () {
                                                        window.location.href = 'front-manage.php';
                                                    });
                                            },
                                            method: "POST",
                                            url: "back_product_edit-attribute.php?id=" + id+"&&tab_mullti="+tab_mullti+"&&SKU_1="+SKU_1+"&&id_branch="+id_branch,
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function (test) {
                                                // alert(test);
                                            },
                                        });
                                    //  } 
                                    //  else {
                                    //     $.ajax({
                                    //         complete: function () {
                                    //             swal({
                                    //                     title: "บันทึกสำเร็จ",
                                    //                     text: "ไปหน้าจัดการสินค้าหรือไม่?",
                                    //                     type: "success",
                                    //                     showCancelButton: true,
                                    //                     confirmButtonClass: "btn-info",
                                    //                     cancelButtonText: "แก้ไขสินค้าต่อ",
                                    //                     confirmButtonText: "ไปหน้าจัดการ",
                                    //                     closeOnConfirm: false
                                    //                 },
                                    //                 function () {
                                    //                     window.location.href = 'front-manage.php';
                                    //                 });
                                    //         },
                                    //         method: "POST",
                                    //         url: "back_product_edit-attribute.php?id=" + id+"&&tab_mullti="+tab_mullti+"&&SKU_1="+SKU_1,
                                    //         data: {
                                    //             price: price,
                                    //             normal: normal,
                                    //             SKU: SKU,
                                    //             weight: weight,
                                    //             tab: tab,
                                    //             id_attr, id_attr
                                    //         },
                                    //         success: function (test) {
                                    //             //alert(test);
                                    //         },
                                    //     });
                                    // }
                                    fetch_thumb();
                                },
                            });
                        });
                    });
                    $(document).on('click', '.del-thumb', function () {
                        var id = $(this).attr('data-id');
                        var id_p = $(this).attr('data-p');
                        $.ajax({
                            type: "POST",
                            url: 'back_product-delmain.php',
                            data: 'id=' + id,
                            success: function (data) {
                                if ($('#active' + id).is(":checked")) {
                                    $('#img-preview').attr('src', '../../uploads/product/' + data);
                                }
                                if (data == '') {
                                    $('#img-preview').attr('src', '../img/suit.jpg');
                                }
                                // alert(data);
                                fetch_thumb();
                                fetch_btnremove(id_p);
                            },
                        });
                    });

                    $(document).on('click', '#print-barcode', function () {
                        var id = $(this).attr('data-id');
                        swal({
                            title: "จำนวนทบาร์โค้ด",
                            text: "กรุณาใส่จำนวนที่จะปริ้น",
                            type: "input",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            inputPlaceholder: "1"
                        }, function (inputValue) {
                            if (inputValue === false) return false;
                            if (inputValue === "") {
                                swal.showInputError("กรุณาใส่จำนวนที่จะปริ้น");
                                return false
                            }
                            window.open('barcode.php?id=' + id + '&num=' + inputValue, '_blank');
                            swal("สำเร็จ", "ปริ้นบาร์โค้ดจำนวน : " + inputValue, "success");
                        });
                        return false
                    });
                    //-------------------------------------------------------------------------Move attribute to recycle----------------------------------------------------------------
                    $(document).on('click', '.del-attribute-recycle', function () {
                        var id = $(this).attr('data-id');
                        // alert(id);
                        $.ajax({
                            type: "POST",
                            url: 'recycle-attribute-back-del.php',
                            data: 'id=' + id,
                            success: function (data) {
                                if (data == 'exist') {
                                    swal("ไม่สามารถลบได้", "สินค้าชิ้นนี้มีการสั่งซื้ออยู่ในออเดอร์ไม่สามารถลบได้", "warning");
                                    return false;
                                }
                                // alert(data);
                                // alert(data);
                                fetch_thumb();
                                fetch_btnremove();
                                fetch_tr_attribute();
                            },
                        });
                    });

                    //-----------------------------------------------------------------------------------------update active product------------------------------------------------------
                    $('body').on('click', '.image-preview', function () {
                        var id = $(this).attr('data-id');
                        var some = $(this).attr('data-some');
                        var name = $(this).attr('data-name');
                        $('#img-preview').attr('src', '../../uploads/product/' + name);
                        $('.discard').removeClass('overlay-cover');
                        $('.text-image').hide();
                        // $('.text'+id).fadeIn('slow');
                        $('.text' + id).show();
                        $('.overlay-image' + id).show();
                        $('.overlay-image' + id).addClass('overlay-cover');
                        document.getElementById('active' + id).checked = true;
                        $.ajax({
                            beforeSend: function () {
                                $("#check_active" + id).show();
                                $("#check_active_true" + id).hide();
                            },
                            complete: function () {
                                $("#check_active" + id).hide();
                                $("#check_active_true" + id).show();
                            },
                            type: "POST",
                            url: 'back_product-updateactive-main.php',
                            data: 'id=' + some,
                            success: function (data) {
                                // alert(data);
                                fetch_thumb();
                                fetch_btnremove();
                            },
                        });
                    });
                    //------------------------------------------------------------------------------------------------
                    $(document).on('click', '.del-attribute', function () {
                        var id = $(this).attr('data-id');
                        document.getElementById('chk' + id).checked = true;
                        try {
                            var table = document.getElementById('table-attribute');
                            var rowCount = table.rows.length;
                            // alert(rowCount);
                            for (var i = 0; i < rowCount; i++) {
                                var row = table.rows[i];
                                var chkbox = row.cells[3].childNodes[0];
                                if (null != chkbox && true == chkbox.checked) {
                                    table.deleteRow(i);
                                    rowCount--;
                                    i--;
                                }
                            }
                        } catch (e) {
                            alert(e);
                        }
                    });

                    $(document).on('click', '.check_value', function () {
                        var i = $(this).attr('data-id');
                        if ($(this).is(':checked')) {
                            $('#option_check_hidden' + i).val('1');
                        } else {
                            $('#option_check_hidden' + i).val('0');
                        }
                    });

                    $(document).on('click', '.old_item', function () {
                        $('#radio_dev_render').prop('checked', false);
                        $('.not_in').removeClass('active_item');
                        $(this).addClass('active_item');
                        $('.variants_change').prop('checked', false);
                        $('.exist_check').prop('checked', true);
                        $('.dev-product-variant-render-exits').show();
                        $('.dev-product-variant-render').hide();
                        $('.variants_temp').remove();
                        $('.empty-message').hide();
                    });
                    $(document).on('click', '.new_gen', function () {
                        $('#radio_dev_exist').prop('checked', false);
                        $('.not_in').removeClass('active_item');
                        $(this).addClass('active_item');
                        // if($('.dev-product-variant-render').is(':hidden')){
                        $('.variants_change').prop('checked', false);
                        // }
                        $('.empty-message').show();
                        $('.dev-product-variant-render-exits').hide();
                        $('.variants_temp').remove();
                        $('.dev-product-variant-render').hide();
                    });


                    //----------------------------------------------------add tr-----------------------------------------------------------------------
                    $(document).on('click', '.add-row', function () {
                        var attribute_text = $('#attribute_text').val();
                        var attribute_head = $('#attribute_head').val();
                        $.ajax({
                            url: "back_add-show-attribute.php",
                            method: "POST",
                            data: {
                                head: attribute_head,
                                text: attribute_text
                            },
                            success: function (data) {
                                i = 1;
                                //--------------------------------------------------------------นับ จำนวน-------------------------------------------------
                                $('.variants_change').each(function () {
                                    i++;
                                });
                                //--------------------------------------------------------------นับ จำนวน-------------------------------------------------
                                var markup = '';
                                markup += "<tr>";
                                markup += '<td align="center"><input type="checkbox" name="" value="' + attribute_text + '" data-idhead="' + data.status + '" data-attr="' + attribute_head + '" class="smtp_changes' + i + ' variants_change variants_num_check' + i + '">';
                                markup += '<td>' + attribute_head + '</td>';
                                markup += '<td><input type="text" value="' + attribute_text + '" data-idhead="' + data.status + '" id="tags" data-role="tagsinput" data-smtp="' + i + '" class="tagss form-control" style="border:none;"></td></tr>';

                                $(".show-attribute").append(markup);
                                $('#attribute_text').val('');
                                $('#attribute_head').val('');
                                $('#attribute_text').tagsinput('removeAll');
                                $.getScript("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js");
                            }
                        });
                    });
//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------tag it-----------------------------------------------------------------------
                    $(document).on('change', '.tagss', function () {
                        var exist_check = '';
                        var exist_checked = '';

                        $('.exist_check').each(function () {

                            if ($(this).is(':checked')) {
                                exist_check += '1';
                            } else {
                                exist_check += '0';
                            }
                        });

                        var i = $(this).attr('data-smtp');
                        var val_smtp = $(this).val();
                        $('.smtp_changes' + i).val(val_smtp);
                        if (val_smtp == '') {
                            $('.smtp_changes' + i).prop("disabled", true);
                            $('.smtp_changes' + i).prop("checked", false);
                        } else {
                            $('.smtp_changes' + i).prop("disabled", false);
                            $('.smtp_changes' + i).prop('checked', true);
                        }
                        var cook = '';
                        var array_push = '';
                        var text_id = '';
                        $('.variants_change').each(function () {
                            if ($(this).is(":checked")) {
                                exist_checked += '1';
                                var id_attr_head = $(this).attr('data-idhead');
                                text_id += id_attr_head + ',';
                                var text_push = $(this).val();
                                array_push += text_push + '||';
                            }
                        });
                        $('.id_attr_head').val(text_id);
                        var array_cut_head = array_push.split("||");
                        // alert(array_cut_head.length)

                        if ($('.variants_change').is(':checked')) {
                            var sum = 1;
                            var allArrays = [];
                            for (var i = 0; i < array_cut_head.length - 1; i++) { // ตัดออกมา เหลือ 2
                                var num = array_cut_head[i].split(',');
                                var text_for_push = '';
                                for (var a = 0; a < num.length; a++) {
                                    if (a == num.length - 1) {
                                        text_for_push += num[a] + ',';
                                    } else {
                                        text_for_push += num[a] + ',-';
                                    }

                                }
                                // num = ตัด , ออกจะได้ จะได้เป็นอาเรย์
                                var cut_text_for_push = text_for_push.split('-');
                                allArrays.push(cut_text_for_push);         // num[i] คือ อาเรย์ที่ จะเก็บค่าข้างใน
                                x = num.length;
                                sum *= x;
                            }

                            // var allArrays = new Array(['a', 'b'], ['c', 'z'], ['d', 'e', 'f']);

                            function getPermutation(array, prefix) {
                                prefix = prefix || '';
                                if (!array.length) {
                                    return prefix;
                                }

                                var result = array[0].reduce(function (result, value) {
                                    return result.concat(getPermutation(array.slice(1), prefix + value));
                                }, []);
                                return result;
                            }

                            var r = getPermutation(allArrays);
                            console.log(allArrays);
                            // return false;        // alert(sum);
                            for (var a = 0; a < sum; a++) {
                                // if(num-a == 1){
                                cook += '<tr class="variants_temp">';
                                cook += '<td><label>';
                                cook += '<img src="https://www.igetweb.com/themes_v2/assets/img/default-img.png" ';
                                cook += 'class="variant-img' + a + ' item-list-img default-img" style="width:40px; cursor:pointer;">';
                                cook += '<input type="file" class="image_upload" data-id="' + a + '" style="display:none;" name="attr_file[]"></label>';
                                cook += '</td>';
                                cook += '<td>';
                                var text_label = r[a].split(',');
                                var val_text = '';
                                for (var i = 0; i < text_label.length - 1; i++) {
                                    if (i == text_label.length - 2) {
                                        val_text += text_label[i];
                                    } else {
                                        val_text += text_label[i] + '/';
                                    }
                                    cook += '<small class="label pull-left bg-option1" style="margin-right: 5px; margin-bottom:5px;">' + text_label[i] + '</small>';
                                }
                                cook += '<input type="hidden" value="' + val_text + '" name="option_attr[]" id="option_attr_render' + a + '">';
                                cook += '<input type="hidden" name="attr_head[]" value="" class="id_attr_head">';
                                cook += '</td>';
                                cook += '<td>';
                                cook += '<div class="input-group input-group-sm">';
                                cook += '<input type="text" name="price[]" value="" class="form-control" >';
                                cook += '<span class="input-group-addon" style="padding:5px;">THB</span>';
                                cook += '</div>';
                                cook += '</td>';
                                cook += '<td>';
                                cook += '<div class="input-group input-group-sm">';
                                cook += '<input type="text" name="normal[]" value="" class="form-control" >';
                                cook += '<span class="input-group-addon" style="padding:5px;">THB</span>';
                                cook += '</div>';
                                cook += '</td>';
                                cook += '<td>';
                                cook += '<input type="text" class="form-control input-sm" name="SKU[]">';
                                cook += '</td>';
                                cook += '<td>';
                                cook += '<input name="stock[]" type="text" class="form-control input-sm" style="max-width:45px; padding-left:0; padding-right:0;">';
                                cook += '</td>';
                                cook += '<td>';
                                cook += '<div class="input-group input-group-sm">';
                                cook += '<input name="weight[]" type="text" name="" value="" class="form-control" >';
                                cook += '<span class="input-group-addon" style="padding:5px;">g</span>';
                                cook += '</div>';
                                cook += '</td>';
                                cook += '<td style="text-align:center; width:60px; max-width:60px;">';
                                cook += '<input name="" type="checkbox" checked="check" value="1" data-id="' + a + '" class="check_value">';
                                cook += '<input name="show[]" type="checkbox" checked id="option_check_hidden' + a + '" value="1" hidden>';
                                cook += '</td>';
                            }
                            // if(exist_checked===exist_check){
                            //   // remove class or hidden class
                            //   var option_render = '';
                            //   for(var a=0;a<sum;a++){
                            //     var text_label = r[a].split(',');
                            //     var val_text =''
                            //     for(var i=0;i< text_label.length-1;i++){
                            //       if(i==text_label.length-2){
                            //         val_text +=text_label[i];
                            //       }else{
                            //         val_text +=text_label[i]+'/';
                            //       }
                            //     }
                            //     if(sum-a==1){
                            //       option_render += $('#option_attr_render'+a+'').val();
                            //     }else{
                            //       option_render += $('#option_attr_render'+a+'').val()+'-';
                            //     }
                            //   }
                            //   var j_num = $('#exist_num').val();
                            //   var option = '';
                            //   for(var j=0;j<j_num;j++){
                            //     if(j_num-j==1){
                            //       option += $('#option_attr'+j+'').val();
                            //     }else{
                            //       option += $('#option_attr'+j+'').val()+'-';
                            //     }
                            //   }

                            //   // alert(option_render);
                            //   // alert(option);
                            //   Array.prototype.diff = function (a) {
                            //       return this.filter(function (i) {
                            //           return a.indexOf(i) === -1;
                            //       });
                            //   };
                            //   var arr1 = option_render.split('-');
                            //   var arr2 = option.split('-');
                            //   var result_arr = arr2.diff(arr1);
                            //   alert(result_arr);
                            //   for(var j=0;j<j_num;j++){
                            //     var text_old = $('#option_attr'+j+'').val();
                            //     for(var j_c=0;j_c<result_arr.length;j_c++){
                            //       if(text_old==result_arr[j_c]){
                            //         $('#option_check'+j+'').prop('checked', false);
                            //       }
                            //     }
                            //   }

                            //   $('.dev-product-variant-render-exits').show();
                            //   $('.dev-product-variant-render').hide();
                            //   $('.empty-message').hide();
                            //   $('#radio_dev_exist').prop('checked', true);
                            // }else{

                            $('.not_in').removeClass('active_item');
                            $('.new_gen').addClass('active_item');
                            $('#radio_dev_exist').prop('checked', false);
                            $('#radio_dev_render').prop('checked', true);

                            $('.dev-product-variant-render-exits').hide();
                            $('.dev-product-variant-render').show();
                            $('.empty-message').hide();
                            $('.dev-product-variant-render').html(cook);
                            // }
                            // $('.dev-product-variant-render').show();

                        } else {
                            $('.dev-product-variant-render-exits').hide();
                            $('.dev-product-variant-render').hide();
                            $('.empty-message').show();
                        }
                        $('.id_attr_head').val(text_id);

                    });
//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------!!tag it---------------------------------------------------------------------

//----------------------------------------------------generate variants------------------------------------------------------------
                    $(document).on('click', '.variants_change', function () {
                        var exist_check = '';
                        var exist_checked = '';

                        $('.exist_check').each(function () {

                            if ($(this).is(':checked')) {
                                exist_check += '1';
                            } else {
                                exist_check += '0';
                            }
                        });


                        var cook = '';
                        var array_push = '';
                        var text_id = '';
                        $('.variants_change').each(function () {
                            if ($(this).is(":checked")) {
                                exist_checked += '1';
                                var id_attr_head = $(this).attr('data-idhead');
                                text_id += id_attr_head + ',';
                                var text_push = $(this).val();
                                array_push += text_push + '||';
                            }
                        });
                        var array_cut_head = array_push.split("||");
                        // alert(array_cut_head.length)

                        if ($('.variants_change').is(':checked')) {
                            var sum = 1;
                            var allArrays = [];
                            for (var i = 0; i < array_cut_head.length - 1; i++) { // ตัดออกมา เหลือ 2
                                var num = array_cut_head[i].split(',');
                                var text_for_push = '';
                                for (var a = 0; a < num.length; a++) {
                                    if (a == num.length - 1) {
                                        text_for_push += num[a] + ',';
                                    } else {
                                        text_for_push += num[a] + ',-';
                                    }

                                }
                                // num = ตัด , ออกจะได้ จะได้เป็นอาเรย์
                                var cut_text_for_push = text_for_push.split('-');
                                allArrays.push(cut_text_for_push);         // num[i] คือ อาเรย์ที่ จะเก็บค่าข้างใน
                                x = num.length;
                                sum *= x;
                            }

                            // var allArrays = new Array(['a', 'b'], ['c', 'z'], ['d', 'e', 'f']);

                            function getPermutation(array, prefix) {
                                prefix = prefix || '';
                                if (!array.length) {
                                    return prefix;
                                }

                                var result = array[0].reduce(function (result, value) {
                                    return result.concat(getPermutation(array.slice(1), prefix + value));
                                }, []);
                                return result;
                            }

                            var r = getPermutation(allArrays);
                            console.log(allArrays);
                            // return false;        // alert(sum);
                            for (var a = 0; a < sum; a++) {
                                // if(num-a == 1){
                                cook += '<tr class="variants_temp">';
                                cook += '<td><label>';
                                cook += '<img src="https://www.igetweb.com/themes_v2/assets/img/default-img.png" ';
                                cook += 'class="variant-img' + a + ' item-list-img default-img" style="width:40px; cursor:pointer;">';
                                cook += '<input type="file" class="image_upload" data-id="' + a + '" style="display:none;" name="attr_file[]"></label>';
                                cook += '</td>';
                                cook += '<td>';
                                var text_label = r[a].split(',');
                                var val_text = '';
                                for (var i = 0; i < text_label.length - 1; i++) {
                                    if (i == text_label.length - 2) {
                                        val_text += text_label[i];
                                    } else {
                                        val_text += text_label[i] + '/';
                                    }
                                    cook += '<small class="label pull-left bg-option1" style="margin-right: 5px; margin-bottom:5px;">' + text_label[i] + '</small>';
                                }
                                cook += '<input type="hidden" value="' + val_text + '" name="option_attr[]">';
                                cook += '<input type="hidden" name="attr_head[]" value="" class="id_attr_head">';
                                cook += '</td>';
                                cook += '<td>';
                                cook += '<div class="input-group input-group-sm">';
                                cook += '<input type="text" name="price[]" value="" class="form-control" >';
                                cook += '<span class="input-group-addon" style="padding:5px;">THB</span>';
                                cook += '</div>';
                                cook += '</td>';
                                cook += '<td>';
                                cook += '<div class="input-group input-group-sm">';
                                cook += '<input type="text" name="normal[]" value="" class="form-control" >';
                                cook += '<span class="input-group-addon" style="padding:5px;">THB</span>';
                                cook += '</div>';
                                cook += '</td>';
                                cook += '<td>';
                                cook += '<input type="text" class="form-control input-sm" name="SKU[]">';
                                cook += '</td>';
                                // cook += '<td>';
                                // cook += '<input type="text" name="stock[]" class="form-control input-sm" style="max-width:45px; padding-left:0; padding-right:0;">';
                                // cook += '</td>';
                                cook += '<td>';
                                cook += '<div class="input-group input-group-sm">';
                                cook += '<input type="text" name="weight[]" value="" class="form-control" >';
                                cook += '<span class="input-group-addon" style="padding:5px;">g</span>';
                                cook += '</div>';
                                cook += '</td>';
                                cook += '<td style="text-align:center; width:60px; max-width:60px;">';
                                cook += '<input name="" type="checkbox" checked="check" value="1" data-id="' + a + '" class="check_value">';
                                cook += '<input name="show[]" type="checkbox" checked id="option_check_hidden' + a + '" value="1" hidden>';
                                cook += '</td>';
                            }

                            if (exist_checked != exist_check) {
                                $('.not_in').removeClass('active_item');
                                $('.new_gen').addClass('active_item');
                                $('#radio_dev_exist').prop('checked', false);
                                $('#radio_dev_render').prop('checked', true);
                            }
                            $('.dev-product-variant-render-exits').hide();
                            $('.dev-product-variant-render').show();
                            $('.empty-message').hide();
                            $('#radio_dev_exist').prop('checked', false);
                            $('#radio_dev_render').prop('checked', true);
                            // $('.dev-product-variant-render').show();
                            $('.dev-product-variant-render').html(cook);
                        } else {
                            $('.dev-product-variant-render').hide();
                            $('.empty-message').show();
                            $('.dev-product-variant-render-exits').hide();
                        }
                        $('.id_attr_head').val(text_id);

                        // alert(exist_check+' '+exist_checked);


                    });
                    $(document).on('change', '.image_upload', function () {
                        var i = $(this).attr('data-id');
                        readURL_upload(this, i);
                    });
                });

                //---------------------------------------------------- preview image----------------------------------
                function readURL_upload(input, i) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('.variant-img' + i).attr('src', e.target.result).fadeIn('slow');
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                }


                // // Open the Modal
                // function openModal() {
                //   document.getElementById('myModal').style.display = "block";
                // }

                // // Close the Modal
                // function closeModal() {
                //   document.getElementById('myModal').style.display = "none";
                // }

                // var slideIndex = 1;
                // showSlides(slideIndex);

                // // Next/previous controls
                // function plusSlides(n) {
                //   showSlides(slideIndex += n);
                // }

                // // Thumbnail image controls
                // function currentSlide(n) {
                //   showSlides(slideIndex = n);
                // }

                function showSlides(n) {
                    var i;
                    var slides = document.getElementsByClassName("mySlides");
                    var dots = document.getElementsByClassName("demo");
                    var captionText = document.getElementById("caption");
                    if (n > slides.length) {
                        slideIndex = 1
                    }
                    if (n < 1) {
                        slideIndex = slides.length
                    }
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                    }
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex - 1].style.display = "block";
                    dots[slideIndex - 1].className += " active";
                    captionText.innerHTML = dots[slideIndex - 1].alt;
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
                function formatMoney_n(inum) {
                    // ฟังก์ชันสำหรับแปลงค่าตัวเลขให้อยู่ในรูปแบบ เงิน
                    var s_inum = String(inum.replace(/,/g, ""));
                    if (s_inum != "") {
                        $('#normal_price').show();
                    } else {
                        $('#normal_price').hide();
                    }

                    var num2 = s_inum.split(".");
                    var n_inum = "";
                    if (num2[0] != undefined) {
                        var l_inum = num2[0].length;
                        for (i = 0; i < l_inum; i++) {
                            if (parseInt(l_inum - i) % 3 == 0) {
                                if (i == 0) {
                                    n_inum += s_inum.charAt(i);
                                } else {
                                    n_inum += "," + s_inum.charAt(i);
                                }
                            } else {
                                n_inum += s_inum.charAt(i);
                            }
                        }
                    } else {
                        n_inum = inum;
                    }
                    if (num2[1] != undefined) {
                        n_inum += "." + num2[1];
                    }
                    $('#variant_price_normal').val(n_inum);
                    $('#price_n').html(n_inum);
                }

                function formatMoney_s(inum) {  // ฟังก์ชันสำหรับแปลงค่าตัวเลขให้อยู่ในรูปแบบ เงิน
                    var s_inum = String(inum.replace(/,/g, ""));
                    var num2 = s_inum.split(".");
                    var n_inum = "";
                    if (num2[0] != undefined) {
                        var l_inum = num2[0].length;
                        for (i = 0; i < l_inum; i++) {
                            if (parseInt(l_inum - i) % 3 == 0) {
                                if (i == 0) {
                                    n_inum += s_inum.charAt(i);
                                } else {
                                    n_inum += "," + s_inum.charAt(i);
                                }
                            } else {
                                n_inum += s_inum.charAt(i);
                            }
                        }
                    } else {
                        n_inum = inum;
                    }
                    if (num2[1] != undefined) {
                        n_inum += "." + num2[1];
                    }
                    $('#variant_price').val(n_inum);
                    $('#price_s').html(n_inum);
                }

                function show_text(val) {
                    var price = String(val);
                    if (price != "") {
                        $("#price_text").show();
                    } else {
                        $('#price_text').hide();
                    }
                    $("#price_text").html(price);
                }

                function Addattribute() {
                    var table = document.getElementById("table-attribute");
                    var rowCount = table.rows.length;
                    var row = table.insertRow(rowCount);
                    var num = rowCount;
                    var num_attr = num + 1;
                    // alert(num);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);
                    cell4.innerHTML = "<input type='radio' name='chk[]' id='chk" + num + "' hidden><button type='button' style='height:30px; padding: 5px;' class='btn btn-block del-attribute' data-id='" + num + "'><i class='glyphicon glyphicon-trash'></i></button>";
                    cell1.innerHTML = "<div style='width:100%; border-bottom:2px solid blue; margin-bottom:5px; font-size:16px;'>แบบที่ " + num_attr + "</div>สี<div class='input-group' style='margin-bottom: 0; padding-bottom: 5px; width:100%;'><input name='color[]' type='text' class='form-control' style='border-radius: 2px;'></div>";
                    cell1.innerHTML += "ขนาด<div class='input-group' style='margin-bottom: 0; padding-bottom:5px; width:100%;'><input name='size[]' type='text' class='form-control' style='border-radius: 2px;'></div>";
                    cell1.innerHTML += "รหัสสินค้า<div class='input-group' style='margin-bottom: 0; width:100%;'><input name='SKU[]' type='text' class='form-control' style='border-radius: 2px;'></div>";
                    cell2.innerHTML = "<div style='margin-top:29px;'>ราคาขาย<div class='input-group' style='margin-bottom: 0; padding-bottom: 5px;'><input name='price[]' type='text' class='form-control' style='border-radius: 2px;'><span class='input-group-addon'>THB</span></div></div>";
                    cell2.innerHTML += "ราคาปกติ<div class='input-group' style='margin-bottom: 0; padding-bottom: 5px;'><input name='normal[]' type='text' class='form-control' style='border-radius: 2px;'><span class='input-group-addon'>THB</span></div>";
                    cell2.innerHTML += "รายละเอียดภาษาไทย<div class='input-group' style='margin-bottom: 0; width:100%;'><input name='DET[]' type='text' class='form-control' style='border-radius: 2px;'></div>";
                    cell3.innerHTML = "<div style='margin-top:29px;'>สต็อก<div class='input-group' style='margin-bottom: 0; padding-bottom: 5px;'><input name='stock[]' type='text' class='form-control' style='border-radius: 2px;'><span class='input-group-addon'>U</span></div></div>";
                    cell3.innerHTML += "น้ำหนัก<div class='input-group' style='margin-bottom: 0;padding-bottom: 5px;'><input name='weight[]' type='text' class='form-control' style='border-radius: 2px;'><span class='input-group-addon'>G</span></div>";
                    cell3.innerHTML += "รายละเอียดภาษาอังกฤษ<div class='input-group' style='margin-bottom: 0; width:100%;'><input name='DET_EN[]' type='text' class='form-control' style='border-radius: 2px;'></div>"
                }

                // function DeleteRow(row){
                //   document.getElementById('chk'+row).checked = true;
                // }
                function tickChk_status(i, a, b, c, active) {
                    $(".style").removeClass('check-active-' + a);
                    $(".style").removeClass('check-active-' + b);
                    $(".style").removeClass('check-active-' + c);
                    $("#tickChk_status" + i).addClass('check-active-' + active);
                    document.getElementById('status' + i).checked = true;
                }

                function checklength() {
                    var input = document.getElementById("product_name");
                    if (input.value.length > 0) {
                        document.getElementById("btnSendEdit").disabled = false;
                    } else {
                        document.getElementById("btnSendEdit").disabled = true;
                    }
                }

                function deleteRow(row) {
                    document.getElementById("table-attribute").deleteRow(row);
                }

                //----------------------------------------------------Set time realtime------------------------------------------------------------------------
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
                    if (i < 10) {
                        i = "0" + i
                    }
                      // add zero in front of numbers < 10
                    return i;
                }
            </script>
</body>
</html>

<!-- cell1.innerHTML = "<input type='radio' name='chk[]' id='chk"+num+"' hidden><button type='button' style='height:100%; padding: 5px;' class='btn btn-block del-attribute' data-id='"+num+"'><i class='glyphicon glyphicon-trash'></i></button>";
    // cell2.innerHTML = "<img src='../image-folder/suit.jpg' width='45' height='35'>";
    cell2.innerHTML = "<div class='input-group' style='margin-bottom: 0; padding-bottom: 5px;'><span class='input-group-addon' style='background-color: #228896; color:white; width: 57px;'>สี</span><input name='color[]' type='text' class='form-control' style='border-radius: 2px;'></div><div class='input-group' style='margin-bottom: 0; padding-bottom:5px;'><span class='input-group-addon' style='background-color: #228896; color:white;'>ขนาด</span><input name='size[]' type='text' class='form-control' style='border-radius: 2px;'></div>";
    cell2.innerHTML += "</div><div class='input-group' style='margin-bottom: 0;'><span class='input-group-addon' style='background-color: #228896; color:white; width: 57px;'>SKU</span><input name='SKU[]' type='text' class='form-control' style='border-radius: 2px;'></div>";

    cell3.innerHTML = "<div class='input-group' style='margin-bottom: 0; padding-bottom: 5px;'><span class='input-group-addon' style='background-color: #228896; color:white; width: 79px;'>ราคาขาย</span><input name='price[]' type='text' class='form-control' style='border-radius: 2px;'><span class='input-group-addon'>THB</span></div>";
    cell3.innerHTML += "<div class='input-group' style='margin-bottom: 0; padding-bottom: 5px'><span class='input-group-addon' style='background-color: #228896; color:white;'>ราคาปกติ</span><input name='normal[]' type='text' class='form-control' style='border-radius: 2px;'><span class='input-group-addon'>THB</span></div>";
    cell3.innerHTML += "<div class='input-group' style='margin-bottom: 0; width:100%;'><span class='input-group-addon' style='background-color: #228896; color:white; font-size: 12px;'>รายละเอียด</span><input name='DET[]' type='text' class='form-control' style='border-radius: 2px;'></div>"
    cell4.innerHTML = "<div class='input-group' style='margin-bottom: 0; padding-bottom: 5px;'><span class='input-group-addon' style='background-color: #228896; color:white; width: 65px;'>สต็อก</span><input name='stock[]' type='text' class='form-control' style='border-radius: 2px;'><span class='input-group-addon'>U</span></div>";
    cell4.innerHTML += "<div class='input-group' style='margin-bottom: 0;'><span class='input-group-addon' style='background-color: #228896; color:white;'>น้ำหนัก</span><input name='weight[]' type='text' class='form-control' style='border-radius: 2px;'><span class='input-group-addon'>G</span></div>"; -->
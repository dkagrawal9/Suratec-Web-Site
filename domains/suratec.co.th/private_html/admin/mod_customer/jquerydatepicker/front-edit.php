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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
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
    </style>

     <style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

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
                <?=lang('แก้ไขสินค้า','Edit product')?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="../../index.php"></i> <?=lang('แดชบอร์ด','Dashboard')?></a></li>
                <li><a href="front-manage.php"></i> <?=lang('การจัดการสินค้า','Product management')?></a></li>
                <li class="active"><?=lang('แก้ไขสินค้า','Edit product')?></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- SELECT2 EXAMPLE -->
           

            <?php
            $str = "SELECT product.* FROM `product`  WHERE product.id_product = '" . $_GET['id'] . "'";
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
                <div class="col-md-5">
                    <div class="row"  id="texts">
          <div class="col-md-12">
            <div class="box box-warning">
              <div class="box-header">
                <h3 class="box-title"><?=lang('รายละเอียดสินค้า','Details')?></h3>
              </div>
              <div class="box-body">
                                        <label class="col-sm-2 control-label"><?=lang('Title Tag','Title Tag')?></label>
                                        <div class='col-sm-9' id='datetimepicker'>
                                            <input type='text' class="form-control"  name="title_tag" id="title_tag" value="<?php echo  $result['title_tag'] ?>">
                                        </div>
                                        <p class="col-sm-1">
                                          <font class="title_tag_class_normal"  id="title_tag_id_normal" style="display: none;" >*</font>
                                          <i class="fa fa-check" id="title_tag_id_success" style="position:absolute;margin-left: 10px; color: green !important; "></i>
                                          <i class="fa fa-times-circle" id="title_tag_id_wrong" style="position:absolute; margin-left: 10px; color: orange !important; display: none;"> </i>
                                        </p>  
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label"><?=lang('Description Tag','Description Tag')?></label>
                                        <div class='col-sm-9' id='datetimepicker'>
                                            <input type='text' class="form-control"  name="description_tag" id="description_tag" value="<?php echo  $result['description_tag'] ?>">
                                        </div>
                                        <p class="col-sm-1">
                                          <font class="description_tag_class_normal"  id="description_tag_id_normal" style="display: none;" >*</font>
                                          <i class="fa fa-check" id="description_tag_id_success" style="position:absolute;margin-left: 10px; color: green !important; "></i>
                                          <i class="fa fa-times-circle" id="description_tag_id_wrong" style="position:absolute; margin-left: 10px; color: orange !important; display: none;"> </i>
                                        </p>
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label"><?=lang('Keyword Tag','Keyword Tag')?></label>
                                        <div class='col-sm-9' id='datetimepicker'>
                                            <input type='text' class="form-control"  name="keyword_tag" id="keyword_tag" value="<?php echo  $result['keywords_tag'] ?>">
                                        </div>
                                        <p class="col-sm-1">
                                          <font class="keyword_tag_class_normal"  id="keyword_tag_id_normal" style="display: none;" >*</font>
                                          <i class="fa fa-check" id="keyword_tag_id_success" style="position:absolute;margin-left: 10px; color: green !important; "></i>
                                          <i class="fa fa-times-circle" id="keyword_tag_id_wrong" style="position:absolute; margin-left: 10px; color: orange !important; display: none;"> </i>
                                        </p>
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label"><?=lang('ชื่อเต็ม EN','Full name EN')?></label>
                                        <div class='col-sm-9' id='datetimepicker'>
                                            <input type='text' class="form-control"  name="name_en" id="name_en" value="<?php echo  $result['name_en'] ?>">
                                        </div>
                                        <p class="col-sm-1">
                                          <font class="name_en_class_normal"  id="name_en_id_normal" style="display: none;" >*</font>
                                          <i class="fa fa-check" id="name_en_id_success" style="position:absolute;margin-left: 10px; color: green !important; "></i>
                                          <i class="fa fa-times-circle" id="name_en_id_wrong" style="position:absolute; margin-left: 10px; color: orange !important; display: none;"> </i>
                                        </p>
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label"><?=lang('ชื่อเต็ม TH','Full name TH')?></label>
                                        <div class='col-sm-9' id='datetimepicker'>
                                            <input type='text' class="form-control"  name="name_th" id="name_th" value="<?php echo  $result['name_th'] ?>">
                                        </div>
                                        <p class="col-sm-1">
                                          <font class="name_th_class_normal"  id="name_th_id_normal" style="display: none;" >*</font>
                                          <i class="fa fa-check" id="name_th_id_success" style="position:absolute;margin-left: 10px; color: green !important; "></i>
                                          <i class="fa fa-times-circle" id="name_th_id_wrong" style="position:absolute; margin-left: 10px; color: orange !important; display: none;"> </i>
                                        </p>
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label"><?=lang('ชื่อเต็ม CH','Full name CH')?></label>
                                        <div class='col-sm-9' id='datetimepicker'>
                                            <input type='text' class="form-control"  name="name_ch" id="name_ch" value="<?php echo  $result['name_ch'] ?>">
                                        </div>
                                        <p class="col-sm-1">
                                          <font class="name_ch_class_normal"  id="name_ch_id_normal" style="display: none;">*</font>
                                          <i class="fa fa-check" id="name_ch_id_success" style="position:absolute;margin-left: 10px; color: green !important; "></i>
                                          <i class="fa fa-times-circle" id="name_ch_id_wrong" style="position:absolute; margin-left: 10px; color: orange !important; display: none;"> </i>
                                        </p>
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label"><?=lang('ชื่อย่อ EN','Initials EN')?></label>
                                        <div class='col-sm-9' id='datetimepicker'>
                                            <input type='text' class="form-control"  name="abbrev_en" id="abbrev_en" value="<?php echo  $result['abbrv_en'] ?>">
                                        </div>
                                        <p class="col-sm-1">
                                          <font class="abbrev_en_class_normal"  id="abbrev_en_id_normal" style="display: none;" >*</font>
                                          <i class="fa fa-check" id="abbrev_en_id_success" style="position:absolute;margin-left: 10px; color: green !important; "></i>
                                          <i class="fa fa-times-circle" id="abbrev_en_id_wrong" style="position:absolute; margin-left: 10px; color: orange !important; display: none;"> </i>
                                        </p>
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label"><?=lang('ชื่อย่อ TH','Initials TH')?></label>
                                        <div class='col-sm-9' id='datetimepicker'>
                                            <input type='text' class="form-control"  name="abbrev_th" id="abbrev_th" value="<?php echo  $result['abbrv_th'] ?>">
                                        </div>
                                        <p class="col-sm-1">
                                          <font class="abbrev_th_class_normal"  id="abbrev_th_id_normal" style="display: none;" >*</font>
                                          <i class="fa fa-check" id="abbrev_th_id_success" style="position:absolute;margin-left: 10px; color: green !important; "></i>
                                          <i class="fa fa-times-circle" id="abbrev_th_id_wrong" style="position:absolute; margin-left: 10px; color: orange !important; display: none;"> </i>
                                        </p>
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label"><?=lang('ชื่อย่อ CH','Initials CH')?></label>
                                        <div class='col-sm-9' id='datetimepicker'>
                                            <input type='text' class="form-control"  name="abbrev_ch" id="abbrev_ch" value="<?php echo  $result['abbrv_ch'] ?>">
                                        </div>
                                        <p class="col-sm-1">
                                          <font class="abbrev_ch_class_normal"  id="abbrev_ch_id_normal" style="display: none;" >*</font>
                                          <i class="fa fa-check" id="abbrev_ch_id_success" style="position:absolute;margin-left: 10px; color: green !important; "></i>
                                          <i class="fa fa-times-circle" id="abbrev_ch_id_wrong" style="position:absolute; margin-left: 10px; color: orange !important; display: none;"> </i>
                                        </p>
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label">
                                            <?=lang('หน่วยใหญ่','Large unit')?>
                                          <font class="large_unit_id_normal"  id="large_unit_id_normal" style="display: none;" >*</font>
                                          <i class="fa fa-check" id="large_unit_id_success" style="position:absolute; color: green !important; "></i>
                                          <i class="fa fa-times-circle" id="large_unit_wrong" style="position:absolute; color: orange !important; display: none;"> </i>    
                                        </label>
                                        <div class='col-sm-3' id='datetimepicker'>
                                            <select name="large_unit" id="large_unit" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                 <option value="0"><?=lang('หน่วยใหญ่','Large unit')?></option>
                                              <?php
                                              $sql1 = "SELECT `id_package` ,`abbrv_package`,`name_package`  FROM `unit_package` WHERE `delete_datetime` is null AND `id_company`= '".$_SESSION['company']."'";
                                              $query1 = mysqli_query($objConnect, $sql1);
                                              while ($result1 = mysqli_fetch_array($query1)) {
                                              ?>
                                              <option
                                              <?php
                                              if ($result['large_unit']==$result1["id_package"]) {
                                                  echo "selected";
                                              }
                                              ?>

                                               value="<?php echo $result1["id_package"] ?>"><?php echo $result1["name_package"]." ( ".$result1["abbrv_package"]." ) " ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        <div class='col-sm-7' id='datetimepicker'>
                                            <input type="checkbox" name="large_unit_buy" id="large_unit_buy"
                                            <?php
                                              if ($result['large_purchase_flg']=='1') {
                                                  echo "checked";
                                              }
                                              ?>
                                            > <?=lang('หน่วยซื้อ','buy unit')?>
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="large_unit_sale" id="large_unit_sale"
                                            <?php
                                              if ($result['large_sale_flg']=='1') {
                                                  echo "checked";
                                              }
                                              ?>
                                              > <?=lang('หน่วยขาย','sale unit')?>
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="large_unit_barcode" id="large_unit_barcode"
                                            <?php
                                              if ($result['large_barcode_flg']=='1') {
                                                  echo "checked";
                                              }
                                              ?>
                                              > <?=lang('Barcode','Barcode')?>
                                        </div>
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label">
                                            <?=lang('หน่วยกลาง','Medium unit')?>
                                          <font class="medium_unit_id_normal"  id="medium_unit_id_normal" style="display: none;" >*</font>
                                          <i class="fa fa-check" id="medium_unit_id_success" style="position:absolute; color: green !important; "></i>
                                          <i class="fa fa-times-circle" id="medium_unit_wrong" style="position:absolute;  color: orange !important; display: none;"> </i>  
                                        </label>
                                        <div class='col-sm-3' id='datetimepicker'>
                                            <select name="medium_unit" id="medium_unit" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                <option value="0"><?=lang('หน่วยกลาง','Medium unit')?></option>
                                              <?php
                                              $sql1 = "SELECT `id_package` ,`abbrv_package`,`name_package`  FROM `unit_package` WHERE `delete_datetime` is null AND `id_company`= '".$_SESSION['company']."'";
                                              $query1 = mysqli_query($objConnect, $sql1);
                                              while ($result1 = mysqli_fetch_array($query1)) {
                                              ?>
                                              <option
                                              <?php
                                              if ($result['medium_unit']==$result1["id_package"]) {
                                                  echo "selected";
                                              }
                                              ?>
                                               value="<?php echo $result1["id_package"] ?>"><?php echo $result1["name_package"]." ( ".$result1["abbrv_package"]." ) " ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        <div class='col-sm-7' id='datetimepicker'>
                                            <input type="checkbox" name="medium_unit_buy" id="medium_unit_buy"
                                            <?php
                                              if ($result['medium_purchase_flg']=='1') {
                                                  echo "checked";
                                              }
                                              ?>
                                              > <?=lang('หน่วยซื้อ','buy unit')?>
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="medium_unit_sale" id="medium_unit_sale"
                                            <?php
                                              if ($result['medium_sale_flg']=='1') {
                                                  echo "checked";
                                              }
                                              ?>
                                              > <?=lang('หน่วยขาย','sale unit')?>
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="medium_unit_barcode" id="medium_unit_barcode"
                                            <?php
                                              if ($result['medium_barcode_flg']=='1') {
                                                  echo "checked";
                                              }
                                              ?>
                                              > <?=lang('Barcode','Barcode')?>
                                        </div>
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label">
                                            <?=lang('หน่วยเล็ก','Small unit')?>
                                            <font class="small_unit_id_normal"  id="small_unit_id_normal" style="display: none;" >*</font>
                                          <i class="fa fa-check" id="small_unit_id_success" style="position:absolute; color: green !important; "></i>
                                          <i class="fa fa-times-circle" id="small_unit_wrong" style="position:absolute; color: orange !important; display: none;"> </i>  
                                        </label>
                                        <div class='col-sm-3' id='datetimepicker'>
                                            <select name="small_unil" id="small_unil" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                                                <option value="0"><?=lang('หน่วยเล็ก','Small unit')?></option>
                                              <?php
                                              $sql1 = "SELECT `id_package` ,`abbrv_package`,`name_package`  FROM `unit_package` WHERE `delete_datetime` is null AND `id_company`= '".$_SESSION['company']."'";
                                              $query1 = mysqli_query($objConnect, $sql1);
                                              while ($result1 = mysqli_fetch_array($query1)) {
                                              ?>
                                              <option
                                              <?php
                                              if ($result['small_unit']==$result1["id_package"]) {
                                                  echo "selected";
                                              }
                                              ?>
                                               value="<?php echo $result1["id_package"] ?>"><?php echo $result1["name_package"]." ( ".$result1["abbrv_package"]." ) " ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        <div class='col-sm-7' id='datetimepicker'>
                                            <input type="checkbox" name="small_unit_buy" id="small_unit_buy"
                                            <?php
                                              if ($result['small_purchase_flg']=='1') {
                                                  echo "checked";
                                              }
                                              ?>
                                              > <?=lang('หน่วยซื้อ','buy unit')?>
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="small_unit_sale" id="small_unit_sale"
                                            <?php
                                              if ($result['small_sale_flg']=='1') {
                                                  echo "checked";
                                              }
                                              ?>
                                              > <?=lang('หน่วยขาย','sale unit')?>
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="small_unit_barcode" id="small_unit_barcode"
                                            <?php
                                              if ($result['small_barcode_flg']=='1') {
                                                  echo "checked";
                                              }
                                              ?>
                                              > <?=lang('Barcode','Barcode')?>
                                        </div>
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label"><?=lang('อัตรากลางต่อหน่วยเล็ก','Medium rate per small unit')?></label>
                                        <p class="col-sm-1">
                                          <font class="rate_small_class_normal"  id="rate_small_id_normal" style="display: none;" >*</font>
                                          <i class="fa fa-check" id="rate_small_id_success" style="position:absolute;margin-left: 10px; color: green !important; "></i>
                                          <i class="fa fa-times-circle" id="rate_small_id_wrong" style="position:absolute; margin-left: 10px; color: orange !important; display: none;"> </i>
                                        </p>
                                        <div class='col-sm-3' id='datetimepicker'>
                                            <input type='text' class="form-control"  name="rate_small" id="rate_small" value="<?php echo $result['rate_medium_per_small'] ?>">
                                        </div>
                                        <label class="col-sm-2 control-label"><?=lang('อัตราใหญ่ต่อหน่วยกลาง','Large rate per medium unit')?></label>
                                        <div class='col-sm-3' id='datetimepicker'>
                                            <input type='text' class="form-control"  name="rate_large" id="rate_large" value="<?php echo $result['rate_large_per_medium'] ?>">
                                        </div>
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label"><?=lang('ประเภท','Type')?></label>
                                        <div class='col-sm-10' id='datetimepicker'>
                                            <input type="checkbox" name="miscellaneous_goods" id="miscellaneous_goods"
                                            <?php
                                              if ($result['miscellaneous_flg']=='1') {
                                                  echo "checked";
                                              }
                                              ?>
                                              > <?=lang('สินค้าเบ็ดเตล็ด (ระบุจำนวน)','Miscellaneous goods (Specify amount)')?>
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="Serial_Number" id="Serial_Number"
                                            <?php
                                              if ($result['serial_flg']=='1') {
                                                  echo "checked";
                                              }
                                              ?>
                                              > <?=lang('มี Serial Number','Serial Number')?>
                                        </div>
                                </div>
                                <div class="box-body">  
                                        <label class="col-sm-2 control-label"><?=lang('สถานะ','Status')?></label>
                                        <div class='col-sm-10' id=''>
                                            <input type="radio" name="status" id="status1" value="1" 
                                            <?php
                                              if ($result['status_flg']=='1') {
                                                  echo "checked";
                                              }
                                            ?>
                                              > <?=lang('สินค้าปกติ','Normal product')?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="status" id="status2" value="2"
                                            <?php
                                              if ($result['status_flg']=='2') {
                                                  echo "checked";
                                              }
                                            ?>
                                            > <?=lang('สินค้าเก่าเก็บ','Old products')?>
                                                                                        
                                        </div>
                                        <div class='col-sm-10' id=''>
                                            <input type="radio" name="status" id="status3" value="3"
                                            <?php
                                              if ($result['status_flg']=='3') {
                                                  echo "checked";
                                              }
                                            ?>
                                            > <?=lang('สินค้ามือสอง','second hand')?>
                                             &nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="status" id="status4" value="4"
                                            <?php
                                              if ($result['status_flg']=='4') {
                                                  echo "checked";
                                              }
                                            ?>
                                            > <?=lang('สินค้า Return','Return products')?>
                                            
                                        </div>
                                </div>
                                <div class="box-body" > 
                                        <label class="col-sm-2 control-label"><?=lang('ขนาด (มม.)','Size (mm)')?></label>
                                        <div class="form-group col-sm-3">
                                          <div class='col-sm-10' id='datetimepicker'>
                                            <input class="form-control" type="text" name="width" id="width" placeholder="<?=lang('กว้าง','width')?>" value="<?php echo $result['size_width'] ?>" OnKeyPress="return isNumber(this)"> 
                                        </div>
                                        <label class="col-sm-1 control-label"><?=lang('X','X')?></label>
                                        </div>
                                        <div class="form-group col-sm-3">
                                          <div class='col-sm-10' id='datetimepicker'>
                                            <input class="form-control" type="text" name="Length" id="Length" placeholder="<?=lang('ยาว','Length')?>" value="<?php echo $result['size_length'] ?>" OnKeyPress="return isNumber(this)"> 
                                        </div>
                                        <label class="col-sm-1 control-label"><?=lang('X','X')?></label>
                                        </div>
                                        <div class="form-group col-sm-3">
                                          <div class='col-sm-10' id='datetimepicker'>
                                            <input class="form-control" type="text" name="height" id="height" placeholder="<?=lang('สูง','height')?>" value="<?php echo $result['size_height'] ?>" OnKeyPress="return isNumber(this)"> 
                                        </div>
                                        </div>
                                </div>
                                <div class="box-body" > 
                                        <label class="col-sm-2 control-label"><?=lang('น้ำหนัก (ก.)','Weight (g.)')?></label>
                                          <div class='col-sm-10' id='datetimepicker'>
                                            <input class="form-control" type="text" name="weight" id="weight" value="<?php echo $result['weight'] ?>" > 
                                        </div>
                                </div>
                                <div class="box-body" > 
                                        <label class="col-sm-2 control-label"><?=lang('URL ผู้ผลิต','Manufacturer URL')?></label>
                                          <div class='col-sm-10' id='datetimepicker'>
                                            <input class="form-control" type="text" name="manufac_url" id="manufac_url" value="<?php echo $result['url_manufacturer'] ?>" > 
                                        </div>
                                </div>
                                <div class="box-body" > 
                                        <label class="col-sm-2 control-label"><?=lang('URL สั่งซื้อ','Order URL')?></label>
                                          <div class='col-sm-10' id='datetimepicker'>
                                            <input class="form-control" type="text" name="order_url" id="order_url" value="<?php echo $result['url_orders'] ?>" > 
                                        </div>
                                </div>
                                <div class="box-body" > 
                                        <label class="col-sm-2 control-label"><?=lang('ส่วนลดหลายชั้น','Multi-layer discount')?></label>
                                          <div class='col-sm-8' id='datetimepicker'>
                                            <input class="form-control" type="text" name="discount" id="discount" value="<?php echo $result['discount_multilayer'] ?>"  > 
                                        </div>
                                        <label class="col-sm-2 control-label"><?=lang('X + Y + Z %','X + Y + Z %')?></label>
                                </div>
                                <div class="box-body" > 
                                        <label class="col-sm-2 control-label"><?=lang('สินค้าทดแทน','replacement Product')?></label>
                                        <div class='col-sm-10' >
                                            <select class="form-control " multiple  name="replacement_product[]" id="replacement_product">
    <?php 
    $b = explode(",", $result['replacement_product']);
    
      $strSQL = "SELECT `id_product`,`name_th`,`name_en` FROM `product` WHERE `id_company` = '".$_SESSION['company']."'";
      $objQuery = mysqli_query($objConnect,$strSQL) or die (mysqli_error());
      while($objResult = mysqli_fetch_array($objQuery))
      {
    ?>
                                      <option
                                      <?php
                                      for ($i=0; $i < count($b); $i++) { 
                                          if ($b[$i]==$objResult["id_product"]) {
                                             echo "selected";
                                          }
                                      }
                                      ?> value="<?php echo $objResult["id_product"] ?>">
                                       <?php echo $objResult["name_th"] ?>
                                      </option>
    <?php } ?>
                                            </select>
                                        </div>
                                        
                                </div>
                                <div class="box-body" > 
                                        <label class="col-sm-2 control-label"><?=lang('lead time','lead time')?></label>
                                          <div class='col-sm-10' id='datetimepicker'>
                                            <input class="form-control" type="text" name="lead_time" id="lead_time" value="<?php echo $result["lead_time"] ?>"  > 
                                        </div>
                                </div>
                                <div class="box-body" > 
                                        <label class="col-sm-2 control-label"><?=lang('การรับประกัน','warranty')?></label>
                                        <div class='col-sm-10' id='datetimepicker'>
                                            <input  type="checkbox" name="warranty" id="warranty"
                                            <?php
                                            if ($result["warranty_flg"]=='1') {
                                                echo "checked";
                                            }
                                            ?>
                                              > <?=lang('มี','Have')?>
                                        </div>
                                        <div class='col-sm-10' id='datetimepicker'>
                                            <textarea class="form-control" name="detail_warranty" id="detail_warranty" placeholder="รายละเอียดประกัน" ><?php echo $result["warranty_condition"] ?></textarea>
                                        </div>
                                </div>
                                <div class="box-body" > 
                                        <label class="col-sm-2 control-label"><?=lang('การใช้งาน','Using')?></label>
                                          <div class='col-sm-10' id='datetimepicker'>
                                            <label class="switch">
                                              <input type="checkbox" name="using" id="using" 
                                              <?php
                                              if ($result["active_flg"]=='1') {
                                                    echo "checked";
                                                }
                                                ?>
                                                 >
                                              <span class="slider round"></span>
                                            </label>
                                        </div>
                                </div>
                                <div class="box-body" > 
                                        <label class="col-sm-2 control-label"><?=lang('หมายเหตุ','note')?></label>
                                        <div class='col-sm-10' id='datetimepicker'>
                                            <textarea class="form-control" name="note" id="note"  ><?php echo $result["remark"] ?></textarea>
                                        </div>
                                </div>

         
            </div>
            <!-- /.box -->

          </div>
          <!-- /.col (left) -->
         
          <!-- /.col (right) -->
        </div>
    
         <div class="col-md-12">
                
                    </div>
                </div>
                     
                <!-- /.col (left) -->
               
                     
                   
                    
                
                <div class="col-md-7">
                    <?php
                    $str_attr = "SELECT * FROM product_attribute WHERE id_product = '" . $_GET['id'] . "' 
                                                                    ";
                    $query_attr = mysqli_query($objConnect , $str_attr);
                    $result_attr = mysqli_fetch_array($query_attr);
                    $row_attr = mysqli_num_rows($query_attr);
                    

                    ?>
                    <div class="box box-default">
                       <div class="box box-warning">
                    <div class="box-header with-border">
                            <h3 class="box-title">รายละเอียดสินค้า</h3>
                        </div>
                       
                

               <div class="box-body" align="right">
                            <div id="printableTable">
                                <div class="box-body" > 
                                       <label class="col-sm-2 control-label">
                                          <?=lang('หมวดหมู่','category')?>
                                          
                                          <font class="category_class_normal"  id="category_id_normal" style="display: none;" >*</font>
                                          <i class="fa fa-check" id="category_id_success" style="position:absolute; color: green !important; "></i>
                                          <i class="fa fa-times-circle" id="category_id_wrong" style="position:absolute; color: orange !important; display: none;"> </i>
                                         
                                        </label>
                                        <div class='col-sm-10' >
                                            <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true"    name="id_catagory" id="id_catagory" disabled>
                                                 <option value="0"><?=lang('หมวดหมู่','category')?></option>
    <?php 
      $strSQL = "SELECT `id_catagory`,`name_catagory`,code FROM `product_catagory` WHERE `level`='1' AND `deleted_datetime` IS null AND `id_company`= '".$_SESSION['company']."' ";
      $objQuery = mysqli_query($objConnect,$strSQL) or die (mysqli_error());
      while($objResult = mysqli_fetch_array($objQuery))
      {
    ?>
                                      <option 
                                      <?php
                                        if ($result['id_catagory']==$objResult["id_catagory"]) {
                                            echo "selected";
                                        }
                                        ?>
                                        value="<?php echo $objResult["id_catagory"] ?>,<?php echo $objResult["code"] ?>">
                                       <?php echo $objResult["name_catagory"] ?>
                                      </option>
    <?php 
      $strSQL2 = "SELECT `id_catagory`,`name_catagory`,code FROM `product_catagory` WHERE `level`='2' AND `group_sub`='".$objResult["id_catagory"]."' AND `deleted_datetime` IS null AND `id_company`= '".$_SESSION['company']."' ";
      $objQuery2 = mysqli_query($objConnect,$strSQL2) or die (mysqli_error());
      while($objResult2 = mysqli_fetch_array($objQuery2))
      {
    ?>
                                      <option 
                                      <?php
                                        if ($result['id_catagory']==$objResult2["id_catagory"]) {
                                            echo "selected";
                                        }
                                        ?>
                                        value="<?php echo $objResult2["id_catagory"] ?>,<?php echo $objResult2["code"] ?>">
                                       <?php echo "&nbsp;&nbsp;-".$objResult2["name_catagory"] ?>
                                      </option>
          
   

    <?php 
      $strSQL3 = "SELECT `id_catagory`,`name_catagory`,code FROM `product_catagory` WHERE `level`='3' AND `group_sub`='".$objResult2["id_catagory"]."' AND `deleted_datetime` IS null AND `id_company`= '".$_SESSION['company']."' ";
      $objQuery3 = mysqli_query($objConnect,$strSQL3) or die (mysqli_error());
      while($objResult3 = mysqli_fetch_array($objQuery3))
      {
    ?>
                                      <option 
                                      <?php
                                        if ($result['id_catagory']==$objResult3["id_catagory"]) {
                                            echo "selected";
                                        }
                                        ?>
                                        value="<?php echo $objResult3["id_catagory"] ?>,<?php echo $objResult3["code"] ?>">
                                       <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;-".$objResult3["name_catagory"] ?>
                                      </option>
          
    <?php } ?>

    <?php } ?>

    <?php } ?>
                                            </select>
                                        </div>
                                        
                                </div>
                                <div class="box-body">
                                  <label class="col-sm-2 control-label">
                                    <?=lang('แบรนด์','brand ')?>
                                    <font class="brand_class_normal"  id="brand_id_normal" style="display: none;">*</font>
                                          <i class="fa fa-check" id="brand_id_success" style="position:absolute; color: green !important; "></i>
                                          <i class="fa fa-times-circle" id="brand_wrong" style="position:absolute; color: orange !important; display: none;"> </i>  
                                  </label>
                                    <div class='col-sm-10' id='datetimepicker'>
                                      <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="brand" id="brand" disabled> 
                                        <option value="0"> <?=lang('แบรนด์','brand ')?></option>
          <?php 
              $strSQL = "SELECT `id_brand`,`name_brand`,code FROM `mod_brand` WHERE `delete_datetime` IS null AND  `id_company` =  '".$_SESSION['company']."'";
              $objQuery = mysqli_query($objConnect,$strSQL);
              while($objResult = mysqli_fetch_array($objQuery)){
          ?>
                                        <option
                                        <?php
                                        if ($result['id_brand']==$objResult["id_brand"]) {
                                            echo "selected";
                                        }
                                        ?>
                                         value="<?php echo $objResult["id_brand"] ?>,<?php echo $objResult["code"] ?>"><?php echo $objResult["name_brand"] ?> </option>
          <?php } ?>
                                      </select>
                                    </div>
                                </div>
                                 <div class="box-body">
                                  <label class="col-sm-2 control-label"><?=lang('รุ่น','generation ')?></label>
                                    <div class='col-sm-9' id='datetimepicker'>
                                      <input class="form-control" type="text" name="generation" id="generation" value="<?php echo $result['model'] ?>" disabled>
                                    </div>
                                    <p class="col-sm-1">
                                          <font class="generation_class_normal"  id="generation_id_normal" style="display: none;" >*</font>
                                          <i class="fa fa-check" id="generation_id_success" style="position:absolute;margin-left: 10px; color: green !important; "></i>
                                          <i class="fa fa-times-circle" id="generation_id_wrong" style="position:absolute; margin-left: 10px; color: orange !important; display: none;"> </i>
                                    </p>
                                </div>



                            </div>


                        </div>

                   

                </div>
                       
                        <?php
                 $str_check_attr = "SELECT * FROM product_attribute WHERE id_product = '" . $_GET['id'] . "' AND`delete_datetime` IS null";
                                            $query_check_attr = mysqli_query($objConnect , $str_check_attr);
                                            $num_check_attr1 = mysqli_num_rows($query_check_attr);
                                            $result_check_attr = mysqli_fetch_array($query_check_attr);
                ?>
<div style="display: none;" >
<input type="radio" name="tab_ch" id="tab_ch1" <?php if ($num_check_attr1<=1  && $result_check_attr["attribute_name"]=='' && $result_check_attr["option_name"]==''){ ?>
                    checked="checked"
                <?php } ?> >
<input type="radio" name="tab_ch" id="tab_ch2" <?php if ($num_check_attr1>1){ ?>
                    checked="checked"
                <?php } ?>>                  
                        </div>
                                      <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li <?php if ($num_check_attr1<=1  && $result_check_attr["attribute_name"]=='' && $result_check_attr["option_name"]==''){ ?>
                    class="active"
                <?php } ?>
                    
               >
                  <a href="#thai_re" data-toggle="tab" aria-expanded="0" id="tab_1">
                   
                    สินค้ามีแบบเดียว
                  </a>
                </li>
                <li <?php if ($num_check_attr1<=1  && $result_check_attr["attribute_name"]!='' && $result_check_attr["option_name"]!=''){ ?>
                    class="active"
                <?php } ?>>
                  <a href="#english_re" data-toggle="tab" aria-expanded="1" id="tab_mullti">
                   
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
                ?>
                 id="thai_re">
                   <div class="box-body">
                <div class="input-group" style="margin-bottom: 0;">
                  
                </div>
              </div>
                  <div class="box-body">
                                  <label class="col-sm-2 control-label"><?=lang('SKU','SKU ')?></label>
                                    <div class='col-sm-9' id='datetimepicker'>
                <input type="hidden" name="sku_auto" id="sku_auto">
                                      <input  class="form-control sku_auto" type="text" name="SKU_1" id="SKU_1" placeholder="หมวดหมู่-แบรนด์-รุ่น" value="<?php
                                      if ($num_check_attr1<=1 && $result_check_attr["attribute_name"]=='' && $result_check_attr["option_name"]==''){
                                       echo $result_check_attr["SKU_attr"];
                                       } else{ } ?>" readonly>

                                      <input class="form-control sku_auto" type="hidden" name="id_attr_product_1" id="id_attr_product_1"  value="<?php
                                      
                                      if ($num_check_attr1<=1 && $result_check_attr["attribute_name"]=='' && $result_check_attr["option_name"]==''){
                                       echo $result_check_attr["id_attr"];
                                       } else{ }  ?>" readonly>
                                    </div>
                                    <p class="col-sm-1">
                                          <font class="SKU_1_class_normal"  id="SKU_1_id_normal" style="display: none;" >*</font>
                                          <i class="fa fa-check" id="SKU_1_id_success" style="position:absolute;margin-left: 10px; color: green !important; "></i>
                                          <i class="fa fa-times-circle" id="SKU_1_id_wrong" style="position:absolute; margin-left: 10px; color: orange !important; display: none;"> </i>
                                    </p>
                                </div>
                </div>
                <div  
                <?php if ($num_check_attr1<=1  && $result_check_attr["attribute_name"]!='' && $result_check_attr["option_name"]!=''){ ?>
                    class="tab-pane active" 
                <?php } else{ ?>
                    class="tab-pane"
                <?php }
                ?>
                
                 id="english_re">
                  <div class="box-body">
                            
                            <input type="hidden" name="" id="id_attr_one" value="<?php echo $result_attr['id_attr'] ?>">
                          <input type="hidden" name="text_id_head" id="text_id_head">
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
                                            $str_attr_h = "SELECT * FROM product_attribute_head  WHERE `id_company` = '".$_SESSION['company']."' AND `deleted_datetime` IS null";
                                            $query_attr_h = mysqli_query($objConnect , $str_attr_h);
                                            $num_head = 0;
                                            while ($result_attr_h = mysqli_fetch_array($query_attr_h)){
                                            //------------------------------------------------------------------------------------เช็ค id product_attribute ว่าตรงกับ ตาราง attribute_head
                                            $str_check_attr = "SELECT * FROM product_attribute WHERE id_product = '" . $_GET['id'] . "' AND `delete_datetime` IS null";
                                            $query_check_attr = mysqli_query($objConnect , $str_check_attr);
                                            $num_check_attr = mysqli_num_rows($query_check_attr);
                                            $id_head_attr = '';
                                            $id_sub_attr = '';
                                            while ($result_check_attr = mysqli_fetch_array($query_check_attr)) {
                                                $id_head_attr .= $result_check_attr["attribute_name"].',';
                                                $id_sub_attr .= $result_check_attr["option_name"].',';
                                            }
                                            $cut_check_attr = explode("," , $id_head_attr);

                                            if (in_array($result_attr_h['id_attr_head'] , $cut_check_attr)) {
                                                if ($num_check_attr1<=1 && $result_check_attr["attribute_name"]=='' && $result_check_attr["option_name"]==''){ 
                                                  $check_cut_attr_head = "";
                                                  $class_check = "";
                                                }else{
                                                  $check_cut_attr_head = "checked";
                                                  $class_check = "exist_check";  
                                                }
                                            } else {
                                                $check_cut_attr_head = "";
                                                $class_check = '';
                                            }
                                            // ! ----------------------------
                                            $num_head++;
                                            $text_sub = '';
                                            $id_sub = '';
                                            $str_sub_attr_h = "SELECT * FROM product_attribute_sub WHERE id_attr_head = '" . $result_attr_h['id_attr_head'] . "' AND `deleted_datetime` IS null";
                                            $query_sub_attr_h = mysqli_query($objConnect , $str_sub_attr_h);
                                            $num_sub = mysqli_num_rows($query_sub_attr_h);
                                            $i = 0;
                                            while ( $result_sub_attr_h = mysqli_fetch_array($query_sub_attr_h) ) {
                                                $i++;
                                                if ($num_sub - $i == 0) {
                                                    $text_sub .= $result_sub_attr_h['name_attr_sub_th'];
                                                    $id_sub .= $result_sub_attr_h['id_attr_sub']; 
                                                } else {
                                                    $text_sub .= $result_sub_attr_h['name_attr_sub_th'] . ',';
                                                    $id_sub .= $result_sub_attr_h['id_attr_sub'].',';
                                                }
                                            }
                                           
                                            ?>

                                            <tr>
                                                <td align="center">
                                                    <?php
                                                    echo '<input type="checkbox" name="" value="' . $text_sub . '" data-idhead="' . $result_attr_h['id_attr_head'] . '" data-idsub="'.$id_sub.'"
                                                             data-attr="' . $result_attr_h['name_attr_head_en'] . '" 
                                                             class="smtp_changes' . $num_head . ' variants_change variants_num_check' . $num_head . ' ' . $class_check . '"
                                                             ' . $check_cut_attr_head . '>';
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo '<span>' . $result_attr_h['name_attr_head_en'] . '</span>';
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                            $b = explode(",", $text_sub);
                            for ($i=0; $i < count($b) ; $i++) { 
                             
                            ?>
                            <span class="" ><small class="label  bg-green"><?php echo $b[$i] ?></small></span>
                            
                          <?php } ?>
                                                    <!-- <input type="text" value="<?php echo $text_sub; ?>" data-role="tagsinput" data-idhead="<?php echo $result_attr_h['id_attr_head'] ?>" id="tags" data-smtp="<?php echo $num_head; ?>" class="tagss form-control" style="border:none;"> -->
                                                    <input type="hidden" value="<?php echo $text_sub; ?>" data-role="" data-idhead="<?php echo $result_attr_h['id_attr_head'] ?>" id="tags" data-smtp="<?php echo $num_head; ?>" class="tagss form-control" style="border:none;">
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
                                        $str_ck_attr = "SELECT * FROM product_attribute WHERE id_product = '" . $_GET['id'] . "' AND `delete_datetime` IS null";
                                        $query_ck_attr = mysqli_query($objConnect , $str_ck_attr);
                                        $ck_num_row = mysqli_num_rows($query_ck_attr);
                                        if ($ck_num_row > 0) {
                                            ?>
                                            <!-- <div style="margin-top: 10px; margin-left: 10px;">
                                                <label>
                                                    <span class="btn btn-sm old_item not_in active_item" style="background-color: white; color: gray; border:1px solid #5cb85c;">Old item</span>
                                                    <input type="radio" name="input_exist" id="radio_dev_exist" <?php echo $radio_dev_exist; ?> value="0" style="display: none;">
                                                </label>
                                                <label>
                                                    <span class="btn btn-sm new_gen not_in" style="background-color: white; color: gray; border:1px solid #5cb85c;">New Generated</span>
                                                    <input type="radio" name="input_render" id="radio_dev_render" <?php echo $radio_dev_render; ?> value="1" style="display: none;">
                                                </label>
                                            </div> -->
                                            <?php
                                        }
                                        ?>
                                        <div class="sticky-table empty">
                                            <div class="table-product table-responsive">
                                                <table id="myTable" class="table table-hover table-list">
                                                    <thead class="show-data">
                                                    <tr style="background-color: #ddd">
                                                        <th style="width: 60px; border-bottom: none;">รูป</th>
                                                        <th style="width: 100px; min-width: 100px; border-bottom: none;">Options</th>
                                                        
                                                        <th style="border-bottom: none;">SKU</th>
                                                        <th style="width: 80px; max-width: 80px; border-bottom: none;">แสดงผล</th>
                                                    </tr>
                                                    </thead>
                                                    <?php
                                                     if ($num_check_attr1>1){
                                                     $str_attr_cobi = "SELECT product_attribute.*,product_attribute_sub.name_attr_sub_th FROM product_attribute 
LEFT JOIN product_attribute_sub ON product_attribute_sub.id_attr_sub=product_attribute.option_name WHERE id_product = '" . $_GET['id'] . "' AND product_attribute.`delete_datetime` IS null ORDER BY orderby ASC ";
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
                                                             
                                                                    <small class="label pull-left bg-option1" style="margin-right: 5px; margin-bottom:5px;"><?php echo $result_attr_cobi['name_attr_sub_th']; ?></small>
                                                                  

                                                                <input type="hidden" value="<?php echo $result_attr_cobi['option_name']; ?>" name="option_attr_ex[]" id="option_attr<?php echo $a; ?>">
                                                                <input type="hidden" name="attr_head_ex[]" value="<?php echo $result_attr_cobi['attribute_name']; ?>" class="id_attr_head">
                                                                <input type="hidden" name="id_attr[]" value="<?php echo $result_attr_cobi['id_attr']; ?>" class="">
                                                            </td>
                                                            
                                                            <td>
                                                                <input type="text" class="form-control input-sm" name="SKU_ex[]" value="<?php echo $result_attr_cobi['SKU_attr']; ?>" readonly/>  
                                                            </td>
                                                           
                                                           
                                                            <td style="text-align:left; width:60px; max-width:60px;">
                                                                <?php
                                                                if ($result_attr_cobi['show_attr'] == 1) {
                                                                    $check_show = "checked";
                                                                } else {
                                                                    $check_show = '';
                                                                }
                                                                ?>
                                                                <input type="checkbox" name="" class="check_value" value="1" data-id="<?php echo $a; ?>" <?php echo $check_show; ?> value="1" id="option_check<?php echo $a; ?>">
                                                                <input type="checkbox" name="show_ex[]" value="<?php echo $result_attr_cobi['show_attr'] ?>" id="option_check_hidden<?php echo $a; ?>" checked hidden>
                                                                <input type="hidden" name="id_attr_product[]" value="<?php echo $result_attr_cobi['id_attr']; ?>">

                                                                <button style='display: none;' id='<?php echo $result_attr_cobi['option_name']; ?>' style='' type='button' class=' btn btn-danger' onclick='del_row(this,"<?php echo $a; ?>")'> <i class='fa fa-fw fa-trash'></i></button>
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
                                                    <!-- </tbody>
                                                    <tbody class="empty-message " style="border:none; <?php echo $empty_attr_cobi; ?>">
                                                    <tr>
                                                        <td colspan="10" class="text-center" style="background-color: white !important;">
                                                            <div style="font-size: 18px; color: gray;">กรุณาเลือกลักษณะของสินค้าที่ต้องการเพิ่มข้อมูล</div>
                                                            <div class="fa fa-edit fa-3x" style="font-size: 70px; color: #ddd;"></div>
                                                        </td>
                                                    </tr>
                                                    </tbody> -->

                                                </table>

                                            </div>
                                        </div>
                                    </form>
                                  </div>

                       
                             
                           <!-- <form action="" name="frmMain" id="frmMain" method="post">
                            <div class="" id="html">


                            </div>-->
                            <!-- <button>ok</button> -->
                       <!--  </form>  -->
                </div> 
              
              
                  
                </div>
               <p style="color: red" align="right">คำแนะนำ : หากขึ้นกรอบสีแดง  ให้เปลี่ยน SKU ใหม่ เนื่องจาก SKU ซ้ำ</p>
              </div>
            </div>
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
                   

                    <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active" id="li_en">
                  <a href="#english" data-toggle="tab" aria-expanded="0">
                    <img class="flag-lang" src="../img/en-fl.jpg" width="22" height="15" >
                    ภาษาอังกฤษ
                  </a>
                </li>
                <li id="li_th" >
                  <a href="#thai" data-toggle="tab" aria-expanded="1">
                    <img class="flag-lang" src="../img/th-fl.png" width="22" height="15" >
                    ภาษาไทย
                  </a>
                </li>
                <li id="li_ch" >
                  <a href="#chlish" data-toggle="tab" aria-expanded="2">
                    <img class="flag-lang" src="../img/ZH.png" width="22" height="15" >
                    ภาษาจีน
                  </a>
                </li>
              </ul>
              <span style="float: right; padding-top: 15px;color: red; padding-right: 5px"><b>คำแนะนำ: </b>**สีแท็บจะเป็นสีเทาเมื่อข้อความเท่ากันทุกภาษา  แท็บสีแดงสำหรับภาษาที่แตกต่าง</span>
              <br>

              <div class="tab-content">
                 <div class="tab-pane active" id="english">
                  <div class="box-body">
                <button onclick="copy()">กดเพื่อตั้วค่าให้ทั้งสามภาษาเหมือนกัน</button>
              </div>

                  <div id="editor" style="margin-top: 10px;">
                    <textarea class="edit"  name="editor_en"  id="editor_en" style="margin-top: 20px;" ><?php echo $result['detail_en'] ?></textarea> 
                  </div>
                </div>
                <div class="tab-pane " id="thai">
                   <div class="box-body">
                
              </div>
   
   
                  <div id="editor" style="margin-top: 10px;">
                    <textarea class='edit' name="editor" id="editor_th" style="margin-top: 20px;"><?php echo $result['detail_th'] ?></textarea>
                  </div>
                </div>
               
                <div class="tab-pane" id="chlish">
                   <div class="box-body">
                
              </div>
                  <div id="editor" style="margin-top: 10px;">
                    <textarea class="edit"  name="editor_ch"  id="editor_ch" style="margin-top: 20px;"><?php echo $result['detail_ch'] ?></textarea> 
                  </div>
                </div>
              </div>
         

            <div class="box-body">
                <table class="table">
                  <tr>
                    <th  style="text-align: center;background: #32AAFF" rowspan="2"><?=lang('ราคาขาย','sale price')?></th>
                    <th  style="text-align: center;background: #32AAFF" colspan="2"><?=lang('หน่วยเล็ก*','Small unit*')?></th>
                    <th  style="text-align: center;background: #32AAFF" colspan="2"><?=lang('หน่วยกลาง','Medium unit')?></th>
                    <th  style="text-align: center;background: #32AAFF" colspan="2"><?=lang('หน่วยใหญ่','Large unit')?></th>
                  </tr>
                  <tr>
                    <th style="text-align: center;background: #96FFFF"><?=lang('จำนวนต่ำสุด','min')?></th>
                    <th style="text-align: center;background: #6EEAFF"><?=lang('จำนวนสูง','max')?></th>
                    <th style="text-align: center;background: #96FFFF"><?=lang('จำนวนต่ำสุด','min')?></th>
                    <th style="text-align: center;background: #6EEAFF"><?=lang('จำนวนสูง','max')?></th>
                    <th style="text-align: center;background: #96FFFF"><?=lang('จำนวนต่ำสุด','min')?></th>
                    <th style="text-align: center;background: #6EEAFF"><?=lang('จำนวนสูง','max')?></th>
                  </tr>
                  <tr>
                    <td style="background: #aaaaaa;"><?=lang('ราคา 1 (A)','price 1 (A)')?></td>
                    <td style="background: #dcdcdc;"><input OnKeyPress="return check_num(this)" class="form-control" type="text" name="small_min_1" id="small_min_1" value="<?php echo $result['price_a_small_qty_min'] ?>"></td>
                    <td style="background: #dcdcdc;"><input OnKeyPress="return check_num(this)" class="form-control" type="text" name="small_max_1" id="small_max_1" value="<?php echo $result['price_a_small_qty_max'] ?>"></td>
                    <td style="background: #dcdcdc;"><input OnKeyPress="return check_num(this)" class="form-control" type="text" name="medium_min_1" id="medium_min_1" value="<?php echo $result['price_a_medium_qty_min'] ?>"></td>
                    <td style="background: #dcdcdc;"><input OnKeyPress="return check_num(this)" class="form-control" type="text" name="medium_max_1" id="medium_max_1" value="<?php echo $result['price_a_medium_qty_max'] ?>"></td>
                    <td style="background: #dcdcdc;"><input OnKeyPress="return check_num(this)" class="form-control" type="text" name="large_min_1" id="large_min_1" value="<?php echo $result['price_a_large_qty_min'] ?>"></td>
                    <td style="background: #dcdcdc;"><input OnKeyPress="return check_num(this)" class="form-control" type="text" name="large_max_1" id="large_max_1" value="<?php echo $result['price_a_large_qty_max'] ?>"></td>
                  </tr>
                  <tr>
                    <td style="background: #aaaaaa;"><?=lang('ราคา 2 (B)','price 2 (B)')?></td>
                    <td style="background: #dcdcdc;"><input OnKeyPress="return check_num(this)"  class="form-control" type="text" name="small_min_2" id="small_min_2" value="<?php echo $result['price_b_small_qty_min'] ?>"></td>
                    <td style="background: #dcdcdc;"><input OnKeyPress="return check_num(this)" class="form-control" type="text" name="small_max_2" id="small_max_2" value="<?php echo $result['price_b_small_qty_max'] ?>"></td>
                    <td style="background: #dcdcdc;"><input OnKeyPress="return check_num(this)" class="form-control" type="text" name="medium_min_2" id="medium_min_2" value="<?php echo $result['price_b_medium_qty_min'] ?>"></td>
                    <td style="background: #dcdcdc;"><input OnKeyPress="return check_num(this)" class="form-control" type="text" name="medium_max_2" id="medium_max_2" value="<?php echo $result['price_b_medium_qty_max'] ?>"></td>
                    <td style="background: #dcdcdc;"><input class="form-control" type="text" name="large_min_2" id="large_min_2" value="<?php echo $result['price_b_large_qty_min'] ?>"></td>
                    <td style="background: #dcdcdc;"><input class="form-control" type="text" name="large_max_2" id="large_max_2" value="<?php echo $result['price_b_large_qty_max'] ?>"></td>
                  </tr>
                  <tr>
                    <td style="background: #aaaaaa;"><?=lang('ราคา 3 (C)','price 3 (C)')?></td>
                    <td style="background: #dcdcdc;"><input OnKeyPress="return check_num(this)" class="form-control" type="text" name="small_min_3" id="small_min_3" value="<?php echo $result['price_c_small_qty_min'] ?>"></td>
                    <td style="background: #dcdcdc;"><input OnKeyPress="return check_num(this)" class="form-control" type="text" name="small_max_3" id="small_max_3" value="<?php echo $result['price_c_small_qty_max'] ?>"></td>
                    <td style="background: #dcdcdc;"><input OnKeyPress="return check_num(this)" class="form-control" type="text" name="medium_min_3" id="medium_min_3" value="<?php echo $result['price_c_medium_qty_min'] ?>"></td>
                    <td style="background: #dcdcdc;"><input OnKeyPress="return check_num(this)" class="form-control" type="text" name="medium_max_3" id="medium_max_3" value="<?php echo $result['price_c_medium_qty_max'] ?>"></td>
                    <td style="background: #dcdcdc;"><input OnKeyPress="return check_num(this)" class="form-control" type="text" name="large_min_3" id="large_min_3" value="<?php echo $result['price_c_large_qty_min'] ?>"></td>
                    <td style="background: #dcdcdc;"><input OnKeyPress="return check_num(this)" class="form-control" type="text" name="large_max_3" id="large_max_3" value="<?php echo $result['price_c_large_qty_max'] ?>"></td>
                  </tr>
                  
                </table>
            </div>



                            <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>

                
                


                <div class="boxsave">
                    <button type="button" class="btn btn-success pull-right btnSendEdit" id="btnSendEdit" style="transition: 0.4s; margin-left: 5px;"><i class="fa fa-check"></i>&nbsp;<?=lang('บันทึก','Save')?></button>
                    <a href="front-manage.php">
                    <button type="button" class="btn btn-default pull-right btnSendClear" id="btnSendClear" ><i class="fa fa-fw fa-arrow-left"></i>&nbsp;<?=lang('ยกเลิก','Cancel')?></button>
                    </a>
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
                 $(function() {
      //$('.select2').select2()

          $('.edit').froalaEditor({
            language: 'ar',
            heightMin: 300,
            heightMax: 400,
            imageUploadURL:"froala_upload_image.php",
            imageUploadParam:"fileName",
            imageManagerLoadMethod:"GET",
            imageManagerLoadURL:"../page_froala/select.php",
            imageManagerDeleteURL:"../page_froala/delete.php",
            imageManagerDeleteMethod:"POST",
            // video
            videoUploadURL: 'froala_upload_video.php',
            videoUploadParam: 'fileName',
            videoUploadMethod: 'POST',
            videoMaxSize: 50 * 1024 * 1024,
            videoAllowedTypes: ['mp4', 'webm', 'jpg', 'ogg'],

            fileUploadURL: 'froala_upload_file.php',
            fileUploadParam: 'fileName',
            fileUploadMethod: 'POST',
            fileMaxSize: 20 * 1024 * 1024,
            fileAllowedTypes: ['*'],
            
          }).on('froalaEditor.image.uploaded', function (e, editor, response) {
            console.log(response);
          }).on('froalaEditor.imageManager.beforeDeleteImage', function (e, editor, $img) {
            console.log($img);
            alert($img);
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
          }).on('froalaEditor.blur', function (e, editor) {
            check_editor();
// Do something here.
});
  //iCheck for checkbox and radio inputs
 $(".show-add").click(function(){
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
  //                   $(document).on('click', '.btnSendClear', function(){
  // location.reload();
  // })
                    $(document).on('click', '.btnSendEdit', function () {
                         var title_tag = $('#title_tag').val();
    var description_tag = $('#description_tag').val();
    var keyword_tag = $('#keyword_tag').val();
    var name_en = $('#name_en').val();
    var name_th = $('#name_th').val();
    var name_ch = $('#name_ch').val();
    var abbrev_en = $('#abbrev_en').val();
    var abbrev_th = $('#abbrev_th').val();
    var abbrev_ch = $('#abbrev_ch').val();
    var large_unit = $('#large_unit').val();
    var medium_unit = $('#medium_unit').val();
    var small_unit = $('#small_unil').val();
    var rate_small = $('#rate_small').val();
    var rate_large = $('#rate_large').val();
    var width = $('#width').val();
    var Length = $('#Length').val();
    var height = $('#height').val();
    var weight = $('#weight').val();
    var manufac_url = $('#manufac_url').val();
    var order_url = $('#order_url').val();
    var discount = $('#discount').val();
    var replacement_product = $('#replacement_product').val();
    var lead_time = $('#lead_time').val();
    var detail_warranty = $('#detail_warranty').val();
    var note = $('#note').val();
    var id_catagory = $('#id_catagory').val();
    var brand = $('#brand').val();
    var generation = $('#generation').val();
    var editor_en = $('#editor_en').val();
    var editor = $('#editor_th').val();
    var editor_ch = $('#editor_ch').val();
    var small_min_1 = $('#small_min_1').val();
    var small_max_1 = $('#small_max_1').val();
    var medium_min_1 = $('#medium_min_1').val();
    var medium_max_1 = $('#medium_max_1').val();
    var large_min_1 = $('#large_min_1').val();
    var large_max_1 = $('#large_max_1').val();
    var small_min_2 = $('#small_min_2').val();
    var small_max_2 = $('#small_max_2').val();
    var medium_min_2 = $('#medium_min_2').val();
    var medium_max_2 = $('#medium_max_2').val();
    var large_min_2 = $('#large_min_2').val();
    var large_max_2 = $('#large_max_2').val();
    var small_min_3 = $('#small_min_3').val();
    var small_max_3 = $('#small_max_3').val();
    var medium_min_3 = $('#medium_min_3').val();
    var medium_max_3 = $('#medium_max_3').val();
    var large_min_3 = $('#large_min_3').val();
    var large_max_3 = $('#large_max_3').val();
    var SKU_1 = $('#SKU_1').val();
    var id_product = $('#id_product').val();
    
    
var tab_mullti  = 0;
    if($('#tab_ch2').is(":checked")){
        tab_mullti = 1;
      }


    var large_unit_buy  = 0;
    if($('#large_unit_buy').is(":checked")){
        large_unit_buy = 1;
      }
    var large_unit_sale  = 0;
    if($('#large_unit_sale').is(":checked")){
        large_unit_sale = 1;
      }
    var large_unit_barcode  = 0;
    if($('#large_unit_barcode').is(":checked")){
        large_unit_barcode = 1;
      }
    var medium_unit_buy  = 0;
    if($('#medium_unit_buy').is(":checked")){
        medium_unit_buy = 1;
      }
    var medium_unit_sale  = 0;
    if($('#medium_unit_sale').is(":checked")){
        medium_unit_sale = 1;
      }
    var medium_unit_barcode  = 0;
    if($('#medium_unit_barcode').is(":checked")){
        medium_unit_barcode = 1;
      }
    var small_unit_buy  = 0;
    if($('#small_unit_buy').is(":checked")){
        small_unit_buy = 1;
      }
    var small_unit_sale  = 0;
    if($('#small_unit_sale').is(":checked")){
        small_unit_sale = 1;
      }
    var small_unit_barcode  = 0;
    if($('#small_unit_barcode').is(":checked")){
        small_unit_barcode = 1;
      }
    var miscellaneous_goods  = 0;
    if($('#miscellaneous_goods').is(":checked")){
        miscellaneous_goods = 1;
      }
    var Serial_Number  = 0;
    if($('#Serial_Number').is(":checked")){
        Serial_Number = 1;
      }
    var status  = 0;
    if($('#status1').is(":checked")){
        status = 1;
      }
    if($('#status2').is(":checked")){
        status = 2;
      }
    if($('#status3').is(":checked")){
        status = 3;
      }
    if($('#status4').is(":checked")){
        status = 4;
      }
    var warranty  = 0;
    if($('#warranty').is(":checked")){
        warranty = 1;
      }
    
    var using  = 0;
    if($('#using').is(":checked")){
        using = 1;
      }

                 
  var generation_id_success = document.getElementById("generation_id_success");
  var rate_small_id_success = document.getElementById("rate_small_id_success");
  var abbrev_ch_id_success = document.getElementById("abbrev_ch_id_success");
  var abbrev_th_id_success = document.getElementById("abbrev_th_id_success");
  var abbrev_en_id_success = document.getElementById("abbrev_en_id_success");
  var name_ch_id_success = document.getElementById("name_ch_id_success");
  var name_th_id_success = document.getElementById("name_th_id_success");
  var name_en_id_success = document.getElementById("name_en_id_success");
  var keyword_tag_id_success = document.getElementById("keyword_tag_id_success");
  var title_tag_id_success = document.getElementById("title_tag_id_success");
  var description_tag_id_success = document.getElementById("description_tag_id_success");
  var large_unit_id_success = document.getElementById("large_unit_id_success");
  var medium_unit_id_success = document.getElementById("medium_unit_id_success");
  var small_unit_id_success = document.getElementById("small_unit_id_success");
  var category_id_success = document.getElementById("category_id_success");
  var brand_id_success = document.getElementById("brand_id_success");

  if (window.getComputedStyle(generation_id_success).display === "none" || window.getComputedStyle(rate_small_id_success).display === "none" || window.getComputedStyle(abbrev_ch_id_success).display === "none" || window.getComputedStyle(abbrev_th_id_success).display === "none" || window.getComputedStyle(abbrev_en_id_success).display === "none"|| window.getComputedStyle(name_ch_id_success).display === "none" || window.getComputedStyle(name_th_id_success).display === "none" || window.getComputedStyle(name_en_id_success).display === "none" || window.getComputedStyle(keyword_tag_id_success).display === "none" || window.getComputedStyle(title_tag_id_success).display === "none" || window.getComputedStyle(description_tag_id_success).display === "none" || window.getComputedStyle(large_unit_id_success).display === "none" || window.getComputedStyle(medium_unit_id_success).display === "none" || window.getComputedStyle(small_unit_id_success).display === "none"  || window.getComputedStyle(category_id_success).display === "none" || window.getComputedStyle(brand_id_success).display === "none") {
    swal("คำเตือน", "กรุณากรอกข้อมูลที่จำเป็นให้ถูกต้อง และครบถ้วน", "warning")
    return false;
  }

  if (small_unit==medium_unit || medium_unit==large_unit || small_unit==large_unit) {
    swal("คำเตือน", "หน่วยเล็ก หน่วยกลาง หน่วยใหญ่ ต้องไม่ซ้ำกัน", "warning")
    return false;
  }
    if($('#tab_ch2').is(":checked")){
      
        if($(".variants_change:checked").length==0){ // ถ้าไม่มีการเลือก checkbox ใดๆ เลย  
        swal("คำเตือน", "คุณยังไม่ได้เลือกคุณลักษณะสินค้า", "warning")
        return false;
        }else{
          var formData1 = new FormData($('#frm_attribute')[0]);
          var do_che = "sku_mull_edit";
         $.ajax({
                       

                        method: "POST",
                        url: "check_sku.php?do_che="+do_che,
                        data: formData1,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(test) {
                          console.log(test.status);
                           if (test.status=='0') {
           
                    swal("คำเตือน", ""+test.message+" กรุณากรอกใหม่", "warning")
                    return false;
          }
                        },
                      });
   
        }
    }else{
      if (SKU_1=='') {

            swal("คำเตือน", "กรุณากรอก SKU", "warning")
            return false;
          }
   
    }

    if(small_min_1 =='' || small_min_2 =='' || small_min_3 =='' || small_max_1=='' || small_max_2=='' || small_max_3==''){ // 
        swal("คำเตือน", "กรุณาใส่จำนวนหน่วยเล็ก", "warning")
        return false;
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
                                    title_tag:title_tag,description_tag:description_tag,keyword_tag:keyword_tag,name_en:name_en,name_th:name_th,name_ch:name_ch,abbrev_en:abbrev_en,abbrev_th:abbrev_th,abbrev_ch:abbrev_ch,large_unit:large_unit,medium_unit:medium_unit,small_unit:small_unit,rate_small:rate_small,rate_large:rate_large,width:width,Length:Length,height:height,weight:weight,manufac_url:manufac_url,order_url:order_url,discount:discount,replacement_product:replacement_product,lead_time:lead_time,detail_warranty:detail_warranty,note:note,id_catagory:id_catagory,brand:brand,generation:generation,editor_en:editor_en,editor:editor,editor_ch:editor_ch,small_min_1:small_min_1,small_max_1:small_max_1,medium_min_1:medium_min_1,medium_max_1:medium_max_1,large_min_1:large_min_1,large_max_1:large_max_1,small_min_2:small_min_2,small_max_2:small_max_2,medium_min_2:medium_min_2,medium_max_2:medium_max_2,large_min_2:large_min_2,large_max_2:large_max_2,small_min_3:small_min_3,small_max_3:small_max_3,medium_min_3:medium_min_3,medium_max_3:medium_max_3,large_min_3:large_min_3,large_max_3:large_max_3,large_unit_buy:large_unit_buy,large_unit_sale:large_unit_sale,large_unit_barcode:large_unit_barcode,medium_unit_buy:medium_unit_buy,medium_unit_sale:medium_unit_sale,medium_unit_barcode:medium_unit_barcode,small_unit_buy:small_unit_buy,small_unit_sale:small_unit_sale,small_unit_barcode:small_unit_barcode,miscellaneous_goods:miscellaneous_goods,Serial_Number:Serial_Number,status:status,warranty:warranty,using:using,SKU_1:SKU_1,id_product:id_product

                                },
                                success: function (data) {
                                    // console.log(data);
                                    //  alert(data);
                                    var id = data;
                                    var SKU_1 = $('#SKU_1').val();
                                    var id_attr_product_1 = $('#id_attr_product_1').val();
                                    var formData = new FormData($('#frm_attribute')[0]);
                                    if($('#tab_ch2').is(":checked")){
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
                                            url: "back_product_edit-attribute.php?id=" + id+"&&tab_mullti="+tab_mullti,
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function (test) {
                                                // alert(test);
                                            },
                                        });
                                     } 
                                     else {
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
                                            url: "back_product_edit-attribute.php?id=" + id+"&&SKU_1="+SKU_1+"&id_attr_product_1="+id_attr_product_1,
                                            data: {
                                                SKU_1: SKU_1,id_attr_product_1:id_attr_product_1
                                            },
                                            success: function (test) {
                                                //alert(test);
                                            },
                                        });
                                    }
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
                                 n = attribute_text.split(',');
                                markup += "<tr>";
                                markup += '<td align="center"><input type="checkbox" name="" value="' + attribute_text + '" data-idhead="' + data.status + '" data-attr="' + attribute_head + '" class="smtp_changes' + i + ' variants_change variants_num_check' + i + '">';
                                markup += '<td>' + attribute_head + '</td>';
                                // markup += '<td><input type="text" value="' + attribute_text + '" data-idhead="' + data.status + '" id="tags" data-role="tagsinput" data-smtp="' + i + '" class="tagss form-control" style="border:none;"></td></tr>';
                                 markup += '<td>';
         for (var i = n.length - 1; i >= 0; i--) {
           markup +=' <span class="" ><small class="label  bg-green">'+n[i]+'</small></span>';
         }
         markup += '<input type="hidden" value="'+attribute_text+'" data-idhead="'+data.status+'" id="tags" data-role="" data-smtp="'+i+'" class="tagss form-control" style="border:none;" disabled="disabled"></td></tr>';

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
var arr = allArrays;
aa=arr.join ( "," );
var text_label = aa.split(',');
text_label_text ='';
for(var a=0;a<text_label.length;a++){     
  if (text_label[a]=='') {}else{ 
    text_label_text += text_label[a]+',';
  }
}
              var r = getPermutation(allArrays);
              console.log(text_label.length);
              var text_id_arr = text_id.split(',');
              var text_id_head = '';
              for (var i = 0; i < allArrays.length; i++) {
                for (var c = 0; c < allArrays[i].length; c++) {
                  text_id_head += text_id_arr[i]+',';
                }
              }
              console.log(text_id_head);
              var text_id_head_arr = text_id_head.split(',');
              // return false;        // alert(sum);
              num_sku=0;
              for(var a=0;a<text_label.length;a++){     
              if (text_label[a]=='') {}else{ 
                num_sku++;
                                cook += '<tr class="variants_temp">';
                                cook += '<td><label>';
                                cook += '<img src="https://www.igetweb.com/themes_v2/assets/img/default-img.png" ';
                                cook += 'class="variant-img' + a + ' item-list-img default-img" style="width:40px; cursor:pointer;">';
                                cook += '<input type="file" class="image_upload" data-id="' + a + '" style="display:none;" name="attr_file[]"></label>';
                                cook += '</td>';
                                cook += '<td>';

                                cook += '<small class="label pull-left bg-option1" style="margin-right: 5px; margin-bottom:5px;">' + text_label_text[a] + '</small>';

                                cook += '<input type="hidden" value="' + text_label_text[a] + '" name="option_attr[]" id="option_attr_render' + a + '">';
                                cook += '<input type="hidden" name="attr_head[]"  value="'+text_id_head_arr[a]+'" class="id_attr_head">';
                                cook += '</td>';
                               
                                cook += '<td>';
                                cook += '<input type="text" class="form-control input-sm" name="SKU[]" id="'+num_sku+'" placeholder="หมวดหมู่-แบรนด์-รุ่น-option">';
                                cook += '</td>';
                               
                                cook += '<td style="text-align:center; width:60px; max-width:60px;">';
                                cook += '<input name="" type="checkbox" checked="check" value="1" data-id="' + a + '" class="check_value">';
                                cook += '<input name="show[]" type="checkbox" checked id="option_check_hidden' + a + '" value="1" hidden>';
                                cook += '</td>';
                           }}
                            
                            $('.not_in').removeClass('active_item');
                            $('.new_gen').addClass('active_item');
                            $('#radio_dev_exist').prop('checked', false);
                            $('#radio_dev_render').prop('checked', true);

                            $('.dev-product-variant-render-exits').hide();
                            $('.dev-product-variant-render').show();
                            $('.empty-message').hide();
                            $('.dev-product-variant-render').html(cook);
                            

                        } else {
                            $('.dev-product-variant-render-exits').hide();
                            $('.dev-product-variant-render').hide();
                            $('.empty-message').show();
                        }
                        // $('.id_attr_head').val(text_id);
                        $('#text_id_head').val(num_sku);

                    });
//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------!!tag it---------------------------------------------------------------------

//----------------------------------------------------generate variants------------------------------------------------------------
                    $(document).on('click', '.variants_change1', function () {
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

                            //var r = getPermutation(allArrays);
                            console.log(allArrays);
                           var arr = allArrays;
aa=arr.join ( "," );
var text_label = aa.split(',');
text_label_text ='';
for(var a=0;a<text_label.length;a++){     
  if (text_label[a]=='') {}else{ 
    text_label_text += text_label[a]+',';
  }
}
var text_label_arr = text_label_text.split(',');

              var r = getPermutation(allArrays);
              console.log(allArrays.length);
              var text_id_arr = text_id.split(',');
              var text_id_head = '';
              for (var i = 0; i < allArrays.length; i++) {
                for (var c = 0; c < allArrays[i].length; c++) {
                  text_id_head += text_id_arr[i]+',';
                }
              }
              console.log(text_id_head);
              var text_id_head_arr = text_id_head.split(',');
              console.log(text_id_head_arr);
              // return false;        // alert(sum);
              num_sku=0;
              for(var a=0;a<text_label_arr.length-1;a++){     
              if (text_label_arr[a]=='') {}else{ 
                num_sku++;
                                cook += '<tr class="variants_temp">';
                                cook += '<td><label>';
                                cook += '<img src="https://www.igetweb.com/themes_v2/assets/img/default-img.png" ';
                                cook += 'class="variant-img' + a + ' item-list-img default-img" style="width:40px; cursor:pointer;">';
                                cook += '<input type="file" class="image_upload" data-id="' + a + '" style="display:none;" name="attr_file[]"></label>';
                                cook += '</td>';
                                cook +=   '<td>';
                                cook += '<small class="label pull-left bg-option1" style="margin-right: 5px; margin-bottom:5px;">'+text_label_arr[a]+'</small>';
             
                                cook += '<input type="hidden" value="'+text_label_arr[a]+'" name="option_attr[]">';
                                cook += '<input type="hidden" name="attr_head[]" value="'+text_id_head_arr[a]+'" class="id_attr_head">';
                                cook +=   '</td>';
                                cook +=   '<td>';
                                cook +=      '<input type="text" class="form-control input-sm" name="SKU[]" id="'+num_sku+'" placeholder="หมวดหมู่-แบรนด์-รุ่น-option" require> ';
                                cook +=   '</td>';
                                
                                cook += '<td style="text-align:center; width:60px; max-width:60px;">';
                                cook += '<input name="" type="checkbox" checked="check" value="1" data-id="' + a + '" class="check_value">';
                                cook += '<input name="show[]" type="checkbox" checked id="option_check_hidden' + a + '" value="1" hidden>';
                                cook += '</td>';
                            }}

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
                        //$('.id_attr_head').val(text_id);
                         $('#text_id_head').val(num_sku);

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

<script src="js/select2.min.js"></script>
<script type="text/javascript">
    $('#replacement_product').select2();
    //$('#id_catagory').select2();
</script>
<script type="text/JavaScript">
function copy(){
 

var name = document.getElementById("editor_en").value;
//document.getElementById("th").innerHTML = name;
// document.getElementById("ch").innerHTML = name;

$('#editor_th').froalaEditor('html.set', name);
$('#editor_ch').froalaEditor('html.set', name);

var name_th = document.getElementById("editor").value;
//alert(name+"="+name_th);
// document.getElementById("input-editor").focus();
// document.getElementById("input-editor_ch").focus();

}

function check_editor(){
  var name_en = document.getElementById("editor_en").value;
  var name_th = document.getElementById("editor_th").value;
  var name_ch = document.getElementById("editor_ch").value;
  if (name_en==name_th  && name_th==name_ch) {
    // alert('yes:'+name_en+'=='+name_th+'=='+name_ch);
    document.getElementById("li_en").style.backgroundColor  = "#a0a0a0";
    document.getElementById("li_th").style.backgroundColor  = "#a0a0a0";
    document.getElementById("li_ch").style.backgroundColor  = "#a0a0a0";
  }else{
    // alert('no:'+name_en+'=='+name_th+'=='+name_ch);
    document.getElementById("li_en").style.backgroundColor  = "#FF0000";
    document.getElementById("li_th").style.backgroundColor  = "#FF0000";
    document.getElementById("li_ch").style.backgroundColor  = "#FF0000";
  }
}


  $(document).on('change','#SKU_1',function(){
    var sku = $(this).val();
    var do_che = "sku_1"

    $.ajax({
        type:"POST",
        url:'check_sku.php',
        data: {sku:sku,do_che:do_che},             
        success:function(data){
          console.log(data);
          if (data.status=='0') {
            document.getElementById("SKU_1").style.border = "3px solid red";
          }else{
            document.getElementById("SKU_1").style = "none ";
          }
          },
        });

    }); 

  $(document).on('change','.input-sm',function(){
    var sku = $(this).val();
    var i = $(this).attr('id');
    var do_che = "sku_1"
    $.ajax({
        type:"POST",
        url:'check_sku.php',
        data: {sku:sku,do_che:do_che},             
        success:function(data){
          console.log(data);
          if (data.status=='0') {
            document.getElementById(i).style.border = "3px solid red";
          }else{
            document.getElementById(i).style = "none ";
          }
          },
        });

    });    
        

</script>
<script type="text/javascript">

    $(document).on('change', '#large_unit', function(){
       
          var username = $(this).val();
          
              
           if(username =='0'){
                  $('#large_unit_id_normal').removeClass('large_unit_class_normal');
                  $('#large_unit_id_success').hide();
                  $('#large_unit_id_wrong').hide();
                  $('#large_unit_id_normal').show();
              
          }else{
            $('#large_unit_id_normal').removeClass('large_unit_class_normal');
                  $('#large_unit_id_success').show();
                  $('#large_unit_id_wrong').hide();
                  $('#large_unit_id_normal').hide();

          }

        });
   $(document).on('change', '#medium_unit', function(){
       
          var username = $(this).val();
          
              
           if(username =='0'){
                  $('#medium_unit_id_normal').removeClass('medium_unit_class_normal');
                  $('#medium_unit_id_success').hide();
                  $('#medium_unit_id_wrong').hide();
                  $('#medium_unit_id_normal').show();
              
          }else{
            $('#medium_unil_id_normal').removeClass('medium_unit_class_normal');
                  $('#medium_unit_id_success').show();
                  $('#medium_unit_id_wrong').hide();
                  $('#medium_unit_id_normal').hide();

          }

        });

   $(document).on('change', '#small_unit', function(){
       
          var username = $(this).val();
          
              
           if(username =='0'){
                  $('#small_unit_id_normal').removeClass('small_unit_class_normal');
                  $('#small_unit_id_success').hide();
                  $('#small_unit_id_wrong').hide();
                  $('#small_unit_id_normal').show();
              
          }else{
            $('#small_unil_id_normal').removeClass('small_unit_class_normal');
                  $('#small_unit_id_success').show();
                  $('#small_unit_id_wrong').hide();
                  $('#small_unit_id_normal').hide();

          }

        });
      $(document).on('change', '#id_catagory', function(){
       
          var username = $(this).val();
          code_id_catagory = username.split(',');


          var brand = $('#brand').val();
          code_brand = brand.split(',');

          $( "#SKU_1" ).keyup();
          var code_modal = $('#generation').val();
          
          
              
           if(username =='0'){
                  $('#category_id_normal').removeClass('category_class_normal');
                  $('#category_id_success').hide();
                  $('#category_id_wrong').hide();
                  $('#category_id_normal').show();
              
          }else{
            $('#category_id_normal').removeClass('category_class_normal');
                  $('#category_id_success').show();
                  $('#category_id_wrong').hide();
                  $('#category_id_normal').hide();

                 $('.sku_auto').val(code_id_catagory[1]+'-'+code_brand[1]+'-'+code_modal);

          }

        });

       $(document).on('change', '#brand', function(){
       
          var username = $(this).val();
          code_brand = username.split(',');


          var id_catagory = $('#id_catagory').val();
          code_id_catagory = id_catagory.split(',');

          $( "#SKU_1" ).keyup();
          var code_modal = $('#generation').val();
          
              
           if(username =='0'){
                  $('#brand_id_normal').removeClass('brand_class_normal');
                  $('#brand_id_success').hide();
                  $('#brand_id_wrong').hide();
                  $('#brand_id_normal').show();
              
          }else{
            $('#brand_id_normal').removeClass('brand_class_normal');
                  $('#brand_id_success').show();
                  $('#brand_id_wrong').hide();
                  $('#brand_id_normal').hide();

                  $('.sku_auto').val(code_id_catagory[1]+'-'+code_brand[1]+'-'+code_modal);

          }

        });
          $(document).on('keyup', '#title_tag', function(){
          var username = $(this).val();
              
           if(username.length > 0){
                  $('#title_tag_id_normal').removeClass('title_tag_class_normal');
                  $('#title_tag_id_success').show();
                  $('#title_tag_id_wrong').hide();
                  $('#title_tag_id_normal').hide();
              
          }else{
            $('#title_tag_id_success').hide();
            $('#title_tag_id_wrong').hide();
            $('#title_tag_id_normal').show();
            $('#title_tag_id_normal').addClass('title_tag_class_normal');

          }
        

        
        });
        $(document).on('keyup', '#description_tag', function(){
          var username = $(this).val();
     
           if(username.length > 0){
                  $('#description_tag_id_normal').removeClass('description_tag_class_normal');
                  $('#description_tag_id_success').show();
                  $('#description_tag_id_wrong').hide();
                  $('#description_tag_id_normal').hide();

          }else{
            $('#description_tag_id_success').hide();
            $('#description_tag_id_wrong').hide();
            $('#description_tag_id_normal').show();
            $('#description_tag_id_normal').addClass('description_tag_class_normal');

          }
                
        });
        
        $(document).on('keyup', '#keyword_tag', function(){
          var username = $(this).val();
          
           if(username.length > 0){
                  $('#keyword_tag_id_normal').removeClass('keyword_tag_class_normal');
                  $('#keyword_tag_id_success').show();
                  $('#keyword_tag_id_wrong').hide();
                  $('#keyword_tag_id_normal').hide();

          }else{
            $('#keyword_tag_id_success').hide();
            $('#keyword_tag_id_wrong').hide();
            $('#keyword_tag_id_normal').show();
            $('#keyword_tag_id_normal').addClass('keyword_tag_class_normal');

          }
                
        });

        $(document).on('keyup', '#name_en', function(){
          var username = $(this).val();
         
           if(username.length > 0){
                  $('#name_en_id_normal').removeClass('name_en_class_normal');
                  $('#name_en_id_success').show();
                  $('#name_en_id_wrong').hide();
                  $('#name_en_id_normal').hide();

          }else{
            $('#name_en_id_success').hide();
            $('#name_en_id_wrong').hide();
            $('#name_en_id_normal').show();
            $('#name_en_id_normal').addClass('name_en_class_normal');

          }
                
        });
        $(document).on('keyup', '#name_th', function(){
          var username = $(this).val();
          
           if(username.length > 0){
                  $('#name_th_id_normal').removeClass('name_th_class_normal');
                  $('#name_th_id_success').show();
                  $('#name_th_id_wrong').hide();
                  $('#name_th_id_normal').hide();

          }else{
            $('#name_th_id_success').hide();
            $('#name_th_id_wrong').hide();
            $('#name_th_id_normal').show();
            $('#name_th_id_normal').addClass('name_th_class_normal');

          }
                
        });
        $(document).on('keyup', '#name_ch', function(){
          var username = $(this).val();
          
           if(username.length > 0){
                  $('#name_ch_id_normal').removeClass('name_ch_class_normal');
                  $('#name_ch_id_success').show();
                  $('#name_ch_id_wrong').hide();
                  $('#name_ch_id_normal').hide();

          }else{
            $('#name_ch_id_success').hide();
            $('#name_ch_id_wrong').hide();
            $('#name_ch_id_normal').show();
            $('#name_ch_id_normal').addClass('name_ch_class_normal');

          }
                
        });
        $(document).on('keyup', '#abbrev_en', function(){
          var username = $(this).val();
          
           if(username.length > 0){
                  $('#abbrev_en_id_normal').removeClass('abbrev_en_class_normal');
                  $('#abbrev_en_id_success').show();
                  $('#abbrev_en_id_wrong').hide();
                  $('#abbrev_en_id_normal').hide();

          }else{
            $('#abbrev_en_id_success').hide();
            $('#abbrev_en_id_wrong').hide();
            $('#abbrev_en_id_normal').show();
            $('#abbrev_en_id_normal').addClass('abbrev_en_class_normal');

          }
                
        });
        $(document).on('keyup', '#abbrev_th', function(){
          var username = $(this).val();
           if(username.length > 0){
                  $('#abbrev_th_id_normal').removeClass('abbrev_th_class_normal');
                  $('#abbrev_th_id_success').show();
                  $('#abbrev_th_id_wrong').hide();
                  $('#abbrev_th_id_normal').hide();

          }else{
            $('#abbrev_th_id_success').hide();
            $('#abbrev_th_id_wrong').hide();
            $('#abbrev_th_id_normal').show();
            $('#abbrev_th_id_normal').addClass('abbrev_th_class_normal');

          }
                
        });
        $(document).on('keyup', '#abbrev_ch', function(){
          var username = $(this).val();
           if(username.length > 0){
                  $('#abbrev_ch_id_normal').removeClass('abbrev_ch_class_normal');
                  $('#abbrev_ch_id_success').show();
                  $('#abbrev_ch_id_wrong').hide();
                  $('#abbrev_ch_id_normal').hide();

          }else{
            $('#abbrev_ch_id_success').hide();
            $('#abbrev_ch_id_wrong').hide();
            $('#abbrev_ch_id_normal').show();
            $('#abbrev_ch_id_normal').addClass('abbrev_ch_class_normal');

          }
                
        });
        $(document).on('keyup', '#rate_small', function(){
          var username = $(this).val();
          var num = parseInt(username);
           if(username.length > 0 && num>0){
                  $('#rate_small_id_normal').removeClass('rate_small_class_normal');
                  $('#rate_small_id_success').show();
                  $('#rate_small_id_wrong').hide();
                  $('#rate_small_id_normal').hide();

          }else{
            $('#rate_small_id_success').hide();
            $('#rate_small_id_wrong').hide();
            $('#rate_small_id_normal').show();
            $('#rate_small_id_normal').addClass('rate_small_class_normal');

          }
                
        });
sku_auto();
        function sku_auto(){
             var brand = $('#brand').val();
          code_brand = brand.split(',');

          var id_catagory = $('#id_catagory').val();
          code_id_catagory = id_catagory.split(',');

          var code_modal = $('#generation').val();
          //$( "#SKU_1" ).keyup();
          $('#sku_auto').val(code_id_catagory[1]+'-'+code_brand[1]+'-'+code_modal);
    
}

        $(document).on('keyup', '#generation', function(){
          var username = $(this).val();

          var brand = $('#brand').val();
          code_brand = brand.split(',');

          var id_catagory = $('#id_catagory').val();
          code_id_catagory = id_catagory.split(',');

          var code_modal = $('#generation').val();
          $( "#SKU_1" ).keyup();
          $('.sku_auto').val(code_id_catagory[1]+'-'+code_brand[1]+'-'+code_modal);

           if(username.length > 0){
                  $('#generation_id_normal').removeClass('generation_class_normal');
                  $('#generation_id_success').show();
                  $('#generation_id_wrong').hide();
                  $('#generation_id_normal').hide();

          }else{
            $('#generation_id_success').hide();
            $('#generation_id_wrong').hide();
            $('#generation_id_normal').show();
            $('#generation_id_normal').addClass('generation_class_normal');

          }
                
        });
        $(document).on('keyup', '#SKU_1', function(){
          var username = $(this).val();
           if(username.length > 0){
                  $('#SKU_1_id_normal').removeClass('SKU_1_class_normal');
                  $('#SKU_1_id_success').show();
                  $('#SKU_1_id_wrong').hide();
                  $('#SKU_1_id_normal').hide();

          }else{
            $('#SKU_1_id_success').hide();
            $('#SKU_1_id_wrong').hide();
            $('#SKU_1_id_normal').show();
            $('#SKU_1_id_normal').addClass('SKU_1_class_normal');

          }
                
        });
        

        
        

        
</script>

<script type="text/javascript">
  $(document).on('click','.variants_change', function(){
 var sku_auto = $('#sku_auto').val();
text_id='';
text_attr_sub='';
      if($(this).is(":checked")){
          var id_attr_head = $(this).attr('data-idhead');
          var id_attr_sub = $(this).attr('data-idsub');
          
          //text_id += id_attr_head;
          var text_attr_sub = $(this).val();
          //array_push += text_push;
        
        console.log(id_attr_head);
        console.log(id_attr_sub);
        console.log(text_attr_sub);
var id_attr_sub_arr = id_attr_sub.split(',');
var text_attr_sub_arr = text_attr_sub.split(',');
        for(var a=0;a<text_attr_sub_arr.length;a++){    

                var table = document.getElementById("myTable");
                count_rows = table.getElementsByTagName("tr").length;

                 console.log('แถม'+count_rows); 
      
    var row = table.insertRow(count_rows);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    // var cell5 = row.insertCell(4);
    // var cell6 = row.insertCell(5);


 
    cell1.innerHTML = '<label><img src="https://www.igetweb.com/themes_v2/assets/img/default-img.png"class="variant-img'+count_rows+' item-list-img default-img" style="width:40px; cursor:pointer;"><input type="file" class="image_upload" data-id="'+count_rows+'" style="display:none;" name="attr_file_ex[]"></label>';
    cell2.innerHTML = '<small class="label pull-left bg-option1" style="margin-right: 5px; margin-bottom:5px;">'+text_attr_sub_arr[a]+'</small>';
    cell3.innerHTML = '<input type="text" class="form-control input-sm sku_auto" name="SKU_ex[]" id="'+count_rows+'" placeholder="หมวดหมู่-แบรนด์-รุ่น-option" value="'+sku_auto+'-'+text_attr_sub_arr[a]+'" readonly/>';
    cell4.innerHTML = '<input name="show_ex[]" type="checkbox" checked="check" value="1" data-id="'+count_rows+'" class="check_value">';
    cell4.innerHTML += '<input type="hidden" value="'+id_attr_sub_arr[a]+'" name="option_attr_ex[]">';
    cell4.innerHTML += '<input type="hidden" name="attr_head_ex[]" value="'+id_attr_head+'" class="id_attr_head">';
    cell4.innerHTML += "<button style='display: none;' id='"+id_attr_sub_arr[a]+"' style='' type='button' class='"+id_attr_head+" btn btn-danger' onclick='del_row(this,"+count_rows+")'> <i class='fa fa-fw fa-trash'></i></button> ";
    cell4.innerHTML += '<input type="hidden" name="id_attr_product[]" value="">';
    
    }
 
}else{
      var id_attr_head = $(this).attr('data-idhead');
      var id_attr_sub = $(this).attr('data-idsub');
      var text_attr_sub = $(this).val();

      console.log(id_attr_head);
      console.log(id_attr_sub);
      console.log(text_attr_sub);

      var id_attr_sub_arr = id_attr_sub.split(',');
      var text_attr_sub_arr = text_attr_sub.split(',');

       for(var a=0;a<id_attr_sub_arr.length;a++){     
var tagButton = document.getElementById (id_attr_sub_arr[a] );
tagButton.click();
}

    }


    
    });

  function del_row(r,id_input){
 
      var i = r.parentNode.parentNode.rowIndex;
     var id_input =id_input;

  document.getElementById("myTable").deleteRow(i);
}

 $("#tab_1").on('click', function(){
      document.getElementById('tab_ch1').checked = true;
  });
  $("#tab_mullti").on('click', function(){
      document.getElementById('tab_ch2').checked = true;
  });

    function isNumber(ele) {
      var vchar = String.fromCharCode(event.keyCode);
 if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
  ele.onKeyPress=vchar;
}
 function check_num(ele) {
      var vchar = String.fromCharCode(event.keyCode);
 if ((vchar<'0' || vchar>'9')) return false;
  ele.onKeyPress=vchar;
}
</script>
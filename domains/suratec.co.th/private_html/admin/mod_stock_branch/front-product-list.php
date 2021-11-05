<?php
//require_once '../library/connect.php';
require_once '../library/functions.php';

checkAdminUser($objConnect);

$id_branch = $_GET['id_branch'];

$cmd = "SELECT * FROM mod_erp_branch WHERE id_branch=?";
$stmt = $objConnect->prepare($cmd);
$stmt->bind_param('s',$id_branch);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

$title_page = 'รายการสินค้าในสต็อกของร้านค้า ' . $result['name_branch'];

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
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../plugins/iCheck/all.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- Pace style -->
    <link rel="stylesheet" href="../plugins/pace/pace.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <link rel="stylesheet" href="css/app.css">
</head>

<body class="hold-transition skin-blue sidebar-mini fixed" onload="startTime()">
<div class="wrapper" ng-app="App"  ng-controller="AppController">
    <?php require_once '../template/nav_menu.php';

    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?=$title_page?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="../../index.php"> แดชบอร์ด</a></li>
                <li class=""><a href="front-manage.php">จัดการสต็อกของสาขา</a></li>
                <li class="active"><?=$title_page?></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- SELECT2 EXAMPLE -->
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <!-- Start box warning for ADD system -->
                    <div class="box box-primary callout-primary-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">รายการสินค้า</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>

                        </div>
                        <div class="box-body" >
                            <div class="box-body">
                                <div class="form-inline">
                                    <label>หมวดหมู่สินค้า</label>
                                    <select class="form-control" ng-model="CategorySelected" ng-change="LoadList()">
                                        <option value=""></option>
                                        <option ng-repeat="cat in Categorys track by $index" value="{{cat.id_catagory}}">{{cat.name_catagory}}</option>
                                    </select>

                                    <input class="form-control" placeholder="ชื่อสินค้า" ng-model="productname" >

                                    <button class="btn btn-warning pull-right" style="margin-left: 0.5rem; <?php echo $button_open; ?>" ng-click="ScrapManage()" ><i class="fa fa-chain-broken"></i> รายการสินค้าที่เสียหาย</button>
                                    <button class="btn btn-success pull-right" style='<?php echo $button_open; ?>' ng-click="ClickAddNew()" ><i class="fa fa-plus"></i> เพิ่มรายการ</button>

                                </div>
                            </div>
                            <div class="box-body">

                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th style="width:20%;max-width: 30%" class="text-center" >สินค้า</th>
                                        <th class="text-center">รายละเอียด</th>
                                        <th class="text-center">บาร์โค้ด</th>
                                        <th class="text-center">จำนวนคงเหลือ</th>
                                        <th class="text-center">จำนวนที่ขายไปแล้ว</th>
                                        <th class="text-center">ขั้นต่ำและสูงสุด</th>
                                        <th class="text-center" width="15%">ควบคุม</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    <tr ng-repeat="item in ProductData.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter:productname track by $index">
                                        <td style=" vertical-align: middle"  class="text-center">{{$index+1 + ((currentPage-1)*itemsPerPage)}}</td>
                                        <td style=" vertical-align: middle"  class="text-left">{{ item.name_product }}</td>
                                        <td style=" vertical-align: middle"  class=""><label class="label bg-blue-active">{{item.option_name}}</label> </td>
                                        <td style=" vertical-align: middle"  class="">{{ item.barcode }}</td>
                                        <td style=" vertical-align: middle" class="text-right">{{ item.balance_stock }}</td>
                                        <td style=" vertical-align: middle" class="text-right">{{ item.order_stock }}</td>
                                        <td style=" vertical-align: middle" class="text-center">{{item.min + ' - ' + item.max}}</td>
                                        <td style=" vertical-align: middle"  class="text-center"  >
                                            <button class="btn btn-primary btn-sm" ng-click="ClickStock(item.id,'<?=$result["id_branch"]?>')" type="button"><i class="fa fa-inbox"></i> บันทึกสต็อก</button>
                                            <button class="btn btn-info btn-sm" ng-click="ClickEdit(item.id,$index)" type="button"><i class="fa fa-edit"></i> แก้ไข</button>
                                            <button class="btn btn-warning btn-sm" ng-click="ScrapAdd(item.id,$index)" type="button"><i class="fa fa-tag"></i> เสียหาย</button>
                                        </td>
                                    </tr>
                                    </tbody>


                                </table>

                            </div>

                            <div class="box-body">
                                <ul uib-pagination total-items="bigTotalItems" ng-model="currentPage" items-per-page="itemsPerPage" max-size="maxSize" class="pagination-sm pull-right" boundary-link-numbers="true" rotate="false"></ul>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
    </div>


    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

<script src="../bower_components/inputmask/dist/jquery.inputmask.bundle.js"></script>


<script src="js/angular.min.js"></script>
<script src="js/angular-animate.min.js"></script>
<script src="js/angular-sanitize.min.js"> </script>
<link rel="stylesheet" href="css/ui-bootstrap-csp.css">
<script src="js/ui-bootstrap-tpls.js"></script>

<script src="../bower_components/PACE/pace.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script>

<script src="js/timer.js"></script>

<script src="js/front-product-list.js"></script>

<script type="application/javascript">



</script>
</body>
</html>

<?php
//require_once '../library/connect.php';
require_once '../library/functions.php';



checkAdminUser($objConnect);

$title_page = 'เพิ่มสินค้า';

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
<div class="wrapper" ng-app="AppFrontAdd" ng-controller="FrontController" >
    <?php require_once '../template/nav_menu.php';   ?>
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
                <div class="col-lg-9 col-md-10 col-sm-10">


                </div>

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <!-- Start box warning for ADD system -->
                    <div class="box box-primary callout-primary-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">เลือกสินค้า</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>

                        </div>

                        <div class="box-body"  >
                            <div class="box-body">
                                <form>
                                    <div class="form-inline">
                                        <input class="form-control" placeholder="ค้นหาด้วยชื่อ"  ng-model="productname">
                                        <button class="btn btn-info">ค้นหา</button>
                                    </div>
                                </form>
                            </div>

                            <div class="box-body" id="ProductSelect">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="text-center" width="10%">#</th>
                                        <th class="text-center" width="5rem">รูป</th>
                                        <th class="text-center" width="50%">สินค้า</th>
                                        <th class="text-center" width="20%">หมวดหมู่</th>
                                        <th class="text-center" width="10%">จำนวนคุณลักษณะ</th>
                                       

                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr ng-repeat="item in ProductData.slice(((bigCurrentPage-1)*itemsPerPage), ((bigCurrentPage)*itemsPerPage)) | filter:productname track by $index" ng-click="ProductTableSelect(item.product.id_product,item)">
                                        <td style=" vertical-align: middle" class="text-center">{{$index+1+ ((bigCurrentPage-1)*itemsPerPage)}}</td>
                                        <td style=" vertical-align: middle" class="vertical-align"><img style="max-width: 5rem" src="" ng-src="{{'../../uploads/product/' + item.product.name_image}}"> </td>
                                        <td style=" vertical-align: middle"  >{{ item.product.name_product }}</td>
                                        <td style=" vertical-align: middle" class="text-center">{{item.product.name_catagory}}</td>
                                        <td style=" vertical-align: middle" class="text-center">{{ item.attr.length }}</td>
                                      

                                    </tr>
                                    </tbody>


                                </table>

                            </div>

                            <div class="box-body">
                                <ul uib-pagination total-items="bigTotalItems" ng-model="bigCurrentPage" items-per-page="itemsPerPage" max-size="maxSize" class="pagination-sm pull-right" boundary-link-numbers="true" rotate="false"></ul>

                            </div>


                        </div>



                    </div>
                </div>

            </div>
        </section>
    </div>

    <div class="modal fade in" id="modal-attr-select" style="display: none; padding-right: 17px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">เลือกคุณลักษณะ {{}}</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center" width="10%">#</th>
                            <th class="text-center" width="5rem">รูป</th>
                            <th class="text-center" width="50%">รายละเอียด</th>
                            <th class="text-center" width="20%">SKU</th>
                            <th class="text-center" width="10%">ราคา</th>
                            <th class="text-center" width="10%">เลือก</th>

                        </tr>
                        </thead>


                        <tbody>
                        <tr ng-repeat="item in TempProductAttr track by $index" ng-click="AttributeSelected(item.id_attr)">
                            <td style=" vertical-align: middle" class="text-center">{{$index+1}}</td>
                            <td style=" vertical-align: middle" class="vertical-align"><img style="max-width: 5rem" src="" ng-src="{{'../../uploads/product/' + selectProduct.name_image}}"> </td>
                            <td style=" vertical-align: middle" >{{ item.option_name }}</td>
                            <td style=" vertical-align: middle" class="text-center">{{ item.SKU_attr }}</td>
                            <td style=" vertical-align: middle" class="text-center">{{ item.price_attr }}</td>
                            <td style=" vertical-align: middle" class="text-center"><i class="fa fa-2x fa-plus-circle"></i></td>

                        </tr>
                        </tbody>
 

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
<script src="js/sweetalert2.all.min.js"></script>

<script src="js/timer.js"></script>

<script src="js/front-add.js"></script>

<script type="application/javascript">



</script>
</body>
</html>

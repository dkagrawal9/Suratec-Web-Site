<?php
//require_once '../library/connect.php';
require_once '../library/functions.php';
require_once 'Database.php';


checkAdminUser($objConnect);

$title_page = 'สร้างรายการใบขอซื้อ';

require_once('vendor/autoload.php');
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
<div class="wrapper" >
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
                <li><a href="../../index.php"></i> แดชบอร์ด</a></li>
                <li class="active"><?=$title_page?></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- SELECT2 EXAMPLE -->
            <div class="row">

                <div class="col-lg-7 col-md-10 col-sm-10">
                    <!-- Start box warning for ADD system -->
                    <div class="box box-primary callout-primary-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">รายละเอียดผู้บันทึก</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>

                        </div>
                        <div class="box-body" >
                            <div class="box-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">สาชา</th>
                                        <th class="text-center">จังหวัด</th>
                                        <th class="text-center">พนักงาน</th>
                                        <th class="text-center">การทำงาน</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    <tr ng-repeat="item in ReportData.slice(((bigCurrentPage-1)*itemsPerPage), ((bigCurrentPage)*itemsPerPage)) track by $index">
                                        <td class="text-center">{{$index+1}}</td>
                                        <td class="text-center">{{ item.create_datetime }}</td>
                                        <td class="text-right">{{item.total_material_price}}</td>
                                        <td class="text-right">{{ item.total_sale }}</td>
                                        <td>
                                            <button class="btn btn-info" ng-click="ClickEdit(item.id,$index)" type="button"><i class="fa fa-edit"></i> แก้ไข </button>
                                            <button class="btn btn-danger" type="button"><i class="fa fa-remove"></i> ลบ </button>
                                        </td>
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




    <div class="boxsave">
        <button type="button" class="delmulti-menu btn btn-danger" style="transition: 0.4s;" id="MultiDelete" disabled><i class="fa fa-remove"></i> ลบรายการที่เลือก <span class="num_"></span></button>

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


<script src="js/sweetalert.min.js"></script>

<script src="js/timer.js"></script>

<script type="application/javascript">



</script>
</body>
</html>

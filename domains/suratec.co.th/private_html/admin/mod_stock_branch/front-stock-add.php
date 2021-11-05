<?php
//require_once '../library/connect.php';
require_once '../library/functions.php';

checkAdminUser($objConnect);

$id_branch = $_GET['id_branch'];

$cmd = "SELECT * FROM mod_erp_branch WHERE id_branch=?";
$stmt = $objConnect->prepare($cmd);
$stmt->bind_param('s', $id_branch);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

$title_page = 'สต๊อกของร้านค้า ' . $result['name_branch'];
$pid = filter_input(INPUT_GET, 'pid', FILTER_VALIDATE_INT);
if (!$pid) {
    exit('not allow');
}
$pcmd = "SELECT p.name_product FROM product_attribute a LEFT JOIN product p on a.id_product = p.id_product WHERE a.id_attr = $pid";
$presult = $objConnect->query($pcmd);
$pdetail = $presult->fetch_assoc();

$acmd = "SELECT b.id , p.name_product , a.option_name , (b.sum_stock - b.order_stock) as  balance_stock ,b.sum_stock,b.order_stock,b.min,b.max , b.create_datetime ,a.barcode FROM product_stock_branch b LEFT JOIN product p ON p.id_product = b.id_product LEFT JOIN product_attribute a 
ON a.id_attr = b.id_product_attr WHERE b.id_branch='$id_branch' AND b.delete_datetime IS NULL AND b.id=$pid";
$aresult = $objConnect->query($acmd)->fetch_assoc();

$sum_stock = $aresult['sum_stock'];

$balance_stock = ($aresult['balance_stock'] / 100) * $sum_stock;
$order_stock = ($aresult['order_stock'] / 100) * $sum_stock;


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

    <link rel="stylesheet" href="../bower_components/bootstrap-datepicker-custom/css/bootstrap-datepicker.min.css">

    <link rel="stylesheet" href="css/app.css">
</head>

<body class="hold-transition skin-blue sidebar-mini fixed" onload="startTime()">
<div class="wrapper" ng-app="App" ng-controller="AppController">
    <?php
    require_once '../template/nav_menu.php';
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?= $title_page ?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="../../index.php"> แดชบอร์ด</a></li>
                <li class=""><a href="front-manage.php">จัดการสต็อกของร้านค้า</a></li>
                <li class="active"><a href="front-product-list.php?id_branch=<?= $result['id'] ?>"></a><?= $title_page ?></li>
                <li class="active">บันทึกสต๊อกสินค้า</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- SELECT2 EXAMPLE -->
            <div class="row">

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <!-- Start box warning for ADD system -->
                    <div class="box box-primary callout-primary-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">สต๊อกสินค้า <?= $aresult['name_product'] ?></h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>

                        </div>
                        <div class="box-body">

                            <div class="chart-responsive">
                                <canvas id="chart-area" width="100%"></canvas>
                            </div>
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">จำนวนคงเหลือ
                                        <?= $aresult['order_stock'] > $aresult['balance_stock'] ? '<span class="pull-right text-green"><i class="fa fa-angle-up"></i>' : '<span class="pull-right text-red"><i class="fa fa-angle-down"></i> ' ?>
                                        <?= $aresult['balance_stock'] ?></span></a></li>
                                <li>
                                    <a href="#">จำนวนที่ขายได้ <?= $aresult['balance_stock'] > $aresult['order_stock'] ? '<span class="pull-right text-green"><i class="fa fa-angle-up"></i>' : '<span class="pull-right text-red"><i class="fa fa-angle-down"></i> ' ?> <?= $aresult['order_stock'] ?></span></a>
                                </li>
                                <li><a href="#">รวมทั้งหมด
                                        <span class="pull-right text-info"></i> <?= $aresult['sum_stock'] ?></span></a></li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <!-- Start box warning for ADD system -->
                    <div class="box box-primary callout-primary-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">บันทึกสต๊อกสินค้า</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>

                        </div>
                        <div class="box-body">
                            <form ng-submit="addStock()">
                                <div class="form-group">
                                    <label>ชื่อสินค้า</label>
                                    <input class="form-control" value="<?= $aresult['name_product'] ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label>จำนวน</label>
                                    <input class="form-control" ng-model="Data.amount" min="1" max="99999" required type="number">
                                </div>

                                <div class="form-group">
                                    <label>Lot.</label>
                                    <input class="form-control" ng-model="Data.lot" type="text">
                                </div>

                                <div class="form-group">
                                    <label>ราคา</label>
                                    <input class="form-control" ng-model="Data.price" type="text">
                                </div>

                                <div class="form-group">
                                    <label>วันหมดอายุ</label>
                                    <input class="form-control datepicker" ng-model="Data.endtime" type="text">
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary">บันทึก</button>
                                </div>
                            </form>
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
<script src="../bower_components/PACE/pace.min.js"></script>
<script src="../bower_components/inputmask/dist/jquery.inputmask.bundle.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>

<script src="../bower_components/bootstrap-datepicker-custom/js/bootstrap-datepicker-custom.js"></script>
<script src="../bower_components/bootstrap-datepicker-custom/locales/bootstrap-datepicker.th.min.js"></script>

<script src="js/angular.js"></script>
<script src="js/angular-animate.min.js"></script>
<script src="js/angular-sanitize.min.js"></script>
<link rel="stylesheet" href="css/ui-bootstrap-csp.css">
<script src="js/ui-bootstrap-tpls.js"></script>


<script src="js/sweetalert2.all.min.js"></script>

<script src="js/timer.js"></script>


<script type="application/javascript">

    $('.datepicker').datepicker({
        language: 'th',
        format: 'yyyy-mm-dd',
        // thaiyear: true
    });

    window.onload = function () {
        var config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                        <?=$balance_stock?>,
                        <?=$order_stock?>
                    ],
                    backgroundColor: [
                        window.chartColors.orange,
                        window.chartColors.green
                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    'จำนวนคงเหลือ',
                    'จำนวนที่ขายได้',

                ]
            },
            options: {
                responsive: true
            }
        };

        var ctx = document.getElementById('chart-area').getContext('2d');

        window.myPie = new Chart(ctx, config);
    };

    let app = angular.module('App', []);
    app.controller('AppController', function ($scope, $http) {
        $scope.Data = {};
        $scope.Data.stock_id = <?=$pid?>;
        $scope.Data.amount = 0;
        $scope.Data.lot = '';
        $scope.Data.price = '';
        $scope.Data.endtime = '';

        const Toast = Swal.mixin({
            position: 'center',
            showConfirmButton: false,
            timer: 3000
        });

        $scope.addStock = function () {
            $http.post('back-add-stock.php',$scope.Data).then(function (response) {
                 console.log(response);
                Toast.fire({
                    type: 'success',
                    title: 'บันทึกข้อมูลสำเร็จ'
                }).then(function () {
                    location.reload(true);
                })
            },function (error) {
                Toast.fire({
                    type: 'error',
                    title: 'บันทึกข้อมูลพลาด'
                })
            });
        };
    });

</script>
</body>
</html>

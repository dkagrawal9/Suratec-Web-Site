<?php
require_once '../library/connect.php';
require_once '../library/functions.php';
//checkAdminUser();

$title = 'New Customer';
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

    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- Pace style -->
    <link rel="stylesheet" href="../plugins/pace/pace.min.css">
    <!--Css table -->
    <link rel="stylesheet" href="css/app.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


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
                <li class="active"><?=$title?></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content" ng-app="NewCustomer" ng-controller="AddUserFormController">
            <!-- SELECT2 EXAMPLE -->
            <div class="row">


            <div class="col-lg-6 col-md-6 col-sm-12">
                <!-- Start box warning for ADD system -->
                <div class="box box-primary callout-primary-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Address 1</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        </div>

                    </div>
                    <div class="box-body" >
                        <form>
                            <div class="col-lg-12 col-md-12 col-sm-12">

                                <div class="form-group">
                                    <label>Name</label><br>
                                    <input type="text" class="form-control" >
                                </div>

                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" type="email"  placeholder="Address">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">

                                <div class="form-group">
                                    <label>Continent</label><br>
                                    <select class="form-control" ng-model="data.Continent" ng-change="LoadCountry(data.Continent)">
                                        <option value="">Select continent</option>
                                        <option ng-repeat="item in Continent track by $index" value="{{ item.id }}">{{ item.name }}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control" ng-model="data.Country"  ng-change="LoadSub(data.Country)" >
                                        <option value=""></option>
                                        <option ng-repeat="item in Country track by $index" value="{{ item.id }}">{{ item.name }}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>State</label>
                                    <select class="form-control" ng-model="data.Sub" >
                                        <option value=""></option>
                                        <option ng-repeat="item in Sub track by $index" value="{{ item.id }}">{{ item.name }}</option>
                                    </select
                                </div>

                                <div class="form-group">
                                    <label>Post Code</label>
                                    <input class="form-control" type="email"  placeholder="PostCode">
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <!-- Start box warning for ADD system -->
        <div class="box box-primary callout-primary-box">
            <div class="box-header with-border">
                <h3 class="box-title">Set Customer</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div>

            </div>
            <div class="box-body" >
                <form>
                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <div class="form-group">
                            <label>Set Group</label><br>
                            <select class="form-control">
                                <option value="">Broker</option>
                                <option value="">Chain Stores</option>
                                <option value="">Chain Supermarket</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Customer Type</label><br>
                            <select class="form-control">
                                <option value="">Retailers</option>
                            </select>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
    </section>

    <div class="boxsave">
        <button type="button" class="btn btn-info pull-right btnSendAdd" id="btnSendAdd" style="transition: 0.4s; margin-left: 5px;" disabled><i class="fa fa-check"></i>&nbsp;Save</button>
        <button type="button" class="btn btn-warning pull-right btnSendClear" id="btnSendClear" style="border:1px solid #e08e0b;"><i class="fa fa-remove"></i>&nbsp;Clear</button>
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

<!-- PACE -->
<script src="../bower_components/PACE/pace.min.js"></script>
<script src="js/timer.js"></script>

<script src="js/angular.js"></script>
<script src="js/angular-animate.min.js"></script>
<script src="js/angular-sanitize.min.js"> </script>
<link rel="stylesheet" href="css/ui-bootstrap-csp.css">
<script src="js/ui-bootstrap-tpls.js"></script>
<script src="js/sweetalert2.all.min.js"></script>
<script src="js/front-add.js"></script>



</body>
</html>

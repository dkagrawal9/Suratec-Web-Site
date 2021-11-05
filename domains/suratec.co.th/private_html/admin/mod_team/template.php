<?php
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser();

$title = 'ergerger';
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
<div class="wrapper">
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
                <li><a href="../page_home/index.php"></i> Dashboard</a></li>
                <li class="active"><?=$title?></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <!-- Start box warning for ADD system -->
                    <div class="box box-primary callout-primary-box">
                        <div class="box-header with-border">
                            <h3 class="box-title"></h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>

                        </div>

                        <div class="box-body">

                        </div>

                        <div class="box-footer">

                        </div>

                    </div>
                </div>

        </section>

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
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- PACE -->
    <script src="../bower_components/PACE/pace.min.js"></script>
    <script src="js/timer.js"></script>

    <script type="text/javascript">




    </script>
</body>
</html>

<?php
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser();

$title = 'Customer Group Management';
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
<div class="wrapper" ng-app="GroupeApp">
    <?php require_once '../template/nav_menu.php'; ?>
    <?php require_once '../library/permission.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" ng-controller="GroupListController">
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
                            <h3 class="box-title">Search</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>

                        </div>

                        <div class="box-body">
                            <div class="form-inline">
                                <input class="form-control" placeholder="Name">

                            </div>

                        </div>

                        <div class="box-footer">

                        </div>

                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <!-- Start box warning for ADD system -->
                    <div class="box box-primary callout-primary-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Customer Groups</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAdd3"><i class="fa fa-plus"></i> Add new</button>
                            </div>

                        </div>

                        <div class="box-body">
                            <table class="table table-hover table-responsive" >
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="30%">Name</th>
                                    <th width="20%">Detail</th>
                                    <th width="15%">Member Count</th>
<!--                                    <th width="20%">Control</th>-->
                                </tr>

                                <tbody>
                                <tr ng-repeat="item in GroupData track by $index">
                                    <td>{{ item.id_group }}</td>
                                    <td>{{ item.name_group }}</td>
                                    <td>{{ item.detail_group }}</td>
                                    <td>{{ item.total }}</td>
<!--                                    <td>-->
<!--                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEdit">Edit</button>-->
<!--                                        <button class="btn btn-danger btn-sm">Remove</button>-->
<!--                                    </td>-->
                                </tr>

                                </tbody>
                            </table>

                        </div>

                        <div class="box-footer">

                        </div>

                    </div>
                </div>

        </section>

        <div class="modal fade" tabindex="-1" role="dialog" id="modalEdit" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Edit Group</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form >
                            <div class="form-group">
                                <label for="edi1">Group Name<span class="text-red">*</span></label>
                                <input class="form-control" type="text" id="edi1" value="Retail Online">
                            </div>

                            <div class="form-group">
                                <label for="edi2">Group Detail</label>
                                <textarea id="edi2" class="form-control" placeholder="Some detail">

                                </textarea>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="modalAdd3" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Add Group</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form >
                            <div class="form-group">
                                <label for="add1">Group Name<span class="text-red">*</span></label>
                                <input class="form-control" type="text" id="add1" ng-model="data.name_group" placeholder="Grope name">
                            </div>

                            <div class="form-group">
                                <label for="add2">Group Detail</label>
                                <textarea id="add2" class="form-control" ng-model="data.detail_group" placeholder="Some detail">

                                </textarea>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" ng-click="Add()">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="control-sidebar-bg"></div>
    </div>
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

<script src="js/angular.js"></script>
<script src="js/front-group.js"></script>
<script src="js/sweetalert2.all.min.js"></script>

<script type="text/javascript">
    $(document).ajaxStart(function () {
        Pace.restart()
    });


</script>
</body>
</html>

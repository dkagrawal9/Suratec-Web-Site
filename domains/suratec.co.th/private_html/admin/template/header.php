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
    <title><?php echo TITLE; ?></title>
    
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
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
       <!-- <link rel="stylesheet" href="css/app.css"> -->
       <!-- Google Font -->
       <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
       <link rel="stylesheet" href="../plugins/sweetalert2/dist/sweetalert2.min.css">

   </head>
<!--     <style type="text/css">
        .btn-sm{
            margin-right: 5px;
        }
    </style> -->
    <style type="text/css">
        .btn-sm{
            margin-right: 5px;
        }

        @media (min-width: 768px)
        {
            .modal-dialog-add-product {
                width: 800px;
                margin: 30px auto;
            }
        }
    </style>
    <body class="hold-transition skin-blue fixed sidebar-mini " onload="startTime()">
        <div class="wrapper">
            <?php require_once '../template/nav_menu.php'; ?>
            <?php require_once '../library/permission.php'; ?>
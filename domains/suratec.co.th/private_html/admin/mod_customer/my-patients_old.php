<?php
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser($objConnect);

$title = 'My Patients';
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
  <link rel="shortcut icon" type="image/png" href="../img/favicon.png" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Pace style -->
  <link rel="stylesheet" href="../plugins/pace/pace.min.css">
  <!--Css table -->
  <link rel="stylesheet" href="css/app.css">
  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="../plugins/sweetalert2/dist/sweetalert2.min.css">

</head>
<style type="text/css">
  .btn-sm {
    margin-right: 5px;
  }
  .read-appointment{
		cursor: pointer;
    color: #007bff;
	}
	.badge{
		font-size: 13px;
    font-weight: normal;
	}
  .badge-warning {
    color: #111;
    background-color: #ffc107;
  }
  .badge-danger {
    color: #fff;
    background-color: #dc3545;
  }
  .badge-success {
    color: #fff;
    background-color: #00a65a;
  }
</style>
<style type="text/css">
  @media screen and (max-width:1500px) {

    /* 0px - 479px */
    #div_table {
      overflow: auto;
    }
  }
</style>

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
              <div class="box-body">
                <br><br>
                <div id="div_table">
                  <table class="table" id="appointmentTable">
                    <thead>
                      <tr>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Birthday</th>
                        <th>Age</th>

                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
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
  <!-- <script src="js/front-manage-attr.js"></script> -->
  <script src="js/timer.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="../plugins/sweetalert2/dist/sweetalert2.min.js"></script>

  <script type="text/javascript">

    var appointmentTable;
    $(document).ready(function(){

      appointmentTable = $('#appointmentTable').DataTable({
        "ajax": 'my-patients-list.php',
        "iDisplayLength" : 10,
        "columns": [
          { "data": "fname"},
          { "data": "lname"},
          { "data": "email" },
          { "data": "telephone" },
          { "data": "birthday" },
          { "data": "age" },
        ],
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Thai.json'
        }
      });

      $(document).on('click','.accept-reject',function(){
        const id = $(this).attr('data-channel');
        let status = 0;
        let statusText = "";

        Swal.fire({
          title: 'Appointment',
          text: 'Please accept/reject the Appointment or press esc to cancel',
          showCancelButton: true,
          confirmButtonText: `Accept`,
          confirmButtonColor: 'green',
          cancelButtonColor: 'red',
          cancelButtonText: 'Reject',
        }).then((result) => {
          
          if (result.value === true) {
            status = 5;
          }else if (result.dismiss === 'cancel'){
            status = 6;
            statusText = "rejected successfully";
          }

          if (status > 0) {

            $.ajax({
              method: "POST",
              url: "update-appointment-status.php",
              data: {id,status}
            }).done(function(res) {
              if (res.status === 200) {
                appointmentTable.ajax.reload();
                swal.fire({
                  title: `Appointment`,
                  text: res.message,
                  type: "success"
                }).then(function() {});
              }else if (res.status === 401) {
                swal.fire({
                  title: "Unable to process appointment",
                  text: res.message,
                  type: "error"
                }).then(function() {});
              }
            }).fail(function(err) {
              console.error('error...',err);
            }).always(function() {
              // always called
            }); 

          }
          
        });


      });


    });
    
  </script>
</body>
</html>
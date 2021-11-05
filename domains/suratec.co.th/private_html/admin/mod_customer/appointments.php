<?php
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser($objConnect);


$sqlMember = "SELECT id_data_role FROM tbl_member WHERE id_member = '".$_SESSION['user_member']."'";
$member = $objConnect->query($sqlMember)->fetch_object();

$customerList = [];
$custSql = "SELECT id_customer, fname FROM mod_customer WHERE fname !='' AND assigned_dr='".$member->id_data_role."'";

$result = $objConnect->query($custSql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_object()){
    $appRow = (array) $row;
    array_push($customerList, $appRow);
  }
}
$bookingTime = getBookingTime();


$title = 'Appointments : List View';
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
  .error{
    color: red;
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
                <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#createAppointmentModal">
                  <i class="fa fa-plus"></i> Create Appointment
                </button>
                <a href="/admin/mod_customer/appointments-calendar.php" class="btn btn-primary btn-sm pull-right">
                  <i class="fa fa-calendar"></i> Calendar view
                </a>



                <div id="createAppointmentModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create an Appointment</h4>
                      </div>
                      <div class="modal-body">
                        <form id="appointmentForm" type="post">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Select Patient</label>
                                <select name="id_customer" id="idCustomer" class="form-control" style="color: #000000">
                                  <option value=""> --- Select Patient --- </option>
                                  <?php foreach ($customerList as $key => $patient): ?>
                                    <option value="<?= $patient['id_customer'] ?>"><?= $patient['fname'] ?></option>
                                  <?php endforeach ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Appointment date</label>
                                    <input type="text" class="form-control mb-30" name="appointment_date" id="appointmentDate" value="<?= date('Y-m-d') ?>" placeholder="" style="color: #000000">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Appointment time</label>
                                    <select name="appointment_time" id="appointmentTime" class="form-control" style="color: #000000">
                                      <option value=""> --- Select Time --- </option>
                                      <?php foreach ($bookingTime as $bookTime => $bookTimeValue): ?>
                                        <option value="<?= $bookTime ?>"><?= $bookTimeValue ?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group button pull-right">
                                <br>
                                <button id="bookNow" class="btn btn-primary animate">Create Appointment</button>
                                &nbsp;&nbsp;&nbsp;
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>

                  </div>
                </div>

                <br><br>
                <div id="div_table">
                  <table class="table" id="appointmentTable">
                    <thead>
                      <tr>
                        <th>Patient name</th>
                        <th>Patient age</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Status</th>
                        <th style="display:none;">Date</th>
                        <th>Action</th>
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
  <script src="../../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

  <script type="text/javascript">


    $('#appointmentDate').datepicker({
      format: 'yyyy-mm-dd',
      language: 'th',
      startDate: new Date,
      autoclose: true
    }).on('changeDate', function(e) {
      if (e.target.value != '') {
        $('#appointmentDate-error').remove();
      }
    });

    var appointmentTable;
    $(document).ready(function(){

      appointmentTable = $('#appointmentTable').DataTable({
        "ajax": 'appointment-list.php',
        "iDisplayLength" : 10,
        "columns": [
          { 
					"data": function (data, type, dataToSet) {
						return `<a href="/admin/mod_employee/patient-profile.php?id=${data.id_customer}" target="_blank">${data.fname}</a>`;
					}
				},
          { "data": "age"},
          { "data": "appointment_date" },
          { "data": "appointment_time" },
          {
            "data": function (data, type, dataToSet) {
              if(data.status == 1){
                return "<a href='javascript:void(0)' data-channel='"+data.channel_id+"' class='accept-reject'><small class='badge badge-warning' title='Click to accept or reject the appointment'>Pending</small></a>";
              }else if(data.status == 2){
                return "<small class='badge badge-danger'>Cancelled</small>";
              }else if(data.status == 3){
                return "<small class='badge badge-dark'>Attended</small>";
              }else if(data.status == 4){
                return "<small class='badge badge-dark'>Unattended</small>";
              }else if(data.status == 5){
                return "<small class='badge badge-success'>Accepted</small>";
              }else if(data.status == 6){
                return "<small class='badge badge-danger'>Rejected</small>";
              }
            }
          },
          { "data": "created_at" },
          {
            "data": function (data, type, dataToSet) {
              let actions  = ''
              if (data.startCall == true) {
                actions += `<a href="/channel/call.php?channel=${data.channel_id}" target="_blank"><i class="fa fa-video-camera"></i>&nbsp;Call</a>&nbsp;`;
                actions += `<a href="/channel/voice-call.php?channel=${data.channel_id}" target="_blank"><i class="fa fa-phone"></i>&nbsp;Call</a>&nbsp;`;
              }
              // actions += `<a href="/admin/mod_employee/patient-profile.php?id=${data.id_customer}" target="_blank"><i class="fa fa-user"></i>&nbsp;Profile</a>`;

              return actions;
            }
          }
        ],
        "columnDefs": [
          {
            "targets": [ 5 ],
            "visible": false,
            "searchable": false
          }
        ],
        order: [[ 5, "asc" ]],
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Thai.json'
        }
      });


      $.validator.methods.validBookTime = function( value, element ) {
        return true;
      }
      $("#appointmentForm").validate({
        errorElement: 'span',
        rules: {
          id_customer: { required: true },
          appointment_date: { required: true },
          appointment_time: { required: true, validBookTime: true }
        },
        messages: {
          id_customer: {
            required: "Please select a Patient"
          },
          appointment_date: {
            required: "Please select Appointment date"
          },
          appointment_time: {
            required: "Please select Appointment time",
            validBookTime: "Please select valid book time",
          }
        },
        submitHandler: function(form) {
          $(".error").remove(); // for custom error from server
          $("#bookNow").attr('disabled',true);
          $("#bookNow").text('Please wait...');

          // Ajax call to book an appointment
          $.ajax({
            method: "POST",
            url: "create-appointment.php",
            data: $(form).serialize()
          }).done(function(res) {
            if (res.status === 200) {
              swal.fire({
                title: "Appointment created!!!",
                text: "Appointment created successfully.",
                type: "success"
              }).then(function() {
                location.reload();
              });
            }else if (res.status === 401) {
              const errors = res.errors;
              if (errors) {
                if (errors.id_customer !== '' && typeof errors.id_customer !== 'undefined') {
                  $(`<span id="idCustomer-error" class="error">${errors.id_customer}</span>`).insertAfter("#idCustomer");
                }
                if (errors.appointment_exists !== '' && typeof errors.appointment_exists !== 'undefined') {
                  $(`<span id="idCustomer-error" class="error">${errors.appointment_exists}</span>`).insertAfter("#idCustomer");
                }
                if (errors.create_error !== '' && typeof errors.create_error !== 'undefined') {
                  $(`<span id="idCustomer-error" class="error">${errors.create_error}</span>`).insertAfter("#idCustomer");
                }
                if (errors.appointment_time !== '' && typeof errors.appointment_time !== 'undefined') {
                  $(`<span id="appointmentTime-error" class="error">${errors.appointment_time}</span>`).insertAfter("#appointmentTime");
                }
                if (errors.appointment_date !== '' && typeof errors.appointment_date !== 'undefined') {
                  $(`<span id="appointmentDate-error" class="error">${errors.appointment_date}</span>`).insertAfter("#appointmentDate");
                }       
              }else{
                swal.fire({
                  title: "Error!!!",
                  text: res.message,
                  type: "error"
                }).then(function() {
                  
                });
              }
            }
          }).fail(function(err) {
            console.error('error...',err);
          }).always(function() {
            $("#bookNow").attr('disabled',false);
            $("#bookNow").text('Create Appointment');
          });
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
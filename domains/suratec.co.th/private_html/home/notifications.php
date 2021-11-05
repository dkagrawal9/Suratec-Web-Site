<?php 
  require_once '../admin/library/connect.php';
  require_once '../admin/library/functions.php';
  checkMemUser($objConnect);
	include 'header.php';
	if(!isset($_SESSION)) 
	{ 
		session_start(); 
	}
	$id = $_SESSION['id_customer'];

	include_once 'common.php';

?>
<link rel="stylesheet" href="../admin/plugins/sweetalert2/dist/sweetalert2.min.css">
<script src="../admin/plugins/sweetalert2/dist/sweetalert2.min.js"></script>

<!-- datatables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.css"/>
<!-- datepicker -->
<link rel="stylesheet" href="../bootstrap-datepicker-custom/css/bootstrap-datepicker.min.css">
<style>
	.swal2-popup{
		font-size: 1rem;
	}
	.read-appointment{
		cursor: pointer;
    color: #007bff;
	}
	.badge{
		font-size: 13px;
    font-weight: normal;
	}
</style>
			<!-- Breadcrumbs -->
			<section class="breadcrumbs overlay bg-image" style="background-image: url(../uploads/mod_central_information/<?=$pic_header['value']?>)">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Bread Title -->
							<div class="bread-title">
								<h2><?php echo $lang['MENU_Notifications']?><!--Profile--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
								<li><a href="./?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME']?><!--Home--></a></li>
								<li class="active"><a href="profile_history.php?profile=st"><i class="fa fa-bell"></i><?php echo $lang['MENU_Notifications']?><!--Profile--></a></li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Breadcrumbs -->
<style>
	.pagination li a {
	top: 0px;
	right: -5px;	
	background: #f6f6f6;
	display: inline;
	width: 40px;
	height: 40px;
	line-height: 20px;
	font-size: 14px;
	color: #282828;
	text-align:center;
	border: 1px solid #e6e6e6;
	font-weight: 400;
	border-radius: 0%;
	border: avajowhite;
}
</style>
			<!-- Contact Us -->
			<section id="contact-us" class="contact-us section">
				<div class="container">
					<div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
							<div class="table-responsive">
								<table id="appointmentTable" class="table table-striped table-bordered" style="width: 100%;">
									<thead>
										<tr>
											<th>Description</th>
											<th>Status</th>
											<th style="display:none;">Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
            </div>
            <div class="col-md-1"></div>
        </div>
				</div>		
			</section>
			<!--/ End Contact Us -->
			
			<!-- Footer -->
			<?php include 'footer.php'?>
			<!--/ End footer -->
			<?php include 'footer_credit.php'?>	
		</div>
    </body>
</html>

<script src="../bootstrap-datepicker-custom/js/bootstrap-datepicker-custom.js"></script>
	<!-- datatables -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.js"></script>

<script type="text/javascript">
	var appointmentTable;
	$(document).ready(function(){
		appointmentTable = $('#appointmentTable').DataTable({
			"ajax": 'notifications-list.php',
			"iDisplayLength" : 10,
			"columns": [
				{ "data": "details"},
				{
					"data": function (data, type, dataToSet) {
						if(data.status == 1){
							return "<small class='badge badge-warning'>Unread</small>";
						}else{
							return "<small class='badge badge-dark'>Read</small>";
						}
					}
				},
				{ "data": "created_at"},
				{
					"data": function (data, type, dataToSet) {
						if (data.status == 1) {
							return '<span class="read-appointment" data-id="'+ data.notification_id +'"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;Mark as read</span>';
						}else{
							return '';
						}
					}
				}
			],
			"columnDefs": [
				{
					"targets": [ 2 ],
					"visible": false,
					"searchable": false
				}
			],
			order: [[ 2, "desc" ]],
			language: {
				url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Thai.json'
			}
		});

		$(document).on('click','.read-appointment',function(){
			const id = $(this).attr('data-id');

			// Ajax call to read a notification
			$.ajax({
					method: "POST",
					url: "read-notification.php",
					data: {id}
				}).done(function(res) {
					if (res.status === 200) {
						appointmentTable.ajax.reload();

						// update count
						let notifCount = parseInt($("#notification-count span").html());
						if (notifCount  > 0) {
							$("#notification-count span").html(--notifCount);
						}

					}else if (res.status === 401) {
						swal.fire({
							title: "Error !!!",
							text: res.message,
							type: "error"
						}).then(function() {});
					}
				}).fail(function(err) {
					console.error('error...',err);
				}).always(function() {
					// always called
				});	
			
		});

	});
</script>

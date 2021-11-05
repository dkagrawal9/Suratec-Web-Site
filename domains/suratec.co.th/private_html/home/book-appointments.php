<?php 
  require_once '../admin/library/connect.php';
  require_once '../admin/library/functions.php';
  checkMemUser($objConnect);

	$doctorsList = getDoctorList();
	$bookingTime = getBookingTime();

	
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
<!-- datepicker -->
<link rel="stylesheet" href="../bootstrap-datepicker/css/bootstrap-datepicker.css">
<style>
	.swal2-popup{
		font-size: 1rem;
	}
	.error{ color: red; }
</style>
			<!-- Breadcrumbs -->
			<section class="breadcrumbs overlay bg-image" style="background-image: url(../uploads/mod_central_information/<?=$pic_header['value']?>)">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Bread Title -->
							<div class="bread-title">
								<h2><?php echo $lang['MENU_Book_Appointment']?><!--Profile--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
								<li><a href="./?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME']?><!--Home--></a></li>
								<li class="active"><a href="profile_history.php?profile=st"><i class="fa fa-calendar"></i><?php echo $lang['MENU_Book_Appointment']?><!--Profile--></a></li>
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
							<div style="margin: 0px 0 0 50px;">
								<div class="contact">
									<h4><?=$lang['MENU_Book_Appointment']?></h4>
									<form id="appointmentForm" type="post">
										<div class="row">
											<div class="col-md-8">
												<div class="form-group">
													<label class="mydropname">Select Doctor</label>
													<select  style="width: 100% !important;" name="id_employee" id="idEmployee" class="form-control" style="color: #000000">
														<option value=""> --- Select Doctor --- </option>
														<?php foreach ($doctorsList as $key => $doctor): ?>
															<option value="<?= $doctor['id_employee'] ?>"><?= $doctor['surname'] ?></option>
														<?php endforeach ?>
													</select>
												</div>
											</div>
											<div class="col-md-8">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Appointment date</label>
															<input type="text" class="form-control mb-30" name="appointment_date" id="appointmentDate" value="<?= date('Y-m-d')  ?>" placeholder="" style="color: #000000">
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
												<div class="form-group button">
													<button id="bookNow" class="btn primary animate">Book Appointment</button>
													&nbsp;&nbsp;&nbsp;
													<a href="./appointments.php?profile=st" class="">Cancel</a>
												</div>
											</div>
										</div>
									</form>
								</div>
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

<script src="../bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<!-- datatables -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.js"></script>
<!-- jQuery Validation -->
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
        
	$(document).ready(function(){

		$.validator.methods.validBookTime = function( value, element ) {
			return true;
		}
		
		$("#appointmentForm").validate({
			errorElement: 'span',
			rules: {
				id_employee: { required: true },
				appointment_date: { required: true },
				appointment_time: { required: true, validBookTime: true }
			},
			messages: {
				id_employee: {
					required: "Please select a Doctor"
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
							title: "Appointment Booked!!!",
							text: "Your Appointment booked successfully.",
							type: "success"
						}).then(function() {
							location.href='./appointments.php?profile=st';
						});
					}else if (res.status === 401) {
						const errors = res.errors;
						if (errors.id_employee !== '' && typeof errors.id_employee !== 'undefined') {
							$(`<span id="idEmployee-error" class="error">${errors.id_employee}</span>`).insertAfter("#idEmployee");
						}
						if (errors.appointment_exists !== '' && typeof errors.appointment_exists !== 'undefined') {
							$(`<span id="idEmployee-error" class="error">${errors.appointment_exists}</span>`).insertAfter("#idEmployee");
						}
						if (errors.create_error !== '' && typeof errors.create_error !== 'undefined') {
							$(`<span id="idEmployee-error" class="error">${errors.create_error}</span>`).insertAfter("#idEmployee");
						}
						if (errors.appointment_time !== '' && typeof errors.appointment_time !== 'undefined') {
							$(`<span id="appointmentTime-error" class="error">${errors.appointment_time}</span>`).insertAfter("#appointmentTime");
						}
						if (errors.appointment_date !== '' && typeof errors.appointment_date !== 'undefined') {
							$(`<span id="appointmentDate-error" class="error">${errors.appointment_date}</span>`).insertAfter("#appointmentDate");
						}						
					}
				}).fail(function(err) {
					console.error('error...',err);
				}).always(function() {
					$("#bookNow").attr('disabled',false);
					$("#bookNow").text('Book Appointment');
				});
			}
		});
	});
</script>
<style>
.nice-select.form-control, .nice-select ul.list{
	width: 100%;
}
.mydropname
{
	width: 100%;
}
</style>
<?php include 'header.php'?>
<?php
$sql_icon = "SELECT * FROM mod_footer  WHERE del_flg = 0 ";
$query_icon = mysqli_query($objConnect, $sql_icon);
?>
<?php include_once 'common.php'; ?>
    <link rel="stylesheet" href="../admin/plugins/sweetalert2/dist/sweetalert2.min.css">
    <script src="../admin/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<!-- recaptcha -->
<script src="https://www.google.com/recaptcha/api.js?hl=th" async defer></script>
<style>
	.swal2-popup{
		font-size: 1rem;
	}
</style>
			<!-- Breadcrumbs -->
			<section class="breadcrumbs overlay bg-image" style="background-image: url(../uploads/mod_central_information/<?=$pic_header['value']?>)">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Bread Title -->
							<div class="bread-title">
								<h2><?=$lang['MENU_contact_us'];?><!--Contact Us--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
								<li><a href="./?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME'];?><!--Home--></a></li>
								<li class="active"><a href="contact_us.php?contact_us=st"><i class="fa fa-clone"></i><?=$lang['MENU_contact_us'];?><!--Contact Us--></a></li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Breadcrumbs -->
			
			<!-- Contact Us -->
			<section id="contact-us" class="contact-us section">
				<div class="container">
					<div class="row">
						<!-- Contact Form -->
						<div class="col-lg-6 col-12">
							<div class="form-main">
								<h4><?=$lang['MENU_Contact'];?></h4>
								<!-- Form -->
								<form id="frm" class="form-inline contact_box">
									<div class="row">
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label><?=$lang['MENU_Name_Surname'];?></label>
												<input type="text" class="form-control mb-30 validate" name="name" placeholder="<?=$lang['MENU_Name_Surname'];?>">
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label><?=$lang['MENU_Phone_number'];?></label>
												<input type="text" class="form-control mb-30 validate" maxlength="10" name="phone" placeholder="<?=$lang['MENU_Phone_number'];?>" OnKeyPress="return check_tel(this)">
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label><?=$lang['MENU_Email'];?></label>
												<input type="email" class="form-control mb-30 validate" name="email" placeholder="<?=$lang['MENU_Email'];?>">
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label><?=$lang['MENU_Contact_story'];?></label>
												<input type="text" class="form-control mb-30 validate" name="subject" placeholder="<?=$lang['MENU_Contact_story'];?>">
											</div>
										</div>
										<div class="col-lg-12 col-12">
											<div class="form-group">
												<label><?=$lang['MENU_Message'];?></label>
												<textarea class="form-control mb-30 validate" name="detail" rows="3" cols="80" placeholder="<?=$lang['MENU_Message'];?>"></textarea>
											</div>	
										</div>
										<div class="col-lg-12 col-12">
											<div class="g-recaptcha" data-sitekey="<?= reCAPTCHA_CLIENT ?>" data-callback="recaptcha_callback"></div>
										</div>
									</div>
								</form>
								<!--/ End Form --><br>
								<div class="row">
								<div class="col-lg-12 col-12">
											<div class="form-group button">	
												<button type="submit" class="btn primary animate" id="btn_send" disabled><?=$lang['MENU_Submit_uestionnaire'];?></button>
											</div>
										</div>
									</div>
							</div>
						</div>
						<!--/ End Contact Form -->	
						<!-- Contact Address -->
						<div class="col-lg-6 col-12">
							<div class="contact-address">
								<div class="contact">
									<h4><?=$lang['MENU_contact_us'];?></h4>
									<!-- Single Address -->
									<div class="single-address">
										<span><i class="icofont icofont-phone"></i><?=$lang['MENU_Phone_number'];?></span>
										<p>
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $tel['value'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $tel['value'];
													echo $name_text_en;
												 }
												?>
											, <?php
												if($lang_file == 'lang.th.php'){
													$name_text = $phone['value'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $phone['value'];
													echo $name_text_en;
												 }
												?>
											</p>
									</div>
									<!--/ End Single Address -->
									<!-- Single Address -->
									<div class="single-address">
										<span><i class="icofont icofont-envelope-open"></i><?=$lang['MENU_Email'];?></span>
										<p><a href="mailto:
											<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $email['value'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $email['value'];
													echo $name_text_en;
												 }
												?>
											">
											<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $email['value'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $email['value'];
													echo $name_text_en;
												 }
												?>
											</a></p>
									</div>
									<!--/ End Single Address -->
									<!-- Single Address -->
									<div class="single-address">
										<span><i class="icofont icofont-pin"></i><?=$lang['MENU_Company_office'];?></span>
										<p>
											<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $address['value'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $address['value'];
													echo $name_text_en;
												 }
												?>
										</p>
									</div>
									<!--/ End Single Address -->
									<!-- Single Address -->
									<div class="single-address">
										<span><i class="icofont icofont-map-pins"></i><?=$lang['MENU_Business_office'];?></span>
										<p>
											<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $address['value'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $address['value'];
													echo $name_text_en;
												 }
												?>
											 <br> <?php
												if($lang_file == 'lang.th.php'){
													$name_text = $timeopen['value'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $timeopen['value'];
													echo $name_text_en;
												 }
												?>
											 Closed</p>
									</div>
									<!--/ End Single Address -->
								</div>
								<div class="social-info">
									<!-- Social -->
									<ul class="social">
										<?php while($res_icon = mysqli_fetch_array($query_icon)){  ?>
										<li><a href="<?=$res_icon['linked']?>" style="border: 0px solid #fff"><img src="../uploads/mod_manage_links/<?=$res_icon['icon']?>" alt="" width="30" style="border-radius: 20%;"></a></li>
										<?php  } ?>
									</ul>
									<!--/ End Social -->
								</div>
								
							</div>
						</div>
						<!--/ End Contact Address -->
					</div>
				</div>		
			</section>
			<!--/ End Contact Us -->
			
			<!-- Map Section -->
			<div class="map-section">
				<div id="myMap"></div>
			</div>
			<!--/ End Map Section -->
			
			<!-- Footer -->
			<?php include 'footer.php'?>
			<!--/ End footer -->
			<?php include 'footer_credit.php'?>	
			
			<!-- Google Map JS -->
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUKoRyztBFJ1gETzwNfNVMoUTrmp9GVA0" type="text/javascript"></script>	
			<script src="../js/gmaps.min.js"></script>
			<script src="../js/map-active.js"></script>
		</div>
    </body>
</html>

<script>

function check_tel(ele)
  {
  var vchar = String.fromCharCode(event.keyCode);
  if ((vchar<'0' || vchar>'9') ) return false;
  ele.onKeyPress=vchar;
  }
</script>

<script>
        function recaptcha_callback() {
        var btn = document.querySelector('#btn_send');
        btn.disabled = false;
        }
        document.querySelector('#btn_send').addEventListener('click', function () {
        var frm = document.querySelector('#frm');
        var formData = new FormData(frm);

        var swal_success = '<?=lang('ส่งแบบสอบถามสำเร็จ', 'Successfully')?>';
        var swal_error = '<?=lang('เกิดข้อผิดพลาด', 'Error')?>';

        if (!validate('frm')) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // console.log(JSON.parse(this.responseText));
                    var response = JSON.parse(this.responseText);
                    if (response.contact.status == 200) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            onClose: () => {
                                window.location.reload()
                            }
                        });
                        
                        /*Toast.fire({
                            type: 'success',
                            title: swal_success
                        })*/
						swal({
							title: swal_success,
							type: 'success',
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'ตกลง',
							onClose: () => {
                                window.location.reload()
                            }
						})
                    }
                    else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        
                        Toast.fire({
                            type: 'warning',
                            title: swal_error
                        })
        
                        console.log(response);
                    }
                }
            };
            xhttp.open("POST", "send_contact.php", true);
            xhttp.send(formData);
        }
    });

    function validate(frm) {
        var swal_title_validate = '<?=lang('คำเตือน!', 'Warning!')?>';
        var swal_text_validate = '<?=lang('กรุณากรอกข้อมูลให้ครบ', 'Please complete the information.')?>';
        var result = false;
        var validate = document.getElementById(frm);
        var input = validate.getElementsByClassName("validate");

        for (i = 0; i < input.length; i++) {
            if (input[i].value == "" || input[i].value == 0) {
                input[i].style.borderColor = "#d9534f"
                swal({
                    title: swal_title_validate,
                    text: swal_text_validate,
                    type: 'warning',
                    confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'ตกลง',	
					  reverseButtons: true,		
					  showLoaderOnConfirm: true
 
                })
                result = true;
            } else {
                input[i].style.borderColor = "#ccc"
            }
        }
        return result;
    }
</script>
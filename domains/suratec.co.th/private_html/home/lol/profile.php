<?php include 'header.php'
?>
<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 



$id = $_SESSION['id_customer'];

$sqlpro = "SELECT   *,mod_customer.telephone AS telephone ,mod_customer.id_customer AS id_customer, mod_customer.fname AS fname, mod_customer.lname AS lname FROM  mod_customer 
LEFT JOIN tbl_member ON mod_customer.id_customer = tbl_member.id_data_role
LEFT JOIN  mod_customer_address ON mod_customer_address.id_customer = mod_customer.id_customer
WHERE  mod_customer.id_customer = '$id' ";

 //echo $sqlpro;

$queryPro = mysqli_query($objConnect, $sqlpro);
$resultPro = mysqli_fetch_array($queryPro);

// var_dump($_SESSION);


?>
<style>

.form-radio
{
     -webkit-appearance: none;
     -moz-appearance: none;
     appearance: none;
     display: inline-block;
     position: relative;
     background-color: #e0e0e0;
     color: #000;
     top: 10px;
     height: 30px;
     width: 30px;
     border: 0;
     border-radius: 50px;
     cursor: pointer;     
     margin-right: 7px;
     outline: none;
}
.form-radio:checked::before
{
     position: absolute;
     font: 13px/1 'Open Sans', sans-serif;
     left: 11px;
     top: 7px;
     content: '\02143';
     transform: rotate(40deg);
}
.form-radio:hover
{
     background-color: #f7f7f7;
}
.form-radio:checked
{
     background-color: #a4e4c3;
}
	.form-group1
	{
		padding-top: 25px;
	}
</style>

<?php include_once 'common.php'; ?>
<link rel="stylesheet" href="../admin/plugins/sweetalert2/dist/sweetalert2.min.css">
    <script src="../admin/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
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
								<h2><?=$lang['MENU_Profile']?><!--Profile--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
								<li><a href="./?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME']?><!--Home--></a></li>
								<li class="active"><a href="profile.php?profile=st"><i class="fa fa-clone"></i><?=$lang['MENU_Profile']?><!--Profile--></a></li>
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
						
						<div class="col-lg-3 col-12">
						<form id="edit_profile_form">
                        <input type="hidden" name="_method" value="ADD_EDIT_CUTTOMER">
                        <input type="hidden"  name="id" class="form-control"  value = "<?=$resultPro['id_customer']?>" placeholder=""  >
                        <input type="hidden"  name="pass_og" class="form-control"  value = "<?=$resultPro['pass_member']?>" placeholder=""  >
                    <div class="contact-sidebar-area mb-80">
                        <!-- Single Sidebar Area -->
                        <div class="single-contact-card mb-50">
<?php $img = $resultPro['img_path'];?>
<div class="form-group img_size">
<label ><h4><?=$lang['MENU_profile']?></h4></label>
<div id="blah">
<img  src=" <?php if( empty($img) ){ print"../img/bg-img/25.jpg"; }else{print "../uploads/customer/".$resultPro['img_path'];} ?> "   style ="width: max-content;"  />
</div>
<hr>
<div class="progress">
  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%; background-color:#4cac9e"></div>
</div> 
<hr>

<input type="file" class="form-control mb-30" name="image" style="padding-top: 4px;" id="filUpload" onchange="return fileValidation()" />
</div>
                        </div>
                    </div>
						</div>
						<!--/ End Contact Form -->	
						<!-- Contact Address -->
						<div class="col-lg-8 col-12">
							<div class="contact-address" style="margin: 0px 0 0 50px;">
								<div class="contact">
									<h4><?=$lang['MENU_Profile']?></h4>
									<!-- Single Address -->
								<div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label><?=$lang['MENU_profile_name']?></label>
                                        <input type="text" class="form-control mb-30" name="fname" id="fname" value="<?=$resultPro['fname']?>" placeholder="<?=$lang['MENU_profile_name']?>" style="color: #000000">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label><?=$lang['MENU_profile_surname']?></label>
                                        <input type="text" class="form-control mb-30" value="<?=$resultPro['lname']?>" name="lname" id="lname" placeholder="<?=$lang['MENU_profile_surname']?>" style="color: #000000">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><?=$lang['MENU_Email']?></label>
                                        <input type="email" class="form-control mb-30" name="email" id="email" value="<?=$resultPro['email']?>" placeholder="<?=$lang['MENU_Email']?>" style="color: #000000">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><?=$lang['MENU_Phone_number']?></label>
                                        <input type="text" class="form-control mb-30" name="tel" id="tel" placeholder="<?=$lang['MENU_Phone_number']?>" value="<?=$resultPro['telephone']?>" style="color: #000000">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group1">
                                        <?php if(isset($_SESSION["id_customer"])){?>
                                        <label><?=$lang['MENU_Regis_text2']?></label>
                                        <?php
                                        if($resultPro['type'] == 1)
                                        {
                                            echo '<input type="radio" name="types" value="1" id="types1" class="form-radio" checked> การแพทย์ &nbsp;';
                                            echo '<input type="radio" name="types" value="2" id="types2" class="form-radio"> การกีฬา';
                                        }
                                        else
                                        {
                                             echo '<input type="radio" name="types" value="1" id="types1" class="form-radio"> การแพทย์ &nbsp;';
                                            echo '<input type="radio" name="types" value="2" id="types2" class="form-radio" checked> การกีฬา';
                                        }
                                        ?>
                                        <?php }?>
                                    </div>
                                </div>
                                        <!-- Border -->
                                <div class="container">
                                    <div class="border-line"></div>
                                </div><br>
                                    <h4 style="left: 15;"><?=$lang['MENU_profile_text_login']?></h4>
                                <div class="col-lg-6">
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><?=$lang['MENU_Login_text1']?></label>
                                        <input type="text" class="form-control mb-30" name="edit_user" id="edit_user" placeholder="<?=$lang['MENU_Login_text1']?>"  style="color: #000000" value="<?=$resultPro['user_member']?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><?=$lang['MENU_profile_text_login_pass']?></label>
                                        <input type="password" class="form-control mb-30" name="newpass" id="newpass" placeholder="<?=$lang['MENU_profile_text_login_pass']?>" style="color: #000000" aria-describedby="helpId">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><?=$lang['MENU_Regis_text5']?></label>
                                        <input type="password" class="form-control mb-30" name="conpass" id="conpass" placeholder="<?=$lang['MENU_Regis_text5']?>" style="color: #000000" aria-describedby="helpId">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                </div>
                                <div class="col-12">
									<div class="form-group button">
                                    <span class="btn primary animate" name="" id="confirm_btn"><?=$lang['MENU_profile_button']?></span>
									</div>		
                                </div>
                            </div>
									<!--/ End Single Address -->
								</div>
								
							</div>
						</div>
						<!--/ End Contact Address -->
						</form>	
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
<style>
 .img_size img{
  max-width:100%;
} 
/* input[type=file]{
padding:10px;
background:#0d61c06e;} */
</style>

<script>
// Checking File Type (images Only)
function fileValidation(){
    var fileInput = document.getElementById('filUpload');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!allowedExtensions.exec(filePath)){

        // alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');

        Swal.fire(
          'Warning !',
          'Please upload file having extensions .jpeg/.jpg/.png/.gif only.',
          'warning'
          ).then((result) => {
            document.getElementById('blah').innerHTML = '<img src="../img/bg-img/25.jpg"/>';
          })
        fileInput.value = '';
        return false;
    
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              document.getElementById('blah').innerHTML = '<img src="'+e.target.result+'"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }

    }
}
</script>



<script>

$(document).on('click', '#confirm_btn', function(event) {
  var formData = new FormData($('#edit_profile_form')[0]);


  if($("#fname").val() != ""
  && $("#lname").val() != ""
  && $("#types").val() != "" 
    
  && $("#edit_user").val() != "" 
  && $("#email").val() != "" 
  && $("#pass").val() != ""  
  && $("#conPass").val() != ""   ){
// ------------------------------------------------------------------------
swal({
                      title: 'ยืนยัน',
                      text: "บันทึกการแก้ไขโปรไฟล์ ?",
                      type: 'question',
                      showCancelButton: true,
                      confirmButtonColor: '#199e36',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'ยืนยัน',
					  cancelButtonText: 'ยกเลิก',
					  reverseButtons: true,
                      showLoaderOnConfirm: true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                        type: "POST",
                        url: "function_m.php",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                          // console.log('12345');
                         // console.log(status);
                          
                        if(data.status == 1){
                        
                          swal.fire({
                            title: "สำเร็จ !",
                            text: "บันทึกการแก้ไขโปรไฟล์สำเร็จ.",
                            type: "success"
                          }).then(function() {
                            // document.getElementById("register_form").reset();
                            // $('#model_login').modal('show');
                            location.href='./';
                          });

                        }

                            },
                        });
                    }   
                })
// -------------------------------------------------------------------------
  }else{
    swal('คำเตือน!','กรุณากรอกข้อมูลให้ครบถ้วน.','warning');

                    if($("#fname").val() == ""){
                        $("#fname").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#fname").attr("style" , "");
                        }, 5000);
                    }

                    if($("#lname").val() == ""){
                        $("#lname").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#lname").attr("style" , "");
                        }, 5000);
                    }
      
                    if($("#types").val() == ""){
                        $("#types").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#types").attr("style" , "");
                        }, 5000);
                    }

                    if($("#edit_user").val() == ""){
                        $("#edit_user").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#edit_user").attr("style" , "");
                        }, 5000);
                    }
                    if($("#email").val() == ""){
                        $("#email").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#email").attr("style" , "");
                        }, 5000);
                    }
                    if($("#pass").val() == ""){
                        $("#pass").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#pass").attr("style" , "");
                        }, 5000);
                    }
                    if($("#conPass").val() == ""){
                        $("#conPass").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#conPass").attr("style" , "");
                        }, 5000);
                    }
  }



            });
</script>
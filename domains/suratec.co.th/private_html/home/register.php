<?php include 'header.php'
?>
<?php include_once 'common.php'; ?>
    <link rel="stylesheet" href="../admin/plugins/sweetalert2/dist/sweetalert2.min.css">
    <script src="../admin/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<style>
	.swal2-popup{
		font-size: 1rem;
	}
</style>
<style>
.alert_sty{
   background-color: #dd4b39 !important;
   text-align: -webkit-center;
 }
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
	.single-bar {margin-top: 8px;}

</style>
<!-- CSS -->
<link rel="stylesheet" href="../assets/css/form-elements.css">
<link rel="stylesheet" href="../assets/css/style.css">
			<!-- Breadcrumbs -->
			<section class="breadcrumbs overlay bg-image" style="background-image: url(../uploads/mod_central_information/<?=$pic_header['value']?>)">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Bread Title -->
							<div class="bread-title">
								<h2><?=$lang['MENU_Signin_Signup'];?><!--Login / Register--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
								<li><a href="./?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME'];?><!--Home--></a></li>
								<li class="active"><a href="Signin_Signup.php?Signin_Signup=st"><i class="fa fa-clone"></i><?=$lang['MENU_Signin_Signup'];?><!--Login / Register--></a></li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Breadcrumbs -->
			<div class="top-content">
        	
            <div class="inner-bg" style="padding: 0px 0 80px 0;">
                <div class="container">   
                    <div class="row">
             
                        	
                        <div class="col-sm-12">
                        	
                        	<div class="form-box">
                        		<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3 style="color: white"><?=$lang['MENU_Regis_text']?></h3>
	                            		<p style="color: white"><?=$lang['MENU_Regis_text1']?></p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-pencil"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="" method="post" class="registration-form"  id="register_form">
									<input type="hidden" name="_method" value="ADD_CUTTOMER">
                                        
                                        <div class="form-group" style="color: #000000">
                                            <span><?=$lang['MENU_Regis_text2']?> :</span>&nbsp;
				                        	<input type="radio" name="types" value="1" id="types1" class="form-radio" checked> <?=$lang['MENU_Regis_text3']?> &nbsp;
                                            <input type="radio" name="types" value="2" id="types2" class="form-radio"> <?=$lang['MENU_Regis_text4']?>
                                            
                                            <div class="col-md-12" id="types_alert" >
											<small id="a_types"  style="color: #fafafa;"></small>
											</div>
										</div>
                                        <div class="form-group">
				                        	<label class="sr-only" for="form-email"><?=$lang['MENU_Email']?></label>
				                        	<input type="text" name="email" placeholder="<?=$lang['MENU_Email']?>..." class="form-email form-control" id="email" onblur="CHECK_EMAIL()">
										
											<div class="col-md-12" id="email_alert" >
											<small id="a_email"  style="color: #fafafa;"></small>
											</div>
										
										</div>
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-first-name"><?=$lang['MENU_Login_text1']?></label>
				                        	<input type="text" name="user" placeholder="<?=$lang['MENU_Login_text1']?>..." class="form-first-name form-control" id="user" maxlength="20">
											
											<div class="col-md-12" id="user_alert" >
											<small id="a_user"  style="color: #fafafa;"></small>
											</div>
										
										</div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-last-name"><?=$lang['MENU_Login_text2']?></label>
											<input type="password" name="pass" placeholder="<?=$lang['MENU_Login_text2']?>..." class="form-last-name form-control" id="pass">
											
<div class="col-md-12" style="padding: 4px; background-color: #ccc; color: #2f2f2f; border-radius: 2px;  font-weight: bold !important;">
<small ><input type="checkbox" onclick="showPass()"> Show Password</small>
</div>								
										</div>
                                        <div class="form-group">
				                        	<label class="sr-only" for="form-last-name"><?=$lang['MENU_Regis_text5']?></label>
				                        	<input type="password" name="conPass" placeholder="<?=$lang['MENU_Regis_text5']?>..." class="form-last-name form-control" id="conPass">
										
											<div class="col-md-12" id="conPass_alert" >
											<small id="a_pass"  style="color: #fafafa;"></small>
											</div>
										
										</div>
										<!-- <button type="submit" class="btn">สมัครสมาชิก!</button> -->
										<button type="button" name="confirm_btn" id="confirm_btn" class="btn btn-success btn-lg btn-block" disabled><span style="color: white"><?=$lang['MENU_Regis_text6']?></span></button>
				                    </form> 
			                    </div>
                        	</div>
                        	
                        </div>
                    </div>
                    
                </div>
            </div>
            

            <div class="modal fade" id="termsConditionModal"  data-backdrop="static" data-keyboard="false" role="dialog">
              <div class="modal-dialog modal-lg ">
              
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    
                    <h2 class="modal-title" style="text-align:center;">Telemedicine Consent Form</h2>
                  </div>
                  <div class="modal-body">
                      <p style="text-align:center;"><strong>TELEMEDICINE PATIENT CONSENT</strong></p>
                      <p style="text-align:justify;"><strong>PURPOSE:&nbsp;</strong>The purpose of "Telemedicine Consent Form" is to get the patient's consent in order to participate in appointments&nbsp;of telemedicine&nbsp;cares.</p>
                      <p style="text-align:justify;"><strong>RECORDS:&nbsp;</strong>Telecommunications with patients will not be recorded and stored. Patients' medical information obtained by the diagnosis and analysis can be used anonymously for further improvements in scientific studies.</p>
                      <p style="text-align:justify;"><strong>TELEMEDICINE INFORMATION:&nbsp;</strong>The medical information related to history, records and tests of the patient will be discussed during the telemedicine appointment with video and audio.</p>
                      <p style="text-align:justify;"><strong>ACCESS:&nbsp;</strong>The patient accepts that he/she needs access to PC, laptop, or mobile device and a good internet connection in order to have an efficient telemedicine appointment.</p>
                      <p style="text-align:justify;"><strong>PATIENT RIGHTS:&nbsp;</strong>The patient can withdraw his/her consent at any time and can ask the questions related to telemedicine appointments and technical requirements for telecommunication.</p>
                    <div id="text_10" class="form-html" data-component="text">
                      <p style="text-align:justify;"><strong>By signing this form,</strong></p>
                      <p style="text-align:justify;">I understand that all the laws that are protecting my privacy of medical history or information are also applied to telemedicine practices.</p>
                      <p style="text-align:justify;">I understand that I can withdraw the consent at any time and that will not affect any of my future treatment procedures.</p>
                      <p style="text-align:justify;">I understand that I can be charged the additional fees that my insurance does not cover.</p>
                      <p style="text-align:justify;">I accept that I authorize&nbsp;health care professionals and use telemedicine for my treatment and diagnosis.</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <a href="Signin_Signup.php?Signin_Signup=st" class="btn btn-danger" >Disagree</a>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Agree</button>
                  </div>
                </div>
                
              </div>
            </div>


        </div>
			<!-- Footer -->
			<?php include 'footer.php'?>
			<!--/ End footer -->
			<?php include 'footer_credit.php'?>	
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v4.0"></script>
		</div>
    </body>
</html>
<script> //show pass
function showPass() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

$(document).ready(function () {
  $("#termsConditionModal").modal('show');
});

$( '#conPass' ).keyup(function() {

  var pass = $('#pass').val();
  var conPass = $('#conPass').val();

  if(pass != conPass){
    $("#conPass_alert").attr("style" , "border-radius: 2px; background-color: #dd4b39; transition: 0.5s; display:inline-block;");
    document.getElementById("a_pass").innerHTML = "รหัสผ่านไม่ตรงกัน <i style='color:#fafafa;' class='fa fa-times-circle'></i>"; 
    document.getElementById('confirm_btn').disabled = true;

	setTimeout(function() {
    $("#conPass_alert").attr("style" , "transition: 0.5s; display:none;");
    }, 3000);

    }
    else{

     $("#conPass_alert").attr("style" , "border-radius: 2px; background-color: #1c8c36; transition: 0.5s; display:inline-block;");
     document.getElementById("a_pass").innerHTML = "รหัสผ่านตรงกัน <i  style='color:#fafafa;' class='fa fa-check-circle'></i>"; 

    setTimeout(function() {
    $("#conPass_alert").attr("style" , "transition: 0.5s; display:none;");
    }, 3000);
    document.getElementById('confirm_btn').disabled = false;  
    }
 

});  


// CHECK_USER
$( '#user' ).keyup(function() {
  var user = $('#user').val();
  var email = $('#email').val();

  var strCount = user;
  var numStr = strCount.length;


                        $.ajax({
                        type: "POST",
                        url: "function_m.php",
                        data:{_method:'CHECK_USER',
                              user:user,
                              email:email
                              },
        
                        success: function(response) {
                          // console.log(response.status);
                          // console.log('numStr : ',numStr);
                          if(response.status == 1 && user != '' ){
                            $("#user").attr("style" , "border-color: #dd4b39; border-width: 2px; background-color: #ff000038;");
                            $("#user_alert").attr("style" , "border-radius: 2px; background-color: #dd4b39; transition: 0.5s; display:inline-block;");
                            document.getElementById("a_user").innerHTML = "<i style='color:#fafafa;' class='fa fa-times-circle'></i>  ชื่อนี้ถูกใช้ไปแล้ว กรุณากรอกชื่ออื่น";
                            document.getElementById('confirm_btn').disabled = true;  
                            $("#a_user").attr("style" , "color: #fafafa;");

                          }else if(numStr < 6){
                            $("#user").attr("style" , "border-color: #ffc107; border-width: 2px; background-color: #ffc10745;");
                            $("#user_alert").attr("style" , "border-radius: 2px; background-color: #ffc107; transition: 0.5s; display:inline-block;");
                            document.getElementById("a_user").innerHTML = "<i style='color:#333;' class='fa fa-exclamation-triangle'></i>  กำหนดชื่อผู้ใช้งานไม่ตำกว่า 6 ตัวอักษร ";
                            $("#a_user").attr("style" , "color: #333;");
                            document.getElementById('confirm_btn').disabled = true; 
                          }else{
                         
                            $("#user").attr("style" , "border-color: #28a745; border-width: 2px; background-color: #28a74585;");
                            $("#user_alert").attr("style" , "border-radius: 2px; background-color: #1c8c36; transition: 0.5s; display:inline-block;");
                            document.getElementById("a_user").innerHTML = "<i style='color:#fafafa;' class='fa fa-check-circle'></i>  ชื่อนี้สามารถใช้ได้ "; 
                            $("#a_user").attr("style" , "color: #fafafa;");

                              setTimeout(function() {
                              $("#user").attr("style" ,"");
                              $("#user_alert").attr("style" , "transition: 0.5s; display:none;");
                              }, 3000);
                              document.getElementById('confirm_btn').disabled = false;  
                              
                          }

                        }

                        });

});


// CHECK_EMAIL
// $( '#email' ).keyup(function() {
  function CHECK_EMAIL(){ 

  var user = $('#user').val();
  var email = 'not';
  email = $('#email').val();
   if(email === ''){
     email = 'not';
   }

  var emailFilter=/^.+@.+\..{2,3}$/;
	var str = email;
  var st_mail = null;
    if (!(emailFilter.test(str))) { 
        st_mail = false;
    }else{
        st_mail = true;
    }

                        $.ajax({
                        type: "POST",
                        url: "function_m.php",
                        data:{_method:'CHECK_EMAIL',
                              user:user,
                              email:email
                              },
        
                        success: function(response) {
                          console.log('email : ',email);
                          
                          if(response.status == 1 && email != 'not' &&  st_mail == true){
                            $("#email").attr("style" , "border-color: #dd4b39; border-width: 2px; background-color: #ff000038;");
                            $("#email_alert").attr("style" , "border-radius: 2px; background-color: #dd4b39; transition: 0.5s; display:inline-block;");
                            document.getElementById("a_email").innerHTML = "<i style='color:#fafafa;' class='fa fa-times-circle'></i> E-Mail ถูกใช้ไปแล้ว กรุณากรอกใหม่ "; 
                            document.getElementById('confirm_btn').disabled = true;  
                            $("#a_email").attr("style" , "color: #fafafa;");
                          }
                          else if( st_mail == false && email != 'not' ){ 
                              console.log('st_mail : ',st_mail);
                            $("#email").attr("style" , "border-color: #ffc107; border-width: 2px; background-color: #ffc10745;");
                            $("#email_alert").attr("style" , "border-radius: 2px; background-color: #ffc107; transition: 0.5s; display:inline-block;");
                            document.getElementById("a_email").innerHTML = "<i style='color:#333;' class='fa fa-exclamation-triangle'></i> รูปแบบ E-Mail ไม่ถูกต้อง"; 
                            document.getElementById('confirm_btn').disabled = true; 
                            $("#a_email").attr("style" , "color: #333;");
                          }
                          else if(response.status == 0 && email != 'not' &&  st_mail == true){
                            $("#email").attr("style" , "border-color: #28a745; border-width: 2px; background-color: #28a74585;");
                            $("#email_alert").attr("style" , "border-radius: 2px; background-color: #1c8c36; transition: 0.5s; display:inline-block;");
                            document.getElementById("a_email").innerHTML = "<i style='color:#fafafa;' class='fa fa-check-circle'></i>  E-Mail นี้สามารถใช้ได้ "; 
                            $("#a_email").attr("style" , "color: #fafafa;");
                         
                              setTimeout(function() {
                              $("#email").attr("style" ,"");
                              $("#email_alert").attr("style" , "transition: 0.5s; display:none;");
                              }, 3000);
                              document.getElementById('confirm_btn').disabled = false;   
                          }
                        }
                        });
// });
  }
</script>

<script>
$(document).on('click', '#confirm_btn', function(event) {
  var formData = new FormData($('#register_form')[0]);

  if($("#user").val() != ""
  && $("#types").val() != ""     
  && $("#email").val() != "" 
  && $("#pass").val() != ""  
  && $("#conPass").val() != ""){
// ------------------------------------------------------------------------
swal({
                      title: 'ยืนยัน',
                      text: "การสมัครสมาชิก ?",
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
                            text: "สมัครสมาชิกสำเร็จ.",
                            type: "success"
                          }).then(function() {
                            document.getElementById("register_form").reset();
                            /*$('#model_login').modal('show');*/
                          });

                        }

                            },
                        });
                    }   
                })
// -------------------------------------------------------------------------
  }else{
    swal('คำเตือน!','กรุณากรอกข้อมูลให้ครบถ้วน.','warning');

                    if($("#user").val() == ""){
                        $("#user").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#user").attr("style" , "");
                        }, 5000);
                    }
                    if($("#types").val() == ""){
                        $("#types").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#types").attr("style" , "");
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




<script>
function forgot(){
    // $('#model_login').modal('hide');
                            swal.fire({
                            title: "ลืมรหัสผ่าน !",/*Forgot password*/
                            html: `
                            <div style="background-color: #47aa9b; border-radius: 5px; padding: 5px;">
                            <h5 style="color:#ffffff;" >กรุณากรอกอีเมลที่ใช้สมัคร</h5>
                            <input type="text" name="mail" class="form-control form-control-sm">
                            </div> 
                                    `,
                        
                            confirmButtonColor: "#1FAB45",
                            confirmButtonText: "ยืนยัน",
                            cancelButtonText: "ยกเลิก",
                            showCancelButton: true,
							reverseButtons: true,	
                            type: "warning",

                            preConfirm: function() {
                            return new Promise((resolve, reject) => {
                                // get your inputs using their placeholder or maybe add IDs to them
                                resolve({
                                    mail: $('input[name="mail"]').val()
                                });
                            });
                        }

                          }).then((data) => {
          console.log(data);
          mail = data.value.mail;

if(mail == ''){ //if 
swal.fire({
title: "Warning !",
text: "กรุณากรอกอีเมลที่ใช้สมัคร !",
type: "warning"
});
}else{

  // ----------------
  $.ajax({
                        type: "POST",
                        url: "function_m.php",
                        data:{_method:'CHECK_EMAIL',
                              email:mail
                              },
        
                        success: function(response) {
                          console.log('response : ',response);
                          if(response.status == 1){
                            let mail_val = new FormData();
                              mail_val.append('mail',mail);
                              // p_price_val.append('status',status);   

                              $.ajax({  
                                      url: "forgot_password.php",  
                                      method: "POST",  
                                      data: mail_val,
                                      contentType: false,
                                      processData: false,  
                                      success:function(data)  
                                      {  

                                              setTimeout(function() {
                                              swal.fire({
                                                  title: "Success !",
                                                  text: "ตรวจสอบรหัสผ่านใหม่ได้ที่อีเมล",
                                                  type: "success"
                                                }).then(function() {
                                                  window.location = "";
                                                });
                                          }, 500);

                              
                                      }  
                                });

                          }else if(response.status == 0){ //if 

                            swal.fire({
                                                  title: "Warning !",
                                                  text: "ไม่พบ E-mail นี้ในการสมัคร กรุณาตรวจสอบใหม่ !",
                                                  type: "warning"
                                                }).then(function() {
                                                  // window.location = "";
                                                });
                          }


                        }
                        });
  // -*--------------

} 

                

                    


    });
}
</script>




<script>
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


// $(document).on('click', '#list_pay_bt', function(){

//   window.location.href = "add_credit.php?pay=show";

// });
  $(document).on('click', '#login', function(){

    var username = $('#txtUserName').val();
    var password = $('#txtPassword').val();
    $.ajax({
        url:"library/function_m.php",
        method:"POST",
        data: {username:username,
              password:password},
      success:function(data){
        if(data.status == 1){
        location.href="index.php";
        }else if(data.status == 0){
         $('.alert-massage').fadeIn();
         $('.alert_sty').fadeIn();
        }else if(data.status == 2){
          location.href="../admin/";
        }else{
         $('.alert-massage-exist').fadeIn();
        }
      } 
    });
  });

  $('#txtPassword').keypress(function(event) {
        if(event.keyCode===13){
          $('#login').trigger('click');
        }
  });

  </script>




<!-- <script>


function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}



  window.fbAsyncInit = function() {
    FB.init({
      appId      : '522214218552727',
      cookie     : true,
      xfbml      : true,
      version    : 'v4.0'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));


   
</script> -->


<script>

var bFbStatus = false;
var fbID = "";
var fbName = "";
var fbEmail = "";
var first_name = "";
var   last_name = "";
var    birthday = "";

window.fbAsyncInit = function() {
  FB.init({
    appId      : '426182824708349',
    cookie     : true,
    xfbml      : true,
    version    : 'v4.0'
  });
  FB.AppEvents.logPageView();   
};

(function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "//connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));


function statusChangeCallback(response)
{

      if(bFbStatus == false)
      {
          fbID = response.authResponse.userID;

            if (response.status == 'connected') {
              getCurrentUserInfo(response)
            } else {
              FB.login(function(response) {
                if (response.authResponse){
                  getCurrentUserInfo(response)
                } else {
                  console.log('Auth cancelled.')
                }
              }, { scope: 'email' });
            }
      }


      bFbStatus = true;
}

function getCurrentUserInfo() {
FB.api('/me?fields=id,first_name,email,last_name,birthday,name,picture.width(800).height(800)', function(userInfo) {

    fbName = userInfo.name;
    fbEmail = userInfo.email;
    fbID = userInfo.id;
    first_name = userInfo.first_name;
    last_name = userInfo.last_name;
    birthday = userInfo.birthday;
    var pic = userInfo.picture.data.url;

    console.log(userInfo);
   // alert(birthday);
    $.ajax({
    url: 'function_m.php',
    // type: 'POST',
    method:"POST",
        data: {
              _method:'facebook_login',
              fbID : fbID,
              first_name : first_name,
              last_name : last_name,
              fbEmail : fbEmail,
              birthday : birthday,
              pic : pic,
              },

    success:function(data){
      // console.log('data data ::',data.code);
    login_fb();

    }
    });


});
}



function checkLoginState() {
FB.getLoginStatus(function(response) {
  statusChangeCallback(response);
});
}



function login_fb() {
    FB.login(function(response) {
      if (response.authResponse) {

        console.log(response.authResponse)

        FB.api(
  '/me',
  'GET',
  {"fields":"id"},
  function(response) {
      console.log('response : ',response);


       $.ajax({

        url:"library/function_m.php",
        method:"POST",
        data: {id_fb:response.id},
        success:function(data){
        console.log('log : ',data);

        if(data.status == 1){

        location.href="index.php";
        }
        
        else if(data.status == 0){
         $('.alert-massage').fadeIn();
        }else if(data.status == 2){
          //location.href="admin/";
        }else{
         $('.alert-massage-exist').fadeIn();
        }
        
      } 
    });
                                  
  }
);
      } else {
        alert('User cancelled login or did not fully authorize.');
      }
    });
}


</script>
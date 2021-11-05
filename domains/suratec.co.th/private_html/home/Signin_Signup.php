<?php include 'header.php'
?>
<?php include_once 'common.php';

$arr_setting =['googlelogintoken','facebooklogintoken'];
for ($i=0; $i < count($arr_setting) ; $i++) { 
           $strSQL = "SELECT * FROM `contact` WHERE `setting` ='".$arr_setting[$i]."'";
           $objQuery = mysqli_query($objConnect,$strSQL) or die (mysqli_error());
           $objResult = mysqli_fetch_array($objQuery);
           $data_value[$i] = $objResult["value"];
           $data_id[$i] = $objResult["id"];
  
}

$googlelogintoken =  $data_value[0];
$facebooklogintoken =  $data_value[1];



?>
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
<link rel="stylesheet" type="text/css" href="css/css_login.css">
<meta name="google-signin-scope" content="profile email">
<meta name="google-signin-client_id" content="<?= $googlelogintoken; ?>">


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

<!-- <style type="text/css">
  a#register {
  position: absolute;
  bottom: 10px;
  left:21%;
} 
</style> -->
      <section>
        <div class="limiter" >
    <div class="container-login100" style="background: unset;">
      <div class="wrap-login100"  style="border: 0 ;box-shadow: 5px 7px #8888883d;border-radius: 15px;">

        <div  class="login100-pic js-tilt" data-tilt style="align-items: center; padding: 5px; background: #1bbc9b;border-top-left-radius:15px;border-bottom-left-radius:15px;">
          <h3 align="center"><?php echo $lang['MENU_Welcome_to'] ?></h3>
          <img style="margin-top: 25%" src="../uploads/mod_central_information/<?php echo $pic_logo['value']?>" >
          <h5 align="center"><?php echo $lang['MENU_data_play_back_system'] ?></h5>
          
          
        </div>

        <form class="login100-form validate-form login-form" role="form" action="profile.php" method="post" style="padding: 25px;"  >
          <span class="login100-form-title">
            <h3 ><?=$lang['MENU_Login'];?></h3>
            <p ><?=$lang['MENU_Login_text'];?></p>
          </span>

          <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
             <label class="sr-only" for="form-username"><?=$lang['MENU_Login_text1'];?></label>
              <input style="border-radius: 25px;" type="text" name="form-username" placeholder="<?=$lang['MENU_Login_text1'];?>..." class="form-username form-control" id="txtUserName" required>
          </div>

          <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <label class="sr-only" for="form-password"><?=$lang['MENU_Login_text2'];?></label>
            <input style="border-radius: 25px;" type="password" name="form-password" placeholder="<?=$lang['MENU_Login_text2'];?>..." class="form-password form-control" id="txtPassword" required>
          </div>

          <div class="text-center p-t-12" style="margin-top: 10px;">
            <h6 style="float: left;"><font style="color:#dc3545;" id="text_error"></font></h6>
            <a class="txt2"  href="#" onclick="forgot()"  style="float: right;color:#dc3545;padding: 0px;"><h6><i class="fa fa-exclamation-triangle"></i> <?=$lang['MENU_Login_text3']?><!--Forgot password ?--></h6></a>
          </div>
         

          <div class="container-login100-form-btn">
            <button type="button" id="login" class="btn primary animate " style="border-radius: 25px !important;width: 100%"><i class="fas fa-sign-in-alt" style="background-color: rgba(0,0,0,0) !important;"></i> <span style="color: white"><?=$lang['MENU_Login'];?></span></button>

          </div>
          <div class="container-login100-form-btn">
            <h5 class="row"><img width="50px" height="24px" src="../images/minus.png">&nbsp;&nbsp;<?php echo $lang['MENU_ro'] ?>&nbsp;&nbsp;<img width="50px" height="24px" src="../images/minus.png"></h5> 
          </div>

           <div class="social-login">
                           
                            <div class="social-login-buttons">
   

<script>
  function onSuccess(googleUser) {
    console.log('Signed in as: ' + googleUser.getBasicProfile().getName());
  }
</script>
<style type="text/css">
  .button_f {
    display: inherit;
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    background: #007bff;
    color: #fff;
    border-radius: 100%;
    border: 1px solid #fff;
}
.abcRioButtonBlue {
    background-color: #f8f9fa !important;
    border: none !important;
    color: #111 !important;
}

</style>

<script>
  function onSuccess(googleUser) {
    console.log('Signed in as: ' + googleUser.getBasicProfile().getName());
  }
</script>
<style type="text/css">
  .i-am-centered { margin: auto; max-width: 500px;}
  @media only screen and (max-width: 736px) {
    .i-am-centered { margin: auto; max-width: 235px;}
  }
</style>
<div class="row i-am-centered" style="margin-bottom: 10px;">
<center><div id="my-signin2" style=""></div></center>
&nbsp; &nbsp;
<!-- <center><button type="button" style="width: 290px; padding-bottom: 5px; border-radius: 5px;" data-size="large" class="g-signin2"  data-onsuccess="onSignIn"   data-theme="dark"></button></center> -->

<!-- <center><div class="fb-login-button"  data-width="" data-size="large" data-button-type="continue_with" data-auto-logout-link="false" data-use-continue-as="false" onlogin="checkLoginState();" ></div></center> -->
<center>
<div class="fb-login-button" data-size="large" data-button-type="login_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" data-width="" onlogin="checkLoginState();" ></div>
</center>
</div>
<div align="center" >
  <h6><?=$lang['MENU_dont_regis'];?> &nbsp; &nbsp;&nbsp; &nbsp;
  <a  style="color: #1bbc9b;"  href="register.php"  id="register" > <u style=""><?=$lang['MENU_Regis_text'];?> </h6></u></a> 
</div>


<!-- <h5 align="center" style="margin-top: 35%">
          <a  style="background: #ccc;" class="txt2 btn primary" href="register.php"  id="register" > <span style=""><h6><?=$lang['MENU_Regis_text'];?> <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i></h6></span></a>
          </h5> -->

                            </div>
                          </div>

          
        </form>
      </div>
    </div>
  </div>
      
	
      </section>
			<!-- Footer -->
			<?php include 'footer.php'?>
			<!--/ End footer -->
			<?php include 'footer_credit.php'?>	
      <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_EN/sdk.js#xfbml=1&version=v4.0"></script>
		</div>
    </body>
</html>

<script>
function renderButton() {
      gapi.signin2.render('my-signin2', {
        'scope': 'profile email',
        'width': 235,
        'height': 45,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSuccess,
        'onfailure': onFailure
      });
    }
    function onFailure(error) {
      console.log(error);
    }
var status = 0;
  function onSignIn(googleUser) {
    // Useful data for your client-side scripts:
    if(status == 1){


   
    var profile = googleUser.getBasicProfile();
    //alert(profile);
    console.log("ID: " + profile.getId()); // Don't send this directly to your server!
    console.log('Full Name: ' + profile.getName());
    console.log('Given Name: ' + profile.getGivenName());
    console.log('Family Name: ' + profile.getFamilyName());
    console.log("Image URL: " + profile.getImageUrl());
    console.log("Email: " + profile.getEmail());  

    var Id = profile.getId();
    var name = profile.getName();
    var gname = profile.getGivenName();
    var fname = profile.getFamilyName();
    var img = profile.getImageUrl();
    var email = profile.getEmail();
    var id_token = googleUser.getAuthResponse().id_token;
    var token = id_token;
    console.log("ID Token: " + id_token);
    // The ID token you need to pass to your backend:

    $.ajax({
    url: 'function_m.php',
    // type: 'POST',
    method:"POST",
        data: {
              _method:'google_login',
              Id : Id,
              first_name : gname,
              last_name : fname,
              ggEmail : email,
              birthday : birthday,
              pic : img,
              },

    success:function(data){
       console.log('data data ::',data.message);
      login_gg(data.message);

    }
    });

  }

  status = 1
   
  }
</script>



<script> //show pass
function showPass() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<script>
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
                            title: "<?php echo $lang['MENU_Login_text3'] ?> !",/*Forgot password*/
                            html: `
                            <div style="background-color: #47aa9b; border-radius: 5px; padding: 5px;">
                            <h5 style="color:#ffffff;" ><?php echo $lang['MENU_Please_enter_email'] ?></h5>
                            <input type="text" name="mail" class="form-control form-control-sm">
                            </div> 
                                    `,
                        
                            confirmButtonColor: "#1FAB45",
                            confirmButtonText: "<?php echo $lang['MENU_btn_confirm'] ?>",
                            cancelButtonText: "<?php echo $lang['MENU_btn_cancel'] ?>",
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
text: "<?php echo $lang['MENU_Please_enter_email'] ?> !",
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
                                                  text: "<?php echo $lang['MENU_Check_new_password_email'] ?>",
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
                                                  text: "<?php echo $lang['MENU_Email_not'] ?> !",
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
          $('#text_error').html('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
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
    appId      : '<?= $facebooklogintoken; ?>',
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








function login_gg(id) {

//alert(id)
       $.ajax({

        url:"library/function_m.php",
        method:"POST",
        data: {id_gg:id},
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
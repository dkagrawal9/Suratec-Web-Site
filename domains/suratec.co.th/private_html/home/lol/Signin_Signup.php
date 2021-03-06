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
                        <div class="col-sm-5">
                        	
                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3 style="color: white"><?=$lang['MENU_Login'];?></h3>
	                            		<p style="color: white"><?=$lang['MENU_Login_text'];?></p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-key"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="profile.php" method="post" class="login-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-username"><?=$lang['MENU_Login_text1'];?></label>
				                        	<input type="text" name="form-username" placeholder="<?=$lang['MENU_Login_text1'];?>..." class="form-username form-control" id="txtUserName" required>
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-password"><?=$lang['MENU_Login_text2'];?></label>
				                        	<input type="password" name="form-password" placeholder="<?=$lang['MENU_Login_text2'];?>..." class="form-password form-control" id="txtPassword" required>
				                        </div>
				                        <!-- <button type="submit" class="btn btn-warning">?????????????????????????????????!</button> -->
                                <button type="button" id="login" class="btn primary animate"><i class="fas fa-sign-in-alt" style="background-color: rgba(0,0,0,0) !important;"></i> <span style="color: white"><?=$lang['MENU_Login'];?></span></button>
				                    </form><br>
                                    <div class="form-top">
	                        		<div class="form-top-left">
                              <a href="#" onclick="forgot()"  style="color:#dc3545;"><small><i class="fa fa-exclamation-triangle"></i> <?=$lang['MENU_Login_text3']?><!--Forgot password ?--></small></a>

                                        <!-- <a href="#"><span style="color: #00339A"><U>????????????????????????????????? ?</U></span></a> -->

	                        		</div>
	                            </div>
			                    </div>

<!-- ------------------------------------------------------------------------------------ -->
        <div class="container-fluid  alert_sty" style="display: none;">
        <div class="row alert-massage" >
        <div class="col-md-12">
          <div class="callout callout-danger" style="opacity: 1; color:black">
            <label style="color:#fafafa;" ><i class="icon fa fa-ban" ></i> <?=$lang['MENU_Login_textf']?> <!--Username or password is wrong!--></label>
          </div>
        </div>  
      </div>
      </div>
<!-- ------------------------------------------------------------------------------------ -->

                                
		                    </div>
		                
		                	<div class="social-login">
	                        	<h3><?=$lang['MENU_Login_textor']?></h3>
	                        	<div class="social-login-buttons">
		                        	<!-- <a class="btn btn-link-1 btn-link-1-facebook" href="#">
		                        		<i class="fa fa-facebook"></i> Facebook
                              </a> -->
                              
<!-- <fb:login-button 
  scope="public_profile,email"
  onlogin="checkLoginState();">
</fb:login-button> -->
<center><div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with" data-auto-logout-link="false" data-use-continue-as="false" onlogin="checkLoginState();" ></div></center>

		                        	<!-- <a class="btn btn-link-1 btn-link-1-google-plus" href="#">
		                        		<i class="fa fa-google-plus"></i> Google Plus
		                        	</a> -->
	                        	</div>
	                        </div>
	                        
                        </div>
                        
                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>
                        	
                        <div class="col-sm-5">
                        	
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
										<!-- <button type="submit" class="btn">?????????????????????????????????!</button> -->
										<button type="button" name="confirm_btn" id="confirm_btn" class="btn btn-success btn-lg btn-block" disabled><span style="color: white"><?=$lang['MENU_Regis_text6']?></span></button>
				                    </form> 
			                    </div>
                        	</div>
                        	
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
</script>

<script>
$( '#conPass' ).keyup(function() {

  var pass = $('#pass').val();
  var conPass = $('#conPass').val();

  if(pass != conPass){
    $("#conPass_alert").attr("style" , "border-radius: 2px; background-color: #dd4b39; transition: 0.5s; display:inline-block;");
    document.getElementById("a_pass").innerHTML = "??????????????????????????????????????????????????? <i style='color:#fafafa;' class='fa fa-times-circle'></i>"; 
    document.getElementById('confirm_btn').disabled = true;

	setTimeout(function() {
    $("#conPass_alert").attr("style" , "transition: 0.5s; display:none;");
    }, 3000);

    }
    else{

     $("#conPass_alert").attr("style" , "border-radius: 2px; background-color: #1c8c36; transition: 0.5s; display:inline-block;");
     document.getElementById("a_pass").innerHTML = "?????????????????????????????????????????? <i  style='color:#fafafa;' class='fa fa-check-circle'></i>"; 

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
                            document.getElementById("a_user").innerHTML = "<i style='color:#fafafa;' class='fa fa-times-circle'></i>  ????????????????????????????????????????????????????????? ???????????????????????????????????????????????????";
                            document.getElementById('confirm_btn').disabled = true;  
                            $("#a_user").attr("style" , "color: #fafafa;");

                          }else if(numStr < 6){
                            $("#user").attr("style" , "border-color: #ffc107; border-width: 2px; background-color: #ffc10745;");
                            $("#user_alert").attr("style" , "border-radius: 2px; background-color: #ffc107; transition: 0.5s; display:inline-block;");
                            document.getElementById("a_user").innerHTML = "<i style='color:#333;' class='fa fa-exclamation-triangle'></i>  ????????????????????????????????????????????????????????????????????????????????? 6 ???????????????????????? ";
                            $("#a_user").attr("style" , "color: #333;");
                            document.getElementById('confirm_btn').disabled = true; 
                          }else{
                         
                            $("#user").attr("style" , "border-color: #28a745; border-width: 2px; background-color: #28a74585;");
                            $("#user_alert").attr("style" , "border-radius: 2px; background-color: #1c8c36; transition: 0.5s; display:inline-block;");
                            document.getElementById("a_user").innerHTML = "<i style='color:#fafafa;' class='fa fa-check-circle'></i>  ????????????????????????????????????????????????????????? "; 
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
                            document.getElementById("a_email").innerHTML = "<i style='color:#fafafa;' class='fa fa-times-circle'></i> E-Mail ???????????????????????????????????? ??????????????????????????????????????? "; 
                            document.getElementById('confirm_btn').disabled = true;  
                            $("#a_email").attr("style" , "color: #fafafa;");
                          }
                          else if( st_mail == false && email != 'not' ){ 
                              console.log('st_mail : ',st_mail);
                            $("#email").attr("style" , "border-color: #ffc107; border-width: 2px; background-color: #ffc10745;");
                            $("#email_alert").attr("style" , "border-radius: 2px; background-color: #ffc107; transition: 0.5s; display:inline-block;");
                            document.getElementById("a_email").innerHTML = "<i style='color:#333;' class='fa fa-exclamation-triangle'></i> ?????????????????? E-Mail ??????????????????????????????"; 
                            document.getElementById('confirm_btn').disabled = true; 
                            $("#a_email").attr("style" , "color: #333;");
                          }
                          else if(response.status == 0 && email != 'not' &&  st_mail == true){
                            $("#email").attr("style" , "border-color: #28a745; border-width: 2px; background-color: #28a74585;");
                            $("#email_alert").attr("style" , "border-radius: 2px; background-color: #1c8c36; transition: 0.5s; display:inline-block;");
                            document.getElementById("a_email").innerHTML = "<i style='color:#fafafa;' class='fa fa-check-circle'></i>  E-Mail ????????????????????????????????????????????? "; 
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
                      title: '??????????????????',
                      text: "?????????????????????????????????????????? ?",
                      type: 'question',
                      showCancelButton: true,
                      confirmButtonColor: '#199e36',
                      cancelButtonColor: '#d33',
                      confirmButtonText: '??????????????????',
					  cancelButtonText: '??????????????????',
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
                            title: "?????????????????? !",
                            text: "???????????????????????????????????????????????????.",
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
    swal('?????????????????????!','???????????????????????????????????????????????????????????????????????????.','warning');

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
                            title: "????????????????????????????????? !",/*Forgot password*/
                            html: `
                            <div style="background-color: #47aa9b; border-radius: 5px; padding: 5px;">
                            <h5 style="color:#ffffff;" >???????????????????????????????????????????????????????????????????????????</h5>
                            <input type="text" name="mail" class="form-control form-control-sm">
                            </div> 
                                    `,
                        
                            confirmButtonColor: "#1FAB45",
                            confirmButtonText: "??????????????????",
                            cancelButtonText: "??????????????????",
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
text: "??????????????????????????????????????????????????????????????????????????? !",
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
                                                  text: "??????????????????????????????????????????????????????????????????????????????????????????",
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
                                                  text: "??????????????? E-mail ??????????????????????????????????????? ???????????????????????????????????????????????? !",
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
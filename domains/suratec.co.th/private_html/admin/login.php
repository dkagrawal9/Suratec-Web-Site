<?php 
  require_once 'library/connect.php';
  require_once 'library/functions.php';
  $str_tbl = "SELECT * FROM tbl_member";
  $query_tbl = mysqli_query($objConnect,$str_tbl);
  if($num = mysqli_fetch_array($query_tbl)){
    if (isset($_SESSION["user_id"])) {
          $str = "SELECT * FROM tbl_member WHERE id_member= '".$_SESSION['user_member']."' AND data_role != 'mod_customer'";
          $query = mysqli_query($objConnect, $str);
          $result = mysqli_fetch_array($query);
          if($_SESSION["user_id"]==$result['member_session_update']){
            header('Location: page_home/');
            exit;
          }
      }
  }else{
    
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=TITLE?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style type="text/css">
body{
  overflow: hidden;
}
   .overlay {
    overflow: hidden;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(255,255,255,0.8);
    z-index: 99999;
  }
  .overlay i{
    margin-left: 47%;
    margin-top: 20%;
    color: #09C;
    font-size: 100px;
  }
  .body-prevent{
    overflow: hidden;
  }
  .loader {
    margin-left: 48%;
    margin-top: 20%;
      border: 5px solid #f3f3f3;
      border-radius: 50%;
      border-top: 5px solid #3498db;
      width: 50px;
      height: 50px;
      -webkit-animation: spin 2s linear infinite; /* Safari */
      animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
</style>
<body class="hold-transition login-page" id="loadpage">
   <div id="overlay" class="overlay" style="display: none;">
      <div class="loader"></div>
    </div>



<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b></a>
  </div>

  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>


    <form method="post" name="frmLogin" id="frmLogin">
      <div class="form-group has-feedback">
        <input type="email" id="txtUserName" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="txtPassword" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row alert-massage" style="display: none;">
        <div class="col-xs-12">
          <div class="callout callout-danger" style="opacity: 0.8">
            <p><i class="icon fa fa-ban"></i> Username or password is wrong!</p>
          </div>
        </div>
      </div>
      <div class="row alert-massage-exist" style="display: none;">
        <div class="col-xs-12">
          <div class="callout callout-warning" style="opacity: 0.8">
            <p><i class="icon fa fa-ban"></i> Username or password is exist!</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
<!--               <input type="checkbox"> Remember Me -->
            </label>
          </div>
        </div>
        <!-- /.col -->
    </form>
    <!-- !form -->
        <!--  <div class="col-xs-4">
          <button type="button" id="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div> -->
        <!-- /.col -->
      </div>
<div >
     
  <a href="../home/index.php"><button type="button" id="" class="btn btn-primary btn-flat">กลับสู่เว็บไซต์</button></a>
  <button type="button" id="login" class="btn btn-primary btn-flat  pull-right">เข้าสู่ระบบ</button>
     
</div>
<!--     <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->



<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
  $(document).on('click', '#login', function(){

   // alert('sss');

    var username = $('#txtUserName').val();
    var password = $('#txtPassword').val();
    $.ajax({
      beforeSend:function(){
        $('#overlay').show();

      },
      complete:function(){
        $('#overlay').fadeOut();
      },
        url:"library/functions.php",
        method:"POST",
        data: {username:username,
              password:password},
      success:function(data){
        // alert('sss');
        if(data.status == 1){
          location.href="page_home/index.php";
        }else if(data.status == 0){
         $('.alert-massage').fadeIn();
        }else{
         $('.alert-massage-exist').fadeIn();
        }
      } 
    });
  });

   $('#txtPassword').keypress(function(event) {
        if(event.keyCode===13){
        //  $('#login').trigger('click');

              var username = $('#txtUserName').val();
          var password = $('#txtPassword').val();
          $.ajax({
            beforeSend:function(){
              $('#overlay').show();

            },
            complete:function(){
              $('#overlay').fadeOut();
            },
              url:"library/functions.php",
              method:"POST",
              data: {username:username,
                    password:password},
            success:function(data){
              // alert('sss');
              if(data.status == 1){
                location.href="page_home/index.php";
              }else if(data.status == 0){
              $('.alert-massage').fadeIn();
              }else{
              $('.alert-massage-exist').fadeIn();
              }
            } 
          });

        }
  });
</script>
</body>
</html>

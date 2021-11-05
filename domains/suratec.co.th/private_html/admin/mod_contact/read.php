<?php
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser($objConnect);

if(!isset($_GET['id'])){
  header('Location:front-manage.php');
}



$sql = "SELECT * FROM mod_contact WHERE id_mail = '".$_GET['id']."'";
$query = mysqli_query($objConnect,$sql);
$result = mysqli_fetch_array($query);


$title = lang('ติดต่อเรา','Contact');
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
    <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
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
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- Pace style -->
    <link rel="stylesheet" href="../plugins/pace/pace.min.css">
    <!--Css table -->
    <link rel="stylesheet" href="css/app.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="../plugins/sweetalert2/dist/sweetalert2.min.css">


</head>
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
                <li><a href="../page_home/index.php"></i> <?=lang('แดชบอร์ด','Dashboard')?></a></li>
                <li><a href="front-manage.php"></i> <?=lang('จัดการติดต่อเรา','Contact us')?></a></li>
                <li class="active"><?=$title?></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <!-- Start box warning for ADD system -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title"><?=lang('เนื้อหา','Content')?></h3>

                          <div class="box-tools pull-right">
<?php
    $sql_pre = "SELECT * FROM mod_contact WHERE id_mail < '".$_GET['id']."'";
    $query_pre = mysqli_query($objConnect,$sql_pre);
    $num_pre = mysqli_num_rows($query_pre);
    $result_pre = mysqli_fetch_array($query_pre);

    if($num_pre!=0){
?>
                           <a href="read.php?id=<?=$result_pre['id_mail']?>" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
<?php        
    }
?>

<?php
    $sql_next = "SELECT * FROM mod_contact WHERE id_mail > '".$_GET['id']."'";
    $query_next = mysqli_query($objConnect,$sql_next);
    $num_next = mysqli_num_rows($query_next);
    $result_next = mysqli_fetch_array($query_next);

    if($num_next!=0){
?>
                            <a href="read.php?id=<?=$result_next['id_mail']?>" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
<?php
    }
?>                      
                          </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                          <div class="mailbox-read-info">
                            <h3><?=$result['subject']?></h3>
                            <h5>From: <?=$result['name']?>
                              <span class="mailbox-read-time pull-right"><?=$result['send_datetime']?></span></h5>
                            <h5>Email : <?=$result['email']?></h5>
                          </div>
                          <!-- /.mailbox-read-info -->
                          <div class="mailbox-read-message">
                            <?=$result['message']?>
                          </div>
                          <!-- /.mailbox-read-message -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                          <div class="pull-right">
                             <button type="button" class="btn btn-default  reply" data-id="<?=$result['email']?>"  message="<?=$result['message']?>" subject="<?=$result['subject']?>" name_to="<?=$result['name']?>" tel="<?=$result['tel']?>" id_mail="<?=$result['id_mail']?>"  ><i class="fa fa-reply"></i> Reply</button>
                          </div>
                          <!-- <button type="button" class="btn btn-default del" data-id="<?=$result['id_mail']?>"><i class="fa fa-trash-o"></i> Delete</button> -->
                        </div>
                        <!-- /.box-footer -->
                      </div>
                      <!-- /. box -->
                </div>

        </section>

        <div class="control-sidebar-bg"></div>
    </div>

    <!-- mail Modal -->
<div class="modal fade" id="modal_mail" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">ตอบกลับการติดต่อ</h3>
                <br>

                <label><div id="name_to"></div></label><br>
                <label><div id="email"></div></label><br>
                 <label><div id="tel"></div></label><br>
                <label><div id="package_number"></div></label><br>
                <label>หมายเหตุ</label><br><div id="description" style="max-height: 100px; overflow: auto;"></div><br>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
      
<form action="" method="post" id="send_mail_form">

<input type="hidden" name="email_data" id="email_data">
<input type="hidden" name="name_to_data" id="name_to_data">
<input type="hidden" name="subject_data" id="subject_data">
<input type="hidden" name="message_data" id="message_data">
<input type="hidden" name="tel" id="tel">
<input type="hidden" name="id" id="id">

<div class="form-group">
  <label for="">จาก : </label>
  <input type="text" name="name_to_reply" id="name_to_reply"  value="<?php echo from_e_mail ?>" readonly class="form-control" placeholder="" aria-describedby="helpId">
</div>
<div class="form-group">
  <label for="">E-mail : </label>
  <input type="text" name="email_to_reply" id="email_to_reply" value="<?php echo e_mail ?>" readonly class="form-control" placeholder="" aria-describedby="helpId">
</div>
<!-- <div class="form-group">
  <label for="">หัวข้อ : </label>
  <input type="text" name="sub_to_reply" id="sub_to_reply" class="form-control" placeholder="" aria-describedby="helpId">
</div>
<div class="form-group">
  <label for="">ข้อความ : </label>
  <textarea name="mass_to_reply" cols="30" rows="5" class="form-control" wrap="virtual" id="mass_to_reply"></textarea>
</div> -->
<!-- <div class="form-group">
  <label for="">ช่องทางติดต่อ : </label>
  <input type="radio" name="contact_tel_mail" name="contact_tel_mail" value="1" checked="checked"> โทรศัทพ์
  <input type="radio" name="contact_tel_mail" name="contact_tel_mail" value="0"> E-mail
</div> -->
<div class="form-group">
  <label for="">รายละเอียด : </label>
  <textarea name="mass_to_reply" cols="30" rows="5" class="form-control" wrap="virtual" id="mass_to_reply"  required></textarea>
</div>


</form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSendAdd">Send to...</button>
            </div>
        </div>
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
    <script src="js/timer.js"></script>
    <script src="../plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <script type="text/javascript">
            $('.mail').click(function(event) {
               var mail = $(this).attr('data-mail');
               location.href = 'mailto:'+mail;
            });

            $(document).on('click','.del',function(event) {
                var data = $(this).attr('data-id');
                swal({
                  title: '<?=lang('ยืนยัน?','Confirm?')?>',
                  text: "<?=lang('คุณยืนยันจะลบข้อความนี้หรือไม่','Do you confirm to delete this message?')?>?",
                  type: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: '<?=lang('ยืนยัน','Confirm')?>',
                  showLoaderOnConfirm: true,
                  preConfirm: function () {
                        return new Promise(function (resolve) {
                        $.ajax({
                            type: "POST",
                            url: "functions.php",
                            data: {id_mail:data,_method:'DELETE'},
                         })
                      // in case of successfully understood ajax response
                        .done(function (myAjaxJsonResponse) {
                            console.log(myAjaxJsonResponse);
                            // swal('สำเร็จ','ลบสำเร็จ.','success');
                            location.href = 'front-manage.php';
                           })
                        .fail(function (erordata) {
                          console.log(erordata);
                          swal('<?=lang('ไม่สำเร็จ','Not Success')?>', '<?=lang('เกิดปัญหากับระบบ','There is a problem with the system.')?>', 'error');
                        })

                    })
                  },    
                })
            });

 $(document).on('click', '.reply', function(event) {
                var email = $(this).attr('data-id');
                var message = $(this).attr('message');
                var subject = $(this).attr('subject');
                var name_to = $(this).attr('name_to');
                var tel = $(this).attr('tel');
                var id_mail = $(this).attr('id_mail');

                console.log(email);
                console.log(message);
                console.log(subject);

                $("#email").html("E-mail : "+email);
                $("#name_to").html("User : "+name_to);
                $("#tel").html("เบอร์โทรศัทพ์ : "+tel);
                $("#package_number").html("หมายเลขพัสดุ : "+subject);
                $("#description").html(""+message);

                $("#email_data").val(email); 
                $("#name_to_data").val(name_to); 
                $("#subject_data").val(subject); 
                $("#message_data").val(message); 
                $("#id").val(id_mail);


                $('#modal_mail').modal('show');
            
                // location.href = 'mailto:'+email;
            });


var data = '';
$('#btnSendAdd').click(function (event) {


var formData = new FormData($('#send_mail_form')[0]);
if($("#sub_to_reply").val() == "" || $("#mass_to_reply").val() == "" ){
    swal('คำเตือน!','กรุณากรอกข้อมูล','warning')
                    if($("#sub_to_reply").val() == ""){
                        $("#sub_to_reply").attr("style" , "border-color: red; border-width: 1px;");
                        setTimeout(function() {
                            $("#sub_to_reply").attr("style" , "");
                        }, 5000);
                    }
                    if($("#mass_to_reply").val() == ""){
                        $("#mass_to_reply").attr("style" , "border-color: red; border-width: 1px;");
                        setTimeout(function() {
                            $("#mass_to_reply").attr("style" , "");
                        }, 5000);
                    }
}else{
var formData = new FormData($('#send_mail_form')[0]);

        swal({
            title: 'ยืนยัน?',
            text: "ยืนยันการส่ง E-mail",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true
        }).then((result) => {
           if (result.value) {
                //console.log(result.value);
                $.ajax({
                    type: "POST",
                    url: "mail_to.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                         console.log(data.status);
                        //  if(data.status==1){
                        swal('สำเร็จ',
                            'การส่ง E-mail สำเร็จ',
                            'success'
                        ).then((value) => {
                            // window.location = 'front-add.php?values=' + $('#sale_id').val();
                            window.location = '';
                        }); 
                  //  }                         
                    },
                });
            }
        })
     }
});


    </script>
</body>
</html>

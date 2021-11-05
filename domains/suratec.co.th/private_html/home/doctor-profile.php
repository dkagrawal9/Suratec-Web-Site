<?php 
require_once '../admin/library/connect.php';
require_once '../admin/library/functions.php';
checkMemUser($objConnect);

include 'header.php';

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 



$id = $_GET['profile'];
$sqlpro = "SELECT * from mod_employee WHERE id_employee='$id'";
$queryPro = mysqli_query($objConnect, $sqlpro);
$resultPro = mysqli_fetch_array($queryPro);


$sqlpro_a = "SELECT  * mod_employee_image WHERE id_employee='$id'";
$queryPro_a = mysqli_query($objConnect, $sqlpro_a);
$resultProImg = [];
$resultProImg['img_path'] = "";
if ($queryPro_a) {
    $resultProImg = mysqli_fetch_array($queryPro_a);
}



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
                <h2>Doctor <?=$lang['MENU_Profile']?><!--Profile--></h2>            </div>
            <!-- Bread List -->
            <ul class="bread-list">
                <li><a href="./?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME']?><!--Home--></a></li>
                <li class="active"><a href="profile.php?profile=st"><i class="fa fa-clone"></i>Doctor <?=$lang['MENU_Profile']?><!--Profile--></a></li>
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
                        <?php $img = $resultProImg['img_path'];?>
                        <div class="form-group img_size">
                            <label ><h4><?=$lang['MENU_profile']?></h4></label>
                            <div id="blah">
                                <img  src=" <?php if( empty($img) ){ print"../img/bg-img/25.jpg"; }else{print "../uploads/customer/".$resultProImg['img_path'];} ?> "   style ="width: max-content;"  />
                            </div>
                          <hr>
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
                            <input type="text" class="form-control mb-30" name="fname" id="fname" value="<?=$resultPro['username_en']?>" placeholder="<?=$lang['MENU_profile_name']?>" disabled style="color: #000000">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label><?=$lang['MENU_profile_surname']?></label>
                            <input type="text" class="form-control mb-30" value="<?=$resultPro['surname']?>" name="lname" id="lname" placeholder="<?=$lang['MENU_profile_surname']?>" disabled style="color: #000000">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label><?=$lang['MENU_Email']?></label>
                            <input type="email" class="form-control mb-30" name="email" id="email" value="<?=$resultPro['email']?>" placeholder="<?=$lang['MENU_Email']?>" disabled="color: #000000">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label><?=$lang['MENU_Phone_number']?></label>
                            <input type="text" class="form-control mb-30" name="tel" id="tel" maxlength="10" placeholder="<?=$lang['MENU_Phone_number']?>" value="<?=$resultPro['tel']?>" disabled style="color: #000000" OnKeyPress="return chkNumber(this)">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group1">
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
                       </div>
                   </div>
                   <!-- Border -->
                   <div class="col-lg-6">
                    <div class="form-group">
                        <label>ที่อยู่</label>
                        <input type="text" class="form-control mb-30" name="address" id="address" placeholder="ที่อยู่" value="<?=$resultPro['address']?>" disabled style="color: #000000">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>ตำบล</label>
                        <input type="text" class="form-control mb-30" name="district" id="district" placeholder="ตำบล" value="<?=$resultPro['district']?>" disabled style="color: #000000">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>อำเภอ</label>
                        <input type="text" class="form-control mb-30" name="amphoe" id="amphoe" placeholder="อำเภอ" value="<?=$resultPro['amphures']?>" disabled style="color: #000000">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>จังหวัด</label>
                        <input type="text" class="form-control mb-30" name="province" id="province" placeholder="จังหวัด" value="<?=$resultPro['province']?>" disabled style="color: #000000">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>รหัสไปรณีย์</label>
                        <input type="text" class="form-control mb-30" maxlength="5" name="zipcode" id="zipcode" placeholder="รหัสไปรณีย์" value="<?=$resultPro['zip_code']?>" disabled style="color: #000000" OnKeyPress="return chkNumber(this)">
                    </div>
                </div>
                <div class="col-lg-6">
                </div>
                <div class="container">
                    <div class="border-line"></div>
                </div><br>	
                <h4 style="margin-left: 15px;">ที่อยู่ที่จัดส่ง</h4>
                <div class="col-lg-6">
                </div>	
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>ที่อยู่</label>
                        <input type="text" class="form-control mb-30" name="address_to" id="address_to" placeholder="ที่อยู่" value="<?=$resultPro['address']?>" disabled style="color: #000000">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>ตำบล</label>
                        <input type="text" class="form-control mb-30" name="district_to" id="district_to" placeholder="ตำบล" value="<?=$resultPro['district']?>" disabled style="color: #000000">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>อำเภอ</label>
                        <input type="text" class="form-control mb-30" name="amphoe_to" id="amphoe_to" placeholder="อำเภอ" value="<?=$resultPro['amphures']?>" disabled style="color: #000000">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>จังหวัด</label>
                        <input type="text" class="form-control mb-30" name="province_to" id="province_to" placeholder="จังหวัด" value="<?=$resultPro['province']?>" disabled style="color: #000000">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>รหัสไปรณีย์</label>
                        <input type="text" class="form-control mb-30" name="zipcode_to" id="zipcode_to" placeholder="รหัสไปรณีย์" value="<?=$resultPro['zip_code']?>" disabled style="color: #000000" maxlength="5" OnKeyPress="return chkNumber(this)">
                    </div>
                </div>
                <div class="col-lg-6">
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
          && $("#tel").val() != ""	 

          && $("#edit_user").val() != "" 
          && $("#email").val() != ""

          && $("#address").val() != ""
          && $("#district").val() != ""
          && $("#amphoe").val() != ""
          && $("#province").val() != ""
          && $("#zipcode").val() != ""

          && $("#address_to").val() != ""
          && $("#district_to").val() != ""
          && $("#amphoe_to").val() != ""
          && $("#province_to").val() != ""
          && $("#zipcode_to").val() != ""

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

    if($("#tel").val() == ""){
        $("#tel").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
        setTimeout(function() {
            $("#tel").attr("style" , "");
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
    if($("#address").val() == ""){
        $("#address").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
        setTimeout(function() {
            $("#address").attr("style" , "");
        }, 5000);
    }
    if($("#district").val() == ""){
        $("#district").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
        setTimeout(function() {
            $("#district").attr("style" , "");
        }, 5000);
    }
    if($("#amphoe").val() == ""){
        $("#amphoe").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
        setTimeout(function() {
            $("#amphoe").attr("style" , "");
        }, 5000);
    }
    if($("#province").val() == ""){
        $("#province").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
        setTimeout(function() {
            $("#province").attr("style" , "");
        }, 5000);
    }
    if($("#zipcode").val() == ""){
        $("#zipcode").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
        setTimeout(function() {
            $("#zipcode").attr("style" , "");
        }, 5000);
    }
    if($("#address_to").val() == ""){
        $("#address_to").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
        setTimeout(function() {
            $("#address_to").attr("style" , "");
        }, 5000);
    }
    if($("#district_to").val() == ""){
        $("#district_to").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
        setTimeout(function() {
            $("#district_to").attr("style" , "");
        }, 5000);
    }
    if($("#amphoe_to").val() == ""){
        $("#amphoe_to").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
        setTimeout(function() {
            $("#amphoe_to").attr("style" , "");
        }, 5000);
    }
    if($("#province_to").val() == ""){
        $("#province_to").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
        setTimeout(function() {
            $("#province_to").attr("style" , "");
        }, 5000);
    }
    if($("#zipcode_to").val() == ""){
        $("#zipcode_to").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
        setTimeout(function() {
            $("#zipcode_to").attr("style" , "");
        }, 5000);
    }
}
});
</script>
<script>
    function check_pass() { 
      var username = document.getElementById("edit_user");
      var x = document.getElementById("newpass");
      var x1 = document.getElementById("conpass");
      if (x.value == x1.value ){
         username.value = username.value.toLowerCase();
     }else{
        swal('คำเตือน!','กรุณากรอกรหัสผ่านให้ตรงกัน.','warning');
        username.value = username.value.toLowerCase();
        document.getElementById('newpass').value="";
        document.getElementById('conpass').value="";
    }
}	

  function chkNumber(ele)
  {
      var vchar = String.fromCharCode(event.keyCode);
      if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
      ele.onKeyPress=vchar;
  }
</script>
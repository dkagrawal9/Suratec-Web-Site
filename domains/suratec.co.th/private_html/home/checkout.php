<?php 

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}


if (isset($_GET['id_product'])) {
    $id_product = $_GET['id_product'];
} else {
    $id_product = 1;
}

  require_once '../admin/library/connect.php';
  require_once '../admin/library/functions.php';
  checkMemUser($objConnect);
?>
<?php include 'header.php';
?>
			<!--/ End Header -->

<?php


$id = $_SESSION['id_customer'];

$sqlpro = "SELECT   *,mod_customer.telephone AS telephone ,mod_customer.id_customer AS id_customer, mod_customer.fname AS fname, mod_customer.lname AS lname FROM  mod_customer 
LEFT JOIN  tbl_member ON mod_customer.id_customer = tbl_member.id_data_role
LEFT JOIN  mod_customer_address ON mod_customer_address.id_customer = mod_customer.id_customer
WHERE  mod_customer.id_customer = '$id'  and mod_customer_address.status = '1' ";

 //echo $sqlpro;

$queryPro = mysqli_query($objConnect, $sqlpro);
$resultPro = mysqli_fetch_array($queryPro);


$sqlpro_a = "SELECT   *,mod_customer.telephone AS telephone ,mod_customer.id_customer AS id_customer, mod_customer.fname AS fname, mod_customer.lname AS lname FROM  mod_customer 
LEFT JOIN tbl_member ON mod_customer.id_customer = tbl_member.id_data_role
LEFT JOIN  mod_customer_address ON mod_customer_address.id_customer = mod_customer.id_customer
WHERE  mod_customer.id_customer = '$id' and mod_customer_address.status = '2' ";

//echo $sqlpro;

$queryPro_a = mysqli_query($objConnect, $sqlpro_a);
$resultPro_a = mysqli_fetch_array($queryPro_a);


// var_dump($_SESSION);


?>
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
								<h2><?=$lang['MENU_pay'];?><!--About Us--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
								<li><a href="./?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME'];?><!--Home--></a></li>
								<li class="active"><a href="about_us.php?about_us=st"><i class="fa fa-clone"></i><?=$lang['MENU_pay'];?><!--About Us--></a></li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Breadcrumbs -->
			
			<!-- About Us -->
			<div id="live-payment">
				
			</div>
			<!--/ End Shop -->
			
			<!-- Footer -->
			<?php include 'footer.php'?>
			<!--/ End footer -->
			<?php include 'footer_credit.php'?>	
		</div>
    </body>
</html>
<script src="asset/jquery.thailand.js/dependencies/JQL.min.js"></script>
<script src="asset/jquery.thailand.js/dependencies/typeahead.bundle.js"></script>
<script src="asset/jquery.thailand.js/dependencies/zip.js/zip.js"></script>
<script src="asset/jquery.thailand.js/dependencies/zip.js/inflate.js"></script>
<script src="asset/jquery.thailand.js/dependencies/zip.js/z-worker.js"></script>

<script src="asset/jquery.thailand.js/jquery.Thailand.js"></script>
<link href="asset/jquery.thailand.js/jquery.Thailand.min.css" rel="stylesheet">
<script>
	function myFunctionex() {
	  var ex = document.getElementById("fname").value;
	  document.getElementById("name-ex").innerHTML = ex;
	}
	</script>
<script>
	
$(function () {
        $.Thailand({
            $district: $('#district'), // input ของตำบล
            $amphoe: $('#amphur'), // input ของอำเภอ
            $province: $('#province'), // input ของจังหวัด
            $zipcode: $('#postalcode'), // input ของรหัสไปรษณีย์
        });
    });	
	
// CHECK_EMAIL
// $( '#email' ).keyup(function() {
  function CHECK_EMAIL(){ 
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
                        success: function(response) {
                          //console.log('email : ',email);
                          
                          if( st_mail == false && email != 'not' ){ 
                              console.log('st_mail : ',st_mail);
                            $("#email").attr("style" , "border-color: #ffc107; border-width: 2px; background-color: #ffc10745;");
                            $("#email_alert").attr("style" , "border-radius: 2px; background-color: #ffc107; transition: 0.5s; display:inline-block;");
                            document.getElementById("a_email").innerHTML = "<i style='color:#333;' class='fa fa-exclamation-triangle'></i> รูปแบบ E-Mail ไม่ถูกต้อง"; 
                            document.getElementById('confirm_btn').disabled = true; 
                            $("#a_email").attr("style" , "color: #333;");
                          }
                          else if(email != 'not' &&  st_mail == true){
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
  var formData = new FormData($('#checkout_form')[0]);

  if($("#fname").val() != ""
  && $("#lname").val() != ""     
  && $("#email").val() != ""
  && $("#address").val() != ""
  && $("#district").val() != ""
  && $("#amphur").val() != ""	 
  && $("#province").val() != ""
  && $("#postalcode").val() != ""
  && $("#address_to").val() != ""
  && $("#district_to").val() != ""
  && $("#amphoe_to").val() != ""	 
  && $("#province_to").val() != ""
  && $("#zipcode_to").val() != ""	 
  && $("#telephone").val() != "")
  /*{*/
// ------------------------------------------------------------------------

// -------------------------------------------------------------------------
	  
  /*}*/
	  {
// ------------------------------------------------------------------------
//swal(
//	{
//                      title: 'ยืนยัน',
//                      text: "การสั่งซื้อ ?",
//                      type: 'question',
//                      showCancelButton: true,
//                      confirmButtonColor: '#199e36',
//                      cancelButtonColor: '#d33',
//                      confirmButtonText: 'ยืนยัน',
//					  cancelButtonText: 'ยกเลิก',
//					  reverseButtons: true,
//                      showLoaderOnConfirm: true
//                }
//			).then((result) => {
//                    if (result.value) {
						formData.append('data',getlocalname())
	
                        $.ajax({
                        type: "POST",
                        url: "function_m.php",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                        //    console.log('12345');
                          //console.log(data.message);
                          
                        if(data.status == 1){
                        
//                          swal.fire({
//                            title: "สำเร็จ !",
//                            text: "สั่งซื้อสำเร็จ.",
//                            type: "success"
//                          }).then(function() {
//							  
//							window.location = "";  
//                            document.getElementById("checkout_form").reset();
//                            /*$('#model_login').modal('show');*/
//                          });
						  localStorage.clear();
                        }

                            },
                        });
//                    }   
//                })
		  	  
		  
		  
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
                    if($("#email").val() == ""){
                        $("#email").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#email").attr("style" , "");
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
	  				if($("#amphur").val() == ""){
                        $("#amphur").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#amphur").attr("style" , "");
                        }, 5000);
                    }
	  				if($("#province").val() == ""){
                        $("#province").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#province").attr("style" , "");
                        }, 5000);
                    }
                    if($("#postalcode").val() == ""){
                        $("#postalcode").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#postalcode").attr("style" , "");
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
	  				if($("#telephone").val() == ""){
                        $("#telephone").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#telephone").attr("style" , "");
                        }, 5000);
                    }
  				}
            });

</script>

<script>
$(document).ready(function() {

    var cok = '';
    var res = '0';
    var coords = [];

    // if(getCookie() != undefined){

    //      cok = getCookie().split('=');
    //      res = cok[1].split(',');
    //      coords = [];
		
    // }
  //  var table;
  if(getlocalname() != undefined){
      //  alert(getlocalname());
         cok = getlocalname();
	  
            var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("live-payment").innerHTML = this.responseText;

                    }
                }
                xmlhttp.open("GET", "live-payment.php?id_product="+cok, true);
                xmlhttp.send();

            }
	  else if(getlocalname() == undefined){
      //  alert(getlocalname());
         cok = getlocalname();
	  
            var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("live-payment").innerHTML = this.responseText;

                    }
                }
                xmlhttp.open("GET", "live-payment_no_data.php", true);
                xmlhttp.send();


            }
}

);
	function checkpong(){

    var data = document.getElementById('pong').value
    var priceall = document.getElementById('total').value;
    var qtyproduct = document.getElementById('qtyproduct').innerHTML;

  
      //  alert(priceall);
        $.ajax({
             type: "POST",
             url: "ajax-pong.php?data="+data+"&&priceall="+priceall+"&&qtyproduct="+qtyproduct+"&&id_customer="+'<?=$id ?>',
        
             success: function (response) {
               // 
                var res = response.split(',');
                var resdis =  res[0].split('@');
                if(res[0] == 'คูปองไม่ถูกต้อง'){

                      //  alert('คูปองไม่ถูกต้อง');
                        Swal.fire(
                            '',
                            'คูปองไม่ถูกต้อง',
                            'error'
                        )
                    
                    }else{


                        var dis = res[0]; 
                        var type = resdis[0];
                        var disvalue = 0;
                       // alert(resdis[4]);
                        if(resdis[1] == 1){
                            disvalue = "";
                            document.getElementById('discount').innerHTML  = resdis[0]+' %';
                            document.getElementById('sumvalue').innerHTML  = (priceall-(resdis[0]*priceall)/100).toFixed(2);
                            document.getElementById('discountdata').value = (resdis[0]*priceall)/100

                        }else{

                            document.getElementById('discount').innerHTML  = resdis[0];
                            document.getElementById('sumvalue').innerHTML  = (priceall-resdis[0]).toFixed(2);
                            document.getElementById('discountdata').value = resdis[0];

                        }
                        
                        document.getElementById('coupon_amount').value  = resdis[0];
                        document.getElementById('pongid').value  = resdis[4];
                        document.getElementById('pongdata').value  = data;
                        document.getElementById('pongsave').innerHTML  = data;
                        document.getElementById('pong').value  = '';
                     
                  
                    

                    }
                    
            
                   
                     }
  });



}
		
</script>

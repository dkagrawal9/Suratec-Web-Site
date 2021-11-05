<?php
require_once '../library/connect.php';

date_default_timezone_set("Asia/Bangkok");

$id_order = $_GET['id_order'];


$sql_value = "SELECT value FROM  contact 
WHERE  id = 12  
-- and  delete_datetime is null
";
$query_value = mysqli_query($objConnect, $sql_value);
$res_value = mysqli_fetch_array($query_value);




$sql = "SELECT * FROM  mod_order 
LEFT JOIN mod_customer on mod_customer.id_customer = mod_order.id_customer
LEFT JOIN mod_customer_address ON mod_order.id_address = mod_customer_address.id_address
WHERE  mod_order.id_order = '".$id_order."'  
-- and  delete_datetime is null
";
$query = mysqli_query($objConnect, $sql);
$res = mysqli_fetch_array($query);



$sql_item = "SELECT * FROM  mod_order 
LEFT JOIN mod_order_item on mod_order_item.id_order = mod_order.id_order
LEFT JOIN product on product.id_product = mod_order_item.id_product
LEFT JOIN product_attribute on mod_order_item.id_product_attr = product_attribute.id_attr
WHERE  mod_order.id_order = '".$id_order."'  
-- and  delete_datetime is null   uni_package
";
$query_item = mysqli_query($objConnect, $sql_item);




function soical1($val){
    global $objConnect;

    $str = "SELECT * FROM contact WHERE id = '".$val."'";
    $query = mysqli_query($objConnect,$str);
    $result = mysqli_fetch_array($query);

    if($result['value']!=''){
        return $result;
    }else{
        return false;
    }
    
}  


$facebook        = soical1(1);
    $id_line         = soical1(2);
    $email           = soical1(3);
    $tell            = soical1(4);
    $web_title       = soical1(5);
    $address         = soical1(6);
    $image           = soical1(7);
    $name            = soical1(8);
    $emergency_tel   = soical1(9);

?>




<?PHP 
function convert($number){ 
$txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ'); 
$txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน'); 
$number = str_replace(",","",$number); 
$number = str_replace(" ","",$number); 
$number = str_replace("บาท","",$number); 
$number = explode(".",$number); 
if(sizeof($number)>2){ 
return 'ทศนิยมหลายตัวนะจ๊ะ'; 
exit; 
} 
$strlen = strlen($number[0]); 
$convert = ''; 
for($i=0;$i<$strlen;$i++){ 
	$n = substr($number[0], $i,1); 
	if($n!=0){ 
		if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; } 
		elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; } 
		elseif($i==($strlen-2) AND $n==1){ $convert .= ''; } 
		else{ $convert .= $txtnum1[$n]; } 
		$convert .= $txtnum2[$strlen-$i-1]; 
	} 
} 

$convert .= 'บาท'; 
if($number[1]=='0' OR $number[1]=='00' OR 
$number[1]==''){ 
$convert .= 'ถ้วน'; 
}else{ 
$strlen = strlen($number[1]); 
for($i=0;$i<$strlen;$i++){ 
$n = substr($number[1], $i,1); 
	if($n!=0){ 
	if($i==($strlen-1) AND $n==1){$convert 
	.= 'เอ็ด';} 
	elseif($i==($strlen-2) AND 
	$n==2){$convert .= 'ยี่';} 
	elseif($i==($strlen-2) AND 
	$n==1){$convert .= '';} 
	else{ $convert .= $txtnum1[$n];} 
	$convert .= $txtnum2[$strlen-$i-1]; 
	} 
} 
$convert .= 'สตางค์'; 
} 
return $convert; 
} 
## วิธีใช้งาน
// $x = '9123568543241.25'; 
// echo  $x  . "=>" .convert($x); 
?>

<?php
$date = date("d-m-Y");
$date_end = date( "d/m/Y", strtotime( $date."+".$_GET['cd']." day" ) ); // PHP:  2009-03-03
$date2 = date("d/m/Y");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>www.mskotop.com</title>


 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
 <link href="../plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

 <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">


 <style>
 body{
    font-family: 'Kanit', sans-serif;
 }

 .swal2-popup {
    display: none;
    position: relative;
    flex-direction: column;
    justify-content: center;
    width: 32em;
    max-width: 100%;
    padding: 1.25em;
    border-radius: .3125em;
    background: #fff;
    font-family: inherit;
    font-size: 1rem;
    box-sizing: border-box;
}


 </style>
</head>
<body>


<div class="container">

<table class="table table-borderless ">

  <tbody>
    <tr>
      <td width="15%"><img src="<?=$image['value']?>" style="width:100%"  alt=""></td>
      <td width="40%" >
      <h5>บริษัท ลีเบียร์ณา จำกัด (สำนักงานใหญ่)</h5>
      <label><?=$address['value']?></label><br>
      <label>โทร. <?=$tell['value']?> โทรสาร. <?=$emergency_tel['value']?></label><br>
      <label>email : <?=$email['value']?></label><br>
      <label>TAX ID : <?=$res_value['value']?></label>
      </td>

      <td style="text-align:center;" colspan="2">
      <h4>ใบส่งสินค้า</h4>
      <label style="font-weight: bold;">DELIVERRY ORDER</label>
      </td>
    </tr>

    <tr>
    <td colspan="2"  >
    <label style="font-weight: bold;" >ลูกค้า : </label> <label><?=$res['fname']?>&nbsp;&nbsp; <?=$res['lname']?>&nbsp;&nbsp;&nbsp;&nbsp;<?=$res['address']?></label><br>
    <label>ต.<?=$res['district']?>&nbsp;&nbsp;อ.<?=$res['amphur']?>&nbsp;&nbsp;จ.<?=$res['province']?>&nbsp;&nbsp;<?=$res['postalcode']?>&nbsp;&nbsp;โทร.<?=$res['telephone']?></label> 
    </td>

    <td>
    <label style="font-weight: bold;">เครดิต :</label> <input type="text" name="credit_day" id="credit_day" size="1"  value="<?php if($_GET['cd'] == ''){print 0;}else{print $_GET['cd'];}?>" id_order="<?=$_GET['id_order']?>" style="border-width:0px; border:none; text-align:center;"  required onblur="credit_day()"> <label style="font-weight: bold;">วัน</label><br>
    <label style="font-weight: bold;">ครบกำหนด :</label> <label><?php if($_GET['cd'] == ''){print $date2;}else{print $date_end;}?></label>
    </td>

    <td>
    <label style="font-weight: bold;">NO.</label> <input type="text" name="no_rec" id="no_rec"  size="6" style="border-width:0px; border:none; "  placeholder="0000/00"  required> <br>
    <label style="font-weight: bold;"><?=$date2?></label> 
    </td>
   
    </tr>

  </tbody>
</table>



<table class="table table-bordered"  >
  <thead style="text-align:center;">
    <tr>
      <th scope="col">ลำดับ</th>
      <th scope="col">รายการ</th>
      <th scope="col">จำนวน</th>
      <th scope="col">หน่วย</th>
      <th scope="col">ราคา/หน่วย</th>
      <th scope="col">ส่วนลด</th>
      <th scope="col">จำนวนเงิน</th>
    </tr>
  </thead>
  <tbody>

<?php $count_li = 1; while($res_item = mysqli_fetch_array($query_item)){?>

    <tr>
      <td style="text-align:center;"><?=$count_li?></td>
      <td><?=$res_item['name_product']?>  <?php if($res_item['attribute_name'] != ''){ print "( ".$res_item['attribute_name']." )"; }else{print"";}?></td>
      <td style="text-align:center;"><?=$res_item['qty']?></td>
      <td style="text-align:center;" ><?=$res_item['']?></td>
      <td style="text-align:center;" ><?=$res_item['price']?></td>
      <td style="text-align:center;" ><?=$res_item['']?></td>
      <td style="text-align:right;"><?=$res_item['subtotal']?></td>
    </tr>

    

<?php $count_li++; } ?>

<tr>
    <td colspan="4"  style="text-align:center;"><br><?php echo convert($res['priceall']);  ?></td>

    <td colspan="2">
    
    <label>รวม</label><br>
    <label>ภาษีมูลค่าเพิ่ม 0%</label><br>
    <label>สุทธิ</label>
    </td>

    <td style="text-align:right;">
    <label><?=$res['priceall']?></label><br>
    <label></label><br>
    <label></label>
    </td>

    </tr>

  </tbody>
</table>


<table class="table  table-borderless"  >

    <tbody>
        <tr>
            <td  width="40%">
            <label>- ได้รับสินค้าในสภาพสมบูรณ์ ครบถ้วน</label><br>
            <label>- สงวนสิทธิ์ในการแก้ไขเอกสารภายใน 7 วัน</label><br>
            <label>- สินค้าซื้อแล้วไม่รับเปลี่ยนหรือคืน</label><br>
            <label>- ชำระหนี้เกินกว่ากำหนด คิดดอกเบี้ร้อยละ 1.5 ต่อเดือน</label>
            </td>

            <td style="text-align:center;">
            <br>
            <label>..................................................................</label><br>
            <label>วันที่...............................................................</label><br>
            <label>ผู้รับสินค้า</label>
            </td>
           
            <td style="text-align:center;">
            <br>
            <label>..................................................................</label><br>
            <label>วันที่...............................................................</label><br>
            <label>ผู้ส่งสินค้า</label>
            </td>

        </tr>

    </tbody>
</table>



<div class="row">
<div class="col-md-12"  style="text-align:center;">
<br>
<br>
<br>
<button type="button" name="" id="display1" onclick="not_print_t()" class="btn btn-danger  pull-right" btn-lg btn-block"><i class="fas fa-print"></i> ยกเลิก</button>
<button type="button" name="" id="display2" onclick="print_t()" class="btn btn-primary  pull-right" btn-lg btn-block"><i class="fas fa-print"></i> พิมพ์ใบเบิก</button>
</div>
</div>


</div>




<script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>

<!-- bootstrap datepicker -->
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script src="../plugins/sweetalert2/dist/sweetalert2.min.js"></script>

<script>




$(document).ready(function() {

    if(navigator.userAgent.toLowerCase().indexOf('chrome') > -1){   // Chrome Browser Detected?
    window.PPClose = false;                                     // Clear Close Flag
    window.onbeforeunload = function(){                         // Before Window Close Event
        if(window.PPClose === false){                           // Close not OK?
            return 'Leaving this page will block the parent window!\nPlease select "Stay on this Page option" and use the\nCancel button instead to close the Print Preview Window.\n';
            console.log('Leaving this page');
        }
    }                   
  //  window.print();                                             // Print preview
    window.PPClose = true;                                      // Set Close Flag to OK.
}

});




</script>


<script>
var input = document.getElementById("credit_day");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();

   var input_val = document.getElementById("credit_day").value;
   var id_order =  $(this).attr("id_order");
   
   console.log(input_val);
   window.location = "print.php?id_order="+id_order+"&cd="+input_val;

  }
});

function credit_day(){ 

  var input_val = document.getElementById("credit_day").value;
   var id_order =  '<?=$_GET['id_order']?>';
   
   console.log(input_val);
   window.location = "print.php?id_order="+id_order+"&cd="+input_val;

}

function not_print_t() {
window.location = "front_manage_se3.php"
}


function print_t() {

//var formData = new FormData($('#frmMain')[0]);

// $.ajax({
// type: "POST",
// url: "add_t.php",
// data: formData,
// processData: false,
// contentType: false,
// success: function(data) {
//     console.log(data);
//     table.ajax.reload();
// },
// });

if($("#credit_day").val() == ""  ){

    swal('คำเตือน','กรุณากรอกเครดิต','warning')
                if($("#credit_day").val() == ""){
                    $("#credit_day").attr("style" , " border-color: red; border-width: 1px;");
                    setTimeout(function() {
                        $("#credit_day").attr("style" , "border-width:0px; border:none; text-align:center; ");
                    }, 5000);
                }

}else if($("#no_rec").val() == ""){

    swal('คำเตือน','กรุณากรอกหมายเลขใบส่งสินค้า','warning')
                if($("#no_rec").val() == ""){
                    $("#no_rec").attr("style" , " border-color: red; border-width: 1px;");
                    setTimeout(function() {
                        $("#no_rec").attr("style" , "border-width:0px; border:none;");
                    }, 5000);
                }

}else{
document.getElementById('display1').style.display = "none";
document.getElementById('display2').style.display = "none";
window.print();

setTimeout(function(){
document.getElementById('display1').style.display = "";
document.getElementById('display2').style.display = "";
}, 500); 
    }
}

</script>





</body>
</html>
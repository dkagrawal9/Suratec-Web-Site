<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require __DIR__.'/mail/vendor/autoload.php';



require_once '../library/connect.php';

header('Content-Type: text/html; charset=utf-8');

$mailname = $_POST['email_data'];





$name_to_data = $_POST['email_data'];

//var_dump($_POST);

$sql = "SELECT *,mod_order.status as status_dl ,mod_shipping.name_shipping AS name_shipping , mod_shipping.price AS price_shipping FROM mod_order  
-- LEFT JOIN mod_order_item on mod_order_item.id_order = mod_order.id_order
LEFT JOIN mod_customer on mod_customer.id_customer = mod_order.id_customer
LEFT JOIN mod_customer_address ON mod_order.id_address = mod_customer_address.id_address
LEFT JOIN mod_shipping ON mod_shipping.id_shipping = mod_order.id_shipping

-- LEFT JOIN product ON product.id_product = mod_order_item.id_product
-- LEFT JOIN  product_attribute ON product.id_product = product_attribute.id_product


WHERE mod_order.id_order = '".$_POST['view_id_order']."' ";


$query = mysqli_query($objConnect,$sql);
$result = mysqli_fetch_array($query,MYSQLI_ASSOC);

$payment = "";

if($result['payment'] = 1){
    $payment ='โอนเงิน';
}else if($result['payment'] = 2){
    $payment ='บัตรเครดิต';
}else if($result['payment'] = 3){
    $payment ='เก็บเงินปลายทาง';
}

$sum = $result['priceall'] +  $result['price_shipping'];

$sum = number_format($sum, 2);

$sql2 = "SELECT *,mod_order.status as status_dl ,mod_shipping.name_shipping AS name_shipping , mod_shipping.price AS price_shipping , mod_order_item.price as price_it FROM mod_order  
LEFT JOIN mod_order_item on mod_order_item.id_order = mod_order.id_order
LEFT JOIN mod_customer on mod_customer.id_customer = mod_order.id_customer
LEFT JOIN mod_customer_address ON mod_order.id_address = mod_customer_address.id_address
LEFT JOIN mod_shipping ON mod_shipping.id_shipping = mod_order.id_shipping

LEFT JOIN product ON product.id_product = mod_order_item.id_product
LEFT JOIN  product_attribute ON product.id_product = product_attribute.id_product


WHERE mod_order.id_order = '".$_POST['view_id_order']."' ";


$query2 = mysqli_query($objConnect,$sql2);





$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->CharSet = "utf-8";
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.leabeerna.co.th';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'info@leabeerna.co.th';                 // SMTP username
    $mail->Password = 'Z341b7jEZB';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, ssl also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    //$mail->SMTPSecure = false;

    //Recipients
    $mail->setFrom('info@leabeerna.co.th', 'Leabeerna');
    $mail->addAddress($mailname , $name_to_data);     // Add a recipient

   
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Leabeerna';
    $mail->Body    = "
  

           <div class='container' style='padding: 5%;'>
           <div class='row'>
           <div class='col-md-12'>

                            <h3 style='color : #005005;'>คำสั่งซื้อหมายเลข : ".$_POST['view_id_order']." อยู่ในระหว่างการจัดส่ง</h3>
                            <div style='text-align:left;'>
                            <a href='https://www.leabeerna.co.th'><img src='https://www.leabeerna.co.th/images/logo.png' style='width: 130px;'></a>
                            </div>

                            <div>
                            <h4 style='color : #000000;'>สวัสดี คุณ ".$result['fname']."  ".$result['lname']."</h4>
                            <h4 style='color : #000000;'>หมายเลขคำสั่งซื้อ :  ".$_POST['view_id_order']."  อยู่ในระหว่างการจัดส่ง</h4>
                            <h4 style='color : #000000;'>หมายเลขพัสดุ : ".$result['tracking_number']." 
                            </div>

                            <h3 style='color : #005005;'>ขั้นตอนต่อไป</h3>
                            <h4 style='color : #000000;'>- กรุณาเตรียมเงินสำหรับค่าสินค้า ใยกรณีที่เป็นการเก็บเงินปลายทาง </h4>
                            <h4 style='color : #000000;'>- โปรดรอรับโทรศัพท์จาก เจ้าหน้าที่ขนส่ง ณ วันจัดส่งสินค้า</h4>


                


                            <h3 style='color : #005005;'>สินค้าของคุณจะได้รับการจัดส่งไปยัง</h3>
                            <h4 style='color : #000000;'>".$result['address']." ต.".$result['district']."  อ.".$result['amphur']."  </h4>
                            <h4 style='color : #000000;'>จ.".$result['province']."  ".$result['postalcode']."</h4>




                            <h3 style='color : #005005;'>รายละเอียดของคำสั่งซื้อ</h3>
                            
                            ";
                            while( $res = mysqli_fetch_array($query2,MYSQLI_ASSOC)){

$mail->Body.= "
                            <div class='row'>   
                            <hr>
                            <div class='col-md-8'>

                            <h4 style='color : #000000;'>".$res['name_product']."</h4>
                            <h4 style='color : #000000;'>".$res['option_name']."</h4>  
                            <h4 style='color : #000000;'>ราคา : ".number_format($res['price_it'], 2)." / ชิ้น</h4>

                            <h4 style='color : #000000;'>จำนวน : ".number_format($res['qty'], 2)."</h4>
                            <h4 style='color : #000000;'>ยอดรวม : ".number_format($res['subtotal'], 2)."</h4>

                            </div>
                            <hr>
                            </div>
         ";
    

                            }

                      

$mail->Body.= "        

                            <h4 style='color : #000000;'>จัดส่งโดย : ".$result['name_shipping']."</h4>
                            <h4 style='color : #000000;'>ชำระเงินด้วยวิธี : ".$payment."</h4>

                       

                            <h4 style='color : #000000;'>ยอดรวม : ".number_format($result['priceall'], 2)."</h4>
                            <h4 style='color : #000000;'>ค่าจัดส่ง : ".$result['price_shipping']." บาท</h4>
                            <h4 style='color : #000000;'>ยอดรวมทั้งสิ้น : ".$sum." บาท</h4>
                            
                    
                            ";
$mail->Body.= "           
           </div>
           </div>
           </div>
         	
    ";


    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}




//}//-----------------------------------------------------------------------------------------


// function DEL_ORDER_SUCCESS(){
	// require_once 'admin/library/connect.php';    
	// header('Content-Type: application/json');
	// $date = date("Y-m-d H:i:s");


	$str = "UPDATE mod_order SET ";
	
			$str .= "mail_status = '1' ";
			$str .= "WHERE id_order = '".$_POST['view_id_order']."' ";

			$query = mysqli_query($objConnect,$str);


	// if($query){
	// 	echo json_encode(array('status' => '1','message'=> "SUCCESS NEW RECORD. "));
	// }else{
	// 	echo json_encode(array('status' => '0','message'=> "ERROR: ".$str));
	// }
// }





?>
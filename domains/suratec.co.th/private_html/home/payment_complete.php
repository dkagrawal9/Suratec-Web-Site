<?php

error_reporting (E_ALL ^ E_NOTICE);
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require __DIR__.'/mail/vendor/autoload.php';


 $rid = $_GET['rid'];

$customeremail = $_GET['customeremail'];
$total = $_GET['total'];
$cardtype = $_GET['cardtype'];
//$id = isset($_GET['id']);
// $status = isset($_GET['status']);
	
if(!isset($_SESSION))
{
session_start();
}

$cid = $_SESSION['id_customer'];

$refid = $_SESSION['refid'];

// $cid = 'd49738a251a7ecb4a294bnb77946f204b1h';

// $refid = 'BL20205681';

require_once '../admin/library/connect.php';
// require_once '../admin/library/functions.php';
header('Content-Type: application/json');
date_default_timezone_set("Asia/Bangkok");

$date = date("Y-m-d H:i:sa");

  if($rid != ''){
	  
//	  $str = "INSERT INTO mod_contact (`id_mail`,`name`,`status`)
//      VALUES('','$rid','1')";
//      $query = mysqli_query($objConnect, $str);
	  
	  $str1 = "UPDATE mod_order SET ";
	  $str1 .= " status = 'Wait shipping' ";
      $str1 .= " WHERE id_customer = '".$cid."' and status = 'complete spending' and doc_no = '".$rid."' ";
      $query1 = mysqli_query($objConnect, $str1);
	
	  	if($query1){
			unset($_SESSION["refid"]);
			echo json_encode(array('status' => '1','message'=> "SUCCESS NEW RECORD. "));
			
			  $str_l = "INSERT INTO payment_gateway_log (`pay_id`,`refno`,`customeremail`,`total`,`cardtype`)
			  VALUES('','$rid','$customeremail','$total','$cardtype')";
			  $query_l = mysqli_query($objConnect, $str_l);
			  if ($query_l) {
			  	$sql_email = "SELECT `email` FROM `mod_customer` WHERE `id_customer` = '".$cid."'";
                $query_email = mysqli_query($objConnect, $sql_email);
                $row_email = mysqli_fetch_array($query_email, MYSQLI_ASSOC);
                $mailname = $row_email['email'];

                $strSQL = "SELECT * FROM `contact` WHERE `setting` ='email_contract'";
           		$objQuery = mysqli_query($objConnect,$strSQL) or die (mysqli_error());
           		$objResult = mysqli_fetch_array($objQuery);
           		$data_value = $objResult["value"];

                

                $name_to_data = '';



$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->CharSet = "utf-8";
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = ''.Host_e_mail;  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = ''.e_mail;                 // SMTP username
    $mail->Password = ''.pass_e_mail;                           // SMTP password
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
    $mail->setFrom(e_mail, from_e_mail);
    //$mail->addAddress($mailname , $name_to_data);     // Add a recipient
    $mail->AddBCC($mailname, $name_to_data);
	$mail->AddBCC($data_value, $name_to_data);


    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'การชำระเงิน '.name_web_e_mail;
    $mail->Body    = "ชำระเงินรายการ ".$rid."เรียบร้อยแล้ว";


    // $mail->AddAttachment( 'example_test.pdf' );

    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

   // $mail->send();
    if(!$mail->send()) {
echo 'Message was not sent.';
echo 'ยังไม่สามารถส่งเมลล์ได้ในขณะนี้ ' . $mail->ErrorInfo;
exit;
} else {
echo 'ส่งเมลล์สำเร็จ';
}
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

			  }
			  
			
		}else{
			echo json_encode(array('status' => '0','message'=> "ERROR: "));
	    }  
//		 echo '<script>document.write(localStorage.clear()); </script>';
    }
?>

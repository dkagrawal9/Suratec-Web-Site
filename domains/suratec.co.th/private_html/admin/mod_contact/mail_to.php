
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


    $name_to_data = $_POST['name_to_data'];


$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->CharSet = "utf-8";
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
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
    $mail->addAddress($mailname , $name_to_data);     // Add a recipient


    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $_POST['subject_data'];
    $mail->Body    = "
  

           
			<div style='background: #668ccc24;padding: 5%; ' >
         
            <a href='".link_e_mail."'><img src='https://www.suratec.co.th/images/logo.png' style='width: 100px;'></a>
                <h2><a href='".link_e_mail."'>".name_web_e_mail."</a><h2>
                
            <div  style='background: #f3f3f3; padding:2%; ' >

            <h4 style='color: #4285f4;'>หัวข้อ</h4>
            <h5>&nbsp;&nbsp;&nbsp;".$_POST['subject_data']."</h5>

            <h4 style='color: #4285f4;' >ข้อความ</h4>
            <h5>&nbsp;&nbsp;&nbsp;".$_POST['message_data']."</h5>

            </div>

				<div  style='background: #fafafa; padding:1%'>				
                <h4 style='color: #4285f4;' >การตอบกลับ</h4>
                <h5>&nbsp;&nbsp;&nbsp;".$_POST['mass_to_reply']."</h5>
                </div>

               <div style='text-align:right;'>
               <h3  style='color: #4285f4;'> By :  <a href='".link_e_mail."'>".$_POST['name_to_reply']."</a><br></h3>
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


echo $sql = "UPDATE mod_contact SET status = '1',send_datetime = '$date' WHERE id_mail = '".$_POST['id']."'";
$query = mysqli_query($objConnect,$sql);






?>
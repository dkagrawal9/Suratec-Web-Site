
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require __DIR__.'/mail/vendor/autoload.php';



require_once '../library/connect.php';

header('Content-Type: text/html; charset=utf-8');
for ($i=0; $i < count($_POST['email']) ; $i++) { 
    

 echo $str = "SELECT * FROM `member` WHERE `id` = '".$_POST['email'][$i]."' ";
    $query = mysqli_query($objConnect,$str);
    $result = mysqli_fetch_array($query);

$mailname = $result['email'];


    $name_to_data = '';


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
    $mail->Subject = 'Bangkoktopnews รับคูปอง';
    $mail->Body    = "
  <h1 style='background: #00800059;padding: 7px 0 17px 7px;margin-bottom:10px;font-size:30px;color:white;' >
                <img src='https://www.bangkoktopnews.com/images/logo/BKTN_Logo.png' style='width: 80px;'>
                <h1>รับคูปอง<h1>
            </h1>
            <div style='padding:2%;'>
                <div style='text-align:center;margin-bottom:50px;'>
                    <img src='https://www.bangkoktopnews.com/images/logo/BKTN_Logo.png' style='width:10%' />                 
                </div>
                <div>               
                    <h3>รหัสคูปอง : <strong style='color:#0000ff;'>".$_POST['coubon_code']."</strong></h3>
                    <h3>ระยะเวลาการใช้งาน : <strong style='color:#0000ff;'>".$_POST['datetimepicker']."</strong></h3>
                    <a href='www.bangkoktopnews.com' target='_blank'>
                        <h1><strong style='color:#3c83f9;'> >> ไปยังหน้าเว็บ << </strong> </h1>
                    </a>
                </div>
        
            </div>    
    ";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
   
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
     
}


}   



//}//-----------------------------------------------------------------------------------------





function generateRandomString($length = 6) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


?>
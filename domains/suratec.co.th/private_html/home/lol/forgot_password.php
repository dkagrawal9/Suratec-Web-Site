
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require __DIR__.'/mail/vendor/autoload.php';



require_once '../admin/library/connect.php';
require_once '../admin/library/config.php';

header('Content-Type: text/html; charset=utf-8');

$mailname = $_POST['mail'];


// echo $mailname;

$sqlpro2 = "SELECT * FROM  mod_customer 
WHERE  mod_customer.email = '$mailname' ";


$queryPro2 = mysqli_query($objConnect, $sqlpro2);
$resultPro2 = mysqli_fetch_array($queryPro2);

$result = mysqli_num_rows($queryPro2);

$random = generateRandomString();

//$newPass = password_hash($random,PASSWORD_BCRYPT);
$newPass = password_hash($random,PASSWORD_DEFAULT);


// echo $newPass;

//-----------------------------------------------------------------------------------------

if($result > 0){



    $strSQL3 = "UPDATE tbl_member SET

    pass_member = '".$newPass."'

    WHERE id_data_role = '".$resultPro2['id_customer']."'";
    $objQuery3 = mysqli_query($objConnect,$strSQL3);
  
    $sqlpro3 = "SELECT * FROM  tbl_member
    INNER JOIN mod_customer ON mod_customer.id_customer = tbl_member.id_data_role
    WHERE  tbl_member.id_data_role = '".$resultPro2['id_customer']."' ";

    $queryPro3 = mysqli_query($objConnect, $sqlpro3);
    $resultPro3 = mysqli_fetch_array($queryPro3);

    $user_member =  $resultPro3['user_member'];
    $fname = $resultPro3['fname'];
    $lname = $resultPro3['lname'];




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
    $mail->addAddress($mailname ,'คุณ'.$fname.' '.$lname);     // Add a recipient


    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'New Password'; 
    $mail->Body    = "
  
    <a href='".link_e_mail."?repass=true' target='_blank'>
			<h1 style='background: linear-gradient(-135deg, #75bdb3, #40a798); padding: 7px 0 17px 7px;margin-bottom:10px;font-size:30px;color:white; border-radius: 5px;' >
				<img src='".link_e_mail."/img/core-img/HatchfulExport-All/logo.png' style='width: 200px;'>
            </h1>
    </a>	
			<div style='padding:2%; background-color: linear-gradient(-135deg, #75bdb3, #40a798); border: solid linear-gradient(-135deg, #75bdb3, #40a798);  5px;  border-radius: 10px;' >
				
				<div>				
                    <h3 style='color:#404040;' >USER NAME : <strong style='color:linear-gradient(-135deg, #75bdb3, #40a798) ; '>".$user_member."</strong></h3>
                    <h3 style='color:#404040;' >PASSWORD : <strong style='color:linear-gradient(-135deg, #75bdb3, #40a798) ;'>".$random."</strong></h3>
                    <hr>

                    <div style='text-align:center;margin-bottom:50px;'>
                    
                    <a href='".link_e_mail."?repass=true' target='_blank'>
                    <h2><strong style='color:linear-gradient(-135deg, #75bdb3, #40a798) ;'> >> Go to Webpage << </strong> </h2>
                    </a>	

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





}//-----------------------------------------------------------------------------------------



	//echo json_encode(array('text'=>$random));

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
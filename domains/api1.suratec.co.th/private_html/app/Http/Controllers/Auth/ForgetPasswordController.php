<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
// use Mail;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Member;
use App\Customer;
use App\Employee;
// use App\mail\vendor\PHPMailer\PHPMailer\Exception;
// use App\mail\vendor\PHPMailer\PHPMailer\PHPMailer;

class ForgetPasswordController extends Controller {


   public function generate_new_password(Request $request) {



  

      // รหัสในการ login
      $new_rand_pass = str_random(8);

      // รหัส hash ใหม่
      $pass_hash = password_hash($new_rand_pass,PASSWORD_DEFAULT);

    // รับค่า email ไปหา ทั้ง mod_customer และ mod_employee
    // หาว่ามี  row ใน mod_customer หรือ mod_employee
    $email = trim($request->email);
    $customer = Customer::where('email', $email)->first();
    $employee = Employee::where('email', $email)->first();

    $result = '';
    $message = '';
    if($customer){
        $result = 'OK';
        $message = 'ระบบทำการส่งรหัสผ่านเรียบร้อย กรุณาตรวจสอบ Email';

        // หา tbl_member ด้วย id_customer = id_data_role
        $member = Member::where('id_data_role', $customer->id_customer)
        ->first();
        // return $customer;
        $member->pass_member = $pass_hash;

        $member->save();

      $data = array('lastname' => $customer['lname'] , 'name'=> $customer['fname'] , 'sent_to' => $email, 'new_password' => $new_rand_pass);


      $to      = $email;
      $subject = 'SURATEC : Your request new password';
      $message = 'new password is : '.$new_rand_pass;
      $headers = 'From: noreply@suratec.co.th' . "\r\n" .
         'Reply-To: noreply@suratec.co.th' . "\r\n" .
         'X-Mailer: PHP/' . phpversion();

      mail($to, $subject, $message, $headers);

      // Mail::send('mail', $data, function($message) use ($data) {
      //    $message->to($data['sent_to'], $data['name'], $data['lastname'])
      //    ->subject('From: SURATEC APP รหัสผ่านใหม่ของคุณ');
      //    $message->from('dev@tpse.co.th','SURATEC');
      // });




      // $name_to_data = '';

      // $mail = new PHPMailer(true);
      // try {
      //     //Server settings
      //     $mail->CharSet = "utf-8";
      //     $mail->SMTPDebug = 0;                                 // Enable verbose debug output
      //     $mail->isSMTP();                                      // Set mailer to use SMTP
      //     $mail->Host = 'mail.suratec.co.th';  // Specify main and backup SMTP servers
      //     $mail->SMTPAuth = true;                               // Enable SMTP authentication
      //     $mail->Username = 'noreply@suratec.co.th';                 // SMTP username
      //     $mail->Password = '5W@!5S9X!vg@V';                           // SMTP password
      //     $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, ssl also accepted
      //     $mail->Port = 587;                                    // TCP port to connect to
      //     $mail->SMTPOptions = array(
      //         'ssl' => array(
      //             'verify_peer' => false,
      //             'verify_peer_name' => false,
      //             'allow_self_signed' => true
      //         )
      //     );
      //     //$mail->SMTPSecure = false;
      
      //     //Recipients
      //     $mail->setFrom('noreply@suratec.co.th', 'noreply@suratec.co.th');
      //     $mail->addAddress($mailname , $name_to_data);     // Add a recipient
      
      //     // .name_web_e_mail
      
      //     //Content
      //     $mail->isHTML(true);                                  // Set email format to HTML
      //     $mail->Subject = 'สมัครตัวแทน ';
      //     $mail->Body    = "test";
      
      //     // $mail->Body    .= " sss :"."$emaildomain  <br>";
      
      //     // $mailname 
      //     // $mail->Body    .= "ชื่อ :"."$id_code";
      
      
      //     // $mail->AddAttachment( 'example_test.pdf' );
      
      //     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
      
      //     $mail->send();
      //     return 'Message has been sent';
      // } catch (Exception $e) {
      //     return 'Message could not be sent. Mailer Error: ';
      // }

 


    }
	elseif($employee){
        $result = 'OK';
        $message = 'ระบบทำการส่งรหัสผ่านเรียบร้อย กรุณาตรวจสอบ Email';

        // หา tbl_member ด้วย id_employee = id_data_role
        $member = Member::where('id_data_role', $employee->id_employee)
        ->first();
      //   return $member;
        $member->pass_member = $pass_hash;
        $member->save();

      $data = array('lastname' => $employee['surname'] , 'name'=> $employee['username'] , 'sent_to' => $email, 'new_password' => $new_rand_pass);

      // Mail::send('mail', $data, function($message) use ($data) {
      //    $message->to($data['sent_to'], $data['name'], $data['lastname'])
      //    ->subject('From: SURATEC APP รหัสผ่านใหม่ของคุณ');
      //    $message->from('dev@tpse.co.th','SURATEC');
      // });

      $to      = $email;
      $subject = 'SURATEC : Your request new password';
      $message = 'new password is : '.$new_rand_pass;
      $headers = 'From: noreply@suratec.co.th' . "\r\n" .
         'Reply-To: noreply@suratec.co.th' . "\r\n" .
         'X-Mailer: PHP/' . phpversion();

      mail($to, $subject, $message, $headers);


    }     
       else {
        $result= 'ผิดพลาด';
        $message = 'ไม่พบอีเมลในระบบ.';
    }
      return response()->json([
          'status' => $result,
          'message' => $message,
          'customer' => $customer,
          //'member' => $member
          'employee' => $employee,
        ], 200);
   }
}
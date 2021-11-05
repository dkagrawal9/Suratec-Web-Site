<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use Mail;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Member;

class MailController extends Controller {
//    public function basic_email() {
//       $data = array('name'=>"Virat Gandhi");

//       Mail::send(['text'=>'mail'], $data, function($message) {
//          $message->to('tanakit.niti@gmail.com', 'Your Password')->subject
//             ('2n31jn23j1kbkj3b2j1');
//          $message->from('tanakit.dev@gmail.com','John Nick');
//       });
//       echo "Basic Email Sent. Check your inbox.";
//    }
   public function generate_new_password(Request $request) {


      $name = "Tanakit";
      $sent_to = "tanakit.dev@gmail.com";
      $new_rand_pass = str_random(10);

      $pass_hash = password_hash($new_rand_pass,PASSWORD_DEFAULT);
      $member = Member::findOrFail($request->id_member);
      $member->pass_member = $pass_hash;
      $member->save();

      $data = array('name'=> $name, 'sent_to' => $sent_to, 'new_password' => $new_rand_pass);

      Mail::send('mail', $data, function($message) use ($data) {
         $message->to($data['sent_to'], $data['name'])
         ->subject('From: MSTRACK APP รหัสผ่านใหม่ของคุณ');
         $message->from('tpse.app@gmail.com','TPS ENTERPRISE CO.,LTD');
      });
      return response()->json([
          'status' => 'OK',
          'message' => 'HTML Email Sent. Check your inbox.',
          'member' => $member
        ], 200);
   }
//    public function attachment_email() {
//       $data = array('name'=>"Virat Gandhi");
//       Mail::send('mail', $data, function($message) {
//          $message->to('abc@gmail.com', 'Tutorials Point')->subject
//             ('Laravel Testing Mail with Attachment');
//          $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
//          $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
//          $message->from('xyz@gmail.com','Virat Gandhi');
//       });
//       echo "Email Sent with attachment. Check your inbox.";
//    }
}

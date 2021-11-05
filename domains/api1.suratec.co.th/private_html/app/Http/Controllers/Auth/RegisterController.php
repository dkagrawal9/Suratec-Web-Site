<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
// use Mail;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Member;
use App\Customer;
use App\Surasole;
use App\Address;
class RegisterController extends Controller {


   public function register(Request $request) {

      $member = new Member();
      $customer = new Customer();
      $surasole = new Surasole();   
      $address = new Address();
      $status = '';
      $message = '';

      $memberExist = Member::where('user_member', $request->username)->get();
      $emailExist = Customer::where('email', $request->email)->get();
      $type = trim($request->type);   
        if(count($memberExist) > 0 || count($emailExist) > 0){
            $status = 'ผิดพลาด';
            $message = 'มีชื่อผู้ใช้นี้อยู่ในระบบแล้ว';

            if(count($emailExist) > 0) {
                $status = 'ผิดพลาด';
                $message = 'มีชื่อผู้ใช้อีเมล์นี้อยู่ในระบบแล้ว';
            }

        }else {
               // verify password and confirm password
              if($request->password == $request->confirm_password){

                $id_member = $this->setMD5();
                $member->id_member = $id_member;
                $member->user_member = $request->username;

                // hash password
                $password_hash = password_hash($request->password, PASSWORD_DEFAULT);
                $member->pass_member = $password_hash;

                $member->member_regdate = date('Y-m-d H:i:s');
                $member->member_last_login = date('Y-m-d H:i:s');
                $member->member_session_update = $id_member;
                $member->data_role = 'mod_customer';
                $member->permission = '';

                $id_data_role = $this->setMD5();
                $member->id_data_role = $id_data_role;

                $member->save();


                $customer->id_customer = $id_data_role;
                $customer->fname = $request->username;
                $customer->lname = '';
                $customer->telephone = '';
                $customer->code = $request->customer_no;
                $customer->birthday = date('0000-00-00');
                $customer->sex = $request->gender;
                $customer->create_datetime = date('Y-m-d H:i:s');
                $customer->update_datetime = date('Y-m-d H:i:s');
                $customer->img_path = 'nopic.png';
                $customer->email = $request->email;
                $customer->type = $type;
                $customer->discount = 0;
    
                $customer->save();
                  
                $surasole->id = '';
                $surasole->action = date('Y-m-d H:i:s');
                $surasole->id_customer = $id_data_role;
                  
                $surasole->save();  

                $address->fname = $request->username;
                $address->create_datetime = date('Y-m-d H:i:s');
                $address->id_customer = $id_data_role;
                $address->status = 1;                                
                $address->save();   
                
                $address->fname = $request->username;
                $address->create_datetime = date('Y-m-d H:i:s');
                $address->id_customer = $id_data_role;
                $address->status = 2;                                
                $address->save();   

                $status = 'สำเร็จ';
                $message = 'สมัครสมาชิกเรียบร้อย';
              }else {
                  $status = 'ผิดพลาด';
                  $message = 'กรุณากรอกรหัสผ่านให้ตรงกัน';
              }
        }

      return response()->json([
          'status' => $status,
          'message' => $message,
          'customer' => $customer,
          'member' => $member

        ], 201);
   }

   public function setMD5(){

    $passuniq = uniqid();
    $passmd5 = md5($passuniq);

    $sumlenght = strlen($passmd5);#num passmd5

    $letter_pre = chr(rand(97,122));#set char for prefix

    $letter_post = chr(rand(97,122));#set char for postfix

    $letter_mid = chr(rand(97,122));#set char for middle string

    $num_rand = rand(0,$sumlenght);#random for cut passmd5

    $cut_pre = substr($passmd5,0,$num_rand);#cutmd5 start 0 stop $numrand
    $setmid = $cut_pre.$letter_mid;#set pre string + char middle

    $cut_post = substr($passmd5,$num_rand, $sumlenght+1);

    $set_modify_md5 = $letter_pre.$setmid.$cut_post.$letter_post;
    return $set_modify_md5;

   }

}

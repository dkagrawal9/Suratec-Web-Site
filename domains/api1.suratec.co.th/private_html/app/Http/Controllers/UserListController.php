<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Customer;
use App\Member;
use App\Surasole;
use App\Address;
use Illuminate\Support\Facades\DB;


class UserListController extends Controller
{
    public function addUserInsert(Request $request){
        DB::beginTransaction();
        try 
        {
            $main_name = 'kkus';
            $hospital_number = 7;
            for($i = 101;$i<=999;$i++){
                $member = new Member();
                $customer = new Customer();
                $surasole = new Surasole();   
                $address = new Address();   
                    $status = '';
                    $message = '';
                    $variable=$i;
                    $password = $main_name.sprintf("%'03d", $variable);                    
                    $username = $main_name.sprintf("%'03d", $variable);                    
                    $userEmail = $main_name.sprintf("%'03d", $variable).'@suratec.co.th';                    
                    
                    $memberExist = Member::where('user_member', $username)->get();
                    $emailExist = Customer::where('email', $userEmail)->get();
                    $type = 1;   
                        if(count($memberExist) > 0 || count($emailExist) > 0){
                           
                            if(count($memberExist) > 0) {
                                continue;
                            }
                            if(count($emailExist) > 0) {
                                continue;
                            }

                        }else {
                           
                                $id_member = $this->setMD5();
                                $member->id_member = $id_member;
                                $member->user_member = $username;

                                // hash password
                                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                                $member->pass_member = $password_hash;

                                $member->member_regdate = date('Y-m-d H:i:s');
                                $member->member_last_login = date('Y-m-d H:i:s');
                                $member->member_session_update = $id_member;
                                $member->data_role = 'mod_customer';
                                $member->permission = '';
                                $id_data_role = $this->setMD5();
                                $member->id_data_role = $id_data_role;
                                $member->parent_id = $hospital_number;
                                $member->save();

                                // Entry in mod_customer table
                                $customer->id_customer = $id_data_role;
                                $customer->fname = $username;
                                $customer->lname = '';
                                $customer->telephone = '';
                                $customer->code = '';
                                $customer->birthday = date('0000-00-00');
                                $customer->sex = 0;
                                $customer->create_datetime = date('Y-m-d H:i:s');
                                $customer->update_datetime = date('Y-m-d H:i:s');
                                $customer->img_path = 'nopic.png';
                                $customer->email = $userEmail;
                                $customer->type = $type;
                                $customer->discount = 0;
                    
                                $customer->save();
                                
                                $surasole->id = '';
                                $surasole->action = date('Y-m-d H:i:s');
                                $surasole->id_customer = $id_data_role;                                
                                $surasole->save();  
                                
                                $address->fname = $username;
                                $address->create_datetime = date('Y-m-d H:i:s');
                                $address->id_customer = $id_data_role;
                                $address->status = 1;                                
                                $address->save();                             
                                $address->fname = $username;
                                $address->create_datetime = date('Y-m-d H:i:s');
                                $address->id_customer = $id_data_role;
                                $address->status = 2;                                
                                $address->save();                             
                }
            }
            DB::commit();
            return "All User added successfully.";
        } catch (\Exception $e) {
            // Rollback Transaction
            DB::rollback();
            dd($e-getMessage());
        }
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
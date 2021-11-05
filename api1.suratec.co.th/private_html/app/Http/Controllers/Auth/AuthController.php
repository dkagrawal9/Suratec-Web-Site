<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Member;
use App\Customer;
use App\Employee;
use App\Erp_branch;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;

use Laravel\Lumen\Routing\Controller as BaseController;
use Exception;

class AuthController extends BaseController
{
    // https://medium.com/tech-tajawal/jwt-authentication-for-lumen-5-6-2376fd38d454
    public function authenticate(Request $request)
    {

        $tbl_member = Member::where('user_member', $request->username)->first();
        if ($tbl_member) {
            if ($tbl_member->id_data_role) {
                if (!$tbl_member->token_member) {
                    if ((password_verify($request->password, $tbl_member->pass_member))) {

                        $token = $this->jwt($tbl_member);
                            $tbl_member->member_last_login = date('Y-m-d H:i:s');
                            // $user->token_member = $token;
                            $tbl_member->save();

                            if ($tbl_member->data_role == "mod_customer"){
                                $userInfo = Customer::where('id_customer', $tbl_member->id_data_role)->first();

                            }else{
                                $userInfo = Employee::where('id_employee', $tbl_member->id_data_role)->first();

                            }	
                            // return $this->responseRequestSuccess($token);
                            return response()->json(['status' => 'สำเร็จ', 'data' => $token, 'member_info' => $tbl_member,'user_info' => $userInfo], 200);
                    } else {
                        return $this->responseRequestError("รหัสผ่านของคุณไม่ถูกต้อง กรุณากรอก password ใหม่!!!");
                    }
                }
            } else {
                return $this->responseRequestError("ไม่สามารถใช้ บัญชี นี้เข้าระบบได้");
            }
        } else {
            return $this->responseRequestError("ไม่พบชื่อผู้ใช้งาน กรุณากรอก username และ password ใหม่!!!");
        }
    }
	
	public function authenticatefacebook(Request $request)
    {
		$customer = Customer::where('id_facebook', $request->id_facebook)->get();
        $fname = trim($request->fname);
        $lname = trim($request->lname);
        $birthday = trim($request->birthday);
        $email = trim($request->email);
		if($request->id_facebook != null)
		{
			if(count($customer) > 0 )
			{
				return response()->json(['status' => 'สำเร็จ', 'customer_info' => $customer], 200);
			}
			else 
        	{
                $member = new Member();
            
                $id_member = $this->setMD5();
                $member->id_member = $id_member;
                $member->user_member = $request->fname;

                // hash password
                $password_hash = password_hash($request->lname, PASSWORD_DEFAULT);
                $member->pass_member = $password_hash;

                $member->member_regdate = date('Y-m-d H:i:s');
                $member->member_last_login = date('Y-m-d H:i:s');
                $member->member_session_update = $id_member;
                $member->data_role = 'mod_customer';
                $member->permission = '';

                $id_data_role = $this->setMD5();
                $member->id_data_role = $id_data_role;

                $member->save();

                $customer = new Customer();
            
                $customer->id_customer = $id_data_role;
                $customer->fname = $request->fname;
                $customer->lname = $request->lname;
                $customer->birthday = $request->birthday;
                $customer->sex = 0;
                $customer->create_datetime = date('Y-m-d H:i:s');
                $customer->update_datetime = date('Y-m-d H:i:s');
                $customer->img_path = 'nopic.png';
                $customer->email = $request->email;
                $customer->id_facebook = $request->id_facebook;
                $customer->discount = 0;
   
                $customer->save();
            return response()->json(['status' => 'สำเร็จพร้อมบันทึก', 'customer_info' => $customer], 200);
        	}
		}
		else
		{
			return response()->json(['status' => 'ผิดพลาดอิอิ!!??'], 200);
		}

        
    }

    public function authentlogouticate(Request $request)
    {
        $tbl_member = Member::where('user_member', $request->id_member)->first();
        $tbl_member->member_last_logout = date('Y-m-d H:i:s');
        $tbl_member->save();
        
        return response()->json(['status' => 'ออกจากระบบเรียบร้อยแล้ว', 'member_info' => $tbl_member,], 200);
    }

    protected function jwt($tbl_member)
    {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $tbl_member->username, // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + env('JWT_EXPIRE_HOUR') * 60 * 60, // Expiration time
        ];
        return JWT::encode($payload, env('JWT_SECRET'));
    }

    protected function responseRequestSuccess($ret)
    {
        return response()->json(['status' => 'สำเร็จ', 'data' => $ret], 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }

    protected function responseRequestError($message = 'Bad request', $statusCode = 404)
    {
        return response()->json(['status' => 'ผิดพลาด', 'message' => $message], $statusCode)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
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
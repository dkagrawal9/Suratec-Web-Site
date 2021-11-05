<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;

use App\Member;
use App\Customer;
use App\Employee;
use App\Daily_data;
use App\Surasole;

use Illuminate\Support\Facades\Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller {
    
    public function selectdashboard(Request $request)
    {
        $customer = Customer::where('id_customer',$request->id_customer)->first();
        if ($customer) 
        { 
            $surasole = Surasole::where('id_customer',$customer->id_customer)->first();
            return response()->json(['status' => 'แสดงข้อมูล','surasole_info' => $surasole,], 200);
            
        }
        else
        {
            return $this->responseRequestError("ไม่พบข้อมูล");
        }
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

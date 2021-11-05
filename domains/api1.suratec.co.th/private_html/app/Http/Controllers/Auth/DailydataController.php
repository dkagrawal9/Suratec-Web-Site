<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;

use App\Member;
use App\Customer;
use App\Employee;
use App\Daily_data;

use Illuminate\Support\Facades\Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DailydataController extends Controller {
    

    public function selectdailydata(Request $request)
    {

        $customer = Customer::where('id_customer',$request->id_customer)->first();
        if($customer->type == '1') 
        {
            $daily_data = Daily_data::where('id_customer',$customer->id_customer)->get();
            
            return response()->json(['status' => 'แสดงข้อมูลที่คุณหา OK', 'customer_info' => $customer , 'daily_data_info' => $daily_data,], 200);
           
        }
        else
        {
            return $this->responseRequestError("ไม่พบข้อมูลที่คุณกำลังหา!!!");
        } 
    }
    public function insertprofile(Request $request)
    {
        $customer = Customer::where('id_customer',$request->id_customer)->first();
        $blood_sugar_levels = trim($request->blood_sugar_levels);
        $food_breakfast = trim($request->food_breakfast);
        $food_lunch = trim($request->food_lunch);
        $food_dinner = trim($request->food_dinner);
        $hours_sleep = trim($request->hours_sleep);

        if ($customer->type == '1') 
        { 
            $daily_data = new Daily_data();
            
            $daily_data->id = '';
            $daily_data->blood_sugar_levels = $blood_sugar_levels;
            $daily_data->action = date('Y-m-d H:i:s');
            $daily_data->food_breakfast = $food_breakfast;
            $daily_data->food_lunch = $food_lunch;
            $daily_data->food_dinner = $food_dinner;
            $daily_data->hours_sleep = $hours_sleep;
            $daily_data->id_customer = $customer->id_customer;
            
            $daily_data->save();
            
            return response()->json(['status' => 'บันทึกข้อมูลสำเร็จการแพทย์',], 200);
        }
		if ($customer->type == null) 
        { 
            $daily_data = new Daily_data();
            
            $daily_data->id = '';
            $daily_data->blood_sugar_levels = $blood_sugar_levels;
            $daily_data->action = date('Y-m-d H:i:s');
            $daily_data->food_breakfast = $food_breakfast;
            $daily_data->food_lunch = $food_lunch;
            $daily_data->food_dinner = $food_dinner;
            $daily_data->hours_sleep = $hours_sleep;
            $daily_data->id_customer = $customer->id_customer;
            
            $daily_data->save();
            
            return response()->json(['status' => 'บันทึกข้อมูลสำเร็จ',], 200);
        }
        else
        {
            return $this->responseRequestError("บันทึกไม่สำเร็จ");
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

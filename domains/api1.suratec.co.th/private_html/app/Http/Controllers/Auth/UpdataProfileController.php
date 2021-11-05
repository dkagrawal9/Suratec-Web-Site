<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;

use App\Member;
use App\Customer;
use App\Employee;

use Illuminate\Support\Facades\Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UpdataProfileController extends Controller {
    

    public function selectprofile(Request $request)
    {
        $customer = Customer::where('id_customer',$request->id_customer)->first();
        if($customer) 
        {
            return response()->json(['status' => 'แสดงข้อมูลที่คุณหา OK', 'customer_info' => $customer,], 200);
        }
        else
        {
            return $this->responseRequestError("ไม่พบข้อมูลที่คุณกำลังหา!!!");
        } 
    }
    // public function updataprofile(Request $request)
    // {
    //     $customer = Customer::where('id_customer',$request->id_customer)->first();
    //     $name = trim($request->name);
    //     $gender = trim($request->gender);
    //     $weight = trim($request->weight);
    //     $height = trim($request->height);
    //     $age = trim($request->age);
    //     $congenital_disease_flg = trim($request->congenital_disease_flg);
    //     $congenital_disease = trim($request->congenital_disease);
    //     $emergency_contract = trim($request->emergency_contract);
    //     if ($customer->type == '1') 
    //     { 
    //         $customer->fname = $name;
    //         $customer->update_datetime = date('Y-m-d H:i:s');
    //         $customer->sex = $gender;
    //         $customer->weight = $weight;
    //         $customer->height = $height;
    //         $customer->age = $age;
    //         $customer->congenital_disease_flg = $congenital_disease_flg;
    //         $customer->congenital_disease = $congenital_disease;
    //         $customer->emergency_contract = $emergency_contract;
    //         $customer->save();

    //         return response()->json(['status' => 'บันทึกข้อมูลสำเร็จการแพทย์', 'customer_info' => $customer,], 200);
            
    //     }
    //     elseif($customer->type == '2') 
    //     {
    //         $customer->fname = $name;
    //         $customer->update_datetime = date('Y-m-d H:i:s');
    //         $customer->sex = $gender;
    //         $customer->weight = $weight;
    //         $customer->height = $height;
    //         $customer->age = $age;
    //         $customer->emergency_contract = $emergency_contract;
    //         $customer->save();
            
    //         return response()->json(['status' => 'บันทึกข้อมูลสำเร็จการกีฬา', 'customer_info' => $customer,], 200);
            
    //     }
	// 	else if($customer->type == null)
	// 	{
	// 		$customer->fname = $name;
    //         $customer->update_datetime = date('Y-m-d H:i:s');
    //         $customer->sex = $gender;
    //         $customer->weight = $weight;
    //         $customer->height = $height;
    //         $customer->age = $age;
    //         $customer->emergency_contract = $emergency_contract;
    //         $customer->save();
            
    //         return response()->json(['status' => 'บันทึกข้อมูลสำเร็จ facebook', 'customer_info' => $customer,], 200);	
			
	// 	}

    //     else
    //     {
    //         return $this->responseRequestError("บันทึกไม่สำเร็จ");
    //     }
        
    // }
    public function updataprofile(Request $request)
    {
        $fname = trim($request->fname);
        $lname = trim($request->lname);
        $telephone = trim($request->telephone);
        $email = trim($request->email);
        $gender = trim($request->gender);

        if ($request->type == 'mod_customer') 
        {  
            $customer = Customer::where('id_customer',$request->id)->first();
            $weight = trim($request->weight);
            $height = trim($request->height);
            $age = trim($request->age);
            $congenital_disease_flg = trim($request->congenital_disease_flg);
            $congenital_disease = trim($request->congenital_disease);
            $emergency_contract = trim($request->emergency_contract);
            if ($customer->type == '1') 
            { 
                $customer->update_datetime = date('Y-m-d H:i:s');
                $customer->fname = $fname;
                $customer->lname = $lname;
                $customer->telephone = $telephone;
                $customer->email = $email;
                $customer->sex = $gender;
                $customer->weight = $weight;
                $customer->height = $height;
                $customer->age = $age;
                $customer->congenital_disease_flg = $congenital_disease_flg;
                $customer->congenital_disease = $congenital_disease;
                $customer->emergency_contract = $emergency_contract;
                $customer->save();
                
                return response()->json(['status' => 'บันทึกข้อมูลสำเร็จการแพทย์', 'customer_info' => $customer,], 200);
                
            }
            elseif($customer->type == '2') 
            {
                $customer->update_datetime = date('Y-m-d H:i:s');
                $customer->fname = $fname;
                $customer->lname = $lname;
                $customer->sex = $gender;
                $customer->telephone = $telephone;
                $customer->weight = $weight;
                $customer->height = $height;
                $customer->age = $age;
                $customer->emergency_contract = $emergency_contract;
                $customer->save();
                
                return response()->json(['status' => 'บันทึกข้อมูลสำเร็จการกีฬา', 'customer_info' => $customer,], 200);
                
            }

            else
            {
                return $this->responseRequestError("บันทึกไม่สำเร็จ");
            }
        }else{
            $employee = Employee::where('id_employee',$request->id)->first();
            $employee->update_datetime = date('Y-m-d H:i:s');
            $employee->username = $fname;
            $employee->surname = $lname;
            $employee->fname = $fname;
            $employee->lname = $lname;
            $employee->telephone = $telephone;
            $employee->email = $email;
            $employee->sex = $gender;       
         
            $employee->save();
            return response()->json(['status' => 'บันทึกข้อมูลสำเร็จการแพทย์', 'customer_info' => $employee,], 200);
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

}

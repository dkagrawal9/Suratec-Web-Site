<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Appointment;
use App\Employee;
use App\Customer;
use App\Member;
use App\Device;

class MemberController extends Controller
{

    
    public function getMember(Request $request,$role)
    {
        if($role == "mod_employee")
        {
            $doctor = [];
            if(isset($_REQUEST['page']) && $_REQUEST['page'] == 0){ 
                $doctor = Employee::select('id_employee','surname as lname','username as fname','birthday','tel','email','img_path');
                if(isset($request->name) && $request->name != ''){ 
                    $doctor =$doctor->where('surname', 'like', '%' . $request->name . '%');
                    $doctor =$doctor->orWhere('username', 'like', '%' . $request->name . '%');
                    $doctor =$doctor->orWhere('email', 'like', '%' . $request->name . '%');
                }
                $doctor =$doctor->get();
            }else{
                $doctor = Employee::select('id_employee','surname as lname','username as fname','birthday','tel','email','img_path');
                if(isset($request->name) && $request->name != ''){ 
                    $doctor =$doctor->where('surname', 'like', '%' . $request->name . '%');
                    $doctor =$doctor->orWhere('username', 'like', '%' . $request->name . '%');
                    $doctor =$doctor->orWhere('email', 'like', '%' . $request->name . '%');
                }
                $doctor =$doctor->paginate(10);
            }
            if($doctor){
                return response()->json(['status' => 'OK','messages' => $doctor], 200);
            }else{
                return response()->json(['status' => 'ERROR','message' => 'Unable to find doctor information'], 401);
            }
        }else{
            $patient =[];
            if(isset($_REQUEST['page']) && $_REQUEST['page'] == 0){ 
                $patient = Customer::select('id_customer','fname','lname','birthday','sex','email','img_path');
                if(isset($request->name) && $request->name != ''){ 
                    $patient =$patient->where('fname', 'like', '%' . $request->name . '%');
                    $patient =$patient->orWhere('lname', 'like', '%' . $request->name . '%');
                    $patient =$patient->orWhere('email', 'like', '%' . $request->name . '%');
                }
                $patient =$patient->get();
            }else{
                $patient = Customer::select('id_customer','fname','lname','birthday','sex','email','img_path');
                if(isset($request->name) && $request->name != ''){ 
                    $patient =$patient->where('fname', 'like', '%' . $request->name . '%');
                    $patient =$patient->orWhere('lname', 'like', '%' . $request->name . '%');
                    $patient =$patient->orWhere('email', 'like', '%' . $request->name . '%');
                }
                $patient =$patient->paginate(10);
            }
            
            if($patient){
                return response()->json(['status' => 'OK','messages' => $patient], 200);
            }else{
                return response()->json(['status' => 'ERROR','message' => 'Unable to find patient information'], 401);
            }
        }
        /* $member = Member::where('data_role',$role)->whereNull('del_time')->get();
        return response()->json(['data' => $member], 200); */
    }

    public function addDevice(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'device_id' => 'required',
            'device_type' => 'required',
            'user_id' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'validation_errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $member = Device::where('user_id',$request->user_id)->delete();
        $member = Device::where('device_id',$request->device_id)->delete();

        $device = new Device();
        $device->device_id = $request->device_id;
        $device->device_type = $request->device_type;
        $device->user_id = $request->user_id;
        $device->status = $request->status;
        if ($device->save()) {
            return response()->json(['status' => 'OK','message' => 'Device information store'], 201);
        }else{
            return response()->json(['status' => 'ERROR','message' => 'Unable to store device information'], 401);
        }
    }

    public function getUserDetails(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'role' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'validation_errors',
                'errors' => $validator->errors()
            ], 422);
        }
        if($request->role == "doctor")
        {
            $doctor = Employee::select('id_employee','surname as lname','username as fname','birthday','tel','email','img_path','sex')->where('id_employee',$request->id)->first();
            if($doctor){
                return response()->json(['status' => 'OK','messages' => $doctor], 200);
            }else{
                return response()->json(['status' => 'ERROR','message' => 'Unable to find doctor information'], 401);
            }
        }else{
            $patient = Customer::select('id_customer','fname','lname','birthday','telephone','email','img_path','congenital_disease_flg','congenital_disease','emergency_contract','height','weight','age','sex')->where('id_customer',$request->id)->first();
            if($patient){
                return response()->json(['status' => 'OK','messages' => $patient], 200);
            }else{
                return response()->json(['status' => 'ERROR','message' => 'Unable to find patient information'], 401);
            }
        }
    }

    public function testNotification(Request $request)
    {
        
            $type = 0;
            $title = "test";
            $msg = "test";
            if ($type != 0) {
                $fields['notification'] = array(
                    'title' => $title,
                    'body' => $msg,
                    'sound' => 'mySound',
                    /*  'type' => $type, */
                );
            } 
            
            $message_data['custom_data']['message'] =  $msg;
            
            //$message_data['custom_data']['type'] =  $type;
            
            if (!empty($message_data['custom_data'])) {

                $fields['data'] = $message_data['custom_data'];
            }

            //$fields['to'] = 'd6ZdcsHlF0AGqDXne99ITC:APA91bEqlOPnSA0cScqyIZokpTl149BED65q4MpPlV2PWowhUQm0M_Rkaa2WylklktCE4NGtAQs9rsyrN-iNGUvw0BLigKFN_HXdE-WrZTJdaKPghMqX8jiFQ7g2ftcpvmfURohDR1tj';
           /*  if($data['multiple'] == 1){ */
            
            $fields['to'] = $request->fcmToken;
            //$fields['to'] = "el5g7-yzRm-EbIByo7VUnr%3AAPA91bElj7gx_vUpLbFcbTEfnkVP5aEycairzBwtgZjDbrJny-gZ8iBrzauhQ_jQWc-IOpuylnY-llKZ_aol1t8nyhzw0KIasHlYNvgmNXATptrS_MffJ7dOlFQG6HlMYy_Gu2OOIE81";
            /* }
            else
            {
            } */
            
            $headers = array(
                'Authorization: key=' . $request->fireBaseAPIAccessKey,
                'Content-Type: application/json'
            );
            //dd($headers);
            #Send Reponse To FireBase Server
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            
            curl_close($ch);
            return $result;
        }
   

}
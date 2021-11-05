<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Chat;
use App\Employee;
use App\Customer;
use App\Notification;
use App\Channel;
use App\Channels;
use App\Device;
use App\ModChat;
use App\Member;
use App\ChatStatus;
use DB;
use URL;

class ChatController extends Controller
{

    /**
    * Add chat message
    *
    * @param  Request $request
    * @return HTTP Response
    */
    public function addMessage(Request $request)
    {

        // Request validation
        $validator = \Validator::make($request->all(), [
            'channel' => 'required',
            'user_id' => 'required',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'validation_errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $errors = [];
        $channels = explode("-",$request->channel);
        $doctorId = !empty($channels[0]) ? $channels[0] : 'invalid';
        $patientId = !empty($channels[1]) ? $channels[1] : 'invalid';
        $validDoctor = $this->validateDoctor($doctorId);
        $validPatient = $this->validatePatient($patientId);

        if ($validDoctor == false) {
            $errors['id_employee'] = ['Invalid Doctor id'];
        }
        if ($validPatient == false) {
            $errors['id_customer'] = ['Invalid Customer/Patient id'];
        }
        if (!in_array($request->user_id,$channels) && is_array($channels)) {
            $errors['id_customer'] = ['Invalid User id'];
        }
        
        if (!empty($errors)) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'validation_errors',
                'errors' => $errors
            ], 422);
        }

        // Create an appointment
        $chat = new Chat;
        $chat->channel = $request->channel;
        $chat->user_id = $request->user_id;
        $chat->message = $request->message;
        if ($chat->save()) {
            return response()->json(['status' => 'OK','message' => 'Message added successfully'], 201);
        }else{
            return response()->json(['status' => 'ERROR','message' => 'Unable to add message'], 401);
        }

    }

    /**
    * Get chat messages
    *
    * @param  String $user_id
    * @return Boolean TRUE is valid, otherwise FALSE
    */
    public function chatMessages($user_id = '')
    {
        $chats = Chat::where('user_id',$user_id)->get();
        return response()->json(['status' => 'OK','messages' => $chats], 200);
    }

    /**
    * Validate Patient/Customer
    *
    * @param  String $id_customer
    * @return Boolean TRUE is valid, otherwise FALSE
    */
    private function validatePatient($id_customer = '')
    {
        $patient = Customer::where('id_customer',$id_customer)->count();

        if (!empty($patient)) {
            return true;
        }else{
            return false;
        }
    }

    /**
    * Validate Doctor
    *
    * @param  String $id_employee
    * @return Boolean TRUE is valid, otherwise FALSE
    */
    private function validateDoctor($id_employee = '')
    {
        $doctor = Employee::where('id_employee',$id_employee)->where('role_id','u6c21d97c94895ab1f58e1db5dde1c9080g')->count();

        if (!empty($doctor)) {
            return true;
        }else{
            return false;
        }
    }

    public function insertChannel(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'sender_id' => 'required',
            'reciever_id' => 'required',
            'channel_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'validation_errors',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $channelData = Channels::where(function ($query)use($request) {
            $query->where('sender_id', $request->sender_id)
                  ->orWhere('sender_id', $request->reciever_id);
        })->where(function ($query)use($request) {
            $query->where('reciever_id', $request->sender_id)
                  ->orWhere('reciever_id', $request->reciever_id);
        })->first();
        
        if(!$channelData){
            $channel = new Channels();
            $channel->sender_id = $request->sender_id;
            $channel->reciever_id = $request->reciever_id;
            $channel->channel_id = $request->channel_id;
            $channel->start_date = $request->start_date;
            $channel->end_date = $request->end_date;
            if ($channel->save()) {
                return response()->json(['status' => 'OK','message' =>$channel ], 201);
            }else{
                return response()->json(['status' => 'ERROR','message' => 'Unable to store device information'], 401);
            }
        }else{
            return response()->json(['status' => 'OK','message' => $channelData], 201)   ;
        }
    }

    public function uploadFile(Request $request)
    {
        try{
            $validator = \Validator::make($request->all(), [
                'file' => 'required|max:500000'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ], 422);
            }
            if ($request->hasFile('file')) {
                $original_filename = $request->file('file')->getClientOriginalName();
                $ext = strtolower($request->file('file')->getClientOriginalExtension());
                $image_formats = ['php', 'exe', 'env'];
                
                if(in_array($ext, $image_formats)){
                    return response()->json(['status' => 'error','message' =>"Not valid file extension" ], 401);
                } 
                $original_filename_arr = explode('.', $original_filename);
                $file_ext = end($original_filename_arr);
                $destination_path = './pic';
                $imageName = $this->getRandomName() . '.' . $file_ext;
            
                if ($ab = $request->file('file')->move($destination_path, $imageName)) {
                    
                    $image = [];
                    $image['name'] = $imageName;
                    $image['type'] = $ext;
                    $image['full_path'] = url('/').'/pic/'.$imageName;
                    return response()->json(['status' => 'OK','message' =>$image ], 201); 
                } else {
                    return response()->json(['status' => 'error','message' =>"File not upload." ], 401);
                }
            } else {
                return response()->json(['status' => 'error','message' =>"File not found." ], 401);
            }
        }catch(\Throwable $th){
            
            return response()->json(['status' => 'error','message' =>"Something want to be wrong." ], 401);

        }
       
    }

    protected function getRandomName()
    {
        $str = '';
        for ($i = 0; $i < 16; $i++) {
            $mode = mt_rand(0, 2);
            if ($mode == 0) {
                $str = $str . chr(mt_rand(48, 57));
            } else if ($mode == 1) {
                $str = $str . chr(mt_rand(65, 90));
            } else {
                $str = $str . chr(mt_rand(97, 112));
            }
        }
        return $str;
    }

    public function channelList($id)
    {
    
        $finalChannelData = [];
        $channelData = Channel::select('mob_channel.*','mod_employee.surname','mod_employee.username','mod_customer.fname','mod_customer.lname')->join('mod_customer', function($join){
            $join->on('mod_customer.id_customer','=','mob_channel.sender_id'); // i want to join the users table with either of these columns
            $join->orOn('mod_customer.id_customer','=','mob_channel.reciever_id');
        })
        ->join('mod_employee', function($join){
            $join->on('mod_employee.id_employee','=','mob_channel.sender_id'); // i want to join the users table with either of these columns
            $join->orOn('mod_employee.id_employee','=','mob_channel.reciever_id');
        })
        ->where(function ($query)use($id) {
            $query->where('sender_id', $id)
                  ->orWhere('reciever_id', $id);
        });
        
        if(isset($_REQUEST['name']) &&  $_REQUEST['name'] != '' && isset($_REQUEST['mod_type']) &&  $_REQUEST['mod_type'] == 'mod_employee'){ 
            $channelData =$channelData->where('mod_customer.fname', 'like', '%' .  $_REQUEST['name']);
            $channelData =$channelData->orWhere('mod_customer.lname', 'like', '%' .  $_REQUEST['name']);    
            
        }
    
        if(isset($_REQUEST['name']) &&  $_REQUEST['name'] != '' && isset($_REQUEST['mod_type']) &&  $_REQUEST['mod_type'] == 'mod_customer'){ 
            $channelData =$channelData->where('mod_employee.surname', 'like', '%' .  $_REQUEST['name']);
            $channelData =$channelData->orWhere('mod_employee.username', 'like', '%' .  $_REQUEST['name']);       
        }        
        $channelData = $channelData->orderBy('id','DESC')->get();
        foreach ($channelData as $key => $value) {
            $last = ModChat::where('channel_id',$value->channel_id)->orderBy('id','DESC')->first();
            $finalChannelData[$key] = $value;
            
            if($value->sender_id ==  $id){
                $role = Member::where('id_data_role',$value->sender_id)->first();
                if($role && $role->data_role == 'mod_customer'){
                    $finalChannelData[$key]->sender_id = $this->getPatientList($value->sender_id);
                }
                if($role && $role->data_role == 'mod_employee'){
                    $finalChannelData[$key]->sender_id = $this->getDoctorList($value->sender_id);
                }
                $role_reci = Member::where('id_data_role',$value->reciever_id)->first();
                if($role_reci && $role_reci->data_role == 'mod_customer'){
                    $finalChannelData[$key]->reciever_id = $this->getPatientList($role_reci->id_data_role);
                }
                if($role_reci && $role_reci->data_role == 'mod_employee'){
                    $finalChannelData[$key]->reciever_id = $this->getDoctorList($role_reci->id_data_role);
                }
            } 
            if($value->reciever_id ==  $id){
                $role = Member::where('id_data_role',$value->sender_id)->first();
                if($role && $role->data_role == 'mod_customer'){
                    $finalChannelData[$key]->sender_id = $this->getPatientList($value->sender_id);
                }
                if($role && $role->data_role == 'mod_employee'){
                    $finalChannelData[$key]->sender_id = $this->getDoctorList($value->sender_id);
                }
                $role_reci = Member::where('id_data_role',$value->reciever_id)->first();
                
                if($role_reci && $role_reci->data_role == 'mod_customer'){
                    $finalChannelData[$key]->reciever_id = $this->getPatientList($value->reciever_id);
                }
                if($role_reci && $role_reci->data_role == 'mod_employee'){
                    $finalChannelData[$key]->reciever_id = $this->getDoctorList($value->reciever_id);
                }
            }
            $finalChannelData[$key]->msg = ($last)?$last:'nomsg';
            // var_dump( $finalChannelData[$key]);
        }
        // dd($finalChannelData);
        return $finalChannelData;       
    }
    public function getPatientList($id){
       return Customer::select('id_customer','id_customer as id','fname','lname','chat_status.status as chat_status','img_path')
                ->leftJoin('chat_status','chat_status.user_id','mod_customer.id_customer')
                ->where('id_customer',$id)->first();
    }
    public function getDoctorList($id){
       return Employee::select('id_employee','id_employee as id','lname','fname','chat_status.status as chat_status','img_path')
       ->leftJoin('chat_status','chat_status.user_id','mod_employee.id_employee')
       ->where('id_employee',$id)->first();
    }
       // get data for online or offline using user id
       public function getchatstatus($id){
        $chat = ChatStatus::where('user_id',$id)->first();
        if($chat){
            return response()->json(['status' => $chat->status]);
            
        }else{
            return response()->json(['status' => NULL]);
        }
    }
    public function messageNotification(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'channel_id' => 'required',
            'reciever_id' => 'required',
            'msg' => 'required',
            'sender_id' => 'required',
            'type' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'validation_errors',
                'errors' => $validator->errors()
            ], 422);
        }
        $type = 0;
        $role = Member::where('id_data_role',$request->sender_id)->first();
        $name = "";
        //return $role;
        if($role->data_role == 'mod_customer'){
            $data = Customer::select('id_customer','id_customer as id','fname','lname','img_path')->where('id_customer',$request->sender_id)->first();
            if($data){
                $name = $data->fname ." ".$data->lname; 
            }
        }
        if($role->data_role == 'mod_employee'){
            $data = Employee::select('id_employee','id_employee as id','lname','fname','img_path')->where('id_employee',$request->sender_id)->first();
            
            if($data){
                $name = $data->lname ." ".$data->fname; 
            }
        }
        $getCustomer = Device::where('user_id',$request->reciever_id)->first();
        if($getCustomer){
            if ($getCustomer->device_type != 0) {
                $fields['notification'] = array(
                    'title' => $name,
                    'body' => $request->msg,
                    'sound' => 'mySound',
                    /*  'type' => $type, */
                );
            }
        } 
        else{
            return response()->json(['status' => 'error','message' =>"Reciver device id not found." ], 401);
        }

        $message_data['data']['title'] =  $name;
        $message_data['data']['message'] =  $request->msg;
        $message_data['data']['type'] =  "chat";
        $message_data['data']['type2'] =  $request->type;
        $message_data['data']['name'] =  $request->name;
        $message_data['data']['url'] =  $request->url;
        $message_data['data']['date'] =  date("Y-m-d H:i:s");
        $message_data['data']['timeZone'] =  $request->timeZone;
        $message_data['data']['channel'] =  $request->channel_id;
        $getChannelData = Channels::where('channel_id',$request->channel_id)->first();
        $message_data['data']['payload'] =  $getChannelData;
                
        if (!empty($message_data['data'])) {

            $fields['data'] = $message_data['data'];
        }
        //dd($getCustomer->device_id);
        if($getCustomer){
            $fields['to'] = $getCustomer->device_id;
        }else{
            return response()->json(['status' => 'error','message' =>"Reciver device id not found." ], 401);
        }
        $headers = array(
            'Authorization: key=' . env("FIREBASE_API_ACCESS_KEY"),
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
        
        return response()->json(['status' => 'OK','message' =>$message_data ], 201);
        
    }
    // add data for online or offline
    public function addonlineofflinestatus(Request $request)
    {
        // Request validation
        $validator = \Validator::make($request->all(), [
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
        $chat = ChatStatus::where('user_id',$request->user_id)->first();
        if($chat){
            $chat->user_id = $request->user_id;
            $chat->status = $request->status;
        }else{
            $chat = new ChatStatus;
            $chat->user_id = $request->user_id;
            $chat->status = $request->status;
        }
        if ($chat->save()) {
            return response()->json(['status' => 'OK','message' => 'Chat status added successfully'], 201);
        }else{
            return response()->json(['status' => 'ERROR','message' => 'Unable to Chat status add message'], 401);
        }

    }
}

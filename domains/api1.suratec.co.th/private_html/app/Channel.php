<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $table = 'mob_channel';
    protected $primaryKey = 'id';

    protected $appends = ['msg'];

    // public function getSenderIdAttribute($value)
    // {
    //     $category = Member::where('id_data_role', $value)->first();
        
    //     if($category->data_role == "mod_customer"){
    //         $senderData = Customer::select('id_customer','fname','lname')->where('id_customer',$value)->first();
    //         return $senderData;
    //     }else{
    //         $senderData = Employee::select('id_employee','surname as lname','username_en as fname')->where('id_employee',$value)->first();
    //         return $senderData;
    //     }
    //     //return $category;
        
    // }

    // public function getRecieverIdAttribute($value)
    // {
    //     $category = Member::where('id_data_role', $value)->first();
        
    //     if($category->data_role == "mod_customer"){
    //         $senderData = Customer::select('id_customer','fname','lname')->where('id_customer',$value)->first();
    //         return $senderData;
    //     }else{
    //         $senderData = Employee::select('id_employee','surname as lname','username_en as fname')->where('id_employee',$value)->first();
    //         return $senderData;
    //     }
    //     //return $category;
        
    // }
    public function getSenderId1Attribute($value)
    {
        $category = Member::where('id_data_role', $value)->first();
        //return $_REQUEST['name'];
        
        if($category->data_role == "mod_customer"){
            $senderData = Customer::select('id_customer','id_customer as id','fname','lname')->where('id_customer',$value);
            if(isset($_REQUEST['name']) &&  $_REQUEST['name'] != ''){ 
                $senderData =$senderData->where('fname', 'like', '%' .  $_REQUEST['name'] . '%');
                $senderData =$senderData->orWhere('lname', 'like', '%' .  $_REQUEST['name'] . '%');
            }
            $senderData =$senderData->first();
            return $senderData;
        }else{
            
            $doctor = Employee::select('id_employee','id_employee as id','surname as lname','username_en as fname')->where('id_employee',$value);
            if(isset($_REQUEST['name']) &&  $_REQUEST['name'] != ''){ 
                $doctor =$doctor->where('surname', 'like', '%' .  $_REQUEST['name'] . '%');
                $doctor =$doctor->orWhere('username', 'like', '%' .  $_REQUEST['name'] . '%');
            }
            $doctor =$doctor->first();
            return $doctor;
        }
        //return $category;
        
    }

    public function getRecieverId1Attribute($value)
    {
        $category = Member::where('id_data_role', $value)->first();
        
        if($category->data_role == "mod_customer"){
            $senderData = Customer::select('id_customer','id_customer as id','fname','lname')->where('id_customer',$value);
            if(isset($_REQUEST['name']) &&  $_REQUEST['name'] != ''){ 
                $senderData =$senderData->where('fname', 'like', '%' .  $_REQUEST['name'] . '%');
                $senderData =$senderData->orWhere('lname', 'like', '%' .  $_REQUEST['name'] . '%');
            }
            $senderData =$senderData->first();
            return $senderData;
        }else{
            $doctor = Employee::select('id_employee','id_employee as id','surname as lname','username_en as fname')->where('id_employee',$value);
            if(isset($_REQUEST['name']) &&  $_REQUEST['name'] != ''){ 
                $doctor =$doctor->where('surname', 'like', '%' .  $_REQUEST['name'] . '%');
                $doctor =$doctor->orWhere('username', 'like', '%' .  $_REQUEST['name'] . '%');
            }
            $doctor =$doctor->first();
            return $doctor;
        }
        //return $category;
        
    }
    public function getMsgAttribute()
    {
        
        return [];
    }

    /* public function mod_employee()
    {
         return $this->belongsTo(ModEmployee::class, 'id_data_role' , 'id_employee');
    } */
}
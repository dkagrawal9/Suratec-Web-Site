<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channels extends Model
{
    protected $table = 'mob_channel';
    protected $primaryKey = 'id';

    protected $appends = ['msg'];
    
    public function getSenderIdAttribute($value)
    {
        
       /*  $category = Member::where('id_data_role', $value)->first();
        $senderData = Employee::select('id_employee','surname as lname','username_en as fname')->where('id_employee',$value)->first();
        return $senderData; */
        $category = Member::where('id_data_role', $value)->first();
        
        if($category->data_role == "mod_customer"){
            $senderData = Customer::select('id_customer','id_customer as id','fname','lname','img_path','sex')->where('id_customer',$value);
            $senderData =$senderData->first();
            return $senderData;
        }else{
            
            $doctor = Employee::select('id_employee','id_employee as id','lname','fname','img_path','sex')->where('id_employee',$value);
            $doctor =$doctor->first();
            return $doctor;
        }
      
        
    }

    public function getRecieverIdAttribute($value)
    {
        $category = Member::where('id_data_role', $value)->first();
        if($category->data_role == "mod_customer"){
            $senderData = Customer::select('id_customer','id_customer as id','fname','lname','img_path','sex')->where('id_customer',$value);
            $senderData =$senderData->first();
            return $senderData;
        }else{
            
            $doctor = Employee::select('id_employee','id_employee as id','lname','fname','img_path','sex')->where('id_employee',$value);
            $doctor =$doctor->first();
            return $doctor;
        }        
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
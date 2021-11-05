<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public function getIdEmployeeAttribute($value)
    {
        $senderData = Employee::select('id_employee','surname as lname','username as fname','img_path','sex')->where('id_employee',$value)->first();
        return $senderData;        
    }
    public function getIdCustomerAttribute($value)
    {
        $senderData = Customer::select('id_customer','lname','fname','img_path','congenital_disease_flg','congenital_disease','emergency_contract','height','weight','age','sex')->where('id_customer',$value)->first();
        return $senderData;        
    }

    
}
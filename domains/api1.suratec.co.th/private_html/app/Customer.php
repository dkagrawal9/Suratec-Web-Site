<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'mod_customer';
    protected $primaryKey = 'id_customer';

    public $incrementing = false;
    protected $keyType = 'string';

    // protected $hidden = [
    //     'pass_member',
    // ];
    protected $appends = ['image'];

    public function getImageAttribute()
    {   
        if($this->img_path != null){
            return $this->img_path;  
        }
        else{
            return "user.png";
        }
    }
    public $timestamps = false;

    // public function mod_employee()
    // {
    //     return $this->belongsTo(ModEmployee::class, 'id_data_role' , 'id_employee');
    // }
}

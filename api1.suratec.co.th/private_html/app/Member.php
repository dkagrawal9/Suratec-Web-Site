<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'tbl_member';
    protected $primaryKey = 'id_member';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $hidden = [
        'pass_member',
    ];

    public $timestamps = false;

    // public function mod_employee()
    // {
    //     return $this->belongsTo(ModEmployee::class, 'id_data_role' , 'id_employee');
    // }
}
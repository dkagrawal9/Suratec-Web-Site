<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $table = 'problem';
    protected $primaryKey = 'problem_id';

    // public $incrementing = false;
    // protected $keyType = 'string';

    // protected $hidden = [
    //     'pass_member',
    // ];

    public $timestamps = false;

    // public function mod_employee()
    // {
    //     return $this->belongsTo(ModEmployee::class, 'id_data_role' , 'id_employee');
    // }
}
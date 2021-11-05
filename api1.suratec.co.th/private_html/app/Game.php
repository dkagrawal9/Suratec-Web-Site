<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'game';
    protected $primaryKey = 'id';

    public $incrementing = false;
    protected $keyType = 'string';

    // protected $hidden = [
    //     'pass_member',
    // ];

    public $timestamps = false;

    // public function mod_employee()
    // {
    //     return $this->belongsTo(ModEmployee::class, 'id_data_role' , 'id_employee');
    // }
}

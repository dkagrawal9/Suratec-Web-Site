<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'game';
    protected $primaryKey = 'id';

    public $incrementing = false;
    protected $keyType = 'string';


    public $timestamps = false;


}

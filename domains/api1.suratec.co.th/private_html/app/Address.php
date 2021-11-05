<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'mod_customer_address';
    protected $primaryKey = 'id_address';
    public $timestamps = false;
    public $incrementing = false;
}
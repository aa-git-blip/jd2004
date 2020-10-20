<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User_address extends Model
{
    //
    protected $table = 'user_address';
    public $timestamps = false;
    protected $primaryKey = 'address_id';
    protected $guarded = [];   //黑名单  create只需要开启
}

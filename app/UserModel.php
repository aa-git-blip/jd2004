<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    //
    protected $table = 'user';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $guarded = [];   //黑名单  create只需要开启
}

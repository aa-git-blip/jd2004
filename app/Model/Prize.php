<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    //
    protected $table = 'prize';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $guarded = [];   //黑名单  create只需要开启
}

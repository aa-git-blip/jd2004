<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //
    protected $table = 'region';
    public $timestamps = false;
    protected $primaryKey = 'region_id';
    protected $guarded = [];   //黑名单  create只需要开启
}

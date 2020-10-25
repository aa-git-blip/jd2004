<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{
    //
    protected $table = 'collect';
    public $timestamps = false;
    protected $primaryKey = 'collect_id';
    protected $guarded = [];   //黑名单  create只需要开启
}

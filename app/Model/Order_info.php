<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order_info extends Model
{
    //
    protected $table = 'order_info';
    public $timestamps = false;
    protected $primaryKey = 'order_id';
    protected $guarded = [];   //黑名单  create只需要开启
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order_goods extends Model
{
    //
    protected $table = 'order_goods';
    public $timestamps = false;
    protected $primaryKey = 'order_shop_id';
    protected $guarded = [];   //黑名单  create只需要开启
}

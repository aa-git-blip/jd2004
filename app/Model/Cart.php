<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $table = 'p_cart';
    public $timestamps = false;
    protected $guarded = [];   //黑名单  create只需要开启
}

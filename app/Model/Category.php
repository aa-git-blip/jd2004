<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'p_category';
    public $timestamps = false;
    protected $primaryKey = 'cat_id';
    protected $guarded = [];   //黑名单  create只需要开启
}

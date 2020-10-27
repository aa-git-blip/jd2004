<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comment';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $guarded = [];   //黑名单  create只需要开启
}

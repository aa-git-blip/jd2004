<?php

namespace App\Http\Controllers\Index;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    function index(){
        // dd(Redis::lrange('logtime10',0,-1));
        return view('index.index');
    }
}

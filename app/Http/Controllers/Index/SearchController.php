<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    function search(){
        return view('index.search');
    }
    function seckill(){
        return view('index.seckill');
    }
}

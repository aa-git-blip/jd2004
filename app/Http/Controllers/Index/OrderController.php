<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class OrderController extends Controller
{
    //
    function order(){
        dd(111);
        return view('index.order');
    }
}

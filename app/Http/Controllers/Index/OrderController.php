<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class OrderController extends Controller
{
    //
    function order(){
        return view('index.order');
    }
}

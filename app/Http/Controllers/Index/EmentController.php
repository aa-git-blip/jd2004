<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class EmentController extends Controller
{
    public function ement(){
        return view('index.ement');
    }
    public function pay(){
        return view('index.pay');
    }
}

<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class CouponController extends Controller
{
    //
    function coupon(){
        return view('index.coupon');
    }
    function couponadd(){
        //验证登录

        echo "领券成功";
    }
    function test(){
        //验证登录

        echo "领券成功";
    }
}

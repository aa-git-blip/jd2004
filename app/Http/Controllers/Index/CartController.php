<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
class CartController extends Controller
{
    //
    public function cart(){
        return view('index.cart');
    }
    public function cartdo()
    {
        $user=session('login');
        if(!$user){
            // dd($_SERVER);
            $url = $_SERVER['HTTP_REFERER'];
            return json_encode(['code'=>1,'msg'=>'您还没登录','url'=>$url]);
        }
        $goods_id=request()->goods_id;
        $buy_number=request()->buy_number;
        $goods=Goods::find($goods_id);
        if($goods->goods_number<$buy_number){
            return json_encode(['code'=>2,'msg'=>'库存不足']);
        }
    }

}

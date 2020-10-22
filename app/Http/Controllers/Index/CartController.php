<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Cart;
class CartController extends Controller
{
    //
    public function cart(){

        $cart = Cart::where('uid',session('login')->id)->pluck('goods_id');
        // dd($cart);
        $cart = $cart?$cart->toArray():[];
        // dd($cart);
        $goods=Goods::leftjoin('p_cart','p_goods.goods_id','=','p_cart.goods_id')->whereIn('p_cart.goods_id',$cart)->get();
        //dd($goods);
        return view('index.cart',['goods'=>$goods]);
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
            return json_encode(['code'=>2,'msg'=>'库存不足，请填写正确参数']);
        }

        $cart = Cart::where('goods_id',$goods_id)->first();
        // dd($cart);
        if($cart){
            //购物车购买数量数量
            $goods_num = $cart->goods_num+$buy_number;
            //dd($goods_num);
            $res = Cart::where('id',$cart->id)->update(['goods_num'=>$goods_num]);
            //dd(123);
            if($res){
                return json_encode(['code'=>3,'msg'=>'添加购物车成功']);
            }
        }else{
            $data = [
                'uid'=>session('login')->id,
                'goods_id' => $goods_id,
                'goods_num'=>$buy_number,
                'add_time'=>time(),
            ];
            $res=Cart::insert($data);
            if($res){
                return json_encode(['code'=>0,'msg'=>'添加购物车成功']);
            }
        }
    }

}

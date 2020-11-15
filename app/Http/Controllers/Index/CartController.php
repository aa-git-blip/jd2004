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
        //dd($goods);
        if($goods->goods_number<$buy_number){
            return json_encode(['code'=>2,'msg'=>'库存不足，请填写正确参数']);
        }
        //根据新的原来的的价格减去虚拟的价格等于促销的价格
        $add=$goods->shop_price - $goods->goods_newest;
        // dd($add);
        //根据商品id查找到当前id并且修改最新价格
        $sss=Goods::where('goods_id',$goods->goods_id)->update(['goods_aaa'=>$add]);;
        $cart = Cart::where('goods_id',$goods_id)->first();
        //dd($cart);
        //查询购物车条数
        $num=Cart::count();
        //dd($num);
        //判断购物车条数如果大于二十给出提示终止
        if($num>=20){
            return json_encode(['code'=>5,'msg'=>'购物车最大数量为20个,请您先清理购物车']);
        }
        ////////////////////////////////单个商品不得超过20个//////////////////////////////////////
        // if($cart['goods_num']>19){
            //return json_encode(['code'=>5,'msg'=>'购物车最大数量为20个']);
        // }
        ////////////推翻前期代码9:04//////////////////////////////////////////////////////////
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

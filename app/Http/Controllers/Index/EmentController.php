<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User_address;
use App\Model\Region;
use App\Model\Cart;
class EmentController extends Controller
{
    public function ement(){
        $cart_id=Request()->cart_id;
        //
        $cart_id=explode(',',$cart_id);
        //dd($cart_id);
        $uid=session('login')->id;
        //dd($uid);
        $address=User_address::where('user_id',$uid)->get();
        $address=$address?$address->toArray():[];
        $topaddress=Region::where('parent_id',0)->get();
        //dd($topaddress);
        $goods=Cart::leftjoin('p_goods','p_cart.goods_id','=','p_goods.goods_id')
        ->whereIn('p_cart.id',$cart_id)
        ->get();
        //dd($goods);
        $total=0;
        foreach($goods as $k=>$v){
            $total += $v->shop_price * $v->goods_num;
        }
        //dd($total);
        $total=number_format($total,2,'.','');
        //dd($total);
        return view('index.ement',['address'=>$address,'topaddress'=>$topaddress,'goods'=>$goods,'total'=>$total]);
    }
    //获取子地区
    public function getsonaddress(Request $request){
        $region_id = $request->region_id;
        // dd($region_id);
        $address = Region::where('parent_id',$region_id)->get();
        // dd($address);
        //return json_encode(['ok',['data'=>$address]]);
        return json_encode(['code'=>0,'msg'=>'ok','data'=>$address]);
    }
    //用户收货地址添加 展示
    public function useraddressadd(Request $request){
        $useraddress = $request->all();
        // dd($useraddress);
        $useraddress['user_id'] = session('login')->id;
        // dd($useraddress);

        $res = User_address::create($useraddress);

        if($request->ajax()){
            $address = User_address::where('user_id',$useraddress)->get();
            return view('index/useraddress',['address'=>$address]);
        }
    }
    public function pay(){
        return view('index.pay');
    }
}

<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User_address;
use App\Model\Region;
use App\Model\Cart;
use App\Model\Order_info;
use App\Model\Order_goods;
use App\Model\Goods;
use Illuminate\Support\Facades\DB;
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
    //订单
    public function order(Request $request){
        //事务
    DB::beginTransaction();
        try {
        $data = $request->except('_token');
        //dd($data);
        $rec_id = $data['rec_id'];
        $data['order_sn'] = $this->createOrderSn();
        $data['user_id'] = session('login')->id;
        if($data['address_id']){
            $useraddress = User_address::where('address_id',$data['address_id'])->first();//查询订单地址表
            $useraddress = $useraddress?$useraddress->toArray():[];//将对象转化为数组
        }
        $data = array_merge($data,$useraddress);//array_merge讲两个数合并为一个数组
        $pay_name = ['1'=>'微信','2'=>'支付宝','3'=>'货到付款'];//支付方式接值
        $data['pay_name'] = $pay_name[$data['pay_type']];
        $data['goods_price'] = Cart::getprice($data['rec_id']);
        $data['order_price'] = $data['goods_price'];
        $data['addtime'] = time();
        unset($data['address_id']);
        unset($data['is_default']);
        unset($data['rec_id']);
        unset($data['address_name']);
        // unset($data['user_id']);
        //添加入库订单表 获取订单id
        $order_id = Order_info::insertGetId($data);
        // dd($order_id);

        //订单商品表入库

        if(is_string($rec_id)){
            $rec_id = explode(',',$rec_id);
        }
        $goods = Cart::select('p_cart.*','p_goods.goods_img')->leftjoin('p_goods','p_cart.goods_id','=','p_goods.goods_id')->whereIn('id',$rec_id)->get();//查询购物车表和商品表
        $goods = $goods?$goods->toArray():[];//将对象转化为数组
        foreach($goods as $k=>$v){
            $goods[$k]['order_id'] = $order_id;
            $goods[$k]['buy_number'] = $v['goods_num'];
            $goods[$k]['shop_price'] = Goods::where('goods_id',$v['goods_id'])->value('shop_price');
            //删除多余参数
            unset($goods[$k]['rec_id']);
            unset($goods[$k]['uid']);
            unset($goods[$k]['add_time']);
            unset($goods[$k]['id']);
            unset($goods[$k]['goods_num']);
            unset($goods[$k]['is_delete']);
        }
        $res = Order_goods::insert($goods);
        if($res){
            // dump('拿下！');
            //清除购物车数据
            Cart::destroy($rec_id);
            foreach($goods as $k=>$v){
                //利用decrement递减清除购物车
                Goods::where('goods_id',$v['goods_id'])->decrement('goods_number',$v['buy_number']);
            }
        }

        DB::commit();

        return redirect('/pay/'.$order_id );
        } catch (\Throwable $e) {
            return $e->getMessage();
            DB::rollBack();
        }
    }
    //生成货号
    public function createOrderSn(){
        $order_sn =  date('YmdHis').rand(1000,9999);
        if($this->isHaveOrdersn($order_sn)){
            $this->createOrderSn();
        }
        return $order_sn;
    }

    //判断货号是否重复
    public function isHaveOrdersn($order_sn){
        return Order_info::where('order_sn',$order_sn)->count();
    }
    //支付
    public function pay(){
        return view('index.pay');
    }
}

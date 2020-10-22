<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Cart extends Model
{
    //
    protected $table = 'p_cart';
    public $timestamps = false;
    protected $guarded = [];   //黑名单  create只需要开启
    public static function getprice($cart_id){
        if(is_array($cart_id)){
            $cart_id = implode(',',$cart_id);
        }

        //dd($cart_id);
        //$total = DB::select("select sum(goods_num*shop_price) as total from p_cart leftjoin p_goods on p_goods.goods_id=p_cart.goods_id where rec_id in($cart_id)");
        $total = DB::select("select sum(goods_num*shop_price) as total from p_cart inner join p_goods on p_goods.goods_id=p_cart.goods_id where id in($cart_id)");

        $total = $total?$total[0]->total:0;
        return $total;
    }
}

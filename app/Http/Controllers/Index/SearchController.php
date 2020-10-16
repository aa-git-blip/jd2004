<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use Illuminate\Support\Facades\Redis;
class SearchController extends Controller
{
    //列表
    function search(){
        $pageSize=config('app.pageSize');
        $data=Goods::paginate($pageSize);
        return view('index.search',['data'=>$data]);
    }
    function seckill($goods_id){
        // Redis::flushall();
        // die;
        $goods=Redis::get('goods_'.$goods_id);
        if(!$goods){
            $goods=Goods::find($goods_id);
            $goods = serialize($goods);
            Redis::setex('goods_'.$goods_id,3600,$goods);
        }
        $goods=unserialize($goods);
        // dd($goods);
        return view('index.seckill',['goods'=>$goods]);
    }
}

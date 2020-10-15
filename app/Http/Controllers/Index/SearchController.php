<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
class SearchController extends Controller
{
    //
    function search(){
        $pageSize=config('app.pageSize');
        $data=Goods::paginate($pageSize);
        return view('index.search',['data'=>$data]);
    }
    function seckill($goods_id){
        $goods=Goods::find($goods_id);
        //dd($goods);
        return view('index.seckill',['goods'=>$goods]);
    }
}

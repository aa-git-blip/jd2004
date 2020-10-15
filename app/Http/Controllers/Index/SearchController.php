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
    function seckill(){

        return view('index.seckill');
    }
}

<?php

namespace App\Http\Controllers\Index;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Comment;
class IndexController extends Controller
{
    //
    function index(){
        // dd(Redis::lrange('logtime10',0,-1));
        $visitgoods=Redis::zrevrange('visit',0,6);//获取到前六条喜欢
        // dd($visitgoods);
        $hot=[];//定义一个空数组
        //if判断$visitgoods有无值
        if($visitgoods){
            $goods_id=[];//空数组用来存入商品id
            //foreach循环Redis的值
            foreach($visitgoods as $v){
                //根据下划线将字符串分隔成数组
                $arr=explode('_',$v);
                // dd($arr);
                //获取到商品id
                $goods_id[]=$arr[1];
            }
            // dd($goods_id);
            $hot=Goods::whereIn('goods_id',$goods_id)->get();//根据商品id查询商品表
            // dd($hot);
            $hot=$hot?$hot->toArray():[];//转化数组

        }
        return view('index.index',compact('hot'));//compact传值
    }
    //评论
    function comment(){
        $goods_id=request()->goods_id;
        $comment_desc=request()->comment_desc;

        // dd($data);
        $uid=session('login')->id;
        //dd($uid);
        $data=[
            'goods_id'=>$goods_id,
            'comment_desc'=>$comment_desc,
            'uid'=>$uid,
            'time'=>time()
        ];
        $res = Comment::insert($data);

        $comment = Comment::where('goods_id',$goods_id)->get();
        // dd($comment);

        // dd($data);
    }
}

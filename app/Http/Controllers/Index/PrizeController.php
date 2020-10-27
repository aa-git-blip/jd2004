<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Prize;
class PrizeController extends Controller
{
    //
    function prize(){
        return view('index.prize');
    }
    function add(){
        //取出用户id
        $uid=session('login')->id;
        if(empty($uid)){
            $response=[
                'error'=>40003,
                'msg'=>"未登录"
            ];
            return $response;
        }
        //检测用户当天有没有抽奖
        $time1=strtotime(date('Y-m-d'));
        $res=Prize::where(['uid'=>$uid])->where('add_time','>=',$time1)->first();
        if($res){
            $response=[
                'error'=>30000,
                'msg'=>'您今天抽奖次数达到上限,他妈的明天再来吧'
            ];
            return $response;
        }
        $rand=mt_rand(1,10000);
        //echo $rand;
        $level=0;
        if($rand>=1 && $rand<=10){
            $level=1;
        }else if($rand>=200 && $rand<=800){
            $level=2;
        }if($rand>=7000 && $rand<=10000){
            $level=3;
        }
        //记录抽奖信息
        $prize_data=[
            'uid'=>$uid,
            'level'=>$level,
            'add_time'=>time()
        ];
        $pid=Prize::insert($prize_data);
        if($pid>0){
            $data=[
                    'error'=>0,
                    'msg'=>'ok',
                    'data'=>[
                        'level'=>$level
                    ]
            ];
        }else{
            //异常
            $data=[
                'error'=>'2000',
                'msg'=>"数据异常"
            ];
        }

        return $data;




        // if($rand==8888){
        //     echo "你他吗中奖了";
        // }else{
        //     echo "谢谢您的参与";
        // }
    }
}

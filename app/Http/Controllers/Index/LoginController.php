<?php

namespace App\Http\Controllers\Index;
use App\UserModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
class LoginController extends Controller
{
    //
    function reg(){
        return view('index.register');
    }
    function regdo(Request $request){
        //验证器可用     不需要make参数
        $validator = Validator($request->all(),[
            'name' => 'required|unique:user',
            'password' => 'required',
            'email' => 'required|unique:user',
            'tel' => 'required|unique:user',
        ],[
                'name.required'=>'用户名称必填',
                'name.unique'=>'用户已存在',
                'password.required'=>'密码必填',
                'email.required'=>'邮箱必填',
                'email.unique'=>'邮箱已存在',
                'tel.required'=>'手机号必填',
                'tel.unique'=>'手机号已存在',
        ]);
        //表单验证
        if($validator->fails()){
            return redirect('/register')
            ->withErrors($validator)
            ->withInput();
        }
        $data=$request->except('_token');
        if($data['password']!=$data['repwd']){
            return redirect('login/reg')->with('msg','两次密码不一致');
        }
        //使用函数password_hash给密码加密
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['last_login']=$_SERVER['REMOTE_ADDR'];
        $data['time']=time();
        //删除多余参数
        unset($data['repwd']);
        unset($data['m1']);
        //添加入库
        $res=UserModel::insert($data);
        if($res){
            return redirect('/login');
        }
    }
    //登录视图
    function login(){
        return view('index.login');
    }
    //登录方法
    function logindo(Request $request){
        $post=$request->except('_token');
        // dd($post);
        //判断账号是否为空  如果为空    返回登录页面
        if($post['name']==''){
            return redirect('/login')->with('msg','非法操作');
        }
        //dd($post);
        $add=$_SERVER['REMOTE_ADDR'];//接收登录IP
        $reg='/^1[3|4|5|6|7|8|9]\d{9}$/';//手机号正则
        $reg_email='/^\w{3,}@([a-z]{2,7}|[0-9]{3})\.(com|cn)$/';//邮箱正则
        //使用三种方法登录 手机号  邮箱  用户名
        if(preg_match($reg,$post['name'])){
            $where=[
                ['tel',"=",$post['name']]
            ];
        }else if(preg_match($reg_email,$post['name'])){
            $where=[
                ['email',"=",$post['name']]
            ];
        }else{
            $where=[
                ['name',"=",$post['name']]
            ];
        }
        //查询用户名下的所有数据
        $user = UserModel::where($where)->first();
        if(!$user){
            return redirect('/login')->with('msg','用户不存在');
        }
        //dd($user);
        //判断
        $count=Redis::get($user['id']);
        //$login_time = ceil(Redis::TTL("login_time:".$user->id) / 60);
            //记录锁定时间
            $out_time=(ceil((Redis::TTL($user['id'])/60)));
            //判断错误次数
            if($count>=5){
                    return redirect('/login')->with('msg','密码错误次数过多,请'.$out_time.'分钟后在来');
            }

        if(!password_verify($post['password'], $user['password'])){
            //用redis自增记录错误次数
            Redis::incr($user->id);
            $count=Redis::get($user->id);
            //判断错误次数
            if($count>=5){
                //时间限制
                Redis::SETEX($user->id,60*60,5);
                    return redirect('/login')->with('msg','密码错误次数过多,请一个小时候在来');
            }
            return redirect('/login')->with('msg','密码错误'.$count.'次，五次后锁定一小时');
        }
        //将时间和IP转化为数组
        $data=[
            'last_login'=>time(),
            'login_ip'=>$add
        ];
        //使用修改方式将数据添加到表中
        $res = UserModel::where('id',$user['id'])->update($data);
        //存入session
        session(['login'=>$user]);
        Redis::rpush('logtime'.$user->id,time());
        // dd(request()->refer);
        if(request()->refer){
            return redirect(request()->refer);
        }
        return redirect('/');
    }
    //退出方式
    function outlogin(){
        //删除session里的值     实现退出功能
        session(['login'=>null]);
        return redirect('/login');
    }
}

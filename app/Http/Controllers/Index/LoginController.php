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
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['last_login']=$_SERVER['REMOTE_ADDR'];
        $data['time']=time();
        unset($data['repwd']);
        unset($data['m1']);
        $res=UserModel::insert($data);
        //发送激活码
        // $active_code=Str::random(64);
        // $redis_active_key='ss:user:active';
        // Redis::zAdd($redis_active_key,$res,$active_code);
        // $active_url=env('APP_URL').'/active?code='.$active_code;
        // echo $active_url;die;
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
        if($post['name']==''){
            return redirect('/login')->with('msg','非法操作');
        }
        //dd($post);
        $add=$_SERVER['REMOTE_ADDR'];
        $reg='/^1[3|4|5|6|7|8|9]\d{9}$/';
        $reg_email='/^\w{3,}@([a-z]{2,7}|[0-9]{3})\.(com|cn)$/';
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
        $user = UserModel::where($where)->first();
        if(!$user){
            return redirect('/login')->with('msg','用户不存在');
        }
        //dd($user);
        //判断
            $count=Redis::get($user['id']);
        //$login_time = ceil(Redis::TTL("login_time:".$user->id) / 60);
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
                Redis::SETEX($user->id,60*60,5);
                    return redirect('/login')->with('msg','密码错误次数过多,请一个小时候在来');
            }
            return redirect('/login')->with('msg','密码错误'.$count.'次，五次后锁定一小时');
        }
        $data=[
            'last_login'=>time(),
            'login_ip'=>$add
        ];
        $res = UserModel::where('id',$user['id'])->update($data);
        session(['login'=>$user]);
        Redis::rpush('logtime'.$user->id,time());
        // dd(request()->refer);
        if(request()->refer){
            return redirect(request()->refer);
        }
        return redirect('/');
    }
    function outlogin(){
        session(['login'=>null]);
        return redirect('/login');
    }
    //激活码修改
    // function active(Request $request){
    //     $active_code=$request->get('code');
    //     echo "激活码".$active_code;
    //     $redis_active_key='ss:user:active';
    //     $id=Redis::zScore($redis_active_key,$active_code);
    //     echo "<br>"."id:".$id;
    //     UserModel::where(['id'=>$id])->update(['is_validated'=>1]);
    //     echo "<br>"."激活成功";
    // }
}

@extends('layouts.shop')
@section('title','注册')
@section('name')

	<div class="register py-container ">
		<!--head-->
		<div class="logoArea">
			<a href="" class="logo"></a>
		</div>
		<!--register-->
		<div class="registerArea">
			<h3>注册新用户<span class="go">我有账号，去<a href="{{url('/login')}}" >登陆</a></span></h3>
			<div class="info">
                {{session('msg')}}
                @if ($errors->any())
            <div class="alert alert-danger">
                    <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                    </ul>
            </div>
            @endif
            <form class="sui-form form-horizontal" action="{{url('login/regdo')}}" method="get">
                @csrf
					<div class="control-group">
						<label class="control-label">用户名：</label>
						<div class="controls">
							<input type="text" name="name" placeholder="请输入你的用户名" class="input-xfat input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label for="inputPassword" class="control-label">登录密码：</label>
						<div class="controls">
							<input type="password" name="password" placeholder="设置登录密码" class="input-xfat input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label for="inputPassword"  class="control-label">确认密码：</label>
						<div class="controls">
							<input type="password" name="repwd" placeholder="再次确认密码" class="input-xfat input-xlarge">
						</div>
					</div>
                    <div class="control-group">
						<label class="control-label">邮箱号：</label>
						<div class="controls">
							<input type="text" name="email" placeholder="设置邮箱" class="input-xfat input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">手机号：</label>
						<div class="controls">
							<input type="text" name="tel" placeholder="请输入你的手机号" class="input-xfat input-xlarge">
						</div>
					</div>
					{{-- <div class="control-group">
						<label for="inputPassword" class="control-label">短信验证码：</label>
						<div class="controls">
							<input type="text" placeholder="短信验证码" class="input-xfat input-xlarge">  <a href="#">获取短信验证码</a>
						</div>
					</div> --}}

					<div class="control-group">
						<label for="inputPassword" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<div class="controls">
							<input name="m1" type="checkbox" value="2" checked=""><span>同意协议并注册《品优购用户协议》</span>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"></label>
						<div class="controls btn-reg">
							<input type="submit" class="sui-btn btn-block btn-xlarge btn-danger" target="_blank" value="注册 ">
						</div>
					</div>
				</form>
				<div class="clearfix"></div>
			</div>
		</div>
@endsection


@extends('layouts.cartadd')
@section('title','购物车')
@section('cartadd')


		<!--All goods-->
		<div class="allgoods">
			<h4>全部商品<span>11</span></h4>
			<div class="cart-main">
				<div class="yui3-g cart-th">
					<div class="yui3-u-1-4"><input type="checkbox" name="" id="" value="" /> 全部</div>
					<div class="yui3-u-1-4">商品</div>
					<div class="yui3-u-1-8">单价（元）</div>
					<div class="yui3-u-1-8">数量</div>
					<div class="yui3-u-1-8">小计（元）</div>
					<div class="yui3-u-1-8">操作</div>
				</div>
				<div class="cart-item-list">
					<div class="cart-shop">
						<input type="checkbox" name="" id="" value="" />
						<span class="shopname self">传智自营</span>
					</div>
					<div class="cart-body">
                        @foreach ($goods as $v)
                            <div class="cart-list">
                                <ul class="goods-list yui3-g">
                                    <li class="yui3-u-1-24">
                                        <input type="checkbox" name="" id="" class="cartid" value="{{$v->id}}" />
                                    </li>
                                    <li class="yui3-u-11-24">
                                        <div class="good-item">
                                        <div class="item-img"><img src="/upload/{{$v->goods_img}}" /></div>
                                        <div class="item-msg">{{$v->goods_name}}</div>
                                        </div>
                                    </li>

                                <li class="yui3-u-1-8"><span class="price">{{$v->shop_price}}</span></li>
                                    <li class="yui3-u-1-8">
                                        <a href="javascript:void(0)" class="increment mins">-</a>
                                        <input autocomplete="off" type="text" value="{{$v->goods_num}}" minnum="1" class="itxt" />
                                        <a href="javascript:void(0)" class="increment plus">+</a>
                                    </li>
                                    <li class="yui3-u-1-8"><span class="sum">{{$v->goods_num * $v->shop_price}}.00</span></li>
                                    <li class="yui3-u-1-8">
                                        <a href="#none">删除</a><br />
                                        <a href="#none">移到我的关注</a>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
					</div>
				</div>
			</div>
			<div class="cart-tool">
				<div class="select-all">
					<input type="checkbox" name="" id="" value="" />
					<span>全选</span>
				</div>
				<div class="option">
					<a href="#none">删除选中的商品</a>
					<a href="#none">移到我的关注</a>
					<a href="#none">清除下柜商品</a>
				</div>
				<div class="toolbar">
					<div class="chosed">已选择<span>0</span>件商品</div>
					<div class="sumprice">
						<span><em>总价（100运费） ：</em><i class="summoney">¥16283.00</i></span>
						<span><em>已加：</em><i>300元</i></span>
					</div>
					<div class="sumbtn">
                        <a class="sum-btn" >结算</a>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- 底部栏位 -->
    <!--页面底部-->
    <script type="text/javascript" src="/static/js/plugins/jquery/jquery.min.js"></script>
<script>
    $('.sum-btn').click(function(){
        var cart_id=new Array();
        $('.cartid:checked').each(function(){
            cart_id.push($(this).val());
        })
        if(!cart_id.length){
            alert('你个傻逼不选商品咋结算');
            return;
        }
        if(cart_id){
            location.href="/ement?cart_id="+cart_id;
        }
    })
</script>
    @endsection



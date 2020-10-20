
@extends('layouts.show')
@section('title','首页')
@section('show')


<script type="text/javascript" src="/static/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/static/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/static/js/plugins/jquery-placeholder/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="/static/js/widget/nav.js"></script>
</body>
    <!--header-->
    <div id="account">
        <div class="py-container">
            <div class="yui3-g home">
                <!--左侧列表-->
                <div class="yui3-u-1-6 list">

                    <div class="person-info">
                        <div class="person-photo"><img src="/static/img/_/photo.png" alt=""></div>
                        <div class="person-account">
                            <span class="name">Michelle</span>
                            <span class="safe">账户安全</span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                     <div class="list-items">
                        <dl>
							<dt><i>·</i> 订单中心</dt>
							<dd ><a href="home-index.html"   >我的订单</a></dd>
							<dd><a href="home-order-pay.html" class="list-active">待付款</a></dd>
							<dd><a href="home-order-send.html"  >待发货</a></dd>
							<dd><a href="home-order-receive.html" >待收货</a></dd>
							<dd><a href="home-order-evaluate.html" >待评价</a></dd>
						</dl>
						<dl>
							<dt><i>·</i> 我的中心</dt>
							<dd><a href="home-person-collect.html">我的收藏</a></dd>
							<dd><a href="home-person-footmark.html">我的足迹</a></dd>
						</dl>
						<dl>
							<dt><i>·</i> 物流消息</dt>
						</dl>
						<dl>
							<dt><i>·</i> 设置</dt>
							<dd><a href="home-setting-info.html">个人信息</a></dd>
							<dd><a href="home-setting-address.html"  >地址管理</a></dd>
							<dd><a href="home-setting-safe.html" >安全管理</a></dd>
						</dl>
                    </div>
                </div>
                <!--右侧主内容-->
                <div class="yui3-u-5-6 order-pay">
                    <div class="body">
                        <div class="table-title">
                            <table class="sui-table  order-table">
                                <tr>
                                    <thead>
                                        <th width="35%">宝贝</th>
                                        <th width="5%">单价</th>
                                        <th width="5%">数量</th>
                                        <th width="8%">商品操作</th>
                                        <th width="10%">实付款</th>
                                        <th width="10%">交易状态</th>
                                        <th width="10%">交易操作</th>
                                    </thead>
                                </tr>
                            </table>
                        </div>

                        <div class="order-detail">
                            <div class="orders">
                                <div class="choose-order">
                                    <label data-toggle="checkbox" class="checkbox-pretty checked">
                                        <input type="checkbox" checked="checked"><span>全选</span>
                                    </label>
                                    <a href="" class="sui-btn btn-info btn-bordered hepay-btn">合并付款</a>
                                    <div class="sui-pagination pagination-large top-pages">
                                        <ul>
                                            <li class="prev disabled"><a href="#">上一页</a></li>

                                            <li class="next"><a href="#">下一页</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="choose-title">
                                    <label data-toggle="checkbox" class="checkbox-pretty ">
                                           <input type="checkbox" checked="checked"><span>2017-02-11 11:59　订单编号：7867473872181848  店铺：哇哈哈 <a>和我联系</a></span>
                                     </label>
                                    <a class="sui-btn btn-info share-btn">分享</a>
                                </div>
                                <table class="sui-table table-bordered order-datatable">

                                    <tbody>
                                        <tr>
                                            <td width="35%">
                                                <div class="typographic"><img src="/static/img/goods.png" />
                                                    <a href="#" class="block-text">包邮 正品玛姬儿压缩面膜无纺布纸膜100粒 送泡瓶面膜刷喷瓶 新款</a>
                                                    <span class="guige">规格：温泉喷雾150ml</span>
                                                </div>
                                            </td>
                                            <td width="5%" class="center">
                                                <ul class="unstyled">
                                                    <li class="o-price">¥599.00</li>
                                                    <li>¥299.00</li>
                                                </ul>
                                            </td>
                                            <td width="5%" class="center">1</td>
                                            <td width="8%" class="center"></td>
                                            <td width="10%" class="center">
                                                <ul class="unstyled">
                                                    <li>¥299.00</li>
                                                    <li>（含运费：￥0.00）</li>
                                                </ul>
                                            </td>
                                            <td width="10%" class="center">
                                                <ul class="unstyled">
                                                    <li>等待买家付款</li>
                                                    <li><a href="orderDetail.html" class="btn">订单详情 </a></li>
                                                </ul>


                                            </td>
                                            <td width="10%" class="center">
                                                <ul class="unstyled">
                                                    <li><a href="#" class="sui-btn btn-info">立即付款</a></li>
                                                    <li><a href="#">取消订单</a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                            <div class="choose-order">
                                <label data-toggle="checkbox" class="checkbox-pretty checked">
                                        <input type="checkbox" checked="checked"><span>全选</span>
                                    </label>
                                <a href="" class="sui-btn btn-info btn-bordered hepay-btn">合并付款</a>
                                <div class="sui-pagination pagination-large top-pages">
                                    <ul>
                                        <li class="prev disabled"><a href="#">«上一页</a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li class="dotted"><span>...</span></li>
                                        <li class="next"><a href="#">下一页»</a></li>
                                    </ul>
                                    <div><span>共10页&nbsp;</span><span>
                                            到
                                            <input type="text" class="page-num"><button class="page-confirm" onclick="alert(1)">确定</button>
                                            页</span></div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 底部栏位 -->
    <!--页面底部-->
    @endsection

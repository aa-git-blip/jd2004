<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','Index\IndexController@index');//首页
Route::get('/login','Index\LoginController@login');//登录页面
Route::get('/register','Index\LoginController@reg');//注册页面
Route::get('/login/regdo','Index\LoginController@regdo');//注册方法
Route::get('login/logindo','Index\LoginController@logindo');//登录方法
Route::get('search','Index\SearchController@search');//列表页
Route::get('seckill/{goods_id}','Index\SearchController@seckill');//商品详情页
Route::get('/outlogin','Index\LoginController@outlogin');
Route::get('/active','Index\LoginController@active');
Route::get('/cartdo','Index\CartController@cartdo');
Route::get('/cart','Index\CartController@cart');
Route::get('/ement','Index\EmentController@ement');
Route::get('/pay','Index\EmentController@pay');

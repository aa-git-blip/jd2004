<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    $router->get('/index', 'HomeController@index')->name('home');
    $router->resource('users', UserController::class);
    $router->resource('category', CategoryController::class);
    $router->resource('goods', GoodsController::class);
});

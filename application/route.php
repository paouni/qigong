<?php
use think\Route;
// 注册路由到index模块的 index 控制器的 category 操作
Route::rule('tour/:id','goods/item');
Route::rule('login','user/login');
Route::rule('logout','user/logout');
Route::rule('register','user/register');
Route::rule('article/:id','index/article');
Route::rule('api','api/request');           //接收智游宝 完结\退票 通知接口

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];

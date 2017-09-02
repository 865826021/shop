<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['domain' => 'mulanshouyao.cn'], function () {
    require __DIR__.'/admin_routes.php';
	Route::match(['get', 'post'],'/appIndex', 'Home\AppIndexController@appIndex');
	Route::match(['get', 'post'],'/categoryIndex', 'Home\AppIndexController@categoryIndex');
	Route::match(['get', 'post'],'/getProductByCid', 'Home\AppIndexController@getProductByCid');
});

Route::group(['domain' => 'www.shop.com'], function () {

    Route::resource('/', 'Home\IndexController');
    Route::resource('/user', 'Home\UserController');
    Route::resource('/test', 'TestController');
    Route::resource('/fasongcode', 'TestController@fasongcode');
    //文章显示
    Route::get('/article/{art_id}', 'Home\IndexController@show');
    //分类显示
    Route::get('/list/{cate_id}', 'Home\IndexController@lists');
    //搜索
    Route::post('/search', 'Home\IndexController@search');
});
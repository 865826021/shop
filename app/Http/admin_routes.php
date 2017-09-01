<?php

//后台路由
Route::resource('/admin/login', 'Admin\LoginController');
//验证码
Route::get('/code/captcha/{tmp}', 'Admin\LoginController@captcha');

Route::group(['middleware' => 'AdminLoginMiddleware'], function () {
    //后台首页
    Route::resource('/', 'Admin\IndexController@index');
    Route::resource('/index', 'Admin\IndexController@index');
    //管理员管理
    Route::get('/editAdminUser', 'Admin\AdminUserController@edit');
    Route::post('/updateAdminUser', 'Admin\AdminUserController@update');
    //个人用户管理
    //Route::resource('/user', 'Admin\UserController');
    Route::get('/user', 'Admin\UserController@index');
    Route::get('/user/edit/{user_id}', 'Admin\UserController@edit');
    Route::post('/user/update', 'Admin\UserController@update');
    Route::get('/user/destroy/{user_id}', 'Admin\UserController@destroy');
    //退出后台
    Route::get('/admin/logout', 'Admin\LoginController@logout');
    //文章管理
    //Route::resource('/article', 'Admin\ArticleController');
    Route::get('/article/index', 'Admin\ArticleController@index');
    Route::get('/article/edit/{art_id}', 'Admin\ArticleController@edit');
    Route::get('/article/create', 'Admin\ArticleController@create');
    Route::post('/article/store', 'Admin\ArticleController@store');
    Route::post('/article/update', 'Admin\ArticleController@update');
    Route::get('/article/destroy/{art_id}', 'Admin\ArticleController@destroy');
    //链接管理
    //Route::resource('/links', 'Admin\LinksController');
    Route::get('/links/index', 'Admin\LinksController@index');
    Route::get('/links/edit/{art_id}', 'Admin\LinksController@edit');
    Route::get('/links/create', 'Admin\LinksController@create');
    Route::post('/links/store', 'Admin\LinksController@store');
    Route::post('/links/update', 'Admin\LinksController@update');
    Route::get('/links/destroy/{art_id}', 'Admin\LinksController@destroy');
    //RBAC权限管理
    //角色
    Route::get('/rbacRole', 'Admin\RbacController@rbacRole');
    Route::get('/addRole', 'Admin\RbacController@addRole');
    Route::post('/addRoleStore', 'Admin\RbacController@addRoleStore');
    //节点
    Route::get('/rbacNode', 'Admin\RbacController@rbacNode');
    Route::get('/addNode', 'Admin\RbacController@addNode');
    Route::post('/addNodeStore', 'Admin\RbacController@addNodeStore');
    //权限
    Route::get('/access/{role_id}', 'Admin\RbacController@access');
    Route::post('/setAccess', 'Admin\RbacController@setAccess');
    //用户
    Route::get('/rbacUser', 'Admin\RbacController@rbacUser');
    Route::get('/addUser', 'Admin\RbacController@addUser');
    Route::post('/addUserStore', 'Admin\RbacController@addUserStore');



});



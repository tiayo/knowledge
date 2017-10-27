<?php

//默认首页
$this->get('/', function () {
    return redirect()->route('home');
});

//密码
$this->get('password', function () {
    return bcrypt('123456');
});

//验证码
$this->get('/captcha/{group}', 'CaptchaController@captcha')->name('captcha');

//登录模块
$this->get('logout', 'Auth\LoginController@logout')->name('logout');
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');

//登录后模块
$this->group(['middleware' => 'auth'], function () {

    //登录后首页
    $this->get('home', 'HomeController@index')->name('home');

    //添加/修改账号信息
    $this->get('/user/list/', 'UserController@listView')->name('user_list');
    $this->get('/user/list/{keyword}', 'UserController@listView')->name('user_search');
    $this->get('/user/update/{id}', 'UserController@updateView')->name('user_update');
    $this->post('/user/update/{id}', 'UserController@post');

    $this->group(['middleware' => 'admin'], function () {
        $this->get('/user/add', 'UserController@addView')->name('user_add');
        $this->post('/user/add', 'UserController@post');
        $this->get('/user/destroy/{id}', 'UserController@destroy')->name('user_destroy');
    });

    //栏目
    $this->get('/category/list/', 'CategoryController@listView')->name('category_list');
    $this->get('/category/add', 'CategoryController@addView')->name('category_add');
    $this->post('/category/add', 'CategoryController@post');
    $this->get('/category/update/{id}', 'CategoryController@updateView')->name('category_update');
    $this->post('/category/update/{id}', 'CategoryController@post');
    $this->get('/category/destroy/{id}', 'CategoryController@destroy')->name('category_destroy');

    //文章
    $this->get('/knowledge/article/{id}', 'KnowledgeController@view')->name('knowledge_view');
    $this->get('/knowledge/list/', 'KnowledgeController@listView')->name('knowledge_list');
    $this->get('/knowledge/list/{keyword}', 'KnowledgeController@listView')->name('knowledge_search');
    $this->get('/knowledge/category/{category_id}', 'KnowledgeController@categoryView')->name('knowledge_category');
    $this->get('/knowledge/add', 'KnowledgeController@addView')->name('knowledge_add');
    $this->post('/knowledge/add', 'KnowledgeController@post');
    $this->get('/knowledge/update/{id}', 'KnowledgeController@updateView')->name('knowledge_update');
    $this->post('/knowledge/update/{id}', 'KnowledgeController@post');
    $this->get('/knowledge/destroy/{id}', 'KnowledgeController@destroy')->name('knowledge_destroy');

});




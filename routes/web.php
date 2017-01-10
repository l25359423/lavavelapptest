<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// get
Route::get('/', function (){
    return view('welcome');
});

/*
// get
Route::get('testGet', function (){
    return "Test get success";
});

// post
Route::post('testPost', function (){
    return "Test Post success";
});

// 指定路由
Route::match(['get','post'],'testMatch', function() {
   return "Test match";
});

// 多请求路由：所有请求方式
Route::any('testAny', function() {
    return 'Test any';
});

// 路由参数
Route::get('user/{name?}/{id?}', function($name = 'liuxiaoshuai', $id = 4) {
   return $name . "-" .$id;
})->where(['id' => '[0-9]+', 'name' => '[a-zA-Z]+']);

// 路由别名
Route::get('member-center', ['as' => 'center', function(){
    return Route("center");
}]);

// 路由群组
Route::group(['prefix' => 'member'], function() {
    Route::any('testAny', function() {
        return 'Test any';
    });
});

// 路由view
Route::any("view", function() {
    return view('welcome');
});
*/

// 测试controller
Route::get('user/info/{id?}', [
    'uses' => 'userController@getUserInfo' ,
    'as' => 'userinfo'
])->where("id", "[0-9]+");

Route::get('insert', 'userController@testInsert');
Route::get('update', 'userController@testUpdate');
Route::get('delete', 'userController@testDelete');
Route::get('select', 'userController@testSelect');
Route::get('jh', 'userController@testJh');
Route::get('ormSelect', 'userController@ormSelect');
Route::get('ormInsert', 'userController@ormInsert');
Route::get('ormUpdate', 'userController@ormUpdate');
Route::get('ormDelete', 'userController@ormDelete');
Route::get('showUser', 'userController@showUser');
Route::get('url1Test', ['as'=>'url', 'uses' => 'userController@urlTest']);
Route::get('userinfo/request1','userController@request1');

Route::group(["middleware" => ['web']], function(){
    Route::any("session1",['uses' => "userController@session1"]);
    Route::any("session2",['uses' => "userController@session2"]);
});

Route::any("response","userController@response");
Route::any("testRedirect",['as'=> 'testRedirect','uses' => 'userController@testRedirect']);

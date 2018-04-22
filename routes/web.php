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

Route::get('/', function () {
    return view('welcome');
});

Route::any('home/login', 'Home\LoginController@login');
Route::any('home/code', 'Home\LoginController@code');


Route::any('admin/test', 'Admin\IndexController@test');
Route::any('admin/login', 'Admin\LoginController@login');
Route::get('admin/code', 'Admin\LoginController@code');

Route::group(['middleware' => ['web','admin.login']], function () {

    Route::get('admin/index', 'Admin\IndexController@index');
    Route::get('admin/info', 'Admin\IndexController@info');
    Route::get('admin/quit', 'Admin\LoginController@quit');
    Route::any('admin/pass', 'Admin\IndexController@pass');

    //后台管理模版
    Route::any('admin/index',['uses' => 'Admin\IndexController@index']);
//大楼管理资源路由
    Route::resource('admin/floor','Admin\FloorController');
//com_admin管理资源路由
    Route::resource('admin/com_admin','Admin\Com_adminController');
//节点管理资源路由
    Route::resource('admin/room','Admin\RoomController');

    Route::any('permit/index',['uses' => 'Admin\PermitController@index']);
    Route::any('permit/create',['uses' => 'Admin\PermitController@create']);
    Route::any('permit/getRoom',['uses' => 'Admin\PermitController@getRoom']);
    Route::any('permit/delete/{id}',['uses' => 'Admin\PermitController@delete']);
    Route::any('permit/update/{id}',['uses' => 'Admin\PermitController@update']);


    Route::any('ac_user/index',[ 'as'=>'ac_user/index'  ,'uses' => 'Admin\ac_userController@index']);
    Route::any('ac_user/save',[ 'as'=>'ac_user/save'  ,'uses' => 'Admin\ac_userController@save']);

    Route::any('ac_user/detail/{id}',[ 'as'=>'ac_user/detail'  ,'uses' => 'Admin\ac_userController@detail']);


    Route::any('ac_record/index',['as'=>'ac_record/index'  ,'uses' => 'Admin\ac_recordController@index']);
    Route::any('ac_record/text',['as'=>'ac_record/text'  ,'uses' => 'Admin\ac_recordController@text']);
    Route::any('ac_record/delete/{id}',[ 'as'=>'ac_record/delete'  ,'uses' => 'Admin\ac_recordController@delete']);


});




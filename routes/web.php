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

//user router for practice
Route::get('user/index', 'UserController@index');
Route::get('user/add', 'UserController@add');
Route::post('user/store', 'UserController@store');
Route::get('user/edit/{id}', 'UserController@edit');
Route::post('user/update', 'UserController@update');
Route::get('user/del/{id}', 'UserController@del');


//admin
Route::namespace('Admin')->group(function () {
    Route::get('admin/login', 'LoginController@index');
    Route::get('admin/code', 'LoginController@code');
    Route::post('admin/signIn', 'LoginController@signIn');
    Route::get('admin/encrypt', 'LoginController@encrypt');

    //group route below and create middleware for them, cause all they need to login in
    Route::group(['middleware'=>'isLogin'], function () {
        Route::get('admin/signOut','LoginController@signOut');
        Route::get('admin/index', 'IndexController@index');
        Route::get('admin/welcome', 'IndexController@welcome');
    });
});

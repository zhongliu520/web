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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('welcome', 'HomeController@welcome');
Route::get('index', 'IndexController@index');


Route::get('index', 'IndexController@index');


Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function(){

    Route::get('index', 'UserController@index');

    Route::post('login', 'UserController@login');

    Route::get('captcha-src', 'UserController@getCaptchaSrc');

    Route::get('logout', 'UserController@logout');

    Route::group(['middleware'=>['auth.user']], function(){

        Route::get('home', 'UserController@home');

        Route::get('meun/index', 'MeunController@index');

        Route::get('meun/list', 'MeunController@showList');
    });
});


//Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function(){
//
//    Route::get('check/code', 'CheackCodeController@index');
//
//});
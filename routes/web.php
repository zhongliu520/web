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

    Route::get('/index', 'UserController@index');

    Route::post('/login', 'UserController@login');

    Route::post('/logout', 'UserController@logout');

    Route::group(['middleware'=>['auth.user']], function(){

        Route::get('home', 'UserController@home');
    });
});


//Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function(){
//
//    Route::get('check/code', 'CheackCodeController@index');
//
//});
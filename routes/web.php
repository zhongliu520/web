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
    Route::get('captcha-src', 'UserController@getCaptchaSrc');

    Route::get('index', 'LoginController@index');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');

    Route::group(['middleware'=>['auth.user']], function(){

        Route::get('home', 'UserController@home');

        Route::group(['prefix' => 'meun'], function(){
            Route::get('index', function() {
                return view("admin.menu.index");
            });
        });

        Route::group(['prefix' => 'users'], function(){
            Route::get('index', function() {
                return view("admin.user.index");
            });
        });
    });


    Route::group(['middleware'=>["auth.ajax.user"]], function(){

        require __DIR__.'/admin/ajax/meun.php';
        require __DIR__.'/admin/ajax/users.php';
        require __DIR__.'/admin/ajax/file.php';
    });

});


//Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function(){
//
//    Route::get('check/code', 'CheackCodeController@index');
//
//});
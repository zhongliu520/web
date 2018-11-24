<?php


Route::group(['prefix' => 'users'], function(){

    Route::get('list', 'UserController@lists');
    Route::post('create', 'UserController@create');
});


<?php


Route::group(['prefix' => 'users'], function(){

    Route::get('list', 'UserController@lists');
});


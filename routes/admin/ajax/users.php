<?php


Route::group(['prefix' => 'users'], function(){

    Route::get('list', 'UserController@lists');
    Route::post('create', 'UserController@create');
    Route::post('save/{id}', 'UserController@save')->where("id", "[0-9]+");
});


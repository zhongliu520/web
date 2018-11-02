<?php


Route::group(['prefix' => 'meun'], function(){

    Route::post('list', 'MenuController@showList');

    Route::post('save/{id}', 'MenuController@save')->where(["id" => "[0-9]+"]);

    Route::get('update/status/{id}', 'MenuController@updateStatusById')->where(["id" => "[0-9]+"]);

    Route::get('delete/{id}', 'MenuController@deleteById')->where(["id" => "[0-9]+"]);
});


<?php

Route::group(['prefix' => 'file'], function(){

    Route::post('upload', 'FileController@upload');
});
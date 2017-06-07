<?php

Route::get('/',['uses'=>'IndexController@show','as'=>'home']);



Route::group(['middleware' => ['web']], function () {

    Route::resource('attributes', 'AttributesController');
    Route::get('attributes/{id}/delete', 'AttributesController@destroy');
    Route::post('attributes/{id}/update', 'AttributesController@update');

});
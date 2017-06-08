<?php

Route::get('/',['uses'=>'IndexController@show','as'=>'home']);



Route::group(['middleware' => ['web']], function () {
    Route::resource('attributes', 'AttributeController');
    Route::get('attributes/{id}/delete', 'AttributeController@destroy');
    Route::post('attributes/{id}/update', 'AttributeController@update');

    Route::resource('categories', 'CategoryController');
    Route::get('categories/{id}/delete', 'CategoryController@destroy');
    Route::post('categories/{id}/update', 'CategoryController@update');

    Route::resource('products', 'ProductController');
    Route::get('products/{id}/delete', 'ProductController@destroy');
    Route::post('products/{id}/update', 'ProductController@update');
});
<?php

Route::get('/', ['uses' => 'IndexController@show', 'as' => 'home']);
Route::get('/products/{id}', ['uses' => 'ProductController@showSingleProduct']);
Route::get('/categories/{id}', ['uses' => 'ProductController@showFromCategory']);
Route::get('/cart', ['uses' => 'CartController@show']);


Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'admin'], function () {
    Route::get('/', 'ProductController@index');

    Route::resource('attributes', 'AttributeController');
    Route::get('attributes/{id}/delete', 'AttributeController@destroy');
    Route::post('attributes/{id}/update', 'AttributeController@update');

    Route::resource('categories', 'CategoryController');
    Route::get('categories/{id}/delete', 'CategoryController@destroy');
    Route::post('categories/{id}/update', 'CategoryController@update');
    Route::post('categories/attributes/{id}', 'CategoryController@getAttributes');

    Route::resource('products', 'ProductController');
    Route::get('products/{id}/delete', 'ProductController@destroy');
    Route::post('products/{id}/update', 'ProductController@update');
});



Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    Route::get('users', function () {
        // Matches The "/admin/users" URL
    });
});


Route::group(['middleware' => ['web'], 'prefix' => 'api'], function () {
    Route::get('/addtocart/{id}', 'CartController@addProductToCart');
});

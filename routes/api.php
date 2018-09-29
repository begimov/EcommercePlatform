<?php

use Illuminate\Http\Request;

Route::resource('categories', 'Products\CategoryController');

Route::resource('products', 'Products\ProductController');

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function() {

    Route::post('register', 'RegisterController@register');

    Route::post('login', 'LoginController@login');

    Route::get('me', 'MeController@index');
    
});


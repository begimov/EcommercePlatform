<?php

use Illuminate\Http\Request;

Route::resource('categories', 'Products\CategoryController');

Route::resource('products', 'Products\ProductController');

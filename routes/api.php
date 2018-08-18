<?php

use Illuminate\Http\Request;

Route::get('/', function () {
    $categories = \App\Models\Products\Category::parents()->get();
    return $categories;
});

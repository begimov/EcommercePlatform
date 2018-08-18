<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Products\Category;
use App\Http\Resources\Products\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(
            Category::parents()
                ->ordered()
                ->with('children')
                ->get()
        );
    }
}

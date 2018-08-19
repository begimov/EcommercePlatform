<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Products\Category;
use App\Http\Resources\Products\CategoryResource;
use App\Repositories\Contracts\Products\CategoryRepository;

class CategoryController extends Controller
{
    protected $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }

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

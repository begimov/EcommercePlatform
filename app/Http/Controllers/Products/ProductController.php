<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Products\ProductRepository;

class ProductController extends Controller
{
    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }

    public function index()
    {
        $products = $this->products->get();
        dd($products);
    }
}

<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Products\ProductResource;
use App\Http\Resources\Products\ProductIndexResource;
use App\Repositories\Contracts\Products\ProductRepository;

class ProductController extends Controller
{
    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }

    public function index(Request $request)
    {
        $products = $this->products
            ->scope($request)
            ->paginate(10);
        
        return ProductIndexResource::collection($products);
    }

    public function show($slug)
    {
        $product = $this->products->getByRouteKeyName($slug);

        if (!$product) {
            return abort(404);
        }

        return new ProductResource($product);
    }
}

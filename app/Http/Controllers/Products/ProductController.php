<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\Criteria\With;
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
        $relations = ['variations', 'variations.stock', 'variations.product'];

        $product = $this->products
            ->withCriteria([
                new With($relations)
            ])
            ->getByRouteKeyName($slug);

        if (!$product) {
            return abort(404);
        }

        return new ProductResource($product);
    }
}

<?php

namespace App\Http\Controllers\Carts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Carts\CartStoreRequest;
use App\Services\App\Cart;
use App\Repositories\Contracts\Products\ProductVariationRepository;

class CartController extends Controller
{
    protected $productVariations;
    
    public function __construct(ProductVariationRepository $productVariations)
    {
        $this->productVariations = $productVariations;
        dd($productVariations);
    }

    public function store(CartStoreRequest $request, Cart $cart)
    {
        $cart->add($request->products);
    }

    public function update($productVariationId)
    {
        dd($productVariationId);
    }
}

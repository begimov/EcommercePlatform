<?php

namespace App\Http\Controllers\Carts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Carts\CartStoreRequest;
use App\Http\Requests\Carts\CartUpdateRequest;
use App\Services\App\Cart;
use App\Repositories\Contracts\Products\ProductVariationRepository;

class CartController extends Controller
{
    protected $productVariations;
    
    public function __construct(ProductVariationRepository $productVariations)
    {
        $this->productVariations = $productVariations;
    }

    public function store(CartStoreRequest $request, Cart $cart)
    {
        $cart->add($request->products);
    }

    public function update(CartUpdateRequest $request, $productVariationId, Cart $cart)
    {
        $productVariation = $this->productVariations->findById($productVariationId);

        if (!$productVariation) return abort(404);

        $cart->update($productVariationId, $request->quantity);
    }
}

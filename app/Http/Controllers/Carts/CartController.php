<?php

namespace App\Http\Controllers\Carts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Carts\CartStoreRequest;
use App\Http\Requests\Carts\CartUpdateRequest;
use App\Services\App\Cart;
use App\Repositories\Contracts\Products\ProductVariationRepository;
use App\Http\Resources\Carts\CartResource;

class CartController extends Controller
{
    protected $productVariations;
    
    public function __construct(ProductVariationRepository $productVariations)
    {
        $this->productVariations = $productVariations;
    }

    public function index(Request $request, Cart $cart)
    {
        $cart->sync();
        
        $request->user()->load([
                'cart.product', 'cart.product.variations.stock', 'cart.stock'
            ]);

        return (new CartResource($request->user()))
            ->additional([
                'meta' => $this->getMetaData($cart)
            ]);
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

    public function destroy($productVariationId, Cart $cart)
    {
        $productVariation = $this->productVariations->findById($productVariationId);

        if (!$productVariation) return abort(404);

        $cart->delete($productVariationId);
    }

    protected function getMetaData(Cart $cart)
    {
        return [
            'empty' => $cart->isEmpty(),
            'subtotal' => $cart->subtotal()->formatted(),
            'total' => $cart->total()->formatted(),
            'changed' => $cart->hasChanged()
        ];
    }
}

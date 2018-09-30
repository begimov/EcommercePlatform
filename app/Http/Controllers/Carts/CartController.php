<?php

namespace App\Http\Controllers\Carts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Carts\CartStoreRequest;

class CartController extends Controller
{
    public function store(CartStoreRequest $request)
    {
        $products = $this->processProducts($request->products);

        $request->user()->cart()->syncWithoutDetaching($products);
    }

    protected function processProducts(array $products)
    {
        return array_reduce($products, function($result, $product) {
            $result[$product['id']] = [
                'quantity' => $product['quantity']
            ];
            return $result;
        }, []);
    }
}

<?php

namespace App\Http\Controllers\Carts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Carts\CartStoreRequest;
use App\Services\App\Cart;

class CartController extends Controller
{
    public function store(CartStoreRequest $request, Cart $cart)
    {
        $cart->add($request->products);
    }

    
}

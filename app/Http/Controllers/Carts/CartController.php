<?php

namespace App\Http\Controllers\Carts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Carts\CartStoreRequest;

class CartController extends Controller
{
    public function store(CartStoreRequest $request)
    {
        return 1;
    }
}

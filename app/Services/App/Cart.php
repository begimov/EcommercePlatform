<?php

namespace App\Services\App;

use App\Models\User;

class Cart
{
    protected $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function add(array $products)
    {
        $this->user->cart()
            ->syncWithoutDetaching($this->processProducts($products));
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

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

    public function update($productId, $quantity)
    {
        $this->user->cart()
            ->updateExistingPivot($productId, [
                'quantity' => $quantity
            ]);
    }

    public function delete($productId)
    {
        $this->user->cart()->detach($productId);
    }

    public function empty()
    {
        $this->user->cart()->detach();
    }
    
    protected function processProducts(array $products)
    {
        return array_reduce($products, function($result, $product) {

            $result[$productId = $product['id']] = [

                'quantity' => $product['quantity'] + $this->getCurrentQuantity($productId)

            ];

            return $result;

        }, []);
    }

    protected function getCurrentQuantity($productId)
    {
        if ($product = $this->user->cart()->where('product_variation_id', $productId)->first()) {

            return $product->pivot->quantity;

        }
        return 0;
    }
}

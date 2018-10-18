<?php

namespace App\Services\App;

use App\Models\User;
use App\Services\App\Money;

class Cart
{
    protected $user;

    protected $hasChanged = false;
    
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

    public function isEmpty()
    {
        return $this->user->cart->sum('pivot.quantity') === 0;
    }

    public function subtotal()
    {
        $subtotal = $this->user->cart->sum(function($product) {
            return $product->price->amount() * $product->pivot->quantity;
        });

        return new Money($subtotal);
    }

    public function total()
    {
        return $this->subtotal();
    }

    public function sync()
    {
        $this->user->cart->each(function($product) {

            $availableQuantity = $product->availableStock($requestedQuantity = $product->pivot->quantity);

            if($availableQuantity != $requestedQuantity) {

                $this->hasChanged = true;

                $product->pivot->update(
                    ['quantity' => $availableQuantity]
                );
            }
        });
    }

    public function hasChanged()
    {
        return $this->hasChanged;
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

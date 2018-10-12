<?php

namespace App\Http\Resources\Carts;

use App\Services\App\Money;
use App\Http\Resources\Products\ProductIndexResource;
use App\Http\Resources\Products\ProductVariationResource;

class CartProductVariationResource extends ProductVariationResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $total = new Money(($quantity = $this->pivot->quantity) * $this->price->amount());
        
        return array_merge(parent::toArray($request), [
            'product' => new ProductIndexResource($this->product),
            'quantity' => $quantity,
            'total' => $total->formatted()
        ]);
    }
}

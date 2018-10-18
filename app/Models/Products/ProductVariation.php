<?php

namespace App\Models\Products;

use App\Models\Traits\HasPrice;
use Illuminate\Database\Eloquent\Model;
use App\Services\App\Money;

class ProductVariation extends Model
{
    use HasPrice;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function stock()
    {
        return $this->belongsToMany(
                ProductVariation::class, 
                'product_variations_stocks_view'
            )->withPivot(
                'stock',
                'in_stock'
            );
    }

    public function stockCount()
    {
        return $this->stock->sum('pivot.stock');
    }

    public function inStock()
    {
        return $this->stockCount() > 0;
    }

    public function availableStock($quantity)
    {
        return min($this->stockCount(), $quantity);
    }

    public function getPriceAttribute($price)
    {
        return !is_null($price) ? new Money($price) : $this->product->price;
    }

    public function priceDiffers()
    {
        return $this->price->amount() !== $this->product->price->amount();
    }
}

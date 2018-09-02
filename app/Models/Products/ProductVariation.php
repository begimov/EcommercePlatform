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

    public function getPriceAttribute($price)
    {
        return !is_null($price) ? new Money($price) : $this->product->price;
    }
}

<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

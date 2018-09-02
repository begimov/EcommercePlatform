<?php

namespace App\Models\Products;

use App\Models\Traits\HasPrice;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasPrice;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

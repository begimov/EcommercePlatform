<?php

namespace App\Models\Products;

use App\Models\Traits\HasPrice;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasPrice;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function stockCount()
    {
        return $this->variations->sum(function ($variation) {
            return $variation->stockCount();
        });
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }
}

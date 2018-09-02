<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function getPriceAttribute($price)
    {
        return new \Money\Money($price, new \Money\Currency('RUB'));
    }

    public function getFormattedPriceAttribute()
    {
        return '6000 руб.';
    }
}

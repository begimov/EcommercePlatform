<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use App\Filters\Products\ProductFilters;

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

    public function scopeFilter($builder, $repository, $request)
    {
        return (new ProductFilters($request))->filter($repository);
    }
}

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
}

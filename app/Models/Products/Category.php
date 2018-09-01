<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\{
    HasChildren,
    isOrderable
};

class Category extends Model
{
    use HasChildren, isOrderable;

    protected $fillable = [
        'name', 'slug', 'order'
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}

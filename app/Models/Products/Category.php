<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'order'
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeOrdered($query, $direction = 'asc')
    {
        return $query->orderBy('order', $direction);
    }
}

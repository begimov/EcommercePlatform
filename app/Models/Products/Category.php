<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasChildren;

class Category extends Model
{
    use HasChildren;

    protected $fillable = [
        'name', 'slug', 'order'
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function scopeOrdered($query, $direction = 'asc')
    {
        return $query->orderBy('order', $direction);
    }
}

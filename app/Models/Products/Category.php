<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}

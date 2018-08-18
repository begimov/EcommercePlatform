<?php

namespace App\Models\Traits;

trait HasChildren
{
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }
}

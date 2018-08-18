<?php

namespace App\Models\Traits;

trait isOrderable
{
    public function scopeOrdered($query, $direction = 'asc')
    {
        return $query->orderBy('order', $direction);
    }
}

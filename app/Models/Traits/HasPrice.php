<?php

namespace App\Models\Traits;

use App\Services\App\Money;

trait HasPrice
{
    public function getPriceAttribute($price)
    {
        return new Money($price);
    }

    public function getFormattedPriceAttribute()
    {
        return $this->price->formatted();
    }
}

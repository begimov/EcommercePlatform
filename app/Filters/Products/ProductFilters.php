<?php

namespace App\Filters\Products;

use App\Filters\FiltersAbstract;
use App\Filters\Products\Product\CategoryFilter;

class ProductFilters extends FiltersAbstract
{
    protected $filters = [
        'category' => CategoryFilter::class,
    ];
}

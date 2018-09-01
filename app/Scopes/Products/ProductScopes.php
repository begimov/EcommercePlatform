<?php

namespace App\Scopes\Products;

use App\Scopes\ScopesAbstract;
use App\Scopes\Products\Product\CategoryScope;

class ProductScopes extends ScopesAbstract
{
    protected $scopes = [
        'category' => CategoryScope::class,
    ];
}

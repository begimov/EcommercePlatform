<?php

namespace App\Scopes\Products\Product;

use App\Scopes\ScopeAbstract;

class CategoryScope extends ScopeAbstract
{
    public function scope($builder, $value)
    {
        return $builder->whereHas('categories', function($builder) use ($value) {

            $builder->where('slug', $value);

        });
    }
}

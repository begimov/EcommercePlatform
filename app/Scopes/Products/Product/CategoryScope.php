<?php

namespace App\Scopes\Products\Product;

use App\Scopes\ScopeAbstract;
use App\Repositories\Eloquent\Criteria\WhereHas;

class CategoryScope extends ScopeAbstract
{
    public function filter($repository, $value)
    {
        return $repository->withCriteria([
            new WhereHas('categories', function($builder) use ($value) {
                $builder->where('slug', $value);
            })
        ]);
    }
}

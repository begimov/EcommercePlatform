<?php

namespace App\Filters\Products\Product;

use App\Filters\FilterAbstract;
use App\Repositories\Eloquent\Criteria\WhereHas;

class CategoryFilter extends FilterAbstract
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

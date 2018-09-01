<?php

namespace App\Filters\Products\Product;

use App\Filters\FilterAbstract;

class CategoryFilter extends FilterAbstract
{
    public function filter($repository, $value)
    {
        dd($repository, $value);
        return $repository->withCriteria([
            //
        ]);
    } 
}

<?php

namespace App\Repositories\Eloquent\Products;

use App\Repositories\Eloquent\EloquentRepositoryAbstract;
use App\Repositories\Contracts\Products\ProductRepository;
use App\Models\Products\Product;

class EloquentProductRepository extends EloquentRepositoryAbstract implements ProductRepository
{
    public function entity()
    {
        return Product::class;
    }
}
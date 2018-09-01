<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\Products\Product;
use App\Scopes\Products\ProductScopes;
use App\Repositories\Eloquent\EloquentRepositoryAbstract;
use App\Repositories\Contracts\Products\ProductRepository;

class EloquentProductRepository extends EloquentRepositoryAbstract implements ProductRepository
{
    public function entity()
    {
        return Product::class;
    }

    public function scope($request)
    {
        $this->entity = (new ProductScopes($request))->scope($this->entity);

        return $this;
    }
}
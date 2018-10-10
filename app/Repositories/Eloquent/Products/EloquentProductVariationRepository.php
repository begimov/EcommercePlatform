<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\Products\ProductVariation;
use App\Repositories\Eloquent\EloquentRepositoryAbstract;
use App\Repositories\Contracts\Products\ProductVariationRepository;

class EloquentProductVariationRepository extends EloquentRepositoryAbstract implements ProductVariationRepository
{
    public function entity()
    {
        return ProductVariation::class;
    }

    public function scope($request)
    {
        // $this->entity = (new ProductVariationScopes($request))->scope($this->entity);

        // return $this;
    }
}
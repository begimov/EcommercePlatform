<?php

namespace App\Repositories\Eloquent\Products;

use App\Repositories\Eloquent\EloquentRepositoryAbstract;
use App\Repositories\Contracts\Products\CategoryRepository;
use App\Models\Products\Category;

class EloquentCategoryRepository extends EloquentRepositoryAbstract implements CategoryRepository
{
    public function entity()
    {
        return Category::class;
    }

    public function parents()
    {
        $this->entity = $this->entity->parents();

        return $this;
    }

    public function ordered()
    {
        $this->entity = $this->entity->ordered();
        
        return $this;
    }
}
<?php

namespace App\Repositories\Eloquent\Criteria;

use App\Repositories\Contracts\CriterionInterface;

class WhereHas implements CriterionInterface
{
    protected $relation;

    protected $callback;

    public function __construct($relation, $callback)
    {
        $this->relation = $relation;

        $this->callback = $callback;
    }
    
    public function apply($entity)
    {
        return $entity->whereHas($this->relation, $this->callback);
    }
}
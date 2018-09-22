<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Exceptions\NoEntityDefined;
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Contracts\CriteriaInterface;

abstract class EloquentRepositoryAbstract implements RepositoryInterface, CriteriaInterface
{
    protected $entity;

    abstract public function scope($request); 

    public function __construct()
    {
        $this->entity = $this->resolveEntity();
    }

    public function get()
    {
        return $this->entity->get();
    }

    public function paginate($by)
    {
        return $this->entity->paginate($by);
    }

    public function getByRouteKeyName($value)
    {       
        return $this->entity
            ->where($this->resolveEntity()->getRouteKeyName(), $value)
            ->first();
    }

    public function withCriteria(array $criteria)
    {
        foreach ($criteria as $criterion) {
            $this->entity = $criterion->apply($this->entity);
        }
        return $this;
    }

    protected function resolveEntity()
    {
        if (!method_exists($this, 'entity')) {
            throw new NoEntityDefined();
        }
        return app()->make($this->entity());
    }
}
<?php

namespace App\Filters;

class FiltersAbstract
{
    protected $request;

    protected $filters = [];

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function filter($repository)
    {
        foreach ($this->getFilters() as $filter => $value) {
            $this->resolveFilter($filter)->filter($repository, $value);
        }
        return $repository;
    }

    protected function resolveFilter($filter)
    {
        return new $this->filters[$filter];
    }

    protected function getFilters()
    {
        return array_filter(
            $this->request->only(
                array_keys($this->filters)
            )
        );
    }
}

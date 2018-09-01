<?php

namespace App\Scopes;

class ScopesAbstract
{
    protected $request;

    protected $scopes = [];

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function scope($builder)
    {
        foreach ($this->getScopes() as $scope => $value) {

            $builder = $this->resolveScope($scope)->scope($builder, $value);

        }
        return $builder;
    }

    protected function resolveScope($scope)
    {
        return new $this->scopes[$scope];
    }

    protected function getScopes()
    {
        return array_filter(

            $this->request->only(array_keys($this->scopes))
        );
    }
}

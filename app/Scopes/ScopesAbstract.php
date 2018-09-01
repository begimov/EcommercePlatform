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

    public function scope($repository)
    {
        foreach ($this->getScopes() as $scope => $value) {
            $this->resolveScope($scope)->scope($repository, $value);
        }
        return $repository;
    }

    protected function resolveScope($scope)
    {
        return new $this->scopes[$scope];
    }

    protected function getScopes()
    {
        return array_filter(
            $this->request->only(
                array_keys($this->scopes)
            )
        );
    }
}

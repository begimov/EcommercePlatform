<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function get();
    public function paginate($by);
    public function getByRouteKeyName($key);
}
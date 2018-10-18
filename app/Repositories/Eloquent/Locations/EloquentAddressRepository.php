<?php

namespace App\Repositories\Eloquent\Locations;

use App\Models\Locations\Address;
use App\Repositories\Eloquent\EloquentRepositoryAbstract;
use App\Repositories\Contracts\Locations\AddressRepository;

class EloquentAddressRepository extends EloquentRepositoryAbstract implements AddressRepository
{
    public function entity()
    {
        return Address::class;
    }

    public function scope($request)
    {
        return $this;
    }
}
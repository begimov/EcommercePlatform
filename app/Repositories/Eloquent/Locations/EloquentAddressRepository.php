<?php

namespace App\Repositories\Eloquent\Locations;

use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $address = $this->entity::make($request->only([
            'name', 'address_1', 'city', 'postal_code', 'country_id'
        ]));

        $request->user()->addresses()->save($address);

        return $address;
    }
}
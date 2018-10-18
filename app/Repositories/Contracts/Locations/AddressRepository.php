<?php

namespace App\Repositories\Contracts\Locations;

use Illuminate\Http\Request;

interface AddressRepository
{
    public function store(Request $request);
}
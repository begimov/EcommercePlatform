<?php

namespace App\Http\Controllers\Locations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Locations\AddressResource;
use App\Repositories\Contracts\Locations\AddressRepository;

class AddressController extends Controller
{
    protected $addresses;

    public function __construct(AddressRepository $addresses)
    {
        $this->addresses = $addresses;
    }

    public function index(Request $request)
    {
        return AddressResource::collection(
            $request->user()->addresses
        );
    }

    public function store(Request $request)
    {
        //
    }
}

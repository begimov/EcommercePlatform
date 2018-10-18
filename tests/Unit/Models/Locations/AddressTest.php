<?php

namespace Tests\Unit\Models\Locations;

use Tests\TestCase;
use App\Models\User;
use App\Models\Locations\Address;
use App\Models\Locations\Country;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressTest extends TestCase
{
    public function test_has_its_country()
    {
        $user = factory(User::class)->create();

        $user->addresses()->save(
            $address = factory(Address::class)->make()
        );

        $this->assertInstanceOf(Country::class, $address->country);
    }

    public function test_belongs_to_user()
    {
        $user = factory(User::class)->create();

        $user->addresses()->save(
            $address = factory(Address::class)->make()
        );

        $this->assertInstanceOf(User::class, $address->user);
    }
}

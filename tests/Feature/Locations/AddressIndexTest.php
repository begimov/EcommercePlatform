<?php

namespace Tests\Feature\Locations;

use Tests\TestCase;
use App\Models\User;
use App\Models\Locations\Address;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressIndexTest extends TestCase
{
    public function test_fails_if_user_not_authenticated()
    {
        $this->json('GET', 'api/addresses')
            ->assertStatus(401);
    }

    public function test_returns_list_of_addresses()
    {
        $user = factory(User::class)->create();

        $address = factory(Address::class)->create([
            'user_id' => $user->id
        ]);

        $this->jsonAs($user, 'GET', 'api/addresses')
            ->assertJsonFragment([
                'id' => $address->id
            ]);
    }
}

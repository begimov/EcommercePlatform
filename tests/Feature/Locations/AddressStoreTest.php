<?php

namespace Tests\Feature\Locations;

use Tests\TestCase;
use App\Models\User;
use App\Models\Locations\Country;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressStoreTest extends TestCase
{
    public function test_fails_if_user_not_authenticated()
    {
        $this->json('POST', 'api/addresses')
            ->assertStatus(401);
    }

    public function test_name_required()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/addresses')
            ->assertJsonValidationErrors(['name']);
    }

    public function test_address_1_required()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/addresses')
            ->assertJsonValidationErrors(['address_1']);
    }

    public function test_city_required()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/addresses')
            ->assertJsonValidationErrors(['city']);
    }

    public function test_country_id_required()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/addresses')
            ->assertJsonValidationErrors(['country_id']);
    }

    public function test_country_id_must_exist()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/addresses', [
            'country_id' => 1
        ])->assertJsonValidationErrors(['country_id']);
    }

    public function test_adding_address()
    {
        $user = factory(User::class)->create();

        $payload = [
            'name' => 'Name',
            'address_1' => 'Address',
            'city' => 'City',
            'country_id' => factory(Country::class)->create()->id
        ];

        $this->jsonAs($user, 'POST', 'api/addresses', $payload);

        $this->assertDatabaseHas('addresses', array_merge([
            'user_id' => $user->id,
        ], $payload));
    }

    public function test_returns_address()
    {
        $user = factory(User::class)->create();

        $payload = [
            'name' => 'Name',
            'address_1' => 'Address',
            'city' => 'City',
            'country_id' => factory(Country::class)->create()->id
        ];

        $response = $this->jsonAs($user, 'POST', 'api/addresses', $payload);

        $response->assertJsonFragment([
            'id' => $id = json_decode($response->getContent())->data->id
        ]);

        $this->jsonAs($user, 'GET', 'api/addresses')
            ->assertJsonFragment([
                'id' => $id
            ]);
    }
}

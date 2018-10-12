<?php

namespace Tests\Feature\Carts;

use Tests\TestCase;
use App\Models\User;
use App\Models\Products\ProductVariation;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartIndexTest extends TestCase
{
    public function test_fails_if_user_not_authenticated()
    {
        $this->json('GET', 'api/carts')
            ->assertStatus(401);
    }

    public function test_returns_list_of_products()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'GET', 'api/carts')
            ->assertJsonCount(0, 'data.products');

        $user->cart()->attach(
            factory(ProductVariation::class)->create()
        );

        $this->jsonAs($user, 'GET', 'api/carts')
            ->assertJsonCount(1, 'data.products');
    }

    public function test_if_empty_cart_meta_data_is_present()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'GET', 'api/carts')
            ->assertJsonFragment([
                'empty' => true
            ]);
    }
}

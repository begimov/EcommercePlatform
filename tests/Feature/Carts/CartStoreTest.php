<?php

namespace Tests\Feature\Carts;

use Tests\TestCase;
use App\Models\User;
use App\Services\App\Cart;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Products\{
    ProductVariation
};

class CartStoreTest extends TestCase
{
    public function test_fails_if_user_not_authenticated()
    {
        $this->json('POST', 'api/carts')
            ->assertStatus(401);
    }

    public function test_products_required()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/carts')
            ->assertJsonValidationErrors(['products']);
    }

    public function test_products_required_to_be_an_array()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/carts', [
            'products' => 1
        ])->assertJsonValidationErrors(['products']);
    }

    public function test_each_product_requires_id()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/carts', [
            'products' => [
                ['quantity' => 1]
            ]
        ])->assertJsonValidationErrors(['products.0.id']);
    }

    public function test_each_product_requires_quantity()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/carts', [
            'products' => [
                ['id' => 1]
            ]
        ])->assertJsonValidationErrors(['products.0.quantity']);
    }

    public function test_each_product_quantity_must_be_greater_than_zero()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/carts', [
            'products' => [
                ['id' => 1, 'quantity' => 0]
            ]
        ])->assertJsonValidationErrors(['products.0.quantity']);
    }

    public function test_each_product_quantity_must_be_numeric()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/carts', [
            'products' => [
                ['id' => 1, 'quantity' => 'a']
            ]
        ])->assertJsonValidationErrors(['products.0.quantity']);
    }

    public function test_each_product_requires_existing_id()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/carts', [
            'products' => [
                ['id' => 1]
            ]
        ])->assertJsonValidationErrors(['products.0.id']);
    }

    public function test_adding_products_to_cart()
    {
        $user = factory(User::class)->create();

        $productVariation = factory(ProductVariation::class)->create();

        $this->jsonAs($user, 'POST', 'api/carts',
            [
                'products' => [
                    [ 'id' => $productVariation->id, 'quantity' => $q = 10 ]
                ]
            ]
        );

        $this->assertDatabaseHas('cart_user', [
            'user_id' => $user->id,
            'product_variation_id' => $productVariation->id,
            'quantity' => $q
        ]);
    }
}

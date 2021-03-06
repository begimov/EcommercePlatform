<?php

namespace Tests\Feature\Carts;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Products\{
    ProductVariation
};

class CartUpdateTest extends TestCase
{
    public function test_fails_if_user_not_authenticated()
    {
        $this->json('PATCH', 'api/carts/1')
            ->assertStatus(401);
    }

    public function test_product_variation_doesnt_exists()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'PATCH', 'api/carts/111', [
                'quantity' => 1
            ])->assertStatus(404);
    }

    public function test_quantity_is_required()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'PATCH', 'api/carts/1')
            ->assertJsonValidationErrors(['quantity']);
    }

    public function test_quantity_must_be_numeric()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'PATCH', 'api/carts/1', [
                'quantity' => 'a'
            ])->assertJsonValidationErrors(['quantity']);
    }

    public function test_quantity_must_equal_at_least_one()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'PATCH', 'api/carts/1', [
                'quantity' => 0
            ])->assertJsonValidationErrors(['quantity']);
    }

    public function test_cart_can_be_updated()
    {
        $user = factory(User::class)->create();

        $user->cart()->attach(
            $productVariation = factory(ProductVariation::class)->create(),[
                'quantity' => 1
            ]);

        $this->jsonAs($user, 'PATCH', "api/carts/{$productVariation->id}", [
                'quantity' => $q = 10
            ]);
        
        $this->assertDatabaseHas('cart_user', [
            'product_variation_id' => $productVariation->id,
            'quantity' => $q,
            'user_id' => $user->id
        ]);
    }
}

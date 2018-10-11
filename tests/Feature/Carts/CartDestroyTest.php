<?php

namespace Tests\Feature\Carts;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Products\{
    ProductVariation
};

class CartDestroyTest extends TestCase
{
    public function test_fails_if_user_not_authenticated()
    {
        $this->json('DELETE', 'api/carts/1')
            ->assertStatus(401);
    }

    public function test_product_variation_doesnt_exists()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'DELETE', 'api/carts/111')
            ->assertStatus(404);
    }

    public function test_cart_product_can_be_deleted()
    {
        $user = factory(User::class)->create();

        $user->cart()->attach(
            $productVariation = factory(ProductVariation::class)->create()
        );

        $user->cart()->attach(
            $productVariation2 = factory(ProductVariation::class)->create()
        );

        $this->jsonAs($user, 'DELETE', "api/carts/{$productVariation->id}");
        
        $this->assertCount(1, $user->cart);

        $this->assertDatabaseMissing('cart_user', [
            'product_variation_id' => $productVariation->id
        ]);

        $this->assertDatabaseHas('cart_user', [
            'product_variation_id' => $productVariation2->id
        ]);
    }
}

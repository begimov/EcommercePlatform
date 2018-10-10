<?php

namespace Tests\Unit\Carts;

use Tests\TestCase;
use App\Models\User;
use App\Services\App\Cart;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Products\{
    ProductVariation
};

class CartTest extends TestCase
{

    public function test_adding_to_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $productVariation = factory(ProductVariation::class)->create();

        $cart->add([
            ['id' => $productVariation->id, 'quantity' => $q = 10]
        ]);

        $this->assertCount(1, $user->fresh()->cart);

        $this->assertEquals($q, $user->cart()->first()->pivot->quantity);
    }

    public function test_adding_to_cart_increments_quantity()
    {
        $productVariation = factory(ProductVariation::class)->create();

        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $cart->add([
            ['id' => $productVariation->id, 'quantity' => $q = 10]
        ]);

        $this->assertEquals($q, $user->cart()->first()->pivot->quantity);

        $cart = new Cart($user);

        $cart->add([
            ['id' => $productVariation->id, 'quantity' => $q]
        ]);

        $this->assertEquals($q * 2, $user->fresh()->cart()->first()->pivot->quantity);
    }

    public function test_updating_quantities_in_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $productVariation = factory(ProductVariation::class)->create();

        $cart->add([
            ['id' => $productVariation->id, 'quantity' => 10]
        ]);

        $cart->update($productVariation->id, $q = 100);

        $this->assertEquals($q, $user->cart()->first()->pivot->quantity);
    }
}

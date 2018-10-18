<?php

namespace Tests\Unit\Carts;

use Tests\TestCase;
use App\Models\User;
use App\Services\App\Cart;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\App\Money;

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

    public function test_deleting_from_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $productVariation1 = factory(ProductVariation::class)->create();
        $productVariation2 = factory(ProductVariation::class)->create();

        $cart->add([
            ['id' => $productVariation1->id, 'quantity' => 10],
            ['id' => $productVariation2->id, 'quantity' => 10]
        ]);

        $cart->delete($productVariation1->id);

        $this->assertCount(1, $user->cart);
    }

    public function test_empty_cart_method()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(factory(ProductVariation::class)->create());

        $this->assertCount(1, $user->cart);

        $cart->empty();

        $this->assertCount(0, $user->fresh()->cart);
    }

    public function test_check_if_cart_is_empty_base_on_quantities()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(factory(ProductVariation::class)->create(), [
                'quantity' => 0
            ]
        );

        $this->assertCount(1, $user->cart);

        $this->assertTrue($cart->isEmpty());
    }

    public function test_subtotal_calculation()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $productVariation = factory(ProductVariation::class)->create([
            'price' => 100
        ]);

        $user->cart()->attach($productVariation, [
                'quantity' => 2,
            ]
        );

        $this->assertEquals(200, $cart->subtotal()->amount());
    }

    public function test_returns_money_instance_for_subtotal()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $this->assertInstanceOf(Money::class, $cart->subtotal());
    }

    public function test_returns_money_instance_for_total()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $this->assertInstanceOf(Money::class, $cart->total());
    }

    public function test_syncing_to_available_stock()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create(),[
                'quantity' => 2
            ]
        );

        $cart->sync();

        $this->assertEquals(0, $user->fresh()->cart()->first()->pivot->quantity);
    }

    public function test_if_cart_has_changed_while_syncing()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create(),[
                'quantity' => 2
            ]
        );

        $this->assertFalse($cart->hasChanged());

        $cart->sync();

        $this->assertTrue($cart->hasChanged());
    }
}

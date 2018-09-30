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

    
}

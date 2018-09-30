<?php

namespace Tests\Unit\Models\Users;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Products\{
    ProductVariation
};

class UserTest extends TestCase
{
    public function test_password_auto_hashed()
    {
        $user = factory(User::class)->create([
            'password' => $password = '123456'
        ]);

        $this->assertNotEquals($password, $user->password);
        $this->assertTrue(password_verify($password, $user->password));
    }

    public function test_has_many_cart_products()
    {
        $user = factory(User::class)->create();

        $user->cart()->attach(
            factory(ProductVariation::class)->create()
        );

        $this->assertInstanceOf(ProductVariation::class, $user->cart()->first());
    }

    public function test_has_quantity_for_each_product_in_cart()
    {
        $user = factory(User::class)->create();

        $user->cart()->attach(
            factory(ProductVariation::class)->create(), [
                'quantity' => $q = 12
            ]
        );

        $this->assertEquals($q, $user->cart()->first()->pivot->quantity);
    }
}

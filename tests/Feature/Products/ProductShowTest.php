<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Products\Product;

class ProductShowTest extends TestCase
{
    public function test_falis_with_non_existing_product()
    {
        $this->json('GET', 'api/products/missing-product')
            ->assertStatus(404);
    }

    public function test_responds_with_product()
    {
        $product = factory(Product::Class)->create();

        $this->json('GET', "api/products/{$product->slug}")
            ->assertJsonFragment([
                'id' => $product->id
            ]);
    }
}

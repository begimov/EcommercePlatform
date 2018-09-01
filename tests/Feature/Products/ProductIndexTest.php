<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Products\Product;

class ProductIndexTest extends TestCase
{
    public function test_returns_products_collection()
    {
        $product = factory(Product::Class)->create();

        $this->json('GET', 'api/products')
            ->assertJsonFragment([
                'slug' => $product->slug
            ]);
    }

    public function test_contains_pagination_data()
    {
        $this->json('GET', 'api/products')
            ->assertJsonStructure([
                'data',
                'links' => ['first'],
                'meta' => ['from']
            ]);
    }
}

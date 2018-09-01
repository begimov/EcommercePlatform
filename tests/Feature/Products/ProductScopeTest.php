<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Products\{
    Category,
    Product
};

class ProductScopeTest extends TestCase
{
    public function test_scope_by_category()
    {
        $product = factory(Product::class)->create();

        $product->categories()->save(

            $category = factory(Category::class)->create()

        );

        $anotherProduct = factory(Product::class)->create();

        $anotherCategory = factory(Category::class)->create();

        $this->json('GET', "api/products?category={$category->slug}")
            ->assertJsonCount(1, 'data');

        $this->json('GET', "api/products?category={$anotherCategory->slug}")
            ->assertJsonCount(0, 'data');
    }
}

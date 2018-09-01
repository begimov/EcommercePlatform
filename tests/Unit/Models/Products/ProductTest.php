<?php

namespace Tests\Unit\Models\Products;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Products\{
    Category,
    Product
};

class ProductTest extends TestCase
{
    public function test_retrieved_by_slug()
    {
        $product = new Product();

        $this->assertEquals($product->getRouteKeyName(), 'slug');
    }

    public function test_has_categories()
    {
        $product = factory(Product::class)->create();

        $product->categories()->save(

            $category = factory(Category::class)->create()

        );

        $this->assertEquals($product->categories->first()->slug, $category->slug);
    }
}

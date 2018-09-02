<?php

namespace Tests\Unit\Models\Products;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Products\{
    Category,
    Product,
    ProductVariation
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

    public function test_has_variations()
    {
        $product = factory(Product::class)->create();

        $product->variations()->save(

            factory(ProductVariation::class)->create([
                'product_id' => $product->id
            ])

        );

        $this->assertInstanceOf(ProductVariation::class, $product->variations->first());
    }
}

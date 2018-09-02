<?php

namespace Tests\Unit\Models\Products;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Products\{
    Product,
    ProductVariation
};

class ProductVariationTest extends TestCase
{
    public function test_belongs_to_product()
    {
        $product = factory(Product::class)->create();

        $product->variations()->save(

            $variation = factory(ProductVariation::class)->create([
                'product_id' => $product->id
            ])

        );

        $this->assertEquals($variation->product->id, $product->id);
    }
}

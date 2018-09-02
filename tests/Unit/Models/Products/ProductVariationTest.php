<?php

namespace Tests\Unit\Models\Products;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Products\{
    Product,
    ProductVariation
};

use App\Services\App\Money;

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

    public function test_returns_money_instance()
    {
        $product = factory(Product::class)->create();

        $productVariation = factory(ProductVariation::class)->create([
            'product_id' => $product->id
        ]);

        $this->assertInstanceOf(Money::class, $productVariation->price);
    }

    public function test_returns_formatted_price()
    {
        $product = factory(Product::class)->create();

        $productVariation = factory(ProductVariation::class)->create([
            'product_id' => $product->id,
            'price' => 12000
        ]);

        $this->assertEquals("120,00 ₽", $productVariation->formattedPrice);
    }
}

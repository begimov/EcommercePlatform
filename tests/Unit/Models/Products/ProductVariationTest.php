<?php

namespace Tests\Unit\Models\Products;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Products\{
    Product,
    ProductVariation,
    Stock
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
        $productVariation = factory(ProductVariation::class)->create();

        $this->assertInstanceOf(Money::class, $productVariation->price);
    }

    public function test_returns_formatted_price()
    {
        $productVariation = factory(ProductVariation::class)->create([
            'price' => 12000
        ]);

        $this->assertEquals("120,00 ₽", $productVariation->formattedPrice);
    }

    public function test_returns_base_price_if_variation_price_is_null()
    {
        $product = factory(Product::class)->create([
            'price' => 100000
        ]);

        $product->variations()->save(
            $productVariation = factory(ProductVariation::class)->create([
                'price' => null
            ])
        );

        $this->assertEquals($product->price->amount(), $productVariation->price->amount());
    }

    public function test_checks_if_price_does_not_differ()
    {
        $product = factory(Product::class)->create([
            'price' => 100000
        ]);

        $product->variations()->save(
            $productVariation = factory(ProductVariation::class)->create([
                'price' => null
            ])
        );

        $this->assertFalse($productVariation->priceDiffers());
    }

    public function test_checks_if_price_differs()
    {
        $product = factory(Product::class)->create([
            'price' => 100000
        ]);

        $product->variations()->save(
            $productVariation = factory(ProductVariation::class)->create([
                'price' => 200000
            ])
        );

        $this->assertTrue($productVariation->priceDiffers());
    }

    public function test_has_stocks()
    {
        $productVariation = factory(ProductVariation::class)->create();

        $productVariation->stocks()->save(
            factory(Stock::class)->make()
        );

        $this->assertInstanceOf(Stock::class, $productVariation->stocks->first());
    }

    public function test_has_stock_data()
    {
        $productVariation = factory(ProductVariation::class)->create();

        $productVariation->stocks()->save(
            factory(Stock::class)->make()
        );

        $this->assertInstanceOf(ProductVariation::class, $productVariation->stock->first());
    }

    public function test_has_stock_count_pivot_data3_from_view()
    {
        $productVariation = factory(ProductVariation::class)->create();

        $productVariation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => $quantity = 50
            ])
        );

        $this->assertEquals($quantity, $productVariation->stockCount());
    }
    public function test_has_in_stock_pivot_data_from_view()
    {
        $productVariation = factory(ProductVariation::class)->create();

        $productVariation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => 0
            ])
        );

        $this->assertFalse($productVariation->inStock());
    }
}

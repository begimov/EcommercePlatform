<?php

use Faker\Generator as Faker;
use App\Models\Products\Product;
use App\Models\Products\ProductVariation;

$factory->define(ProductVariation::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->unique()->name(),
        'product_id' => factory(Product::class)->create()->id
    ];
});

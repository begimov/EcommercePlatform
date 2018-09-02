<?php

use Faker\Generator as Faker;
use App\Models\Products\ProductVariation;

$factory->define(ProductVariation::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->unique()->name(),
    ];
});

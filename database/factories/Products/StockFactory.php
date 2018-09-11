<?php

use Faker\Generator as Faker;

use App\Models\Products\Stock;

$factory->define(Stock::class, function (Faker $faker) {
    return [
        'quantity' => 100
    ];
});

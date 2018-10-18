<?php

use Faker\Generator as Faker;
use App\Models\Locations\Country;

$factory->define(Country::class, function (Faker $faker) {
    return [
        'name' => 'Russia',
        'code' => 'RU'
    ];
});

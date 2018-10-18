<?php

use Faker\Generator as Faker;
use App\Models\Locations\Address;
use App\Models\Locations\Country;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address_1' => $faker->streetAddress,
        'city' => $faker->city,
        'postal_code' => $faker->postcode,
        'country_id' => factory(Country::class)->create()->id
    ];
});

<?php

use Faker\Generator as Faker;
use App\Models\Products\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->unique()->name(),
        'slug' => str_slug($name)
    ];
});

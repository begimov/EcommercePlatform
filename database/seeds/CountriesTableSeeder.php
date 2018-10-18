<?php

use Illuminate\Database\Seeder;
use App\Models\Locations\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            'Россия' => 'RU',
            'Беларусь' => 'BY',
            'Украина' => 'UA',
            'Казахстан' => 'KZ',
            'Азербайджан' => 'AZ',
            'Армения' => 'AM',
            'Грузия' => 'GE',
            'Киргизия' => 'KG',
            'Таджикистан' => 'TJ',
            'Узбекистан' => 'UZ',
        ];

        collect($countries)->each(function ($code, $name) {
            Country::create([
                'name' => $name,
                'code' => $code
            ]);
        });
    }
}

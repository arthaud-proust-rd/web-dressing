<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::factory()->create([
            'name' => 'Bordeaux',
            'lat' => 44.833,
            'lon' => -0.567,
            'insee' => '33063',
        ]);

        City::factory()->create([
            'name' => 'Le Haillan',
            'lat' => 44.874600,
            'lon' => -0.685833,
            'insee' => '33200',
        ]);

        City::factory()->create([
            'name' => 'Lacanau',
            'lat' => 44.980278,
            'lon' => -1.078333,
            'insee' => '33214',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Dressing;
use App\Models\User;
use Illuminate\Database\Seeder;

class DressingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::all() as $user) {
            foreach (City::all() as $city) {
                Dressing::factory()
                    ->for($city)
                    ->for($user)
                    ->create();
            }
        }
    }
}

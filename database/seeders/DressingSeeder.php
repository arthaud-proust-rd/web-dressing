<?php

namespace Database\Seeders;

use App\Models\Dressing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Dressing::factory()
            ->count(2)
            ->hasClothes(20)
            ->create();
    }
}

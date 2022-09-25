<?php

namespace Database\Seeders;

use App\Models\Dressing;
use App\Models\User;
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
        $users = User::all();

        foreach ($users as $user){
            Dressing::factory()
                ->count(2)
                ->hasClothes(6)
                ->for($user)
                ->create();
        }
    }
}

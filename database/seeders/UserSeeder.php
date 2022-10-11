<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->create([
                'email' => "user@email.com"
            ]);

        for ($i = 1; $i < 3; $i++) {
            User::factory()
                ->create([
                    'email' => "user$i@email.com"
                ]);
        }
    }
}

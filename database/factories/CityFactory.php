<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->city(),
            'lat' => $this->faker->latitude($min = -90, $max = 90),    // 77.147489
            'lon' => $this->faker->longitude($min = -180, $max = 180),
        ];
    }
}

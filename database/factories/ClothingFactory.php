<?php

namespace Database\Factories;

use App\Enums\ClothingCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clothing>
 */
class ClothingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $rainy = $this->faker->boolean();
        $dry = !$rainy || $this->faker->boolean();

        $cold = $this->faker->boolean();
        $hot = !$cold || $this->faker->boolean();

        return [
//            'name' => $this->faker->word(),
            'note' => $this->faker->numberBetween(1,3),
            'category' => $this->faker->randomElement(ClothingCategory::cases()),
            'weather_options' => [
                'rainy' => $rainy,
                'dry' => $dry,
                'cold' => $cold,
                'hot' => $hot,
            ]
        ];
    }
}

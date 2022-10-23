<?php

namespace Database\Seeders;

use App\Enums\ClothingCategory;
use App\Models\Clothing;
use App\Models\Dressing;
use Illuminate\Database\Seeder;

class ClothingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];
        $categories[ClothingCategory::SHIRT->value] = [
            [
                'weather_options' => [
                    'rainy' => true,
                    'dry' => true,
                    'cold' => true,
                    'hot' => true,
                ],
                'image' => 't-shirt',
            ],
            [
                'weather_options' => [
                    'rainy' => true,
                    'dry' => true,
                    'cold' => true,
                    'hot' => false,
                ],
                'image' => 'cold-t-shirt',
            ],
        ];

        $categories[ClothingCategory::PANTS->value] = [
            [
                'weather_options' => [
                    'rainy' => false,
                    'dry' => true,
                    'cold' => true,
                    'hot' => true,
                ],
                'image' => 'light-jeans',
            ],
            [
                'weather_options' => [
                    'rainy' => true,
                    'dry' => true,
                    'cold' => true,
                    'hot' => false,
                ],
                'image' => 'dark-jeans',
            ],
        ];

        $categories[ClothingCategory::PULL->value] = [
            [
                'weather_options' => [
                    'rainy' => true,
                    'dry' => true,
                    'cold' => true,
                    'hot' => false,
                ],
                'image' => 'pull',
            ],
        ];

        $categories[ClothingCategory::ACCESSORY->value] = [
            [
                'weather_options' => [
                    'rainy' => true,
                    'dry' => true,
                    'cold' => true,
                    'hot' => false,
                ],
                'image' => 'cold-cap',
            ],
            [
                'weather_options' => [
                    'rainy' => true,
                    'dry' => true,
                    'cold' => false,
                    'hot' => true,
                ],
                'image' => 'hot-cap',
            ],
            [
                'weather_options' => [
                    'rainy' => false,
                    'dry' => true,
                    'cold' => false,
                    'hot' => true,
                ],
                'image' => 'sunglasses',
            ],
        ];

        $categories[ClothingCategory::UNDERWEAR->value] = [
            [
                'weather_options' => [
                    'rainy' => true,
                    'dry' => true,
                    'cold' => true,
                    'hot' => true,
                ],
                'image' => 'socks',
            ],
        ];

        foreach (Dressing::all() as $dressing) {
            foreach ($categories as $category => $clothes) {
                foreach ($clothes as $clothing) {
                    Clothing::factory()
                        ->count(1)
                        ->for($dressing)
                        ->create([
                            'weather_options' => $clothing['weather_options'],
                            'images' => [
                                'tests/' . $clothing['image'] . '-front.jpeg',
                                'tests/' . $clothing['image'] . '-back.jpeg',
                            ],
                            'category' => $category
                        ]);
                }

            }
        }
    }
}

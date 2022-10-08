<?php

namespace App\Enums;

enum ClothingWeatherOptions: string
{
    case Rainy = 'rainy';
    case Sunny = 'sunny';
    case Cold = 'cold';

    public function toString(): string
    {
        return match($this) {
            self::Rainy => 'Pluvieux',
            self::Sunny => 'Ensoleillé',
            self::Cold => 'Froid',
        };
    }

    public static function associativeArray(): array
    {
        $list = [];
        foreach (self::cases() as $category)
        {
            $list[$category->toString()] = $category->value;
        }

        return $list;
    }

    public static function array(): array
    {
        $list = [];
        foreach (self::cases() as $category)
        {
            $list[] = [
                'label' => $category->toString(),
                'value' =>$category->value
            ];
        }

        return $list;
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

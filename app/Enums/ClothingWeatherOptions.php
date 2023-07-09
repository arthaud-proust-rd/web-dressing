<?php

namespace App\Enums;

enum ClothingWeatherOptions: string
{
    case RAINY = 'rainy';
    case DRY = 'dry';
    case COLD = 'cold';
    case HOT = 'hot';

    public function toString(): string
    {
        return match ($this) {
            self::RAINY => 'Pluvieux',
            self::DRY => 'Sec',
            self::COLD => 'Froid',
            self::HOT => 'Chaud',
        };
    }

    public static function associativeArray(): array
    {
        $list = [];
        foreach (self::cases() as $category) {
            $list[$category->toString()] = $category->value;
        }

        return $list;
    }

    public static function array(): array
    {
        $list = [];
        foreach (self::cases() as $category) {
            $list[] = [
                'label' => $category->toString(),
                'value' => $category->value
            ];
        }

        return $list;
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

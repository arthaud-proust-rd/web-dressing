<?php

namespace App\Enums;

enum ClothingCategory: int
{
    case TO_CATEGORIZE = 0;
    case SHIRT = 1;
    case PANTS = 2;
    case UNDERWEAR = 3;
    case PULL = 4;
    case ACCESSORY = 5;

    public function toString(): string
    {
        return match ($this) {
            self::TO_CATEGORIZE => 'À catégoriser',
            self::SHIRT => 'T-shirts',
            self::PANTS => 'Pantalons',
            self::UNDERWEAR => 'Sous-vêtements',
            self::PULL => 'Pulls',
            self::ACCESSORY => 'Accessoires',
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

<?php

namespace App\Enums;

enum ClothingCategory: int
{
    case ToCategorize = 0;
    case Shirt = 1;
    case Pants = 2;
    case Underwear = 3;
    case Pull = 4;

    public function toString(): string
    {
        return match($this) {
            self::ToCategorize => 'A catégoriser',
            self::Shirt => 'T-shirt',
            self::Pants => 'Pantalon',
            self::Underwear => 'Sous-vêtement',
            self::Pull => 'Pull',
        };
    }

    public static function list(): array
    {
        $list = [];
        foreach (self::cases() as $category)
        {
            $list[$category->toString()] = $category->value;
        }

        return $list;
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

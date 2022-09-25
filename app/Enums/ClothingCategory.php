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
            self::ToCategorize => 'À catégoriser',
            self::Shirt => 'T-shirts',
            self::Pants => 'Pantalons',
            self::Underwear => 'Sous-vêtements',
            self::Pull => 'Pulls',
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

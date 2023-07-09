<?php

namespace App\Enums;

enum WeatherForecastDayPart: string
{
    case DAY = 'day';
    case MORNING = 'morning';
    case AFTERNOON = 'afternoon';

    public function toString(): string
    {
        return match ($this) {
            self::DAY => 'Jour',
            self::MORNING => 'Matin',
            self::AFTERNOON => 'Après-midi',
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

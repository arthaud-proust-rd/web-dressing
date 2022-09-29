<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lat',
        'lon',
    ];

    public function dressings(): HasMany
    {
        return $this->hasMany(Dressing::class);
    }

    public function weatherForecasts(): HasMany
    {
        return $this->hasMany(WeatherForecast::class);
    }

}

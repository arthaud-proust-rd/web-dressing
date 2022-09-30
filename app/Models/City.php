<?php

namespace App\Models;

use Illuminate\Support\Collection;
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

    protected $appends = [
      'days_weather_forecasts'
    ];

    public function dressings(): HasMany
    {
        return $this->hasMany(Dressing::class);
    }

    public function weatherForecasts(): HasMany
    {
        return $this->hasMany(WeatherForecast::class);
    }

    public function getDaysWeatherForecastsAttribute(): Collection
    {
        return $this->weatherForecasts()->get()->groupBy(function($item, $key) {
           return substr($item['forecast_dt'], 0, 10);
        });
    }
}

<?php

namespace App\Services;

use App\Models\City;
use App\Models\WeatherForecast;
use Illuminate\Support\Facades\Http;

class CityService
{
    private City $instance;

    private array $fetchedWeatherForecasts;

    public function __construct(City $instance)
    {
        $this->instance = $instance;
    }

    public function fetchWeatherForecasts(): static
    {
        $this->clearFetchedWeatherForecasts();

        $this->fetchWeatherForecastsFromApi();

        $this->storeFetchedWeatherForecasts();

        return $this;
    }

    public function clearFetchedWeatherForecasts(): static
    {
        $this->instance->weatherForecasts()->delete();

        return $this;
    }

    public function fetchWeatherForecastsFromApi(): static
    {
        $response = Http::get(config('services.openweather.host').'/forecast', [
            'appid' => config('services.openweather.key'),
            'units' => 'metric',
            'lang' => 'fr',
            'lat' => $this->instance->lat,
            'lon' => $this->instance->lon,
        ])->json();

        $this->fetchedWeatherForecasts = $response['list'];

        return $this;
    }

    public function storeFetchedWeatherForecasts(): static
    {
        $request_dt = now()->toDateTimeString();
        foreach ($this->fetchedWeatherForecasts as $forecast)
        {
//            dd($forecast);
            WeatherForecast::factory()
                ->for($this->instance)
                ->create([
                    'description' => $forecast['weather'][0]['description'] ?? 'Aucune description',
                    'temp' => $forecast['main']['temp'],
                    'temp_feels' => $forecast['main']['feels_like'],
                    'temp_min' => $forecast['main']['temp_min'],
                    'temp_max' => $forecast['main']['temp_max'],
                    'precip' => $forecast['rain']['3h'] ?? 0,
                    'precip_proba' => 100 * ($forecast['pop'] ?? 0),
                    'humidity' => ($forecast['main']['humidity'] ?? 0),
                    'cloudcover' => $forecast['clouds']['all'] ?? 0,
                    'request_dt' => $request_dt,
                    'forecast_dt' => $forecast['dt_txt'],
                ]);
        }

        return $this;
    }

}

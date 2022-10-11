<?php

namespace App\Services\WeatherForecastApi;

use App\Models\City;
use App\Models\WeatherForecast;
use Illuminate\Support\Facades\Http;

class OpenWeatherService
{
    public City $city;

    public function __construct(City $city)
    {
        $this->city = $city;
    }

    public function fetchDaily(): array
    {
        $response = Http::get(config('services.meteoconcept.host') . '/forecast/daily', [
            'appid' => config('services.openweather.key'),
            'units' => 'metric',
            'lang' => 'fr',
            'lat' => $this->instance->lat,
            'lon' => $this->instance->lon,
        ])->json();

        return $response['list'];
    }

    public function storeFetchedWeatherForecasts(): static
    {
        $request_dt = now()->toDateTimeString();
        foreach ($this->fetchedWeatherForecasts as $forecast) {
            if (!str_ends_with($forecast['dt_txt'], '09:00:00') && !str_ends_with($forecast['dt_txt'], '15:00:00')) {
                continue;
            }

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


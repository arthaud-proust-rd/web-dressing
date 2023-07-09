<?php

namespace App\Services;

use App\Models\City;
use App\Services\WeatherForecastApi\MeteoConceptService;

class CityService
{
    private City $instance;
    
    public function __construct(City $instance)
    {
        $this->instance = $instance;
    }

    public function fetchWeatherForecasts(): static
    {
        $this->clearFetchedWeatherForecasts();

        $this->fetchWeatherForecastsFromApi();

        return $this;
    }

    public function clearFetchedWeatherForecasts(): static
    {
        $this->instance->weatherForecasts()->delete();

        return $this;
    }

    public function fetchWeatherForecastsFromApi(): static
    {
        $weatherForecastApiService = new MeteoConceptService($this->instance);
        $weatherForecastApiService->fetch2WeeksForecast();

        return $this;
    }
}

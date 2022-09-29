<?php

namespace App\Http\Livewire\WeatherForecast;

use App\Models\WeatherForecast;
use Illuminate\Support\Collection;
use Livewire\Component;

class DayCard extends Component
{
    public Collection $dayForecasts;

    public function render()
    {
        return view('livewire.weather-forecast.day-card');
    }
}

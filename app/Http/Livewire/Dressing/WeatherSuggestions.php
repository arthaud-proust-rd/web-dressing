<?php

namespace App\Http\Livewire\Dressing;

use App\Models\Dressing;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class WeatherSuggestions extends Component
{
    public Dressing $dressing;

    public array $daysWeatherForecasts;
    public int $dayWeatherForecastIndex = 0;

    public function mount()
    {
        $this->daysWeatherForecasts = array_values($this->dressing->city->daysWeatherForecasts->all());
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.dressing.weather-suggestions', [
            'daysWeatherForecasts' => $this->daysWeatherForecasts,
            'd' => $this->daysWeatherForecasts[$this->dayWeatherForecastIndex]
        ]);
    }

    public function nextDay(): void
    {
        ++$this->dayWeatherForecastIndex;
    }

    public function previousDay(): void
    {
        --$this->dayWeatherForecastIndex;
    }
}

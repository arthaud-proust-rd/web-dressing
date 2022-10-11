<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Services\CityService;
use Illuminate\Console\Command;

class FetchWeatherForecast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch weather forecast for all cities';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (City::all() as $city) {
            $cityService = new CityService($city);

            $cityService->fetchWeatherForecasts();
        }

        return 0;
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dressing;
use App\Models\WeatherForecast;
use Illuminate\Support\Facades\Gate;

class DressingApiController extends Controller
{
    public function filterIndex()
    {
    }


    public function weatherSuggestions(Dressing $dressing, WeatherForecast $weatherForecast)
    {
        Gate::authorize('view', $dressing);

        $weatherOptions = [];
        $weatherOptions[$weatherForecast->isRainy?'rainy':'dry'] = true;
        $weatherOptions[$weatherForecast->isCold?'cold':'hot'] = true;

        return $dressing
            ->clothes()
            ->weatherOptions($weatherOptions)
            ->get();
    }
}

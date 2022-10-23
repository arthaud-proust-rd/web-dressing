<?php

use App\Http\Controllers\Api\DressingApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::controller(DressingApiController::class)
        ->prefix('dressing')
        ->name('dressing.')
        ->group(function () {

            Route::get('{dressing}/weather-suggestions/{weatherForecast}', 'weatherSuggestions')
                ->name('weather-suggestions');
        });
});



<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DressingController;
use App\Http\Controllers\ClothingController;

Route::redirect('/', '/dressing');

Route::resources([
    'dressing' => DressingController::class,
    'clothing' => ClothingController::class,
]);

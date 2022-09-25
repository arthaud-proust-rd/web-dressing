<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DressingController;
use App\Http\Controllers\ClothingController;

Route::middleware('auth')->group(function() {

    Route::redirect('/', '/dressing');

    Route::resource('dressing', DressingController::class);
    Route::resource('clothing',ClothingController::class);

    Route::get('dressing/{dressing}/add-clothing', [ClothingController::class, 'create'])->name('dressing.add-clothing');
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\ClothingController;
use App\Http\Controllers\ClothingImageController;
use App\Http\Controllers\DressingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::redirect('/', '/dressing');

    Route::get('/profile', ProfileController::class)->name('user.profile');

    Route::resource('dressing', DressingController::class);
    Route::resource('clothing', ClothingController::class);

    Route::name('clothing.')->prefix('clothing')->group(function () {
        Route::post('images/upload', [ClothingImageController::class, 'store'])->name('images.store');
        Route::post('images/delete', [ClothingImageController::class, 'destroy'])->name('images.destroy');
    });
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';

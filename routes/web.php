<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NasaController;


Route::get('/', [NasaController::class, 'index']);
Route::get('/asteroid-chart', [NasaController::class, 'asteroidChartData']);
Route::get('/rover', [NasaController::class, 'roverPhotos'])->name('rover.photos');
Route::get('/asteroids', [NasaController::class, 'asteroids']);
Route::get('/apod', [NasaController::class, 'apod']);
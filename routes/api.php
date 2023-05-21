<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Location\LocationController;
use App\Http\Controllers\Api\Locations\AllController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('locations')->name('api.locations.')->group(function (): void {
    Route::get('/}', AllController::class)->name('list-all');
    Route::get('/{location}', LocationController::class)->name('single-location');
});

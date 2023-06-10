<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Location\LocationController;
use App\Http\Controllers\Api\Locations\AllController;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

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

Route::get(
    '/ping',
    function (): JsonResponse {
        return response()->json(
            [
                'service' => 'Wandersnap API',
                'timestamp' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );
    }
)
    ->name('api.ping');

Route::prefix('auth')->name('api.auth.')->group(function (): void {
    Route::post('/register', RegisterController::class)->name('register');
    Route::post('/login', RegisterController::class)->name('login');
});
Route::middleware('auth:sanctum')
    ->prefix('locations')
    ->name('api.locations.')->group(function (): void {
        Route::get('/', AllController::class)->name('list-all');
        Route::get('/{location}', LocationController::class)->name('single-location');
    });

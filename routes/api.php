<?php

declare(strict_types=1);

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

Route::prefix('locations')->group(function (): void {
    Route::get('/}', PatchController::class)->name('api.properties.patch');
    Route::get('/{location}', DeleteController::class)->name('api.properties.delete');
});

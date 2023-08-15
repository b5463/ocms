<?php
use App\Arrival\Http\Controllers\ArrivalController;

Route::prefix('api/v1')->middleware('auth')->group(function () {
    Route::get('arrivals', [ArrivalController::class, 'index']);
    Route::post('arrivals', [ArrivalController::class, 'store']);
    Route::get('usersArrivals', [ArrivalController::class, 'getUsersArrivals']);
});

// Handling errors
Route::fallback(function () {
    return response()->json(['message' => 'Route not found'], 404);
});
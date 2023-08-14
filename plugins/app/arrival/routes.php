<?php

use App\Arrival\Http\Controllers\ArrivalController;

Route::prefix('api/v1')->group(function () {
    // Routes that require JWT authentication
    // Retrieve all arrivals
    Route::get('arrivals', [ArrivalController::class, 'index']);
    
    // Create a new arrival
    Route::post('arrivals', [ArrivalController::class, 'store']);
    
    // Retrieve user's arrivals
    Route::get('usersArrivals', [ArrivalController::class, 'getUsersArrivals']);
});

// Handling errors
Route::fallback(function () {
    return response()->json(['message' => 'Route not found'], 404);
});
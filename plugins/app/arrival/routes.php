<?php
use App\Arrival\Http\Controllers\ArrivalController; // Make sure this path is correct

Route::prefix('api/v1')->group(function () {
    
    Route::middleware(['auth'])->group(function () {    
        Route::get('arrivals', [ArrivalController::class, 'index']); // Route to retrieve all arrivals
        
        Route::post('arrivals', [ArrivalController::class, 'store']); // Route to create a new arrival
        
        Route::get('usersArrivals', [ArrivalController::class, 'getUsersArrivals']); // Route to retrieve user's arrivals
    });
});
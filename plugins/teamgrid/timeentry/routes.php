<?php
use Teamgrid\Timeentry\Http\Controllers\TimeEntryController;
use Teamgrid\Timeentry\Http\Middlewares\TimeEntryMiddleware;

Route::prefix('api/v1/timeentry')->group(function () {
    // Require authentication for all routes in this group
    Route::middleware(['auth'])->group(function () {
        // Start time tracking route
        Route::post('start', [TimeEntryController::class, 'startTimeTracking']);
        
        // Routes within this group require TimeEntryMiddleware
        Route::middleware([TimeEntryMiddleware::class])->group(function () {
            // Stop time tracking route with dynamic parameter 'key'
            Route::post('end/{key}', [TimeEntryController::class, 'stopTimeTracking'])
                ->where('key', '[0-9]+'); // Restrict 'key' to numeric values
        });
    });
});
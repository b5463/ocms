<?php
use Teamgrid\Project\Http\Controllers\ProjectController;
use Teamgrid\Project\Http\Middlewares\ProjectMiddleware;

Route::prefix('api/v1/projects')->group(function () {
    Route::get('index', [ProjectController::class, 'index']);

    Route::middleware(['auth'])->group(function () {

        Route::post('store', [ProjectController::class, 'store']);

        Route::middleware([ProjectMiddleware::class])->group(function () {
            Route::post('show/{key}', [ProjectController::class, 'show']);
            Route::post('update/{key}', [ProjectController::class, 'update']);
            Route::post('done/{key}', [ProjectController::class, 'markAsDone']);
        });
    });
});
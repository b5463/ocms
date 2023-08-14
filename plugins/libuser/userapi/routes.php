<?php
    use LibUser\Userapi\Http\Controllers\UserController;

    Route::group(["prefix" => "api"], function() {

        Route::group(["prefix" => "auth"], function() {
            Route::post("register", [UserController::class, "register"]);
            Route::post("login", [UserController::class, "login"]);
        });
        
    });
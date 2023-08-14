<?php namespace LibUser\Userapi\Http\Controllers;

use LibUser\Userapi\Http\Resources\UserResource;
use Exception;
use RainLab\User\Facades\Auth;

class UserController {

    // register user
    function register() {
        $creds = [
            "name" => post("name"),
            "surname" => post("surname"),
            "email" => post("email"),
            "password" => post("password"),
            "password_confirmation" => post("password_confirmation")
        ];
        $user = Auth::register($creds);

        return new UserResource($user);
    }

    // login user
    function login() {
        $creds = [
            "email"    => post("email"),
            "password" => post("password")
        ];

        if (!$token = auth()->attempt($creds)) {
            throw new Exception("Wrong email or password");
        }

        return $this->respondWithToken($token);
    }

    // respond json array with jwt info
    private function respondWithToken($token) {
        return response()->json([
            "token" => $token,
            "token_type" => "bearer",
            "expires_in" => config("jwt.ttl")
        ]);
    }
    
}
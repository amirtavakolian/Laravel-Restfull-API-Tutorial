<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);
Route::post('/users/login', [UserController::class, 'login']);


Route::get('/test-token', function () {

    return ["message" => "You are login"];
})->middleware('auth:sanctum');

// don't forget to put authorizatin header & the token you have + Accept: application/json header

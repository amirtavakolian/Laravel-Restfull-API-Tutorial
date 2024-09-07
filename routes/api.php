<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);
Route::post('/users/login', [UserController::class, 'login']);

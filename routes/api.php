<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


// php .\artisan make:controller UserController --api --model=User

// --api ==> use api resource to create controller ==> --api doesn't create the update and create methods
// we usually use --resource (resource controller) but for api we use --api (api resource controller)

// --model=User ==> prepare route model binding

// -----------------------------------------

Route::apiResource('users', UserController::class);

// instead of creating a route group and create all the routes individually, we use apiResource

// we have Route::resource & Route::apiResource

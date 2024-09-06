<?php

use App\Models\User;
use App\Services\RestApi\ApiResponseBuilder;
use App\Services\RestApi\ApiResponseFacade;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {

    $users = User::all();

    return (new ApiResponseBuilder())
        ->withMessage('list of users')
        ->withData($users)
        ->withStatus(200)
        ->build()
        ->response();


    // use facade so there is no need to new ApiResponseBuilder

    return ApiResponseFacade::withMessage('list of users')
        ->withData($users)
        ->build()
        ->response();
});

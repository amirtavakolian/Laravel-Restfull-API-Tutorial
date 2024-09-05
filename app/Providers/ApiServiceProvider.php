<?php

namespace App\Providers;

use App\Http\Resources\UserResource;
use App\Services\RestApi\ApiResponseBuilder;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // here we have defined when we use apiResponse facade,
        // service container should give us an object from ApiResponseBuilder()

        $this->app->bind('apiResponseFacade', function () {
            return new ApiResponseBuilder();
        });

        $this->app->bind(UserResource::class, function ($app, $parameters) {
            return new UserResource($parameters['user']);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

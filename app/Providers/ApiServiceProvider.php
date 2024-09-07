<?php

namespace App\Providers;

use App\Http\Resources\UserRegistrationResource;
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

        $this->app->bind(UserRegistrationResource::class, function ($app, $params) {
            return new UserRegistrationResource($params['user']);
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

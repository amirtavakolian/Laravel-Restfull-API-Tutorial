<?php

namespace App\Providers;

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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

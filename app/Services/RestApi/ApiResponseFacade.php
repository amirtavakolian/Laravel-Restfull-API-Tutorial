<?php

namespace App\Services\RestApi;

use Illuminate\Support\Facades\Facade;

class ApiResponseFacade extends Facade
{

    // there is no need to use 'Facade' word in any facade you make
    // Ex: User::create ==> User is a facade
    // but for practicing purpose I have used it
    // you can create Facade directory and change this class name to ApiResponse & put it in Facade directory :D

    // extend Facade class
    // create getFacadeAccessor
    // create service provider ==> php artisan make:provider ApiServiceProvider
    // add service provider to app.php ==> you can even create an alias for your facade for easily access it.
    //

    protected static function getFacadeAccessor()
    {
        return 'apiResponseFacade';
    }

}

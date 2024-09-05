<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\RestApi\ApiResponseFacade;

class UserController extends Controller
{

    public function show(User $user)
    {
        return ApiResponseFacade::withData(resolve(UserResource::class, ['user' => $user]))
            ->withMessage('my user :D')
            ->withStatus(200)
            ->build()
            ->response();

        // you can even use like this
        return resolve(UserResource::class, ['user' => $user]);


        /*
           # Important: each method can have its own api resource with its own data structure.

           Ex: an api resource for show method ==> JsonResponse
               an api resource for index method ==> CollectionResponse

               for admins, i want to send all the data of the users even they're passwords
               for coworkers of support, we just send the first_name, last_name, email

        */
    }
}

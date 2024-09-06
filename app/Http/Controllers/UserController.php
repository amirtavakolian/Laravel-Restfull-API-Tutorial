<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsersListApiResourceCollection;
use App\Models\User;
use App\Services\RestApi\ApiResponseFacade;

class UserController extends Controller
{

    /*

    with() & load  ==> both are used for eager loading :D

    # with() method ==>   $users = User::with('articles')->get();


    # load() method:
       $users = User::all();
       return $users->load('articles');
       return $users->load('articles')->load('comments');

    */

    public function index()
    {
        $users = User::with('articles')->get();

        return ApiResponseFacade::withData(new UsersListApiResourceCollection($users))
            ->withMessage('my user :D')
            ->withStatus(200)
            ->build()
            ->response();


        // you can even do like this ==> using load()

        $users = User::all();

        return ApiResponseFacade::withData(new UsersListApiResourceCollection($users->load('articles')))
            ->withMessage('my user :D')
            ->withStatus(200)
            ->build()
            ->response();
    }
}

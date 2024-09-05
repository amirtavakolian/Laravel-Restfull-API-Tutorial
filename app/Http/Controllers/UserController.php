<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsersListApiResourceCollection;
use App\Models\User;
use App\Services\RestApi\ApiResponseFacade;

class UserController extends Controller
{

    /*
    as you can see in previous commit:
    when we use resource api it just make changes on the data of only one eloquent object model
    ( define what we need to send and we don't)

    we can even use resource api's ::collection() method to make changes on the data of
    collections which contains eloquent model objects.

    Resource collection extend resource api + several features (Ex: pagination features - methods)

    # Remember: each method can have its own Api resource
    Ex: a resource api for show() or store() or update() method
        a collection resource for index() method
    */

    // create api resource for collections ==> php artisan make:resource UsersListApiResourceCollection --collection

    /*
    what are the differences between api resource ::collection & collection resource


    both are used for managing and re-presenting json data, but:

    use collection resource for re-presenting a collection of resources ==> Ex: list of users, list of posts &...
    -->
    you can do it with api resource ::collection but, you cant add extra data like pagination data and meta-data like
    number of pages, previous links, forward links, number of all the pages &...

    but, in api resource ::collection, you can define which keys should be available and which not

    ------------------------------------------------------------------------

    in collection resource you can define the structure like this:

    return new ArticleCollection(
        Article::latest()->select(['name', 'subtitle', 'cover'])->paginate(10)
    );

    **************************************************

    # or like below in toArray method of the resource collection:

    return [
            'users' => $this->collection->transform(function($user){
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    // Add other fields as needed
                ];
            }),
            'meta' => [
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage(),
            ],
        ];

    **************************************************

    # use map()

    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'custom_attribute' => $item->customAttribute,
                ];
            })->all(),
            'meta' => $this->meta(),
            'links' => $this->paginationLinks(),
        ];
    }

    **************************************************

    # or use resource api in your collection:


    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'related_data' => new ArticleResource($this->relatedData),
        ];
    }

======================================================================================

    # a very good example of using ::collection ==>
    create a collection for articles like this ==> ArticlesApiResource::collection($this->articles)
    use it when you want to load the articles of users for example
    ==>
    paginate the users and use collection resource
    but for articles, use api resource ::collection


    i think resource collection allows you to customize the way of representing a collection's objects
    while working with pagination & add additional data to it :D :P

    take a look at the methods which are suggests after $this->collection->
    all are the methods which laravel collection data type has :))
    where(), pluck(), first() &... \:D/

    */

    public function index()
    {
        $users = User::all();

        // return new UsersListApiResourceCollection($users);  ==> we can use this for returning data

        return ApiResponseFacade::withData(new UsersListApiResourceCollection($users))
            ->withMessage('my user :D')
            ->withStatus(200)
            ->build()
            ->response();

        // you can even use service container (resolve) instead of  ==> new UsersListApiResourceCollection($users)
    }
}

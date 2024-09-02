<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with('articles')->get(); // here we have used with() for Eager Loading

        // you can even use protected $with = ['articles']; in User model.
        // when using $with, any query on users table will have articles data

        return response()->json([
            "data" => $users
        ], 200);

        //=====================================================================

        // you can get more than one relation with ::with() method

        $users = User::with(['articles', 'comments'])->get();

        //=====================================================================

        // get comments of articles: nested egar loading

        $users = User::with('articles.comments')->get();

        //=====================================================================

        // you can even use load(), but, after getting data from database:

        $users = User::all();
        return response()->json([
            "data" => $users->load('articles')
        ], 200);

        //=====================================================================

        // choose which columns you want from articles:   # method 1:

        $users = User::with(['articles' => function ($query) {
            $query->select('id', 'title', 'user_id'); // user_id را اضافه کنید تا رابطه به درستی کار کند
        }])->get();

        // you can even use collection methods on $query variable

    }
}

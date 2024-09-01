<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response()->json([
            "data" => $users
        ], 200);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::query()->where('email', $request->input('email'))->first();
        if ($user) {
            return response()->json([
                "message" => "user is currently available",
                "data" => ""
            ], 422);
        }
        $user = User::query()->insert([
            "name" => $request->input("name"),
            "email" => $request->input("email"),
            "password" => Hash::make($request->input("password")),
        ]);
        return response()->json([
            "message" => "user created successfully",
            "data" => $user
        ], 201);
    }

    public function show(User $user)
    {
        return response()->json([
            "data" => $user
        ], 200);
    }

    public function update(Request $request, User $user)
    {

    }

    public function destroy(User $user)
    {

    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response()->json([
            "data" => $users
        ], 200);
    }

    public function store(Request $request)
    {

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

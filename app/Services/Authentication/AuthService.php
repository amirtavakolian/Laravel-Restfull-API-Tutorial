<?php

namespace App\Services\Authentication;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public function getAllUsers()
    {
        return [
            "data" => User::all(),
            "message" => "list of all users"
        ];
    }

    public function registerUser(array $inputs)
    {
        try {
            $user = User::query()->create($inputs);

        } catch (Exception $e) {
            return [
                "ok" => false,
                "data" => "",
                "message" => "error in registering user"
            ];
        }
        return [
            "ok" => true,
            "data" => $user,
            "message" => "user has been created successfully"
        ];
    }

    public function loginUser(array $inputs)
    {
        $user = $this->findUserByEmail($inputs['email']);

        if (!$user || !Hash::check($inputs['password'], $user->password)) {
            return [
                'ok' => false,
                'data' => '',
                'message' => 'Email is not available or password is wrong'
            ];
        }
        return [
            'ok' => true,
            'data' => [
                "user" => $user,
                "token" => $user->createToken($inputs['user-agent'])->plainTextToken
            ],
            'message' => 'login successfully'
        ];
    }

    public function logoutUser()
    {
        auth()->user()->currentAccessToken()->delete();
        return [
            'ok' => true,
            'message' => 'You have successfully logged out.'
        ];
    }

    private function findUserByEmail($email)
    {
        return User::query()->where('email', $email)->first();
    }
}

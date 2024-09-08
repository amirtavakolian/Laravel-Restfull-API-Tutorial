<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserRegistrationResource;
use App\Models\User;
use App\Services\Authentication\AuthService;
use App\Services\RestApi\ApiResponseFacade;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct(private AuthService $authService)
    {
    }

    public function store(StoreUserRequest $request)
    {
        $userRegistrationResult = $this->authService->registerUser($request->all());

        if (!$userRegistrationResult['ok']) {
            return ApiResponseFacade::withMessage($userRegistrationResult['message'])
                ->withStatus(500);
        }

        return ApiResponseFacade::withData(resolve(UserRegistrationResource::class, ['user' => $userRegistrationResult['data']]))
            ->withMessage($userRegistrationResult['message'])
            ->withStatus(200)
            ->build()
            ->response();
    }

    public function login(LoginUserRequest $request)
    {
        $userLoginResult = $this->authService->loginUser(array_merge($request->validated(), ["user-agent" => $request->userAgent()]));

        if (!$userLoginResult['ok']) {
            return ApiResponseFacade::withMessage($userLoginResult['message'])
                ->withStatus(404)
                ->build()
                ->response();
        }
        return ApiResponseFacade::withMessage($userLoginResult['message'])
            ->withData($userLoginResult['data'])
            ->withStatus(200)
            ->build()
            ->response();
    }

    public function logout()
    {
        $userLogoutResult = $this->authService->logoutUser();
        return ApiResponseFacade::withMessage($userLogoutResult['message'])
            ->withStatus(200)
            ->build()
            ->response();

    }
}

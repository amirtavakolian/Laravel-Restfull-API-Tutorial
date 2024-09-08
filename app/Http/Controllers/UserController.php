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
use OpenApi\Annotations as OA;

class UserController extends Controller
{

    public function __construct(private AuthService $authService)
    {
    }

    /*
    *
    * @OA\Get(          ==> a get request
    *
    * path="/api/users",               ==> the endpoint - url of the request
    * description="Get users list",
    * summary="Get list of users",    ==>
    *
    * @OA\Response(      ==> every info you need to put in doc about response | what response client will get when he sends request to this end point
    *
    * response=200,  ==> status code
    * description="list of all users."   ==> a brief description about the response
    *
    * @OA\JsonContent ==> use it to define the body of responses
    *
    * Ex: for index method we have a list of users in json which, first property is an array which contains items
    *     and each item of that like id, first_name, last_name &... has value, type & etc...
    *
    * Ex: we have a property called "meta" for pagination which it has data, type &...
    *     another property called "previous_link" & etc...
    *
    * we have to define this structure in our swagger document \:D/
    *
    * @OA\Property ==> define what data do you have in your response (define your json's schema) ==>
    * what properties do you have, what types do they have (array, string, int or...),
    *
    * Ex: here we have a data property which its object
    *     inside that object, we have a property which its type is array
    *
    * @OA\Items ==> define the items of the array
    *
    * @OA\Examples ==> you have define diffrent example values
    *
    * Ex: you need diffrent structures to show to your client developer ==>
    *     for admins we show all the data of users
    *     for writers we just show first and last name of users
    */

    /**
     * @OA\Get(
     *     path="/api/users",
     *     description="Get users list",
     *     summary="Get list of users",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="List of all users.",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="data",
     *                     type="array",
     *                     @OA\Items(
     *                         @OA\Property(
     *                             property="id",
     *                             type="integer",
     *                             nullable=false,
     *                             example=1
     *                         ),
     *                         @OA\Property(
     *                             property="first_name",
     *                             type="string",
     *                             nullable=false,
     *                             example="Amir"
     *                         )
     *                     )
     *                 )
     *             ),
     *             @OA\Examples(
     *                 example="result1",
     *                 summary="This is result 1",
     *                 value={"data":{"data":{{"id":1, "first_name":"amir 1"}}}}
     *             ),
     *             @OA\Examples(
     *                 example="result2",
     *                 summary="This is result 2",
     *                 value={"data":{"data":{{"id":2, "first_name":"amir 2"}}}}
     *             )
     *         )
     *     )
     * )
     */





    public function index()
    {
        return $this->authService->getAllUsers();
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

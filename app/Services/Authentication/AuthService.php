<?php

namespace App\Services\Authentication;

use App\Models\User;
use Exception;

class AuthService
{

    /*
        we have cut the logic of user authentication from UserController
        and put them in the service layer ==> UserService

        you can even use the action classes ==> search and read more about action classes.

        service layer - action class is awesome for logic of search which we usually
        put them in the index method of the controller.

        so the focus of controller is only on its responsibility:
        it connects the view and model + gets one request and return the response in json or blade

        so all the business logic are in the right place &
        every class is responsible to do its own responsibility only
    */

    /*
        in service layer, all the methods name must be related to the business.
        ==> so it will be clear what each method is doing

        Ex: wana create a new user ==> addNewUser() | RegisterUser()
    */

    public function registerUser(array $inputs)
    {
        // you can get request object instead of array $inputs
        // but i don't want to have dependency to request object.

        try {
            $user = User::query()->create($inputs);

        } catch (Exception $e) {

            // we use below structure to return data from service layer to controller.
            // you can even model it and make an object for returning service layer data
            // and you can create a builder for that :))

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
}

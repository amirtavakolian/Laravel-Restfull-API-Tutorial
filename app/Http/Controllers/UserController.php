<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /*
        two important questions:

        1) what each code is doing?

        2) is the logic of that code is in the right place/class?
           ( is it that class responsibility [to do that work / to have that logic?] )

        ------------------------------------------------------------

        the duty - responsibility of controller is creating a relation - connection between
        model and view + sending response to the client.

        but in this code, the controller contains logic of the works which are not its responsibility.

        so we have to put the codes in the right place/class till we can

         1- obey to Single Responsibility

         2- if our project get MPA(Multiple Page Application) in the future, and we want to have blade view,
            so there is no need to duplicate the logic of register, login & etc...
            -->
            if we want to make changes, we should change 2 places ==> logic is same but

        -------------------------------------------------------------

        so ==> create one class (UserService - or an action class) which contains logics of authentication or...
               & use it where ever you need the logics of authentication \:D/ **==

        so ==> there is no duplicate code | make changes easily | develop codes faster & easier.

        service layer - action class is awesome for logic of search which we usually
        put it in index method of the controller.
    */

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                "last_name" => "required|string|min:1|max:255",
                "password" => "required|string|min:8|max:255",
                'email' => 'required|string|email|max:255|unique:users',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $inputs = $validator->validated();
            $inputs['password'] = Hash::make($inputs['password']);

            $user = User::create($inputs);
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong. Try again later'], 500);
        }

        return response()->json(['message' => 'User created successfully', 'data' => $user], 200);
    }


}

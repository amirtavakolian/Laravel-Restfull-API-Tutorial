<?php

namespace App\Trait;

class ApiResponse
{
    protected function successResponse($data = [], $message = null, $status = 200)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    protected function errorResponse($data = [], $message = null, $status = 200)
    {
        return response()->json([
            'status' => 'error',
            'data' => $data,
            'message' => $message,
        ], $status);
    }
}

/*
you can use above methods for sending api responses

but, what if we want to add new parameters to the methods?
     what if we want to change the place of a parameter?

you have to make changes in lots of places in your project

*/

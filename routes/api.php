<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/response', function () {

    return response()->json([
        "message" => "successfully done",
        "data" => [
            "id" => 1,
            "first-name" => "Amir",
            "last-name" => "Tavakolian"
        ]
    ], 200);
});


// first parameter of json is our response's body

// seconde one is our response's status code ==> by default its 200

// 3th one is our response's header

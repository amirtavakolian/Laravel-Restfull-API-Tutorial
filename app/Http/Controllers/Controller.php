<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

// below annotations are about our document not a specific route or request
// OA ==> stands for Open Api
// Info() ==> its a method

/**
 * @OA\Info(
 *  title="My Documentation",
 *  version="1.0.0"
 * )
 * @OA\Tag(
 *  name="Users"
 * )
 */


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}

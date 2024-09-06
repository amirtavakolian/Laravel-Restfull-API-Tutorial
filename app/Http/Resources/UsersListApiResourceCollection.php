<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UsersListApiResourceCollection extends ResourceCollection
{

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {

        // check the codes in  ==> UserListsResource::collection

        return [
            'users' => $this->collection,  // here, all the articles will be sent to the client.
            "userss" => UserListsResource::collection($this->collection),
        ];

    }
}

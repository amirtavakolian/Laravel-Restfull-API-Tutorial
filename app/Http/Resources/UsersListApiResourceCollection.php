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
        // return parent::toArray($request);

        return [
            'users' => $this->collection,  // the collection which we passed is accessable by $this->collection
            "userss" => UserListsResource::collection($this->collection),
            // you can use resource api in resource collection to define the structure of each object in the collection.
        ];

        // you can even use like below
        return parent::collection($resource)->additional([
            'meta' => [
                'total' => $resource->count(),
            ],
        ]);

    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserListsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        // we can use api resource (json resource) ::collection method to support collections :D

        return [
            "name" => $this->name,
            "family" => $this->family
        ];
    }
}

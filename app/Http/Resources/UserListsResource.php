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
            "family" => $this->family,
            'articles' => $this->articles

            // $this->articles ==>  here, the laravel's serialization will be used
            // $this->articles->only(['name', 'family']) ==> you can limit the returned data using only in larvel serialization.
            // $appends, $hidden &... in models, are effect on serialization :D :P
            // you can even override the toArray() method in the models and write the structure of the data you want to return
            
            /*
            Ex:
            public function toArray(){
                return [
                    "id" => $this->id,
                    "name" => $this->name
                ]
            }
            
            but, using toArray structure will be implemented on the hole of our project 
            the api and the web so its not a good way to define our responses structure

            better to use api resources for structuring your responses

            */
            

            // you can even load articles like this ==> ['articles' => $this->whenLoaded('articles')]

            // you can even use api resource collection for articles
            // ==>
            // ArticlesApiResource::collection($this->articles)
            // ArticlesApiResource::collection($this->whenLoaded('articles'))

            // ArticlesApiResource::collection($this->whenLoaded('articles')->load('comments'))

        ];
    }
}

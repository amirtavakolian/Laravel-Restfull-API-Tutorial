<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        // return parent::toArray($request);  ==> this code will send all the users data

        // here you can define what data to return to the client + with what key:
        // Ex: i want to change "family" key to "last_name" | i want to change the format of created_at to format('m-d H:i:s')
        // read "why we need a good structure for our api responses" commit in 3-json-response-structure for more info.

        return [
            'id' => $this->id,
            'name' => ucfirst($this->name),
            'family' => $this->family,
            'email' => $this->email,
            'full_name' => $this->fullname,  // you can even use the accessors here :D
            'first_article' => new ArticleResource($this->articles->first()),
            'first_article_1' => $this->articles->first()
        ];

        // 'first_article' ==> here we have used api resources.
        // Api Resources doesn't care about what you have defined in $hidden, $appends &... properties in your models
        // only the above data you have defined will be sent to the client

        /*
         'first_article_1' ==> here we have used laravel's serialization

         so, $hidden, $appends &... other properties which we have defined in Article model will effect to the result
         because we have used laravel's serialization

        */

        /*
            Both Laravel API Resources and Laravel’s built-in serialization methods are used
            to transform your data into JSON, but they serve different purposes and offer different levels of control.

            # Laravel API Resources: each model, once api resources ==> it has more features for transforming data to JSON.

            Transformation Layer:
            Laravel API Resources provide a transformation layer between your Eloquent models and the JSON responses.
            This allows you to customize how your models and their relationships are represented in JSON.

            Granular Control:
            They offer fine-grained control over the JSON output, enabling you to include or exclude attributes conditionally,
            add meta-data, and format relationships in a specific way.

            Resource Collections:
            You can create resource collections to handle multiple models, which is useful for paginated responses
            and adding additional metadata like links.

            Customization:
            API Resources allow you to define how each attribute should be serialized, making it easier
            to maintain a consistent API response format.


            # Laravel Serialization:

            * Direct Conversion:
            Laravel’s built-in serialization methods, such as toJson() and toArray(),
            provide a straight-forward way to convert Eloquent models and collections to JSON.

            Ex: 'user' => $this->user->only() ==> with only() method u can limit the columns which you wana send to client.

            * Less Control:
            While these methods are simpler to use, they offer less control over the output.
            You can’t easily add conditional attributes or meta-data.

            * Quick and Easy:
            For simple use cases where you don’t need extensive customization,
            using toJson() or toArray() can be quicker and easier.


            # When to Use Each: it depends on what you want to do - your senario

            Use API Resources when you need more control over the JSON output,
            such as when building a public API where consistency and customization are important.

            Use Serialization Methods for simpler tasks where you just need to quickly convert models
            to JSON without much customization.



         */

    }
}

<?php

namespace App\Services\RestApi;

// a builder class for ApiResponse class
// instead of making object from ApiResponse class, make object from ApiResponseBuilder
// so, you can call the methods as a chain.

// finally, you should return an object from ApiResponse, because this builder is created for ApiResponse
// look like the query builder which you use where(), select(), orderBy() &... finally use get(), paginate(), all() &...
// you can even make an abstraction(abstract or interface) for ApiResponseBuilder

class ApiResponseBuilder
{

    private ApiResponse $response;

    public function __construct()
    {
        $this->response = new ApiResponse();

        // we create an object from ApiResponse
        // set its properties
        // finally, we return that object (properties are set) to the client
    }

    public function withMessage(string $message)
    {
        $this->response->setMessage($message);
        return $this;
    }

    public function withData(mixed $data)
    {
        $this->response->setData($data);
        return $this;
    }

    public function withStatus(int $status)
    {
        $this->response->setStatus($status);
        return $this;
    }

    public function withAppends(array $appends)
    {
        $this->response->setAppends($appends);
        return $this;
    }

    public function build(): ApiResponse
    {
        return $this->response;
    }
}

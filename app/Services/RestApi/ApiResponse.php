<?php

namespace App\Services\RestApi;

/*
if you want to use ApiResponse, you have to write below code everywhere you need to send response:
==> not a clean code :))


$user = User:create([]);

$response = new ApiResponse();  // or using service container (resolve or inject to controller)
$response->setMessage('test message');
$response->setData($user);
return $response->response();


# so, create a builder class for ApiResponse

*/

class ApiResponse
{
    private string $message;
    private mixed $data = null;
    private int $status = 200;
    private array $appends = []; // you can add extra data here. Ex: data of the payment

    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    public function setData(mixed $data)
    {
        $this->data = $data;
    }

    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    public function setAppends(array $appends)
    {
        $this->appends = $appends;
    }

    public function response()
    {
        $body = [];
        !is_null($this->message) && $body['message'] = $this->message;
        !is_null($this->data) && $body['data'] = $this->data;
        $body = $body + $this->appends;
        return response()->json($body, $this->status);
    }
}

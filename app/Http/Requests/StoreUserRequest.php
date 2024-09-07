<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class StoreUserRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            "family" => "required|string|min:1|max:255",
            "password" => "required|string|min:3|max:255",
            'email' => 'required|string|email|max:255',
        ];
    }

    protected function passedValidation()
    {
        $this->merge([
            'password' => Hash::make($this->password)
        ]);
    }
}

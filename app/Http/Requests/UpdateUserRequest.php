<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends BaseRequest
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
            "name" => "required|min:4|max:255",
            "email" => ["required","email", Rule::unique('users', 'email')->ignore($this->user)],
            "password" => "min:4",
        ];
    }

    protected function passedValidation()
    {
        if ($this->input('password')) {
            $this->merge([
                'password' => Hash::make($this->input('password'))
            ]);
        }
    }
}



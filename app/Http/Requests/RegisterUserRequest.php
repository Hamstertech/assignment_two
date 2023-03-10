<?php

namespace App\Http\Requests;

use App\Rules\TokenMatch;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'data.name' => 'required|string',
            'data.email' => 'required|email|string|unique:users,email',
            'data.password' => [
                'required',
                'confirmed',
                Password::min(4)
                // Password::min(8)->mixedCase()->numbers()->symbols(),
            ],
            'data.token' => [
                'required',
                'integer',
                new TokenMatch,
            ],
        ];
    }
}

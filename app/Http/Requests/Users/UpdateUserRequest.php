<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Change to your authorization logic if needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'sometimes|string|max:255',
            'password' => 'sometimes|string|min:8',
            'email' => 'sometimes|email|unique:users,email,' . $this->user->id,
            'is_active' => 'boolean',
        ];
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'username.sometimes' => 'The username is optional but must be a string.',
            'password.sometimes' => 'The password is optional but must be at least 8 characters long.',
            'email.sometimes' => 'The email is optional but must be valid.',
            'email.unique' => 'This email is already in use.',
            'is_active.boolean' => 'The is_active field must be true or false.',
        ];
    }
}

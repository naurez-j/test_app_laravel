<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'email' => 'required|email|unique:users,email',
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
            'username.required' => 'The username is required.',
            'password.required' => 'The password is required and must be at least 8 characters long.',
            'email.required' => 'The email is required and must be a valid email address.',
            'email.unique' => 'This email is already in use.',
            'is_active.boolean' => 'The is_active field must be true or false.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Set to true if all authenticated users are allowed to update posts.
        // Adjust this logic as needed for your application's authorization rules.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'is_liked' => 'nullable|boolean',
        ];
    }

    /**
     * Customize the validation error messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required when updating.',
            'title.max' => 'The title must not exceed 255 characters.',
            'description.required' => 'The description field is required when updating.',
        ];
    }
}

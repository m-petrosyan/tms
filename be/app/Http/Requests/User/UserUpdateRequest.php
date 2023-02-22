<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['nullable', 'min:2'],
            'email' => ['nullable', 'email', 'unique:users,email,'.auth()->id(), 'max:100'],
            'password' => ['nullable', Password::min('8')],
        ];
    }
}

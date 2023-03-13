<?php

namespace App\Http\Requests\Task;

use App\Enum\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class TaskCreateRequest extends FormRequest
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
            'title' => ['required', 'min:2'],
            'description' => ['min:8'],
            'status' => ['numeric', new Enum(StatusEnum::class)],
            'img' => ['nullable', 'mimes:jpeg,jpg,bmp,png,webp', 'max:5000'],
        ];
    }
}

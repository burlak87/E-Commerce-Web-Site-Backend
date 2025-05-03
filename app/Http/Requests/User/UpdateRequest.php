<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user.first_name' => 'sometimes|string',
            'user.last_name' => 'sometimes|string',
            'user.role' => 'sometimes|string',
            'user.phone' => 'sometimes|string',
            'user.email' => 'sometimes|email|unique:users,email,' . $this->user()->id,
            'user.password' => 'nullable|string|min:8'
        ];
    }
}

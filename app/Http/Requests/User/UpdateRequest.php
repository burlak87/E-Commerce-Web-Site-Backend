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
            'user.first_name' => 'sometimes|string|max:50',
            'user.lost_name' => 'sometimes|string|max:50',
            'user.role' => 'sometimes|string|max:255',
            'user.phone' => 'sometimes|string|max:255',
            'user.email' => 'sometimes|email|max:255|unique:users,email',
            'user.password_hash' => 'sometimes',
        ];
    }
}

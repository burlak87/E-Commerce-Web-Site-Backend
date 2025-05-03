<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user.first_name' => 'required|string',
            'user.last_name' => 'required|string',
            'user.phone' => 'required|string',
            'user.email' => 'required|email|unique:users,email',
            'user.password' => 'required|string|min:8',
        ];
    }
}

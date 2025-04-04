<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class DestroyAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('address')->user->id === auth()->id();
    }

    public function rules(): array
    {
        return [];
    }
}

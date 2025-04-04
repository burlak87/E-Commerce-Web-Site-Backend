<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('cart')->user->id === auth()->id();
    }

    public function rules(): array
    {
        return [];
    }
}

<?php

namespace App\Http\Requests\CartItem;

use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('cart_item')->user->id === auth()->id();
    }

    public function rules(): array
    {
        return [];
    }
}

<?php

namespace App\Http\Requests\CartItem;

use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        $cartItem = $this->route('cartItem');
        return $cartItem && $cartItem->cart && $cartItem->cart->user_id === auth()->id(); 
    }

    public function rules(): array
    {
        return [];
    }
}

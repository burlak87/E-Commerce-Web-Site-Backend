<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        $cart = $this->route('cart');
        return $cart && $cart->user_id === auth()->id(); 
    }

    public function rules(): array
    {
        return [];
    }
}

<?php

namespace App\Http\Requests\CartItem;

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
            'item.quantity' => 'required|integer',
            'cart.id' => 'required|integer',
            'product.id' => 'required|integer',
        ];
    }
}

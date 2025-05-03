<?php

namespace App\Http\Requests\WishlistItem;

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
            'wishlist.id' => 'required|integer',
            'product.id' => 'required|integer',
        ];
    }
}

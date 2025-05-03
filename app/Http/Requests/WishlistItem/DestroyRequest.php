<?php

namespace App\Http\Requests\WishlistItem;

use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        $wishlistItem = $this->route('wishlistItem');
        return $wishlistItem && $wishlistItem->wishlist && $wishlistItem->wishlist->user_id === auth()->id(); 
    }

    public function rules(): array
    {
        return [];
    }
}

<?php

namespace App\Http\Requests\Wishlist;

use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        $wishlist = $this->route('wishlist');
        return $wishlist && $wishlist->user_id === auth()->id(); 
    }
    public function rules(): array
    {
        return [];
    }
}

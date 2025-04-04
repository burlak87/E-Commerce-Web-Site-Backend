<?php

namespace App\Http\Requests\Wishlist;

use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('wishlist')->user->id === auth()->id();
    }
    public function rules(): array
    {
        return [];
    }
}

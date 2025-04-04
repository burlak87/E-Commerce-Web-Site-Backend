<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('product')->user->id === auth()->id();
    }

    public function rules(): array
    {
        return [];
    }
}

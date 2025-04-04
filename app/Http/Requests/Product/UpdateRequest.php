<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('product')->user->id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|max:2048',
            'price' => 'sometimes|integer',
            'stock_quantity' => 'sometimes|integer',
            'image_url' => 'sometimes|string|max:1024',
            'color' => 'sometimes|string|max:255',
            'size' => 'sometimes|string|max:16',
            'category' => 'sometimes|string|max:16',
            'type_product' => 'sometimes|string|max:255',
            'dress_style' => 'sometimes|string|max:255',
        ];
    }
}

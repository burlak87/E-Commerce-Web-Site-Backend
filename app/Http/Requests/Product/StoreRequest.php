<?php

namespace App\Http\Requests\Product;

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
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:2048',
            'price' => 'required|integer',
            'stock_quantity' => 'required|integer',
            'image_url' => 'required|string|max:1024',
            'color' => 'required|string|max:255',
            'size' => 'required|string|max:16',
            'category' => 'required|string|max:16',
            'type_product' => 'required|string|max:255',
            'dress_style' => 'required|string|max:255',
        ];
    }
}

<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'string|max:255',
            'description' => 'string|max:2048',
            'price' => 'integer',
            'stock_quantity' => 'integer',
            'image_url' => 'string|max:1024',
            'color' => 'string|max:255',
            'size' => 'string|max:16',
            'category' => 'string|max:16',
            'type_product' => 'string|max:255',
            'dress_style' => 'string|max:255',
        ];
    }
}

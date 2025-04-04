<?php

namespace App\Http\Requests\OrderItem;

use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('order_item')->user->id === auth()->id();
    }

    public function rules(): array
    {
        return [];
    }
}

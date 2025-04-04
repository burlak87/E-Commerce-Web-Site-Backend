<?php

namespace App\Http\Requests\MyOrders;

use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('my-orders')->user->id === auth()->id();
    }

    public function rules(): array
    {
        return [];
    }
}

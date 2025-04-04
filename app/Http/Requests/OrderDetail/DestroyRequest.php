<?php

namespace App\Http\Requests\OrderDetail;

use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('order-detail')->user->id === auth()->id();
    }

    public function rules(): array
    {
        return [];
    }
}

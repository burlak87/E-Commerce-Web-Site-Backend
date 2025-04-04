<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
{

    public function authorize(): bool
    {
        return $this->route('address')->user->id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'country' => 'sometimes|string|max:255',
            'company' => 'sometimes|string|max:255',
            'street' => 'sometimes|string|max:2048',
            'house' => 'sometimes|integer',
            'apartment' => 'sometimes|integer',
            'city' => 'sometimes|string|max:255',
            'state' => 'sometimes|string|max:255',
            'postal_code' => 'sometimes|integer',
            'delivery_instruction' => 'sometimes|string|max:2048'
        ];
    }
}
